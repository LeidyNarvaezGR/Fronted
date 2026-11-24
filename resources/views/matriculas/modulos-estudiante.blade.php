<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Módulos del estudiante</title>
</head>
<body>

    <h1>Módulos matriculados</h1>

    <h2>
        Estudiante:
        {{ $estudiante['nombre'] }}
        {{ $estudiante['apellidos'] }}
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
                        Este estudiante no tiene módulos matriculados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    <a href="{{ route('matriculas.create') }}">
        Volver a matrículas
    </a>

    <br><br>

    <a href="{{ url('/') }}">
        Volver al inicio
    </a>

</body>
</html>