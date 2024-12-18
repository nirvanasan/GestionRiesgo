<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Dofa;
use App\Models\Amenaza;
use App\Models\Oportunidad;
use App\Models\Fortaleza;
use App\Models\Debilidad;

class AnalisisDofaController extends Controller
{
    public function getAnalisisDofaByUser(Request $request)
    {
        // Validar que se envíe el id_usuario
        $request->validate([
            'id_usuario' => 'required|integer|exists:users,id',
        ]);

        $idUsuario = $request['id_usuario'];
        $dofa = $validated['dofa'] ?? null;
        $tipo = $validated['tipo'] ?? null;
        $proceso = $validated['proceso'] ?? null;

        $resultados = [
            'Debilidades' => [],
            'Amenazas' => [],
            'Oportunidades' => [],
            'Fortalezas' => []
        ];

        // Consultar cada categoría según los filtros
        if (!$dofa || $dofa === 'Debilidad') {
            $resultados['Debilidades'] = Debilidad::whereHas('dofa', function ($query) use ($idUsuario, $proceso) {
                $query->where('id_usuario', $idUsuario);
                if ($proceso) {
                    $query->where('id_proceso', $proceso);
                }
            })->when($tipo, function ($query, $tipo) {
                $query->where('tipo', $tipo);
            })->get();
        }

        if (!$dofa || $dofa === 'Amenaza') {
            $resultados['Amenazas'] = Amenaza::whereHas('dofa', function ($query) use ($idUsuario, $proceso) {
                $query->where('id_usuario', $idUsuario);
                if ($proceso) {
                    $query->where('id_proceso', $proceso);
                }
            })->when($tipo, function ($query, $tipo) {
                $query->where('tipo', $tipo);
            })->get();
        }

        if (!$dofa || $dofa === 'Oportunidad') {
            $resultados['Oportunidades'] = Oportunidad::whereHas('dofa', function ($query) use ($idUsuario, $proceso) {
                $query->where('id_usuario', $idUsuario);
                if ($proceso) {
                    $query->where('id_proceso', $proceso);
                }
            })->when($tipo, function ($query, $tipo) {
                $query->where('tipo', $tipo);
            })->get();
        }

        if (!$dofa || $dofa === 'Fortaleza') {
            $resultados['Fortalezas'] = Fortaleza::whereHas('dofa', function ($query) use ($idUsuario, $proceso) {
                $query->where('id_usuario', $idUsuario);
                if ($proceso) {
                    $query->where('id_proceso', $proceso);
                }
            })->when($tipo, function ($query, $tipo) {
                $query->where('tipo', $tipo);
            })->get();
        }

        // Retornar los resultados
        return response()->json($resultados, 200);
    }
}
