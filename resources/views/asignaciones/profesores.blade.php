<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Profesores asignados</title>
</head>
<body>

    <h1>Profesores asignados al módulo</h1>
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
                <th>Apellido</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse($profesores as $profesor)
                <tr>
                    <td>{{ $profesor['id'] }}</td>
                    <td>{{ $profesor['nombre'] }}</td>
                    <td>{{ $profesor['apellido'] }}</td>
                    <td>
    <form action="{{ route('asignaciones.retirar') }}"
          method="POST"
          onsubmit="return confirm('¿Deseas retirar este profesor del módulo?')">

        @csrf
        @method('DELETE')

        <input type="hidden"
               name="teacher_id"
               value="{{ $profesor['id'] }}">

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
                        No hay profesores asignados a este módulo.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    <a href="{{ route('asignaciones.create') }}">
        Volver a asignaciones
    </a>

</body>
</html>