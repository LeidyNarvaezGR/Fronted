<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DelegadoController extends Controller
{
    public function create()
    {
        $respuesta = Http::get(
            'http://127.0.0.1:8000/api/estudents'
        );

        if ($respuesta->failed()) {
            return response('Error al consultar estudiantes', 502);
        }

        $estudiantes = $respuesta->json();

        return view('delegados.create', compact('estudiantes'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'estudent_id' => 'required|integer',
            'delegado_id' => 'required|integer|different:estudent_id',
        ]);

        $respuesta = Http::post(
            'http://127.0.0.1:8000/api/delegados',
            $datos
        );

        if ($respuesta->failed()) {
            return back()->withInput()->withErrors([
                'api' => $respuesta->json('message')
                    ?? 'No se pudo asignar el delegado.'
            ]);
        }

        return redirect()->route('delegados.create')
            ->with('success', 'Delegado asignado correctamente.');
    }

    public function index()
{
    $respuesta = Http::get(
        'http://127.0.0.1:8000/api/estudents'
    );

    if ($respuesta->failed()) {
        return response('Error al consultar estudiantes', 502);
    }

    $estudiantes = $respuesta->json();

    foreach ($estudiantes as &$estudiante) {
        $detalle = Http::get(
            'http://127.0.0.1:8000/api/estudents/'
            . $estudiante['id'] . '/delegado'
        );

        $estudiante['delegado'] = $detalle->successful()
            ? $detalle->json('delegado')
            : null;
    }

    unset($estudiante);

    return view('delegados.index', compact('estudiantes'));
}


public function retirar($id)
{
    $respuesta = Http::delete(
        'http://127.0.0.1:8000/api/estudents/' . $id . '/delegado'
    );

    if ($respuesta->failed()) {
        return back()->withErrors([
            'api' => 'No se pudo retirar el delegado.'
        ]);
    }

    return redirect()->route('delegados.index')
        ->with('success', 'Delegado retirado correctamente.');
}
}