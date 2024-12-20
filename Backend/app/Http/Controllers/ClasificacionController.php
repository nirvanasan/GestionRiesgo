<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clasificacion;

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

        return response()->json([
            'success' => true,
            'message' => 'Registro creado exitosamente.',
            'data' => $clasificacion,
        ], 201);
    }
}
