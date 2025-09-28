<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Juego;
use App\Models\UsuarioJuego;
use App\Models\Logro;
use App\Models\Recompensa;
use App\Models\EstadisticaUsuario;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\ReaccionJuego;
use GuzzleHttp\Client;

class Juegos extends Component
{
    public $puntos = 0;
    public $monedas = 0;
    public $trofeos = 0;

    public $modalAbierto = false;
    public $juegoSeleccionado;
    public $preguntas = [];
    public $indicePregunta = 0;
    public $puntajeActual = 0;
    public $mensajeMotivador = '';
    public $pistaIA = '';
    public $explicacionIA = '';
    public $respuestaCorrecta = null;
    public $mensajeFinal = '';


    protected $listeners = ['abrirJuego' => 'abrirJuego'];

    public function mount()
    {
        $user = Auth::user();
        $estadisticas = EstadisticaUsuario::firstOrCreate(
            ['user_id' => $user->id],
            ['puntos' => 0, 'monedas' => 0, 'trofeos' => 0]
        );

        $this->puntos = $estadisticas->puntos;
        $this->monedas = $estadisticas->monedas;
        $this->trofeos = $estadisticas->trofeos;
    }

   public function render()
{
    $user = Auth::user();

    // Traemos todos los juegos con sus contadores
    $juegos = Juego::withCount([
        'reacciones as me_gusta_count' => fn($q) => $q->where('tipo', 'me_gusta'),
        'reacciones as corazon_count' => fn($q) => $q->where('tipo', 'corazon')
    ]);

    // Si el usuario es estudiante, filtramos por nivel
    if ($user->hasRole('Estudiante')) {
        $matricula = $user->matriculas()->latest()->first();
        $nivel = $matricula?->grado; // el grado del estudiante corresponde al nivel del juego

        if ($nivel) {
            $juegos = $juegos->where('nivel', $nivel);
        }
    }

    $juegos = $juegos->get();

    $juegosDisponibles = $juegos->where('bloqueado', false);
    $juegosBloqueados  = $juegos->where('bloqueado', true);

    return view('livewire.juegos', [
        'juegosDisponibles' => $juegosDisponibles,
        'juegosBloqueados'  => $juegosBloqueados,
        'user' => $user
    ]);
}




    public function abrirJuego($juegoId)
    {
        $this->juegoSeleccionado = Juego::with('preguntas')->findOrFail($juegoId);
        $this->preguntas = $this->juegoSeleccionado->preguntas()
            ->inRandomOrder()
            ->take(10)
            ->get()
            ->toArray();
        $this->indicePregunta = 0;
        $this->puntajeActual = 0;
        $this->mensajeMotivador = '';
        $this->pistaIA = '';
        $this->explicacionIA = '';
        $this->modalAbierto = true;
    }

    public function responder($respuesta)
    {
        $pregunta = $this->preguntas[$this->indicePregunta];
        $totalPreguntas = count($this->preguntas);

        if ($respuesta === $pregunta['respuesta_correcta']) {
            $this->puntajeActual += 2;
            $this->respuestaCorrecta = true;
        } else {
            $this->respuestaCorrecta = false;
        }

        // Progreso actual
        $preguntasRespondidas = $this->indicePregunta + 1;
        $porcentaje = ($this->puntajeActual / ($totalPreguntas * 2)) * 100;

        // 🎯 Mensajes dinámicos por rango
        if ($this->respuestaCorrecta) {
            if ($porcentaje >= 80) {
                $mensajes = [
                    "🔥 ¡Imparable! Ya llevas {$this->puntajeActual} puntos.",
                    "🏆 Estás arrasando, sigue así.",
                    "✨ Excelente, no hay quien te pare."
                ];
            } elseif ($porcentaje >= 50) {
                $mensajes = [
                    "💪 Muy bien, llevas {$this->puntajeActual} puntos.",
                    "👏 Estás en buen camino, sigue concentrado.",
                    "✅ Correcto, cada vez mejor."
                ];
            } else {
                $mensajes = [
                    "👌 ¡Correcto! Ya tienes {$this->puntajeActual} puntos.",
                    "🚀 Vas sumando, sigue adelante.",
                    "👍 Bien hecho, confía en ti."
                ];
            }
        } else {
            if ($porcentaje < 30) {
                $mensajes = [
                    "😅 Tranquilo, apenas estás empezando. ¡Tú puedes!",
                    "🌱 No pasa nada, recién calientas motores.",
                    "🙂 Ánimo, que lo bueno empieza ahora."
                ];
            } elseif ($porcentaje < 60) {
                $mensajes = [
                    "🙌 No pasa nada, aún puedes remontar. Llevas {$this->puntajeActual} puntos.",
                    "🔄 Aprende del error y sigue adelante.",
                    "💡 Concéntrate, seguro la siguiente es tuya."
                ];
            } else {
                $mensajes = [
                    "🤔 Casi, pero no te desanimes. Ya tienes {$this->puntajeActual} puntos.",
                    "💪 Un tropiezo no es el final, sigue fuerte.",
                    "😉 No pasa nada, estás muy cerca."
                ];
            }
        }

        // ✅ Escoger mensaje aleatorio
        $this->mensajeMotivador = $mensajes[array_rand($mensajes)];

        // Avanzar pregunta
        $this->indicePregunta++;
        $this->pistaIA = '';
        $this->explicacionIA = '';

        if ($this->indicePregunta >= $totalPreguntas) {
            $this->jugar($this->puntajeActual);
        }
    }


