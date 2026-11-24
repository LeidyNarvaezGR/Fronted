<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Matricular Estudiante</title>

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
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
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

    <h1>Matricular Estudiante</h1>
    @if(session('success'))
    <div style="background:#d4edda; color:#155724; padding:12px; margin-bottom:15px;">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div style="background:#f8d7da; color:#721c24; padding:12px; margin-bottom:15px;">
        <strong>Se encontraron errores:</strong>

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <a href="{{ route('home') }}">Volver al inicio</a>

    <br><br>

    <div class="formulario">

        @if (session('success'))
            <p style="color:green;">
                {{ session('success') }}
            </p>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        @endif

        <form action="{{ route('matriculas.store') }}" method="POST">
            @csrf

            <label>Seleccionar estudiante:</label>
            <select name="estudent_id" required>
                <option value="">Seleccione un estudiante</option>

                @foreach ($estudiantes as $estudiante)
                    <option value="{{ $estudiante['id'] }}"
                        {{ old('estudent_id') == $estudiante['id'] ? 'selected' : '' }}>
                        {{ $estudiante['nombre'] }}
                        {{ $estudiante['apellidos'] }}
                    </option>
                @endforeach
            </select>

            <label for="module_ids">Seleccionar módulos:</label>

<select name="module_ids[]" id="module_ids" multiple required
        style="width: 100%; min-height: 160px; padding: 10px;">

    @foreach($modulos as $modulo)
        <option value="{{ $modulo['id'] }}"
            @selected(in_array($modulo['id'], old('module_ids', [])))>
            {{ $modulo['codigo'] }} - {{ $modulo['nombre'] }}
        </option>
    @endforeach

</select>

<p>
    Mantén presionada la tecla Ctrl para seleccionar varios módulos.
</p>

            <button type="submit">Matricular Estudiante</button>
        </form>

    </div>

</body>
</html>