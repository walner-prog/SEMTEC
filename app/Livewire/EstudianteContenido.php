<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Actividad;
use App\Models\Intento;
use App\Models\Revision;
use Illuminate\Support\Facades\Auth;

class EstudianteContenido extends Component
{
    public $actividades = [];
    public $actividadSeleccionada = null;
    public $items = [];
    public $itemIndex = 0;
    public $respuesta = null;
    public $intentoId = null;
    public $mostrarModal = false;
    public $esCronometro = false;
    public $tiempoRestante = null;
    public $actividadFinalizada = false;
    public $respuestasCorrectas = 0;
    public $respuestasIncorrectas = 0;
    public $pistaIA = null;
    public $explicacionIA = null;

    public $puntajeFinal = 0;
    public $accesibilidad = [
        'tts' => false, 
        'isn' => false,  
    ];
    public $fontSize = 16;  
    public $highContrast = false;  

   public function mount()
{
    $user = Auth::user();

    $this->actividades = Actividad::with('indicador.competencia.unidad.grado')
        ->whereHas('indicador.competencia.unidad.grado', function ($q) use ($user) {
            $q->whereIn('id', $user->grados->pluck('id'));
        })
        // Solo actividades que el estudiante aún no ha revisado
        ->whereDoesntHave('intentos', function ($q) use ($user) {
            $q->where('user_id', $user->id)       // solo sus intentos
              ->whereHas('revision', function($q2) {
                  $q2->where('revisado', true);  // revisados
              });
        })
        ->get();
}

    public function leerEnunciado()
    {
        $enunciado = $this->items[$this->itemIndex]['enunciado'];
        $this->dispatch('tts', text: $enunciado);
    }
 
    public function aumentarFont()
    {
        $this->fontSize = min($this->fontSize + 2, 36);
    }

    public function disminuirFont()
    {
        $this->fontSize = max($this->fontSize - 2, 12);
    }
    public function toggleHighContrast()
    {
        $this->highContrast = !$this->highContrast;
    }

    public function generarPista()
{
    $item = $this->items[$this->itemIndex] ?? null;
    if (!$item) return;

    $this->pistaIA = $this->consultarIA("Dame una pista para esta pregunta, sin revelar la respuesta, breve y sencilla, 
    lenguaje para primaria [6-12 años]: {$item['enunciado']}");
}

public function pedirExplicacion()
{
    $item = $this->items[$this->itemIndex] ?? null;
    if (!$item) return;

    $this->explicacionIA = $this->consultarIA("Explica de manera sencilla esta pregunta para estudiantes de primaria [6-12 años], 
    sin revelar la respuesta correcta, con ejemplos simples y paso a paso si es matemáticas: {$item['enunciado']}");
}

private function consultarIA($input)
{
    $client = new \GuzzleHttp\Client();
    $response = $client->post('https://api.openai.com/v1/chat/completions', [
        'headers' => [
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'model' => 'gpt-4o',
            'messages' => [
                ['role' => 'user', 'content' => $input],
            ],
        ],
    ]);

    $result = json_decode($response->getBody(), true);
    return $result['choices'][0]['message']['content'] ?? 'No hay respuesta';
}


    public function abrirActividad($id)
    {
        $this->actividadSeleccionada = Actividad::with('items')->findOrFail($id);
        $this->items = $this->actividadSeleccionada->items->sortBy('orden')->values()->toArray();
        $this->itemIndex = 0;
        $this->respuesta = null;
        $this->actividadFinalizada = false;

        // Accesibilidad
        $this->accesibilidad = json_decode($this->actividadSeleccionada->accesibilidad_flags, true) ?? $this->accesibilidad;

        // Cronómetro
        if ($this->actividadSeleccionada->tipo === 'cronometro' && $this->actividadSeleccionada->limite_tiempo) {
            $this->esCronometro = true;
            $this->tiempoRestante = $this->actividadSeleccionada->limite_tiempo * 60; // minutos → segundos
        }

        // Crear intento
        $intento = Intento::create([
            'actividad_id' => $this->actividadSeleccionada->id,
            'user_id' => Auth::id(),
            'inicio' => now(),
            'aciertos' => 0,
            'errores' => 0,
            'puntaje' => 0,
        ]);

        $this->intentoId = $intento->id;
        $this->mostrarModal = true;
    }


    public function siguienteItem()
    {
        $item = $this->items[$this->itemIndex];
        $intento = Intento::find($this->intentoId);
        $intento->item_id = $item['id'];

        // Validar respuesta contra la correcta
        if (isset($item['respuesta']) && $this->respuesta !== null) {
            if ($this->respuesta == $item['respuesta']) {
                $intento->aciertos++;
            } else {
                $intento->errores++;
            }
        }

        $intento->save();

        $this->respuesta = null;
    $this->pistaIA = null;         // limpiar pista
    $this->explicacionIA = null;
    
        $this->respuesta = null;

        // Avanzar o finalizar
        if ($this->itemIndex < count($this->items) - 1) {
            $this->itemIndex++;
        } else {
            $this->finalizarActividad();
        }
    }

    public function finalizarActividad()
    {
        $intento = Intento::find($this->intentoId);
        $intento->fin = now();

        // Calcular puntaje porcentual
        $total = $intento->aciertos + $intento->errores;
        if ($total > 0) {
            $intento->puntaje = round(($intento->aciertos / $total) * 100, 2);
        }
        $intento->save();

        // Crear revisión automática
        $docenteId = $this->actividadSeleccionada
            ->indicador
            ->competencia
            ->unidad
            ->grado
            ->docente_id ?? 4;

        Revision::create([
            'intento_id' => $intento->id,
            'docente_id' => $docenteId,
            'revisado' => true,
            'retroalimentacion' => 'Revisión automática del sistema',
            'calificacion' => $intento->puntaje,
            'fecha_revision' => now()
        ]);

        // 🔹 Guardar resultados en propiedades
        $this->respuestasCorrectas = $intento->aciertos;
        $this->respuestasIncorrectas = $intento->errores;
        $this->puntajeFinal = $intento->puntaje;
        $this->actividadFinalizada = true;
        $this->mount(); // Recargar actividades para actualizar estado
    }

    public function cerrarModal()
    {
        $this->mostrarModal = false;
        $this->reset([
            'actividadSeleccionada',
            'items',
            'itemIndex',
            'respuesta',
            'intentoId',
            'esCronometro',
            'tiempoRestante',
            'actividadFinalizada',
            'respuestasCorrectas',
            'respuestasIncorrectas',
            'puntajeFinal'
        ]);
        $this->mount(); // Recargar actividades
    }

    public function render()
    {
        return view('livewire.estudiante-contenido');
    }
}
