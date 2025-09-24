<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Desempeño</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-bottom: 20px; }
        .stat-box { border: 1px solid #ddd; padding: 10px; text-align: center; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f5f5f5; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Desempeño</h1>
        <h2>{{ $estudiante->name }}</h2>
        <p>Generado el: {{ date('d/m/Y H:i') }}</p>
    </div>

    <div class="stats">
        <div class="stat-box">
            <strong>{{ $estadisticas['total_actividades'] }}</strong>
            <div>Total Actividades</div>
        </div>
        <div class="stat-box">
            <strong>{{ $estadisticas['actividades_completadas'] }}</strong>
            <div>Completadas</div>
        </div>
        <div class="stat-box">
            <strong>{{ $estadisticas['promedio_puntaje'] }}</strong>
            <div>Puntaje Promedio</div>
        </div>
        <div class="stat-box">
            <strong>{{ $estadisticas['actividades_revisadas'] }}</strong>
            <div>Revisadas</div>
        </div>
    </div>

    <h3>Detalle de Actividades</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Actividad</th>
                <th>Fecha</th>
                <th>Aciertos</th>
                <th>Puntaje</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($intentos as $intento)
                <tr>
                    <td>{{ $intento->actividad->titulo }}</td>
                    <td>{{ $intento->created_at->format('d/m/Y') }}</td>
                    <td>{{ $intento->aciertos }}</td>
                    <td>{{ $intento->puntaje }}</td>
                    <td>
                        @if($intento->revision && $intento->revision->revisado)
                            Revisado
                        @else
                            Pendiente
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 30px; font-size: 12px; color: #666;">
        <p>Filtros aplicados:</p>
        <ul>
            <li>Grado: {{ $filtros['grado'] }}</li>
            <li>Unidad: {{ $filtros['unidad'] }}</li>
            <li>Competencia: {{ $filtros['competencia'] }}</li>
            @if($filtros['fecha_inicio'])
                <li>Desde: {{ $filtros['fecha_inicio'] }}</li>
            @endif
            @if($filtros['fecha_fin'])
                <li>Hasta: {{ $filtros['fecha_fin'] }}</li>
            @endif
        </ul>
    </div>
</body>
</html>