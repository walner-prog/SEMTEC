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
use Illuminate\Support\Facades\DB;





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
    public $categoriaSeleccionada = null;
    public $modalResumenAbierto = false;
    public $resumenDatos = [];



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

        // Determinar nivel del estudiante
        $nivel = null;
        if ($user->hasRole('Estudiante')) {
            $matricula = $user->matriculas()->latest()->first();
            $nivel = $matricula?->grado;
        }

        // Traer los juegos con conteo de reacciones
        $juegosQuery = Juego::withCount([
            'reacciones as me_gusta_count' => fn($q) => $q->where('tipo', 'me_gusta'),
            'reacciones as corazon_count' => fn($q) => $q->where('tipo', 'corazon')
        ]);

        // Filtrar por nivel
        if ($nivel) {
            $juegosQuery->where('nivel', $nivel);
        }

        // Filtrar por categoría seleccionada
        if ($this->categoriaSeleccionada) {
            $juegosQuery->where('categoria', $this->categoriaSeleccionada);
        }

        $juegos = $juegosQuery->get();

        // Traer progreso del usuario en los juegos
        $usuarioJuegos = UsuarioJuego::where('user_id', $user->id)
            ->get()
            ->keyBy('juego_id');

        foreach ($juegos as $juego) {
            $progreso = $usuarioJuegos->get($juego->id);

            $juego->ya_jugado = (bool) $progreso;
            $juego->puntaje_usuario = $progreso->puntaje ?? 0;
            $juego->racha_actual = $progreso->racha_actual ?? 0;
            $juego->racha_maxima = $progreso->racha_maxima ?? 0;
            $juego->dias_jugados = $progreso->dias_jugados ?? 0;

            // Logros obtenidos por el usuario en este juego
            $juego->logros_obtenidos = $user->logros()
                ->wherePivot('juego_id', $juego->id)
                ->get();
        }

        $juegosDisponibles = $juegos->where('bloqueado', false);
        $juegosBloqueados = $juegos->where('bloqueado', true);

        // Categorías filtradas por nivel del estudiante
        $categoriasQuery = Juego::select('categoria')->distinct();
        if ($nivel) {
            $categoriasQuery->where('nivel', $nivel);
        }
        $categorias = $categoriasQuery->pluck('categoria');

        return view('livewire.juegos', [
            'juegosDisponibles' => $juegosDisponibles,
            'juegosBloqueados' => $juegosBloqueados,
            'categorias' => $categorias,
            'user' => $user,
        ]);
    }



    // 🔹 Método para seleccionar categoría
    public function filtrarPorCategoria($categoria)
    {
        $this->categoriaSeleccionada = $categoria;
    }

    // 🔹 Método para limpiar filtro
    public function limpiarFiltro()
    {
        $this->categoriaSeleccionada = null;
    }


    public function abrirJuego($juegoId)
    {
        $user = Auth::user();

        // 🔹 Cargar el juego con sus preguntas
        $this->juegoSeleccionado = Juego::with('preguntas')->findOrFail($juegoId);

        // 🔹 Logros obtenidos
        $this->juegoSeleccionado->logros_obtenidos = $user->logros()
            ->wherePivot('juego_id', $this->juegoSeleccionado->id)
            ->get() ?? collect();

        // 🔹 Cargar preguntas aleatorias
        $this->preguntas = $this->juegoSeleccionado->preguntas()
            ->inRandomOrder()
            ->take(10)
            ->get()
            ->toArray();

        // 🔹 Progreso del usuario
        $usuarioJuego = UsuarioJuego::firstOrCreate([
            'user_id' => $user->id,
            'juego_id' => $juegoId,
        ]);

        $this->juegoSeleccionado->racha_actual = $usuarioJuego->racha_actual ?? 0;
        $this->juegoSeleccionado->racha_maxima = $usuarioJuego->racha_maxima ?? 0;
        $this->juegoSeleccionado->dias_jugados = $usuarioJuego->dias_jugados ?? 0;

        // 🔹 Reiniciar estado del componente
        $this->indicePregunta = 0;
        $this->puntajeActual = 0;
        $this->mensajeMotivador = '';
        $this->pistaIA = '';
        $this->explicacionIA = '';
        $this->modalAbierto = true;

        // 🔹 Actualizar racha si juega hoy
        $hoy = Carbon::today();
        $ultima = $usuarioJuego->ultima_partida ? Carbon::parse($usuarioJuego->ultima_partida)->startOfDay() : null;

        if (!$ultima || $ultima->lt($hoy)) {
            if ($ultima && $ultima->diffInDays($hoy) === 1) {
                $usuarioJuego->racha_actual += 1;
                $usuarioJuego->racha_maxima = max($usuarioJuego->racha_maxima, $usuarioJuego->racha_actual);
            } else {
                $usuarioJuego->racha_actual = 1;
            }
            $usuarioJuego->dias_jugados = ($usuarioJuego->dias_jugados ?? 0) + 1;
            $usuarioJuego->ultima_partida = now();
            $usuarioJuego->save();

            // 🔹 Actualizar propiedades del componente para mostrar en modal
            $this->juegoSeleccionado->racha_actual = $usuarioJuego->racha_actual;
            $this->juegoSeleccionado->racha_maxima = $usuarioJuego->racha_maxima;
            $this->juegoSeleccionado->dias_jugados = $usuarioJuego->dias_jugados;
        }
    }



    public function diasDesdeUltimaPartida($juegoId)
    {
        $registro = \App\Models\UsuarioJuego::where('user_id', Auth::id())
            ->where('juego_id', $juegoId)
            ->first();

        if (!$registro || !$registro->ultima_partida) {
            return 'Primera vez jugando';
        }

        return \Carbon\Carbon::parse($registro->ultima_partida)->diffForHumans();
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


        $preguntasRespondidas = $this->indicePregunta + 1;
        $porcentaje = ($this->puntajeActual / ($totalPreguntas * 2)) * 100;

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

        DB::transaction(function () use ($user, $juego, $puntajeObtenido) {

            // 1️⃣ Registrar progreso del usuario en el juego
            $usuarioJuego = UsuarioJuego::firstOrNew([
                'user_id' => $user->id,
                'juego_id' => $juego->id,
            ]);

            $usuarioJuego->intentos = ($usuarioJuego->intentos ?? 0) + 1;
            $usuarioJuego->puntaje = $puntajeObtenido;
            $usuarioJuego->completado = true;

            // 🔹 Calcular rachas y días jugados
            $hoy = Carbon::today();
            $ultima = $usuarioJuego->ultima_partida ? Carbon::parse($usuarioJuego->ultima_partida)->startOfDay() : null;

            if (!$ultima || $ultima->lt($hoy)) {
                if ($ultima && $ultima->diffInDays($hoy) === 1) {
                    $usuarioJuego->racha_actual = ($usuarioJuego->racha_actual ?? 0) + 1;
                    $usuarioJuego->racha_maxima = max($usuarioJuego->racha_maxima ?? 0, $usuarioJuego->racha_actual);
                } else {
                    $usuarioJuego->racha_actual = 1;
                }
                $usuarioJuego->dias_jugados = ($usuarioJuego->dias_jugados ?? 0) + 1;
            }

            $usuarioJuego->ultima_partida = Carbon::now();
            $usuarioJuego->save();

            // 2️⃣ Logros obtenidos
            foreach ($juego->logros as $logro) {
                if ($puntajeObtenido >= $logro->puntos_requeridos) {
                    $user->logros()->syncWithoutDetaching([
                        $logro->id => [
                            'fecha_obtenido' => Carbon::now(),
                            'juego_id' => $juego->id
                        ]
                    ]);
                }
            }

            // 3️⃣ Recompensas obtenidas
            $recompensas = Recompensa::where('puntos_requeridos', '<=', $puntajeObtenido)->get();
            foreach ($recompensas as $recompensa) {
                $user->recompensas()->syncWithoutDetaching([
                    $recompensa->id => ['fecha' => Carbon::now()]
                ]);
            }

            // 4️⃣ Actualizar estadísticas globales
            $estadisticas = EstadisticaUsuario::firstOrCreate(
                ['user_id' => $user->id],
                ['puntos' => 0, 'monedas' => 0, 'trofeos' => 0]
            );

            $estadisticas->puntos += $puntajeObtenido;
            $estadisticas->monedas += intval($puntajeObtenido / 2);
            if ($puntajeObtenido >= 80) $estadisticas->trofeos += 1;
            $estadisticas->save();

            // 5️⃣ Desbloquear juegos según requisitos
            Juego::where('bloqueado', true)
                ->where(
                    fn($q) => $q
                        ->where('requisito_puntos', '<=', $estadisticas->puntos)
                        ->orWhere('requisito_monedas', '<=', $estadisticas->monedas)
                        ->orWhere('requisito_trofeos', '<=', $estadisticas->trofeos)
                )
                ->update(['bloqueado' => false]);

            // 6️⃣ Actualizar propiedades del componente
            $this->puntos = $estadisticas->puntos;
            $this->monedas = $estadisticas->monedas;
            $this->trofeos = $estadisticas->trofeos;

            $this->juegoSeleccionado->racha_actual = $usuarioJuego->racha_actual;
            $this->juegoSeleccionado->racha_maxima = $usuarioJuego->racha_maxima;
            $this->juegoSeleccionado->dias_jugados = $usuarioJuego->dias_jugados;

            $this->juegoSeleccionado->logros_obtenidos = $user->logros()
                ->wherePivot('juego_id', $this->juegoSeleccionado->id)
                ->get();
        });

        // 🔹 Mensaje final enriquecido
        $logrosObtenidos = $this->juegoSeleccionado->logros_obtenidos->pluck('nombre')->toArray();
        $recompensasObtenidas = Recompensa::where('puntos_requeridos', '<=', $puntajeObtenido)->pluck('descripcion')->toArray();

        // Mensaje base según puntaje
        if ($puntajeObtenido >= 18) {
            $mensajeBase = "¡Excelente! Has completado el juego con {$puntajeObtenido} puntos. 🎉";
        } elseif ($puntajeObtenido >= 14) {
            $mensajeBase = "¡Muy bien! Has completado el juego con {$puntajeObtenido} puntos. 🎉";
        } elseif ($puntajeObtenido >= 10) {
            $mensajeBase = "Terminaste el juego con {$puntajeObtenido} puntos. ¡Puedes mejorar! 💪";
        } elseif ($puntajeObtenido >= 6) {
            $mensajeBase = "Terminaste el juego con {$puntajeObtenido} puntos. ¡Sigue intentándolo! 😊";
        } else {
            $mensajeBase = "Has terminado el juego con {$puntajeObtenido} puntos. ¡No te rindas! 🚀";
        }

        $mensajeRacha = "Tu racha actual es de {$this->juegoSeleccionado->racha_actual} días, y tu racha máxima es {$this->juegoSeleccionado->racha_maxima} días.";
        $mensajeLogros = $logrosObtenidos ? "🎖️ Logros obtenidos: " . implode(', ', $logrosObtenidos) . "." : "";
        $mensajeRecompensas = $recompensasObtenidas ? "🎁 Recompensas desbloqueadas: " . implode(', ', $recompensasObtenidas) . "." : "";
        $mensajeEstadisticas = "Ahora tienes {$this->monedas} monedas y {$this->trofeos} trofeos en total.";

        $this->mensajeFinal = implode(" ", array_filter([$mensajeBase, $mensajeRacha, $mensajeLogros, $mensajeRecompensas, $mensajeEstadisticas]));

        $this->modalAbierto = false;
        session()->flash('create', "¡Partida finalizada! {$this->mensajeFinal}");

        // 🔹 Resetear solo lo necesario
        $this->reset('preguntas', 'indicePregunta', 'puntajeActual', 'mensajeMotivador', 'pistaIA', 'explicacionIA', 'respuestaCorrecta');
    }




    public function cerrarModal()
    {
        $this->modalAbierto = false;
        $this->reset('juegoSeleccionado', 'preguntas', 'indicePregunta', 'puntajeActual', 'mensajeMotivador', 'pistaIA', 'explicacionIA', 'respuestaCorrecta', 'mensajeFinal');
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
