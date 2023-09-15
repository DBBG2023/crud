<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estudiantes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstudiantesController extends Controller
{
    public function index(){
        $estudiantes = Estudiantes::all();
        if($estudiantes->count() > 0){
            return response()->json([
                'status' => 200,
                'estudiantes' => $estudiantes
            ], 200);  
        }else{
            return response()->json([
                'status' => 404,
                'mensaje' => 'No hay registros'
            ], 404);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|string|max:191',
            'edad' => 'nullable|integer|min:0', // Edad debe ser un número entero y puede ser nulo
            'grado' => 'nullable|integer|min:0', // Grado debe ser una cadena de hasta 50 caracteres y puede ser nulo
            'promedio' => 'nullable|numeric|between:0,100',
        ]);

        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()               
            ], 422);

        }else{
            $estudiantes = Estudiantes::create([
                'nombre' => $request->nombre,
                'edad' => $request->edad,
                'grado' => $request->grado,
                'promedio' => $request->promedio,
            ]);
            
            if($estudiantes){
                return response()->json([
                    'status' => 200,
                    'message' => 'El estudiante se agrego correctamente'               
                ], 200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => 'Algo salio mal'               
                ], 500);
            }

        }
    }

    public function show($id){
        $estudiantes = Estudiantes::find($id);

        if($estudiantes){
            return response()->json([
                'status' => 200,
                'message' => $estudiantes             
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Estudiante no encontrado'               
            ], 404);
        }

    }

    public function edit($id){
        
        $estudiantes = Estudiantes::find($id);
        if($estudiantes){
            return response()->json([
                'status' => 200,
                'message' => $estudiantes             
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Estudiante no encontrado'               
            ], 404);
        }

    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|string|max:191',
            'edad' => 'nullable|integer|min:0', // Edad debe ser un número entero y puede ser nulo
            'grado' => 'nullable|integer|min:0', // Grado debe ser una cadena de hasta 50 caracteres y puede ser nulo
            'promedio' => 'nullable|numeric|between:0,100',
        ]);

        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()               
            ], 422);

        }else{
            $estudiantes = Estudiantes::find($id);
            
            
            if($estudiantes){

                $estudiantes->update([
                    'nombre' => $request->nombre,
                    'edad' => $request->edad,
                    'grado' => $request->grado,
                    'promedio' => $request->promedio,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'El estudiante ha sido actualizado'               
                ], 200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Algo salio mal'               
                ], 404);
            }

        }
    }


    public function destroy($id){
        $estudiantes = Estudiantes::find($id);

        if($estudiantes){

            $estudiantes->delete();

        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Algo salio mal'               
            ], 404);
        }
    }

}