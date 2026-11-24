<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Profesores - Proyecto Integrador</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        h1 {
            color: #17365d;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #17365d;
            color: white;
        }

        a {
            color: #17365d;
        }
    </style>
</head>
<body>

    <h1>Listado de Profesores</h1>
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

    <a href="{{ route('home') }}">Volver al inicio</a>
    <a href="{{ route('teachers.create') }}">Registrar nuevo profesor</a>

    <br><br>

    <table>
      <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Teléfono</th>
        <th>Cédula</th>
        <th>Acciones</th>
    </tr>
</thead>

        <tbody>
@forelse ($profesores as $profesor)
    <tr>
        <td>{{ $profesor['id'] }}</td>
        <td>{{ $profesor['nombre'] }}</td>
        <td>{{ $profesor['apellido'] }}</td>
        <td>{{ $profesor['telefono'] }}</td>
        <td>{{ $profesor['cedula'] }}</td>

        <td>
    <a href="{{ route('teachers.edit', $profesor['id']) }}">
        Editar
    </a>

    <form action="{{ route('teachers.destroy', $profesor['id']) }}"
          method="POST"
          style="display:inline;"
          onsubmit="return confirm('¿Estás seguro de eliminar este profesor?');">

        @csrf
        @method('DELETE')

        <button type="submit"
                style="background:red; color:white; border:none; padding:8px; cursor:pointer;">
            Eliminar
        </button>
    </form>
</td>
    </tr>
@empty
    <tr>
        <td colspan="6">No hay profesores registrados.</td>
    </tr>
@endforelse
        </tbody>
    </table>

</body>
</html>