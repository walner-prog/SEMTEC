# SEMTEC

Plataforma educativa inclusiva para matemáticas

SEMTEC es una plataforma educativa inclusiva diseñada para democratizar el aprendizaje de las matemáticas en educación primaria.  

Integra tecnología accesible, lenguaje de señas y gamificación para garantizar que todos los estudiantes, incluyendo aquellos con discapacidad visual o auditiva, tengan las mismas oportunidades de aprender.

---

## Características disruptivas

- **Juegos matemáticos interactivos**: categorizados por grado escolar y alineados al currículo nacional.  
- **IA adaptativa**: personaliza las actividades según el progreso de cada estudiante, ajustando la dificultad y ofreciendo retroalimentación inmediata accesible con audio, subtítulos y pistas interactivas.  
- **Gamificación avanzada**: los estudiantes aprenden, ganan puntos, acumulan monedas, consiguen trofeos y desbloquean nuevos juegos, reforzando la motivación y haciendo las matemáticas más divertidas.  
- **Asistente pedagógico con IA para docentes**: sugiere estrategias inclusivas, genera actividades alineadas al currículo y entrega reportes inteligentes de desempeño para tomar mejores decisiones en el aula.  

SEMTEC convierte el aprendizaje de las matemáticas en una experiencia divertida, accesible y alineada con el programa oficial de estudios, asegurando que ningún estudiante quede atrás.

---

## Público objetivo

- Estudiantes de primaria.  
- Docentes y tutores que requieren herramientas inclusivas.  
- Administradores o directores educativos que gestionan contenidos y reportes.  

---

## Requerimientos Técnicos

- **Framework**: Laravel 12  
- **Paquetes principales**:
  - `spatie/laravel-permission` → Roles y permisos  
  - `laravel/livewire` → Componentes interactivos y reactivos  
  - `laravel/breeze` → Autenticación, sesiones y perfiles  
  - `dompdf/dompdf` → Exportar reportes PDF  
  - `guzzlehttp/guzzle` → Consumo de APIs (IA, almacenamiento, etc.)  
- **Base de datos**: MySQL  
- **IA**: OpenAI / Gemini (pistas y reexplicación inclusiva vía API)  
- **Almacenamiento**: Local en desarrollo; MEGA (Cloud Storage) en producción para multimedia (videos ISN, audios, subtítulos)  
- **Despliegue**: Railway (contenerización y CI/CD integrado)  
- **Diseño UI/UX**: Blade + TailwindCSS, responsive, accesible (A11y)  

### Buenas prácticas

- Desarrollo con SCRUM (8 semanas – MVP)  
- Optimización de consultas a BD  
- Arquitectura limpia y escalable  

### Roles de usuario

- Administrador  
- Docente  
- Estudiante  
- Tutor  

---

## Instalación y Despliegue

1. **Clonar repositorio**
```bash
git clone https://github.com/walner-prog/SEMTEC.git
cd semtec
