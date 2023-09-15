<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profesores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfesoresController extends Controller
{
    public function index()
    {
        $profesores = Profesores::all();
        if ($profesores->count() > 0) {
            return response()->json([
                'status' => 200,
                'profesores' => $profesores
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'mensaje' => 'No hay registros'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:191',
            'edad' => 'nullable|integer|min:0', // Edad debe ser un número entero y puede ser nulo
            'materia' => 'required|string|max:100',
            'años_experiencia' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $profesor = Profesores::create([
                'nombre' => $request->nombre,
                'edad' => $request->edad,
                'materia' => $request->materia,
                'años_experiencia' => $request->años_experiencia,
            ]);

            if ($profesor) {
                return response()->json([
                    'status' => 200,
                    'message' => 'El profesor se agregó correctamente'
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Algo salió mal'
                ], 500);
            }
        }
    }

    public function show($id)
    {
        $profesor = Profesores::find($id);

        if ($profesor) {
            return response()->json([
                'status' => 200,
                'message' => $profesor
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Profesor no encontrado'
            ], 404);
        }
    }

    public function edit($id)
    {
        $profesor = Profesores::find($id);
        if ($profesor) {
            return response()->json([
                'status' => 200,
                'message' => $profesor
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Profesor no encontrado'
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:191',
            'edad' => 'nullable|integer|min:0', // Edad debe ser un número entero y puede ser nulo
            'materia' => 'required|string|max:100',
            'años_experiencia' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $profesor = Profesores::find($id);

            if ($profesor) {
                $profesor->update([
                    'nombre' => $request->nombre,
                    'edad' => $request->edad,
                    'materia' => $request->materia,
                    'años_experiencia' => $request->años_experiencia,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'El profesor ha sido actualizado'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Profesor no encontrado'
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $profesor = Profesores::find($id);

        if ($profesor) {
            $profesor->delete();
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Profesor no encontrado'
            ], 404);
        }
    }
}