    public function generarPista()
    {
        if ($this->indicePregunta < count($this->preguntas)) {
            $pregunta = $this->preguntas[$this->indicePregunta];
            $this->pistaIA = $this->consultarIA("Dame una pista para esta pregunta te aclaro los detalles 
            1. No reveles la respuesta correcta
            2. Se breve
            3. Usa un lenguaje sencillo
            4. No uses emojis
            5. Son preguntas de estudiantes de primaria [6 a 12 años max 13 años de nicaragua]
            6. No uses jerga técnica
            7. Puedes usar ejemplos sencillos para explicar mejor la pista
            : {$pregunta['enunciado']}");
        }
    }

    public function pedirExplicacion()
    {
        $pregunta = $this->preguntas[$this->indicePregunta] ?? null;
        if (!$pregunta) return;

        $this->explicacionIA = $this->consultarIA("Explica de manera sencilla la respuesta correcta para 
        
        te aclaro los detalles 
            1. No reveles la respuesta correcta
            2. Se breve
            3. Usa un lenguaje sencillo
            4. NO Uses emojis
            5. Son preguntas de estudiantes de primaria [6 a 12 años max 13 años de nicaragua]
            6. No uses jerga técnica
            7. Puedes usar ejemplos sencillos para explicar mejor la pista
            8. Explica por qué las otras opciones son incorrectas
            9. Si la pregunta es de matemáticas, explica paso a paso pero claro y breve  como se llega a la respuesta correcta
            
        
        : {$pregunta['enunciado']}");
    }




    private function consultarIA($input)
    {
        $client = new Client();
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

    public function jugar($puntajeObtenido)
    {
        $user = Auth::user();
        $juego = $this->juegoSeleccionado;

        $usuarioJuego = UsuarioJuego::firstOrNew([
            'user_id' => $user->id,
            'juego_id' => $juego->id,
        ]);
        $usuarioJuego->intentos = ($usuarioJuego->intentos ?? 0) + 1;
        $usuarioJuego->puntaje = $puntajeObtenido;
        $usuarioJuego->ultima_partida = Carbon::now();
        $usuarioJuego->completado = true;
        $usuarioJuego->save();

        // logros y recompensas
        foreach ($juego->logros as $logro) {
            if ($puntajeObtenido >= $logro->puntos_requeridos) {
                $user->logros()->syncWithoutDetaching([$logro->id => ['fecha_obtenido' => Carbon::now()]]);
            }
        }

        $recompensas = Recompensa::where('puntos_requeridos', '<=', $puntajeObtenido)->get();
        foreach ($recompensas as $recompensa) {
            $user->recompensas()->syncWithoutDetaching([$recompensa->id => ['fecha' => Carbon::now()]]);
        }

        $estadisticas = EstadisticaUsuario::firstOrCreate(
            ['user_id' => $user->id],
            ['puntos' => 0, 'monedas' => 0, 'trofeos' => 0]
        );
        $estadisticas->puntos += $puntajeObtenido;
        $estadisticas->monedas += intval($puntajeObtenido / 2);
        if ($puntajeObtenido >= 80) $estadisticas->trofeos += 1;
        $estadisticas->save();

        $this->puntos = $estadisticas->puntos;
        $this->monedas = $estadisticas->monedas;
        $this->trofeos = $estadisticas->trofeos;

        // desbloquear juegos
        Juego::where('bloqueado', true)
            ->where(fn($q) => $q->where('requisito_puntos', '<=', $estadisticas->puntos)
                ->orWhere('requisito_monedas', '<=', $estadisticas->monedas)
                ->orWhere('requisito_trofeos', '<=', $estadisticas->trofeos))
            ->update(['bloqueado' => false]);


        if ($puntajeObtenido >= 18) {
            $this->mensajeFinal = "¡Excelente! Has completado el juego con {$puntajeObtenido} puntos. 🎉 ademas recuerda que los puntos que vas ganando te acercan a nuevas recompensas. Tambien podras desbloquear otros juegos";
        } elseif ($puntajeObtenido >= 14) {
            $this->mensajeFinal = "¡Has completado el juego con {$puntajeObtenido} puntos ! 🎉 ademas recuerda que los puntos que vas ganando te acercan a nuevas recompensas. Tambien podras desbloquear otros juegos";
        } elseif ($puntajeObtenido >= 10) {
            $this->mensajeFinal = "Has terminado el juego con {$puntajeObtenido} puntos. ¡Puedes mejorar! 💪 ademas recuerda que los puntos que vas ganando te acercan a nuevas recompensas. Tambien podras desbloquear otros juegos";
        } elseif ($puntajeObtenido >= 6) {
            $this->mensajeFinal = "Has terminado el juego con {$puntajeObtenido} puntos. ¡Sigue intentándolo! 😊 ademas recuerda que los puntos que vas ganando te acercan a nuevas recompensas. Tambien podras desbloquear otros juegos";
        } else {
            $this->mensajeFinal = "Has terminado el juego con {$puntajeObtenido} puntos. ¡No te rindas! 🚀";
        }

        $this->modalAbierto = false;
        session()->flash('create', "¡Partida finalizada! {$this->mensajeFinal}");
    }

    public function cerrarModal()
    {
        $this->modalAbierto = false;
    }

    public function reaccionar($juegoId, $tipo)
    {
        $user = Auth::user();

        $reaccion = ReaccionJuego::where('user_id', $user->id)
            ->where('juego_id', $juegoId)
            ->first();

        if ($reaccion && $reaccion->tipo === $tipo) {
            $reaccion->delete();
        } else {
            ReaccionJuego::updateOrCreate(
                ['user_id' => $user->id, 'juego_id' => $juegoId],
                ['tipo' => $tipo]
            );
        }
    }
}
