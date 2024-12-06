<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dofa;
use App\Models\Amenaza;
use App\Models\Oportunidad;
use App\Models\Fortaleza;
use App\Models\Debilidad;

class VerDofaController extends Controller
{
    public function buscar(Request $request)

    {

        // Validar los parámetros de búsqueda
        $validated = $request->validate([
            'id_usuario' => 'required|integer', // Usuario es obligatorio
            'dofa' => 'nullable|string|in:Debilidad,Amenaza,Oportunidad,Fortaleza', // Tipo de DOFA opcional
            'tipo' => 'nullable|string|in:Operativo,Estratégico,Táctico', // Tipo de categoría opcional
            'area' => 'nullable|string|in:Sistemas,Gestión Humana,Producción' // Área opcional
        ]);

        // Capturar los parámetros validados
        $idUsuario = $validated['id_usuario'];
        $dofa = $validated['dofa'] ?? null; // Tipo de DOFA (si se pasa)
        $tipo = $validated['tipo'] ?? null; // Tipo de categoría (si se pasa)
        $area = $validated['area'] ?? null; // Área (si se pasa)

        // Inicializar los resultados con todos los tipos
        $resultados = [
            'Debilidades' => [],
            'Amenazas' => [],
            'Oportunidades' => [],
            'Fortalezas' => []
        ];

        // Función para filtrar datos por tipo y área
        $applyFilters = function ($query) use ($tipo, $area) {
            if ($tipo) {
                $query->where('tipo', $tipo); // Solo filtrar por tipo si está presente
            }
            if ($area) {
                $query->where('descripcion', 'like', "%$area%");
            }
        };

        // Si no se pasa un tipo de DOFA o se pasa null, se buscan todas las categorías
        if (!$dofa || $dofa === 'Debilidad') {
            $resultados['Debilidades'] = Debilidad::whereHas('dofa', function ($query) use ($idUsuario) {
                $query->where('id_usuario', $idUsuario);
            })->where($applyFilters)->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'codigo_debilidad' => $item->codigo_debilidad,
                    'descripcion' => $item->descripcion,
                    'tipo' => $item->tipo,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at
                ];
            });
        }

        if (!$dofa || $dofa === 'Amenaza') {
            $resultados['Amenazas'] = Amenaza::whereHas('dofa', function ($query) use ($idUsuario) {
                $query->where('id_usuario', $idUsuario);
            })->where($applyFilters)->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'codigo_amenaza' => $item->codigo_amenaza,
                    'descripcion' => $item->descripcion,
                    'tipo' => $item->tipo,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at
                ];
            });
        }

        if (!$dofa || $dofa === 'Oportunidad') {
            $resultados['Oportunidades'] = Oportunidad::whereHas('dofa', function ($query) use ($idUsuario) {
                $query->where('id_usuario', $idUsuario);
            })->where($applyFilters)->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'codigo_oportunidad' => $item->codigo_oportunidad,
                    'descripcion' => $item->descripcion,
                    'tipo' => $item->tipo,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at
                ];
            });
        }

        if (!$dofa || $dofa === 'Fortaleza') {
            $resultados['Fortalezas'] = Fortaleza::whereHas('dofa', function ($query) use ($idUsuario) {
                $query->where('id_usuario', $idUsuario);
            })->where($applyFilters)->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'codigo_fortaleza' => $item->codigo_fortaleza,
                    'descripcion' => $item->descripcion,
                    'tipo' => $item->tipo,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at
                ];
            });
        }

        // Retornar la respuesta
        return response()->json($resultados, 200);
    }

}
