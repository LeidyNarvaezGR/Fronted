<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\EstudentController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\DelegadoController;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/teachers', [TeacherController::class, 'index'])
    ->name('teachers.index');

    Route::get('/teachers/create', [TeacherController::class, 'create'])
    ->name('teachers.create');

Route::post('/teachers', [TeacherController::class, 'store'])
    ->name('teachers.store');

    Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])
    ->name('teachers.edit');

Route::put('/teachers/{id}', [TeacherController::class, 'update'])
    ->name('teachers.update');

    Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])
    ->name('teachers.destroy');

    Route::get('/estudents', [EstudentController::class, 'index'])
    ->name('estudents.index');

    Route::get('/estudents/create', [EstudentController::class, 'create'])
    ->name('estudents.create');

Route::post('/estudents', [EstudentController::class, 'store'])
    ->name('estudents.store');

    Route::get('/estudents/{id}/edit', [EstudentController::class, 'edit'])
    ->name('estudents.edit');

Route::put('/estudents/{id}', [EstudentController::class, 'update'])
    ->name('estudents.update');

    Route::delete('/estudents/{id}', [EstudentController::class, 'destroy'])
    ->name('estudents.destroy');

    Route::get('/modules', [ModuleController::class, 'index'])
    ->name('modules.index');

    Route::get('/modules/create', [ModuleController::class, 'create'])
    ->name('modules.create');

Route::post('/modules', [ModuleController::class, 'store'])
    ->name('modules.store');

    Route::get('/modules/{id}/edit', [ModuleController::class, 'edit'])
    ->name('modules.edit');

Route::put('/modules/{id}', [ModuleController::class, 'update'])
    ->name('modules.update');

    Route::delete('/modules/{id}', [ModuleController::class, 'destroy'])
    ->name('modules.destroy');

    Route::get('/matriculas/create', [MatriculaController::class, 'create'])
    ->name('matriculas.create');

Route::post('/matriculas', [MatriculaController::class, 'store'])
    ->name('matriculas.store');

    Route::get('/matriculas/modulo/{id}', [MatriculaController::class, 'estudiantesModulo'])
    ->name('matriculas.estudiantes');

    Route::delete('/matriculas/retirar', [MatriculaController::class, 'retirar'])
    ->name('matriculas.retirar');


Route::get('/asignaciones/create', [AsignacionController::class, 'create'])
    ->name('asignaciones.create');

Route::post('/asignaciones', [AsignacionController::class, 'store'])
    ->name('asignaciones.store');
    
    Route::get('/asignaciones/modulo/{id}', [AsignacionController::class, 'profesoresModulo'])
    ->name('asignaciones.profesores');

    Route::delete('/asignaciones/retirar', [AsignacionController::class, 'retirar'])
    ->name('asignaciones.retirar');

    Route::get('/matriculas/estudiante/{id}', [MatriculaController::class, 'modulosEstudiante'])
    ->name('matriculas.modulos-estudiante');

    Route::get('/asignaciones/profesor/{id}', [AsignacionController::class, 'modulosProfesor'])
    ->name('asignaciones.modulos-profesor');

    
Route::get('/delegados/create', [DelegadoController::class, 'create'])
    ->name('delegados.create');

Route::post('/delegados', [DelegadoController::class, 'store'])
    ->name('delegados.store');

    Route::get('/delegados', [DelegadoController::class, 'index'])
    ->name('delegados.index');

Route::delete('/delegados/{id}', [DelegadoController::class, 'retirar'])
    ->name('delegados.retirar');