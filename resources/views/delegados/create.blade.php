<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de delegados</title>
</head>
<body>

    <h1>Asignar delegado a un estudiante</h1>

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

    <form action="{{ route('delegados.store') }}" method="POST">
        @csrf

        <label for="estudent_id">Seleccionar estudiante:</label>

        <select name="estudent_id" id="estudent_id" required>
            <option value="">Seleccione un estudiante</option>

            @foreach($estudiantes as $estudiante)
                <option value="{{ $estudiante['id'] }}"
                    @selected(old('estudent_id') == $estudiante['id'])>
                    {{ $estudiante['nombre'] }}
                    {{ $estudiante['apellidos'] }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label for="delegado_id">Seleccionar delegado:</label>

        <select name="delegado_id" id="delegado_id" required>
            <option value="">Seleccione un delegado</option>

            @foreach($estudiantes as $estudiante)
                <option value="{{ $estudiante['id'] }}"
                    @selected(old('delegado_id') == $estudiante['id'])>
                    {{ $estudiante['nombre'] }}
                    {{ $estudiante['apellidos'] }}
                </option>
            @endforeach
        </select>

        <br><br>

        <button type="submit">
            Asignar delegado
        </button>
    </form>

    <br>

    <a href="{{ url('/') }}">Volver al inicio</a>

</body>
</html>