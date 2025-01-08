<?php

namespace App\Http\Controllers;

use App\Models\Control;
use App\Models\Clasificacion;
use Illuminate\Http\Request;

class ControlController extends Controller
{
    /**
     * Inserta un nuevo control en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'id_elemento' => 'required', // Asegúrate de que la tabla `elementos` existe
            'usuario' => 'required',  // Asegúrate de que la tabla `usuarios` existe
            'tipo' => 'required|in:Oportunidad,Riesgo',
            'descripcion' => 'required|string',
            'probabilidad' => 'required',
            'impacto' => 'required',
        ]);

        // Creación del registro
        $control = Control::create($validated);

        // Actualización del campo `control` en la tabla `clasificacion`
        Clasificacion::where('id_elemento', $validated['id_elemento'])->update(['control' => 1]);

        // Respuesta exitosa
        return response()->json([
            'message' => 'Control creado exitosamente',
            'control' => $control,
        ], 201);
    }
}
