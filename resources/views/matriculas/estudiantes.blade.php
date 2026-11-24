<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estudiantes matriculados</title>
</head>
<body>

    <h1>Estudiantes matriculados</h1>
    @if(session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
@endif

@if($errors->any())
    <p style="color: red;">
        {{ $errors->first() }}
    </p>
@endif

    <h2>Módulo: {{ $modulo['nombre'] }}</h2>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($estudiantes as $estudiante)
                <tr>
                    <td>{{ $estudiante['id'] }}</td>
                    <td>{{ $estudiante['nombre'] }}</td>
                    <td>{{ $estudiante['apellidos'] }}</td>
                    <td>
    <form action="{{ route('matriculas.retirar') }}"
          method="POST"
          onsubmit="return confirm('¿Deseas retirar este estudiante del módulo?')">

        @csrf
        @method('DELETE')

        <input type="hidden"
               name="estudent_id"
               value="{{ $estudiante['id'] }}">

        <input type="hidden"
               name="module_id"
               value="{{ $modulo['id'] }}">

        <button type="submit">
            Retirar
        </button>
    </form>
</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        No hay estudiantes matriculados en este módulo.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    <a href="{{ route('matriculas.create') }}">
        Volver a matrículas
    </a>

</body>
</html>