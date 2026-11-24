<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Estudiante</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        .formulario {
            background: white;
            padding: 25px;
            max-width: 450px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button {
            background: #17365d;
            color: white;
            border: none;
            padding: 12px 20px;
            margin-top: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h1>Registrar Estudiante</h1>

    <a href="{{ route('estudents.index') }}">Volver al listado</a>

    <br><br>

    <div class="formulario">

        @if ($errors->any())
            <div style="color:red;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('estudents.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <label>Nombre:</label>
            <input type="text" name="nombre"
                   value="{{ old('nombre') }}" required>

            <label>Apellidos:</label>
            <input type="text" name="apellidos"
                   value="{{ old('apellidos') }}" required>

            <label>Fecha de nacimiento:</label>
            <input type="date" name="fecha_nacimiento"
                   value="{{ old('fecha_nacimiento') }}" required>

            <label>Expediente:</label>
            <input type="text" name="expediente"
                   value="{{ old('expediente') }}" required>

            <label>Fotografía:</label>
            <input type="file" name="foto"
                   accept=".jpg,.jpeg,.png">

            <button type="submit">Guardar Estudiante</button>

        </form>
    </div>

</body>
</html>