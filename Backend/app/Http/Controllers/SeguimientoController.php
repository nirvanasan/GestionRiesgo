<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seguimiento;

class SeguimientoController extends Controller
{
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'control_actual' => 'required|string',
            'p1' => 'required|in:Sí,No',
            'p2' => 'required|in:Sí,No',
            'p3' => 'required|in:Sí,No',
            'p4' => 'required|in:Sí,No',
            'accion_id' => 'required|exists:acciones,id_elemento',
            'probabilidad' => 'required|integer|min:0|max:5',
            'fecha' => 'required|date',
            'impacto' => 'required|integer|min:0|max:5',
            'valoracion_riesgo' => 'required|integer',
            'valoracion_control' => 'required|integer',
            'valoracion_total' => 'required|integer',
            'justificacion' => 'nullable|string',
            'proximo_seguimiento' => 'nullable|date'
        ]);

        // Creación del registro en la base de datos
        $seguimiento = Seguimiento::create($request->all());

        return response()->json([
            'message' => 'Seguimiento guardado con éxito',
            'data' => $seguimiento
        ], 201);
    }
}
