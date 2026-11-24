<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de delegados</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #e8e8e8;
        }

        button {
            background-color: #c62828;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
        }

        a {
            display: inline-block;
            margin-bottom: 15px;
        }

        .tabla {
            overflow-x: auto;
        }
    </style>
</head>
<body>

    <h1>Gestión de delegados</h1>

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

    <a href="{{ route('delegados.create') }}">
        Asignar nuevo delegado
    </a>

    <div class="tabla">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Estudiante</th>
                    <th>Delegado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse($estudiantes as $estudiante)
                    <tr>
                        <td>{{ $estudiante['id'] }}</td>

                        <td>
                            {{ $estudiante['nombre'] }}
                            {{ $estudiante['apellidos'] }}
                        </td>

                        <td>
                            @if(!empty($estudiante['delegado']))
                                {{ $estudiante['delegado']['nombre'] }}
                                {{ $estudiante['delegado']['apellidos'] }}
                            @else
                                Sin delegado
                            @endif
                        </td>

                        <td>
                            @if(!empty($estudiante['delegado']))
                                <form
                                    action="{{ route('delegados.retirar', $estudiante['id']) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        onclick="return confirm('¿Retirar este delegado?')">
                                        Retirar
                                    </button>
                                </form>
                            @else
                                Sin acciones
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            No hay estudiantes registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <br>

    <a href="{{ url('/') }}">Volver al inicio</a>

</body>
</html>