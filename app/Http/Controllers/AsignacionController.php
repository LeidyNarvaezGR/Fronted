<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AsignacionController extends Controller
{
    public function create()
    {
        $respuestaProfesores = Http::get(
            'http://127.0.0.1:8000/api/teachers'
        );

        $respuestaModulos = Http::get(
            'http://127.0.0.1:8000/api/modules'
        );

        if ($respuestaProfesores->failed() || $respuestaModulos->failed()) {
            return response('Error al consultar profesores o módulos', 502);
        }

        $profesores = $respuestaProfesores->json();
        $modulos = $respuestaModulos->json();

        return view('asignaciones.create', compact('profesores', 'modulos'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'teacher_id' => 'required|integer',
            'module_id' => 'required|integer',
        ]);

        $respuesta = Http::post(
            'http://127.0.0.1:8000/api/asignaciones',
            $datos
        );

        if ($respuesta->failed()) {
            return back()->withInput()->withErrors([
                'api' => $respuesta->json('message')
                    ?? 'No se pudo asignar el profesor.'
            ]);
        }

        return redirect()->route('asignaciones.create')
            ->with('success', 'Profesor asignado correctamente.');
    }
    public function profesoresModulo($id)
{
    $respuestaModulo = Http::get(
        'http://127.0.0.1:8000/api/modules/' . $id
    );

    $respuestaProfesores = Http::get(
        'http://127.0.0.1:8000/api/modules/' . $id . '/teachers'
    );

    if ($respuestaModulo->failed() || $respuestaProfesores->failed()) {
        return response('Error al consultar los profesores del módulo', 502);
    }

    $modulo = $respuestaModulo->json();
    $profesores = $respuestaProfesores->json();

    return view('asignaciones.profesores', compact('modulo', 'profesores'));
}
public function retirar(Request $request)
{
    $datos = $request->validate([
        'teacher_id' => 'required|integer',
        'module_id' => 'required|integer',
    ]);

    $respuesta = Http::delete(
        'http://127.0.0.1:8000/api/asignaciones',
        $datos
    );

    if ($respuesta->failed()) {
        return back()->withErrors([
            'api' => $respuesta->json('message')
                ?? 'No se pudo retirar al profesor.'
        ]);
    }

    return back()->with(
        'success',
        'Profesor retirado del módulo correctamente.'
    );
}
public function modulosProfesor($id)
{
    $respuestaProfesor = Http::get(
        'http://127.0.0.1:8000/api/teachers/' . $id
    );

    $respuestaModulos = Http::get(
        'http://127.0.0.1:8000/api/teachers/' . $id . '/modules'
    );

    if ($respuestaProfesor->failed() || $respuestaModulos->failed()) {
        return response('Error al consultar los módulos del profesor', 502);
    }

    $profesor = $respuestaProfesor->json();
    $modulos = $respuestaModulos->json();

    return view('asignaciones.modulos-profesor', compact('profesor', 'modulos'));
}
}