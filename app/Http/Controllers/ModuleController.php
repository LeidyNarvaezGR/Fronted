<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $respuesta = Http::get(
            'http://127.0.0.1:8000/api/modules'
        );

        if ($respuesta->failed()) {
            return response('Error al consultar los módulos', 502);
        }

        $modulos = $respuesta->json();

        return view('modules.index', compact('modulos'));
    }
    public function create()
{
    return view('modules.create');
}

public function store(Request $request)
{
    $datos = $request->validate([
        'codigo' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
    ]);

    $respuesta = Http::post(
        'http://127.0.0.1:8000/api/modules',
        $datos
    );

    if ($respuesta->failed()) {
        return back()
            ->withInput()
            ->withErrors([
                'api' => $respuesta->json('message')
                    ?? 'No se pudo registrar el módulo.'
            ]);
    }

    return redirect()->route('modules.index')
        ->with('success', 'Módulo registrado correctamente.');
}
public function edit($id)
{
    $respuesta = Http::get(
        'http://127.0.0.1:8000/api/modules/' . $id
    );

    if ($respuesta->failed()) {
        return redirect()->route('modules.index')
            ->withErrors([
                'api' => 'No se encontró el módulo.'
            ]);
    }

    $modulo = $respuesta->json();

    return view('modules.edit', compact('modulo'));
}

public function update(Request $request, $id)
{
    $datos = $request->validate([
        'codigo' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
    ]);

    $respuesta = Http::put(
        'http://127.0.0.1:8000/api/modules/' . $id,
        $datos
    );

    if ($respuesta->failed()) {
        return back()
            ->withInput()
            ->withErrors([
                'api' => $respuesta->json('message')
                    ?? 'No se pudo actualizar el módulo.'
            ]);
    }

    return redirect()->route('modules.index')
        ->with('success', 'Módulo actualizado correctamente.');
}
public function destroy($id)
{
    $respuesta = Http::delete(
        'http://127.0.0.1:8000/api/modules/' . $id
    );

    if ($respuesta->failed()) {
        return redirect()->route('modules.index')
            ->withErrors([
                'api' => 'No se pudo eliminar el módulo.'
            ]);
    }

    return redirect()->route('modules.index')
        ->with('success', 'Módulo eliminado correctamente.');
}
}
