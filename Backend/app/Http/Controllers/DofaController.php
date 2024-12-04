<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dofa;
use App\Models\Amenaza;
use App\Models\Fortaleza;
use App\Models\Debilidad;
use App\Models\Oportunidad;
use Illuminate\Support\Facades\Auth;

class DofaController extends Controller
{
    public function guardar(Request $request)
    {
        // Obtener el ID del usuario autenticado
        //$idUsuario = Auth::id();
        $idUsuario = 6;

        // Validar la estructura del JSON recibido
        $data = $request->validate([
            'Debilidad' => 'array',
            'Amenaza' => 'array',
            'Oportunidad' => 'array',
            'Fortaleza' => 'array',
            'Debilidad.*.tipo' => 'required|string',
            'Debilidad.*.descripcion' => 'required|string',
            'Amenaza.*.tipo' => 'required|string',
            'Amenaza.*.descripcion' => 'required|string',
            'Oportunidad.*.tipo' => 'required|string',
            'Oportunidad.*.descripcion' => 'required|string',
            'Fortaleza.*.tipo' => 'required|string',
            'Fortaleza.*.descripcion' => 'required|string',
        ]);

        // Procesar cada elemento y guardar en la tabla correspondiente
        $codigos = []; // Para almacenar los códigos generados

        // Insertar Debilidades
        foreach ($data['Debilidad'] as $debilidad) {
            $debilidadModel = Debilidad::create([
                'descripcion' => $debilidad['descripcion'],
                'tipo' => $debilidad['tipo']
            ]);
            $codigos[] = $debilidadModel->codigo;
        }

        // Insertar Amenazas
        foreach ($data['Amenaza'] as $amenaza) {
            $amenazaModel = Amenaza::create([
                'descripcion' => $amenaza['descripcion'],
                'tipo' => $amenaza['tipo']
            ]);
            $codigos[] = $amenazaModel->codigo;
        }

        // Insertar Oportunidades
        foreach ($data['Oportunidad'] as $oportunidad) {
            $oportunidadModel = Oportunidad::create([
                'descripcion' => $oportunidad['descripcion'],
                'tipo' => $oportunidad['tipo']
            ]);
            $codigos[] = $oportunidadModel->codigo;
        }

        // Insertar Fortalezas
        foreach ($data['Fortaleza'] as $fortaleza) {
            $fortalezaModel = Fortaleza::create([
                'descripcion' => $fortaleza['descripcion'],
                'tipo' => $fortaleza['tipo']
            ]);
            $codigos[] = $fortalezaModel->codigo;
        }

        // Insertar en la tabla DOFA
        foreach ($codigos as $codigo) {
            Dofa::create([
                'codigo' => $codigo,
                'id_usuario' => $idUsuario
            ]);
        }

        return response()->json(['message' => 'Datos guardados exitosamente']);
    }
}
