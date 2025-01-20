<?php

namespace App\Http\Controllers;

use App\Models\Accion;
use Illuminate\Http\Request;


class AccionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_elemento' => 'required|string',
            'tipo' => 'required|string',
            'informacion' => 'required|string',
            'accion' => 'required|string',
            'responsable' => 'required|string',
            'acciones' => 'required|string',
            'proceso' => 'required|string',
            'fecha_seguimiento' => 'required|date',
            'fecha_cierre' => 'required|date',
        ]);

        $accion = Accion::create($request->all());

        return response()->json([
            'message' => 'Acción registrada exitosamente',
            'data' => $accion
        ], 201);
    }
}
