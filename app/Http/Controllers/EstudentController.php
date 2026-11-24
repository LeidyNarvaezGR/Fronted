<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class EstudentController extends Controller
{
    public function index()
    {
        $respuesta = Http::get('http://127.0.0.1:8000/api/estudents');

        if ($respuesta->failed()) {
            return response('Error al consultar los estudiantes', 502);
        }

        $estudiantes = $respuesta->json();

        return view('estudents.index', compact('estudiantes'));
    }
    public function create()
{
    return view('estudents.create');
}

public function store(Request $request)
{
    $datos = $request->validate([
        'nombre' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'fecha_nacimiento' => 'required|date',
        'expediente' => 'required|string|max:255',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $peticion = Http::asMultipart();

    foreach (['nombre', 'apellidos', 'fecha_nacimiento', 'expediente'] as $campo) {
        $peticion = $peticion->attach($campo, $datos[$campo]);
    }

    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');

        $peticion = $peticion->attach(
            'foto',
            fopen($foto->getRealPath(), 'r'),
            $foto->getClientOriginalName()
        );
    }

    $respuesta = $peticion->post(
        'http://127.0.0.1:8000/api/estudents'
    );

    if ($respuesta->failed()) {
        return back()
            ->withInput()
            ->withErrors([
                'api' => $respuesta->json('message')
                    ?? 'No se pudo registrar el estudiante.'
            ]);
    }

    return redirect()->route('estudents.index')
        ->with('success', 'Estudiante registrado correctamente.');
}
public function edit($id)
{
    $respuesta = Http::get(
        'http://127.0.0.1:8000/api/estudents/' . $id
    );

    if ($respuesta->failed()) {
        return redirect()->route('estudents.index')
            ->withErrors([
                'api' => 'No se encontró el estudiante.'
            ]);
    }

    $estudiante = $respuesta->json();

    return view('estudents.edit', compact('estudiante'));
}

public function update(Request $request, $id)
{
    $datos = $request->validate([
        'nombre' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'fecha_nacimiento' => 'required|date',
        'expediente' => 'required|string|max:255',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $peticion = Http::asMultipart();

    foreach (['nombre', 'apellidos', 'fecha_nacimiento', 'expediente'] as $campo) {
        $peticion = $peticion->attach($campo, $datos[$campo]);
    }

    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');

        $peticion = $peticion->attach(
            'foto',
            fopen($foto->getRealPath(), 'r'),
            $foto->getClientOriginalName()
        );
    }

    // Laravel procesa archivos correctamente mediante POST
    // utilizando _method=PUT.
    $peticion = $peticion->attach('_method', 'PUT');

    $respuesta = $peticion->post(
        'http://127.0.0.1:8000/api/estudents/' . $id
    );

    if ($respuesta->failed()) {
        return back()
            ->withInput()
            ->withErrors([
                'api' => $respuesta->json('message')
                    ?? 'No se pudo actualizar el estudiante.'
            ]);
    }

    return redirect()->route('estudents.index')
        ->with('success', 'Estudiante actualizado correctamente.');
}
public function destroy($id)
{
    $respuesta = Http::delete(
        'http://127.0.0.1:8000/api/estudents/' . $id
    );

    if ($respuesta->failed()) {
        return redirect()->route('estudents.index')
            ->withErrors([
                'api' => 'No se pudo eliminar el estudiante.'
            ]);
    }

    return redirect()->route('estudents.index')
        ->with('success', 'Estudiante eliminado correctamente.');
}
}