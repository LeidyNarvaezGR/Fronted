<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Módulos del profesor</title>
</head>
<body>

    <h1>Módulos asignados al profesor</h1>

    <h2>
        Profesor:
        {{ $profesor['nombre'] }}
        {{ $profesor['apellido'] }}
    </h2>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nombre del módulo</th>
            </tr>
        </thead>

        <tbody>
            @forelse($modulos as $modulo)
                <tr>
                    <td>{{ $modulo['id'] }}</td>
                    <td>{{ $modulo['codigo'] }}</td>
                    <td>{{ $modulo['nombre'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        Este profesor no tiene módulos asignados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    <a href="{{ route('asignaciones.create') }}">
        Volver a asignaciones
    </a>

    <br><br>

    <a href="{{ url('/') }}">
        Volver al inicio
    </a>

</body>
</html>