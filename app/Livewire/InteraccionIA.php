<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class InteraccionIA extends Component
{
    public $modalAbierto = false;
    public $modalSugerencias = false;  
    public $mensaje = '';
    public $respuestaIA = '';
    public $cargando = false;

    protected $listeners = ['abrirModalIA' => 'abrirModal'];

    
    public function abrirModal($userId)
    {
        $this->modalAbierto = true;
        $this->respuestaIA = '';
        $this->mensaje = '';
    }

    public function cerrarModal()
    {
        $this->modalAbierto = false;
        $this->mensaje = '';
        $this->respuestaIA = '';
    }

   
    public function abrirModalSugerencias()
    {
        $this->modalSugerencias = true;
    }

    public function cerrarModalSugerencias()
    {
        $this->modalSugerencias = false;
    }
 
   public function enviarMensaje()
{
    if (empty($this->mensaje)) return;

    $this->cargando = true;

    $user = Auth::user()->load('intentos.actividad', 'juegos');
    $nombre = $user->name;

    
    $actividades = $user->intentos->map(fn($i) => $i->actividad?->nombre ?? 'Actividad sin nombre')->toArray();
    $actividadesStr = empty($actividades) 
        ? '<li>Ninguna</li>' 
        : implode('', array_map(fn($a) => "<li>$a</li>", $actividades));

    
    $juegosCompletados = $user->juegos->filter(fn($j) => $j->pivot->completado)
        ->map(fn($j) => "<li>{$j->nombre} (puntaje: {$j->pivot->puntaje})</li>")->toArray();
    $juegosStr = empty($juegosCompletados) ? '<li>Ninguno</li>' : implode('', $juegosCompletados);

   
    $promedioActividades = round($user->intentos->avg('puntaje') ?? 0, 2);
    $promedioJuegos = round($user->juegos->pluck('pivot.puntaje')->avg() ?? 0, 2);

     
    $contexto = "
    <strong>Estudiante:</strong> $nombre
    <ul>
        <li><strong>Actividades realizadas:</strong> <ul>$actividadesStr</ul></li>
        <li><strong>Juegos completados:</strong> <ul>$juegosStr</ul></li>
        <li><strong>Puntaje promedio en actividades:</strong> $promedioActividades</li>
        <li><strong>Puntaje promedio en juegos:</strong> $promedioJuegos</li>
        <li><strong>Recomendaciones anteriores:</strong> Ninguna</li>
    </ul>
    ";

    
    $reglas = "Reglas para la IA:
1. Responde usando lenguaje amigable, motivador y nicaragüense, nada técnico.
2. Siempre llama al estudiante por su nombre: $nombre.
3. Explica matemáticas usando ejemplos visuales, dibujos, frutas y lenguaje de señas.
4. Nunca reveles respuestas correctas; solo guía y sugiere.
5. Resume información clara y estructurada, usando emojis y listas para niños.
6. Refuerza la inclusión: cada explicación debe mostrar cómo usar el lenguaje de señas para aprender.
7. La primera interacción incluye un mensaje de bienvenida cordial.
8. Devuelve la respuesta en HTML simple (<ul>, <li>, <strong>, emojis) para que se vea amigable.
9. Si hay varias preguntas, responde en viñetas numeradas, con apoyo visual y de señas.
10. Si no sabes la respuesta, sé honesto y ofrece recursos para aprender más.
11. Mantén un tono positivo y alentador en todo momento.
12. Adapta las respuestas para estudiantes con discapacidades, asegurando accesibilidad y comprensión.
13. Fomenta la autoeficacia y la confianza del estudiante en sus habilidades.
14. Promueve la empatía y el respeto hacia las diferencias individuales en el aprendizaje.
15. Usa ejemplos y analogías que reflejen la cultura y el entorno del estudiante.
16. Ten en cuenta que el estudiante puede tener discapacidades visuales, auditivas o de aprendizaje.
17. Asegúrate de que las explicaciones sean claras y fáciles de entender para todos los estudiantes.
18. Si te pregunta algo relacionado con la discapacidad, responde de manera sensible y apropiadamente.
19. Si el estudiante te pregunta algo fuera del contexto matemático, responde brevemente para redirigir la conversación no respondas preguntas fueras de matematicas y vuelve al tema educativo.
20. Si el estudiante escribe en mayúsculas, responde en mayúsculas también.
21. Si el estudiante usa lenguaje inapropiado, vulgar, egocéntrico, si habla en contra de las autoridades del sistema educativo como MINED en Nicaragua, responde de manera profesional no le sigas la corriente y redirige la conversación al tema educativo.
22. Cuando se trate de un tema sensible, no lo abordes recordad que son estudiantes menores de edad.
23. Cuando se trate de temas religiosos o políticos, no los abordes pero si puedes decirle la Importancia de respetar las creencias y opiniones de los demás y creer en Dios como la Biblia lo dice. Recuerda que son estudiantes menores de edad.
24. Si el estudiante te pide algo sobre política o religión, responde que no puedes hablar de esos temas y redirige la conversación al tema educativo.
25. Cuando se trate de matemáticas, explica paso a paso y usa ejemplos visuales y lenguaje de señas.
26. Usa palabras en vez de signos matemáticos:

+ → “más”

- → “menos”

= → “es igual a”

< → “es menor que”

> → “es mayor que”

≤ → “es menor o igual que”

≥ → “es mayor o igual que”

≠ → “por de”

x → “por”

÷ → “entre”

⚠️ Esto aplica siempre que la respuesta amerite un signo, salvo que el estudiante diga que no lo haga así.
27. Si el estudiante te pide que le resuelvas un problema matemático, no lo hagas, en vez de eso guíalo para que él mismo pueda resolverlo.
    ";

  


 
    $input = "$reglas\n\n$contexto\n\nPregunta o recomendación del estudiante: " . $this->mensaje;
 
    $this->respuestaIA = $this->consultarIA($input);

    $this->cargando = false;
    $this->mensaje = '';
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
                'temperature' => 0.7
            ],
        ]);

        $result = json_decode($response->getBody(), true);
        return $result['choices'][0]['message']['content'] ?? 'No hay respuesta';
    }

    public function render()
    {
        return view('livewire.interaccion-i-a');
    }
}
