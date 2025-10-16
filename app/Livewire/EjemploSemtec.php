<?php

namespace App\Livewire;

use Livewire\Component;

class EjemploSemtec extends Component
{
    public $moduloActual = 1;
    public $pasoActual = 0;

    // Estructura de módulos y pasos
    public $modulos = [];

    public function mount()
    {
        $this->modulos = [
            1 => [
                'titulo' => 'Introducción General',
                'pasos' => [
                    [
                        'id' => 'GEN-INTRO',
                        'titulo' => 'Qué es SEMTEC',
                        'descripcion' => 'Conoce la plataforma y su propósito educativo.',
                        'video' => 'https://www.youtube.com/embed/N6O2ncUKvlg'
                    ],
                    [
                        'id' => 'GEN-BENEF',
                        'titulo' => 'Beneficios',
                        'descripcion' => 'Descubre los beneficios para docentes y estudiantes.',
                        'video' => 'https://www.youtube.com/embed/8ZcmTl_1ER8'
                    ],
                    [
                        'id' => 'GEN-ROLES',
                        'titulo' => 'Roles disponibles',
                        'descripcion' => 'Explora los diferentes tipos de usuario en SEMTEC.',
                        'video' => 'https://www.youtube.com/embed/4UZrsTqkcW4'
                    ],
                ],
            ],
            2 => [
                'titulo' => 'Uso para Estudiantes',
                'pasos' => [
                    [
                        'id' => 'STU-LOGIN',
                        'titulo' => 'Inicio de sesión',
                        'descripcion' => 'Cómo ingresar a la plataforma.',
                        'video' => 'https://www.youtube.com/embed/n2RNcPRtAiY'
                    ],
                    [
                        'id' => 'STU-GRADE',
                        'titulo' => 'Recorrido estudiantil',
                        'descripcion' => 'Explora el entorno de aprendizaje.',
                        'video' => 'https://www.youtube.com/embed/ktlTxC4QG8g'
                    ],
                    [
                        'id' => 'STU-GAME',
                        'titulo' => 'Juegos interactivos',
                        'descripcion' => 'Aprende jugando en SEMTEC.',
                        'video' => 'https://www.youtube.com/embed/LXb3EKWsInQ'
                    ],
                ],
            ],
            3 => [
                'titulo' => 'Uso para Docentes',
                'pasos' => [
                    [
                        'id' => 'TEA-LOGIN',
                        'titulo' => 'Acceso docente',
                        'descripcion' => 'Ingreso de docentes a la plataforma.',
                        'video' => 'https://www.youtube.com/embed/tgbNymZ7vqY'
                    ],
                    [
                        'id' => 'TEA-GROUPS',
                        'titulo' => 'Gestión de Actividades',
                        'descripcion' => 'Crea y gestiona actividades de aprendizaje.',
                        'video' => 'https://www.youtube.com/embed/fLexgOxsZu0'
                    ],
                    [
                        'id' => 'TEA-REPORT',
                        'titulo' => 'Reportes de rendimiento',
                        'descripcion' => 'Analiza el progreso de los estudiantes.',
                        'video' => 'https://www.youtube.com/embed/ysz5S6PUM-U'
                    ],
                ],
            ],
            4 => [
                'titulo' => 'Uso para Tutores o Padres',
                'pasos' => [
                    [
                        'id' => 'TUT-ACCESS',
                        'titulo' => 'Acceso al perfil',
                        'descripcion' => 'Consulta el avance de tus hijos.',
                        'video' => 'https://www.youtube.com/embed/lTTajzrSkCw'
                    ],
                    [
                        'id' => 'TUT-PROGRESS',
                        'titulo' => 'Seguimiento del progreso',
                        'descripcion' => 'Monitorea el aprendizaje.',
                        'video' => 'https://www.youtube.com/embed/sBws8MSXN7A'
                    ],
                    [
                        'id' => 'TUT-CONTACT',
                        'titulo' => 'Comunicación con docentes',
                        'descripcion' => 'Mantente en contacto con los profesores.',
                        'video' => 'https://www.youtube.com/embed/Bey4XXJAqS8'
                    ],
                ],
            ],
            5 => [
                'titulo' => 'Uso para Administradores',
                'pasos' => [
                    [
                        'id' => 'ADM-INST',
                        'titulo' => 'Registro institucional',
                        'descripcion' => 'Agrega centros educativos.',
                        'video' => 'https://www.youtube.com/embed/E7wJTI-1dvQ'
                    ],
                    [
                        'id' => 'ADM-USERS',
                        'titulo' => 'Gestión de usuarios',
                        'descripcion' => 'Administra docentes y estudiantes.',
                        'video' => 'https://www.youtube.com/embed/aqz-KE-bpKQ'
                    ],
                    
                ],
            ],
        ];
    }

    public function siguientePaso()
    {
        $totalPasos = count($this->modulos[$this->moduloActual]['pasos']);
        if ($this->pasoActual + 1 < $totalPasos) {
            $this->pasoActual++;
        } else {
            $this->siguienteModulo();
        }
    }

    public function anteriorPaso()
    {
        if ($this->pasoActual > 0) {
            $this->pasoActual--;
        } else {
            $this->anteriorModulo();
        }
    }

    public function siguienteModulo()
    {
        if ($this->moduloActual < count($this->modulos)) {
            $this->moduloActual++;
            $this->pasoActual = 0;
        }
    }

    public function anteriorModulo()
    {
        if ($this->moduloActual > 1) {
            $this->moduloActual--;
            $this->pasoActual = 0;
        }
    }

    public function render()
    {
        $modulo = $this->modulos[$this->moduloActual];
        $paso = $modulo['pasos'][$this->pasoActual];

        return view('livewire.ejemplo-semtec', [
            'modulo' => $modulo,
            'paso' => $paso,
        ]);
    }
}
