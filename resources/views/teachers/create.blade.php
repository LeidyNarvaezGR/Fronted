<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Profesor</title>
</head>
<body>

    <h1>Registrar Profesor</h1>

    <a href="{{ route('teachers.index') }}">Volver</a>

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('teachers.store') }}" method="POST">
        @csrf

        <p>
            <label>Nombre:</label>
            <input type="text" name="nombre"
                   value="{{ old('nombre') }}" required>
        </p>

        <p>
            <label>Apellido:</label>
            <input type="text" name="apellido"
                   value="{{ old('apellido') }}" required>
        </p>

        <p>
            <label>Teléfono:</label>
            <input type="text" name="telefono"
                   value="{{ old('telefono') }}" required>
        </p>

        <p>
            <label>Cédula:</label>
            <input type="text" name="cedula"
                   value="{{ old('cedula') }}" required>
        </p>

        <button type="submit">Guardar Profesor</button>
    </form>

</body>
</html>