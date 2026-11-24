<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MatriculaController extends Controller
{
    public function create()
    {
        $respuestaEstudiantes = Http::get(
            'http://127.0.0.1:8000/api/estudents'
        );

        $respuestaModulos = Http::get(
            'http://127.0.0.1:8000/api/modules'
        );

        if ($respuestaEstudiantes->failed() || $respuestaModulos->failed()) {
            return response('Error al consultar estudiantes o módulos', 502);
        }

        $estudiantes = $respuestaEstudiantes->json();
        $modulos = $respuestaModulos->json();

        return view('matriculas.create', compact('estudiantes', 'modulos'));
    }

    public function store(Request $request)
{
    $datos = $request->validate([
        'estudent_id' => 'required|integer',
        'module_ids' => 'required|array|min:1',
        'module_ids.*' => 'required|integer|distinct',
    ], [
        'estudent_id.required' => 'Debes seleccionar un estudiante.',
        'module_ids.required' => 'Debes seleccionar al menos un módulo.',
        'module_ids.min' => 'Debes seleccionar al menos un módulo.',
        'module_ids.*.distinct' => 'No puedes seleccionar módulos repetidos.',
    ]);

    try {
        $respuesta = Http::timeout(10)->post(
            'http://127.0.0.1:8000/api/matriculas',
            $datos
        );

        if ($respuesta->failed()) {
            return back()->withInput()->withErrors(
                $respuesta->json('errors')
                ?: ['api' => $respuesta->json('message')
                    ?? 'No se pudo realizar la matrícula.']
            );
        }

        return redirect()->route('matriculas.create')
            ->with('success', 'Matrícula realizada correctamente.');

    } catch (\Illuminate\Http\Client\ConnectionException $e) {
        return back()->withInput()->withErrors([
            'api' => 'No se pudo conectar con el backend. Comprueba que esté encendido.'
        ]);
    }


    return redirect()->route('matriculas.create')
        ->with('success', 'Estudiante matriculado correctamente en los módulos seleccionados.');
}
    public function estudiantesModulo($id)
{
    $respuestaModulo = Http::get(
        'http://127.0.0.1:8000/api/modules/' . $id
    );

    $respuestaEstudiantes = Http::get(
        'http://127.0.0.1:8000/api/modules/' . $id . '/estudents'
    );

    if ($respuestaModulo->failed() || $respuestaEstudiantes->failed()) {
        return response('Error al consultar los estudiantes del módulo', 502);
    }

    $modulo = $respuestaModulo->json();
    $estudiantes = $respuestaEstudiantes->json();

    return view('matriculas.estudiantes', compact('modulo', 'estudiantes'));
}
public function retirar(Request $request)
{
    $datos = $request->validate([
        'estudent_id' => 'required|integer',
        'module_id' => 'required|integer',
    ]);

    $respuesta = Http::delete(
        'http://127.0.0.1:8000/api/matriculas',
        $datos
    );

    if ($respuesta->failed()) {
        return back()->withErrors([
            'api' => $respuesta->json('message')
                ?? 'No se pudo retirar la matrícula.'
        ]);
    }

    return back()->with(
        'success',
        'Estudiante retirado del módulo correctamente.'
    );
}
public function modulosEstudiante($id)
{
    $respuestaEstudiante = Http::get(
        'http://127.0.0.1:8000/api/estudents/' . $id
    );

    $respuestaModulos = Http::get(
        'http://127.0.0.1:8000/api/estudents/' . $id . '/modules'
    );

    if ($respuestaEstudiante->failed() || $respuestaModulos->failed()) {
        return response('Error al consultar los módulos del estudiante', 502);
    }

    $estudiante = $respuestaEstudiante->json();
    $modulos = $respuestaModulos->json();

    return view('matriculas.modulos-estudiante', compact('estudiante', 'modulos'));
}

}