<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clasificacion;
use App\Models\Dofa;
use Illuminate\Http\JsonResponse;

class ClasificacionController extends Controller
{
    public function store(Request $request)
    {
        // Validación de datos
        $validatedData = $request->validate([
            'id_elemento' => 'required|string',
            'id_usuario' => 'required|integer',
            'tipo' => 'required|string|in:Oportunidad,Riesgo',
            'causa' => 'required|string',
            'efecto' => 'required|string',
            'probabilidad' => 'required|integer|min:1|max:5',
            'impacto' => 'required|integer|min:1|max:5',
            'valoracion' => 'required|integer|min:1',
        ]);

        // Crear el registro en la base de datos
        $clasificacion = Clasificacion::create($validatedData);

           // Buscar el registro en la tabla DOFA basado en id_elemento (Codigo)
        $dofa = Dofa::where('Codigo', $validatedData['id_elemento'])->first();


        if ($dofa) {
            // Actualizar el campo 'clasificacion' a 1
            $dofa->clasificacion = true;
            $dofa->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Registro creado exitosamente.',
            'data' => $clasificacion,
        ], 201);
    }

    public function index(Request $request): JsonResponse
    {
        try {
            // Validar si se envió el campo 'id_usuario' y es un entero
            $idUsuario = $request->input('id_usuario');
    
            // Construir la consulta
            $query = Clasificacion::where('control', 0);
    
            // Aplicar el filtro si 'id_usuario' es proporcionado
            if ($idUsuario !== null && is_numeric($idUsuario)) {
                $query->where('id_usuario', (int) $idUsuario);
            }
    
            // Ejecutar la consulta
            $clasificaciones = $query->get();
    
            // Retornar los datos
            return response()->json([
                'success' => true,
                'data' => $clasificaciones,
            ]);
        } catch (\Exception $e) {
            // Manejar errores y retornar un mensaje apropiado
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al obtener las clasificaciones.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
