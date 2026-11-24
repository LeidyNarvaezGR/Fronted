<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Módulo</title>

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

    <h1>Editar Módulo</h1>

    <a href="{{ route('modules.index') }}">
        Volver al listado
    </a>

    <br><br>

    <div class="formulario">

        @if ($errors->any())
            <div style="color:red;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('modules.update', $modulo['id']) }}"
              method="POST">

            @csrf
            @method('PUT')

            <label>Código del módulo:</label>
            <input
                type="text"
                name="codigo"
                value="{{ old('codigo', $modulo['codigo']) }}"
                required>

            <label>Nombre del módulo:</label>
            <input
                type="text"
                name="nombre"
                value="{{ old('nombre', $modulo['nombre']) }}"
                required>

            <button type="submit">
                Actualizar Módulo
            </button>

        </form>
    </div>

</body>
</html>