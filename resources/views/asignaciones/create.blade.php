<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar profesores</title>
</head>
<body>

    <h1>Asignar profesor a un módulo</h1>

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

    <form action="{{ route('asignaciones.store') }}" method="POST">
        @csrf

        <label>Seleccionar profesor:</label>
        <select name="teacher_id" required>
            <option value="">Seleccione un profesor</option>

            @foreach($profesores as $profesor)
                <option value="{{ $profesor['id'] }}">
                    {{ $profesor['nombre'] }} {{ $profesor['apellido'] }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label>Seleccionar módulo:</label>
        <select name="module_id" required>
            <option value="">Seleccione un módulo</option>

            @foreach($modulos as $modulo)
                <option value="{{ $modulo['id'] }}">
                    {{ $modulo['nombre'] }}
                </option>
            @endforeach
        </select>

        <br><br>

        <button type="submit">Asignar profesor</button>
    </form>

    <br>

    <a href="{{ url('/') }}">Volver al inicio</a>

</body>
</html>