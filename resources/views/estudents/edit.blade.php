<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Estudiante</title>
</head>
<body>

    <h1>Editar Estudiante</h1>

    <a href="{{ route('estudents.index') }}">Volver al listado</a>

    @if ($errors->any())
        <div style="color:red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('estudents.update', $estudiante['id']) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <p>
            <label>Nombre:</label>
            <input type="text" name="nombre"
                   value="{{ old('nombre', $estudiante['nombre']) }}"
                   required>
        </p>

        <p>
            <label>Apellidos:</label>
            <input type="text" name="apellidos"
                   value="{{ old('apellidos', $estudiante['apellidos']) }}"
                   required>
        </p>

        <p>
            <label>Fecha de nacimiento:</label>
            <input type="date" name="fecha_nacimiento"
                   value="{{ old('fecha_nacimiento', $estudiante['fecha_nacimiento']) }}"
                   required>
        </p>

        <p>
            <label>Expediente:</label>
            <input type="text" name="expediente"
                   value="{{ old('expediente', $estudiante['expediente']) }}"
                   required>
        </p>

        <p>
            <label>Fotografía actual:</label>

            @if (!empty($estudiante['foto']))
                <img
                    src="{{ 'http://127.0.0.1:8000/storage/' . $estudiante['foto'] }}"
                    width="120"
                    alt="Fotografía actual">
            @else
                Sin fotografía
            @endif
        </p>

        <p>
            <label>Cambiar fotografía (opcional):</label>
            <input type="file" name="foto"
                   accept=".jpg,.jpeg,.png">
        </p>

        <button type="submit">Actualizar Estudiante</button>

    </form>

</body>
</html>