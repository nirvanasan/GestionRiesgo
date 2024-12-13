<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proceso;

class ProcesoController extends Controller
{
    /**
     * Maneja la creación de un proceso.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);
        // Crear el proceso
        Proceso::create($validatedData);

        return response()->json(['message' => 'Proceso creado exitosamente'], 201);
    }

    public function buscar()
    {
        // Obtener todos los nombres de los procesos
        $procesos = Proceso::select('id', 'nombre')->get();

        return response()->json($procesos);
    }
}
