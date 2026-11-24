<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $respuesta = Http::get('http://127.0.0.1:8000/api/teachers');

        if ($respuesta->failed()) {
            return response('Error al consultar los profesores', 502);
        }

        $profesores = $respuesta->json();

        return view('teachers.index', compact('profesores'));
    }
    public function create()
{
    return view('teachers.create');
}

public function store(Request $request)
{
    $datos = $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'telefono' => 'required|string|max:255',
        'cedula' => 'required|string|max:255',
    ]);

    $respuesta = Http::post(
        'http://127.0.0.1:8000/api/teachers',
        $datos
    );

    if ($respuesta->failed()) {
        return back()
            ->withInput()
            ->withErrors([
                'api' => $respuesta->json('message')
                    ?? 'No se pudo registrar el profesor.'
            ]);
    }

    return redirect()->route('teachers.index')
        ->with('success', 'Profesor registrado correctamente');
}
public function edit($id)
{
    $respuesta = Http::get(
        'http://127.0.0.1:8000/api/teachers/' . $id
    );

    if ($respuesta->failed()) {
        return redirect()->route('teachers.index')
            ->withErrors(['api' => 'No se encontró el profesor.']);
    }

    $profesor = $respuesta->json();

    return view('teachers.edit', compact('profesor'));
}

public function update(Request $request, $id)
{
    $datos = $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'telefono' => 'required|string|max:255',
        'cedula' => 'required|string|max:255',
    ]);

    $respuesta = Http::put(
        'http://127.0.0.1:8000/api/teachers/' . $id,
        $datos
    );

    if ($respuesta->failed()) {
        return back()
            ->withInput()
            ->withErrors([
                'api' => $respuesta->json('message')
                    ?? 'No se pudo actualizar el profesor.'
            ]);
    }

    return redirect()->route('teachers.index')
        ->with('success', 'Profesor actualizado correctamente');
}

public function destroy($id)
{
    $respuesta = Http::delete(
        'http://127.0.0.1:8000/api/teachers/' . $id
    );

    if ($respuesta->failed()) {
        return redirect()->route('teachers.index')
            ->withErrors([
                'api' => 'No se pudo eliminar el profesor.'
            ]);
    }

    return redirect()->route('teachers.index')
        ->with('success', 'Profesor eliminado correctamente');
}
}