<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estudiantes - Proyecto Integrador</title>

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

        img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <h1>Listado de Estudiantes</h1>

    <a href="{{ route('home') }}">Volver al inicio</a>
    <a href="{{ route('estudents.create') }}">
    Registrar nuevo estudiante
      </a>
     @if (session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
     @endif 
    <br><br>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Fecha de nacimiento</th>
                <th>Expediente</th>
                <th>Fotografía</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($estudiantes as $estudiante)
                <tr>
                    <td>{{ $estudiante['id'] }}</td>
                    <td>{{ $estudiante['nombre'] }}</td>
                    <td>{{ $estudiante['apellidos'] }}</td>
                    <td>{{ $estudiante['fecha_nacimiento'] }}</td>
                    <td>{{ $estudiante['expediente'] }}</td>

                    <td>
                        @if (!empty($estudiante['foto']))
                            <img
                                src="{{ 'http://127.0.0.1:8000/storage/' . $estudiante['foto'] }}"
                                alt="Foto del estudiante">
                        @else
                            Sin fotografía
                        @endif
                    </td>
                 <td>
    <a class="btn-editar"
       href="{{ route('estudents.edit', $estudiante['id']) }}">
        Editar
    </a>

    <form action="{{ route('estudents.destroy', $estudiante['id']) }}"
          method="POST"
          style="display:inline;"
          onsubmit="return confirm('¿Estás seguro de eliminar este estudiante?');">

        @csrf
        @method('DELETE')

        <button type="submit"
                style="background:red; color:white; border:none; padding:8px 15px; border-radius:5px; cursor:pointer;">
            Eliminar
        </button>
    </form>
</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay estudiantes registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>