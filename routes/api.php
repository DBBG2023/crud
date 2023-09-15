<?php

use App\Http\Controllers\Api\EstudiantesController;
use App\Http\Controllers\Api\CursosController;
use App\Http\Controllers\Api\ProfesoresController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Estudiantes
Route::get('estudiantes', [EstudiantesController::class, 'index']);
Route::post('estudiantes', [EstudiantesController::class, 'store']);
Route::get('estudiantes/{id}', [EstudiantesController::class, 'show']);
Route::get('estudiantes/{id}/edit', [EstudiantesController::class, 'edit']);
Route::put('estudiantes/{id}/edit', [EstudiantesController::class, 'update']);
Route::delete('estudiantes/{id}/delete', [EstudiantesController::class, 'destroy']);

//Profesores

Route::get('profesores', [ProfesoresController::class, 'index']);
Route::post('profesores', [ProfesoresController::class, 'store']);
Route::get('profesores/{id}', [ProfesoresController::class, 'show']);
Route::get('profesores/{id}/edit', [ProfesoresController::class, 'edit']);
Route::put('profesores/{id}/edit', [ProfesoresController::class, 'update']);
Route::delete('profesores/{id}/delete', [ProfesoresController::class, 'destroy']);


//Cursos
Route::get('cursos', [CursosController::class, 'index']);
Route::post('cursos', [CursosController::class, 'store']);
Route::get('cursos/{id}', [CursosController::class, 'show']);
Route::get('cursos/{id}/edit', [CursosController::class, 'edit']);
Route::put('cursos/{id}/edit', [CursosController::class, 'update']);
Route::delete('cursos/{id}/delete', [CursosController::class, 'destroy']);

//Route::post('estudiantes', 'Api\EstudiantesController@store');
