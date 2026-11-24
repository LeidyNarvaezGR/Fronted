<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Módulos - Proyecto Integrador</title>

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
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #17365d;
            color: white;
        }

        a {
            color: #17365d;
            margin-right: 15px;
        }
    </style>
</head>
<body>

    <h1>Listado de Módulos</h1>
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
    <a href="{{ route('modules.create') }}">
    Registrar nuevo módulo
     </a>
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
    <br><br>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>

       <tbody>
    @forelse ($modulos as $modulo)
        <tr>
            <td>{{ $modulo['id'] }}</td>
            <td>{{ $modulo['codigo'] }}</td>
            <td>{{ $modulo['nombre'] }}</td>

           <td>
    <a href="{{ route('modules.edit', $modulo['id']) }}">
        Editar
    </a>

    <form action="{{ route('modules.destroy', $modulo['id']) }}"
          method="POST"
          style="display:inline;"
          onsubmit="return confirm('¿Estás seguro de eliminar este módulo?');">

        @csrf
        @method('DELETE')

        <button type="submit"
                style="background:red; color:white; border:none; padding:8px 15px; border-radius:5px; cursor:pointer;">
            Eliminar
        </button>
    </form>
</td>

    @empty
        <tr>
            <td colspan="4">
                No hay módulos registrados.
            </td>
        </tr>
    @endforelse
</tbody>
    </table>

</body>
</html>