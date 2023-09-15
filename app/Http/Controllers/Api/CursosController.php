<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CursosController extends Controller
{
    public function index()
    {
        $cursos = Cursos::all();
        if ($cursos->count() > 0) {
            return response()->json([
                'status' => 200,
                'cursos' => $cursos
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
            'nivel' => 'required|string|max:50',
            'capacidad' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $curso = Cursos::create([
                'nombre' => $request->nombre,
                'nivel' => $request->nivel,
                'capacidad' => $request->capacidad,
            ]);

            if ($curso) {
                return response()->json([
                    'status' => 200,
                    'message' => 'El curso se agregó correctamente'
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
        $curso = Cursos::find($id);

        if ($curso) {
            return response()->json([
                'status' => 200,
                'message' => $curso
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Curso no encontrado'
            ], 404);
        }
    }

    public function edit($id)
    {
        $curso = Cursos::find($id);
        if ($curso) {
            return response()->json([
                'status' => 200,
                'message' => $curso
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Curso no encontrado'
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:191',
            'nivel' => 'required|string|max:50',
            'capacidad' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $curso = Cursos::find($id);

            if ($curso) {
                $curso->update([
                    'nombre' => $request->nombre,
                    'nivel' => $request->nivel,
                    'capacidad' => $request->capacidad,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'El curso ha sido actualizado'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Curso no encontrado'
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $curso = Cursos::find($id);

        if ($curso) {
            $curso->delete();
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Curso no encontrado'
            ], 404);
        }
    }
}
