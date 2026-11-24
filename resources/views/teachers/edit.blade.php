<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Profesor</title>
</head>
<body>

    <h1>Editar Profesor</h1>

    <a href="{{ route('teachers.index') }}">Volver</a>

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('teachers.update', $profesor['id']) }}"
          method="POST">

        @csrf
        @method('PUT')

        <p>
            <label>Nombre:</label>
            <input type="text" name="nombre"
                   value="{{ old('nombre', $profesor['nombre']) }}"
                   required>
        </p>

        <p>
            <label>Apellido:</label>
            <input type="text" name="apellido"
                   value="{{ old('apellido', $profesor['apellido']) }}"
                   required>
        </p>

        <p>
            <label>Teléfono:</label>
            <input type="text" name="telefono"
                   value="{{ old('telefono', $profesor['telefono']) }}"
                   required>
        </p>

        <p>
            <label>Cédula:</label>
            <input type="text" name="cedula"
                   value="{{ old('cedula', $profesor['cedula']) }}"
                   required>
        </p>

        <button type="submit">Actualizar Profesor</button>

    </form>

</body>
</html>