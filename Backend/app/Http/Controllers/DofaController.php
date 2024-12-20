<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dofa;
use App\Models\Amenaza;
use App\Models\Oportunidad;
use App\Models\Fortaleza;
use App\Models\Debilidad;
use Illuminate\Support\Facades\Auth;

class DofaController extends Controller
{
public function store(Request $request)
{
    $validated = $request->validate([
        'Debilidad' => 'array',
        'Amenaza' => 'array',
        'Oportunidad' => 'array',
        'Fortaleza' => 'array',
        'id_usuario' => 'required|integer',
        'id_proceso' => 'required|integer'
    ]);

    $idUsuario = $validated['id_usuario'];
    $idProceso = $validated['id_proceso'];
   

    // Procesar Debilidades
    foreach ($validated['Debilidad'] as $debilidad) {
        $registro = Debilidad::create([
            'descripcion' => $debilidad['descripcion'],
            'tipo' => $debilidad['tipo'],
        ]);
        // Recuperar el código generado
        $codigo = Debilidad::find($registro->id)->codigo;

        Dofa::create([
            'codigo' => $codigo,
            'id_usuario' => $idUsuario,
            'id_proceso' => $idProceso,
        ]);
    }

    // Procesar Amenazas
    foreach ($validated['Amenaza'] as $amenaza) {
        $registro = Amenaza::create([
            'descripcion' => $amenaza['descripcion'],
            'tipo' => $amenaza['tipo'],
        ]);
        // Recuperar el código generado
        $codigo = Amenaza::find($registro->id)->codigo;

        Dofa::create([
            'codigo' => $codigo,
            'id_usuario' => $idUsuario,
            'id_proceso' => $idProceso,
        ]);
    }

    // Procesar Oportunidades
    foreach ($validated['Oportunidad'] as $oportunidad) {
        $registro = Oportunidad::create([
            'descripcion' => $oportunidad['descripcion'] ?? '',
            'tipo' => $oportunidad['tipo'] ?? '',
        ]);
        // Recuperar el código generado
        $codigo = Oportunidad::find($registro->id)->codigo;

        Dofa::create([
            'codigo' => $codigo,
            'id_usuario' => $idUsuario,
            'id_proceso' => $idProceso,
        ]);
    }

    // Procesar Fortalezas
    foreach ($validated['Fortaleza'] as $fortaleza) {
        $registro = Fortaleza::create([
            'descripcion' => $fortaleza['descripcion'],
            'tipo' => $fortaleza['tipo'],
        ]);
        // Recuperar el código generado
        $codigo = Fortaleza::find($registro->id)->codigo;

        Dofa::create([
            'codigo' => $codigo,
            'id_usuario' => $idUsuario,
            'id_proceso' => $idProceso,
        ]);
    }

    return response()->json(['message' => 'Datos insertados con éxito'], 201);
}}