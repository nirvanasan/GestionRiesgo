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
        $dofa = $validated['dofa'] ?? null;
        $tipo = $validated['tipo'] ?? null;
        $area = $validated['area'] ?? null;

        // Inicializar los resultados
        $resultados = [];

        // Función para filtrar datos por tipo y área
        $applyFilters = function ($query) use ($tipo, $area) {
            if ($tipo) {
                $query->where('tipo', $tipo);
            }
            if ($area) {
                $query->where('descripcion', 'like', "%$area%");
            }
        };

        // Filtrar por tipo de DOFA
        if (!$dofa || $dofa === 'Debilidad') {
            $resultados['Debilidades'] = Debilidad::whereHas('dofa', function ($query) use ($idUsuario) {
                $query->where('id_usuario', $idUsuario);
            })->where($applyFilters)->get();
        }

        if (!$dofa || $dofa === 'Amenaza') {
            $resultados['Amenazas'] = Amenaza::whereHas('dofa', function ($query) use ($idUsuario) {
                $query->where('id_usuario', $idUsuario);
            })->where($applyFilters)->get();
        }

        if (!$dofa || $dofa === 'Oportunidad') {
            $resultados['Oportunidades'] = Oportunidad::whereHas('dofa', function ($query) use ($idUsuario) {
                $query->where('id_usuario', $idUsuario);
            })->where($applyFilters)->get();
        }

        if (!$dofa || $dofa === 'Fortaleza') {
            $resultados['Fortalezas'] = Fortaleza::whereHas('dofa', function ($query) use ($idUsuario) {
                $query->where('id_usuario', $idUsuario);
            })->where($applyFilters)->get();
        }

        // Retornar la respuesta
        return response()->json($resultados, 200);
    }
}
