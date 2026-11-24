<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Integrador - Inicio</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
        }

        header {
            background-color: #17365d;
            color: white;
            padding: 25px;
            text-align: center;
        }

        nav {
            background-color: #24476b;
            padding: 15px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 15px;
            font-weight: bold;
        }

        nav a:hover {
            color: #ffcc00;
        }

        main {
            text-align: center;
            padding: 60px 20px;
        }

        h2 {
            color: #17365d;
        }

        .contenedor {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 35px;
        }

        .tarjeta {
            background-color: white;
            padding: 30px;
            width: 200px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .tarjeta a {
            color: #17365d;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <header>
        <h1>PROYECTO INTEGRADOR</h1>
        <p>Sistema de Gestión Académica</p>
    </header>

    <nav>
        <a href="{{ route('home') }}">Inicio</a>
        <<a href="{{ route('teachers.index') }}">Profesores</a>
        <a href="{{ route('estudents.index') }}">Estudiantes</a>
        <a href="{{ route('modules.index') }}">Módulos</a>
        <a href="{{ route('matriculas.create') }}">Matrículas</a>
        <a href="{{ route('delegados.index') }}">Delegados</a>

    </nav>

    <main>
        <h2>Bienvenido al Sistema Académico</h2>
        <p>Selecciona una opción para administrar la información.</p>

        <div class="contenedor">
            <div class="tarjeta">
               <a href="{{ route('teachers.index') }}">Gestión de Profesores</a>
            </div>

            <div class="tarjeta">
                <a href="{{ route('estudents.index') }}">
              Gestión de Estudiantes
             </a>
            </div>

            <div class="tarjeta">
                <a href="{{ route('modules.index') }}">
                Gestión de Módulos
             </a>
            </div>

            <div class="tarjeta">
                <a href="{{ route('matriculas.create') }}">
              Gestión de Matrículas
             </a>
            </div>
        </div>
    </main>

</body>
</html>