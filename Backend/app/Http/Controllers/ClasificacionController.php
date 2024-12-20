<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clasificacion;
use App\Models\Dofa;

class ClasificacionController extends Controller
{
    public function store(Request $request)
    {
        // Validación de datos
        $validatedData = $request->validate([
            'id_elemento' => 'required|string',
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
}
