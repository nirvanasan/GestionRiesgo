<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dofa;
use App\Models\Amenaza;
use App\Models\Oportunidad;
use App\Models\Fortaleza;
use App\Models\Debilidad;
use App\Models\Clasificacion;
use App\Models\Control;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    }

    public function buscar(Request $request) {
        $prueba = DB::table('Dofa')
            ->leftJoin('clasificacion', 'Dofa.Codigo', '=', 'clasificacion.id_elemento')
            ->leftJoin('controles', 'clasificacion.id_elemento', '=', 'controles.id_elemento')
            ->leftJoin('acciones', 'controles.id_elemento', '=', 'acciones.id_elemento')
            ->leftJoin('seguimiento', 'acciones.id_elemento', '=', 'seguimiento.accion_id')
            ->select(
                'Dofa.id as dofa_id',
                'Dofa.Codigo as dofa_codigo',
                'Dofa.id_usuario as dofa_usuario',
                'Dofa.id_proceso as dofa_proceso',
                'Dofa.created_at as dofa_created_at',
                
    
                'clasificacion.tipo as clasificacion_tipo',
                'clasificacion.causa as clasificacion_causa',
                'clasificacion.efecto as clasificacion_efecto',
                'clasificacion.probabilidad as clasificacion_probabilidad',
                'clasificacion.impacto as clasificacion_impacto',
                'clasificacion.valoracion as clasificacion_valoracion',
    
                'controles.descripcion as control_descripcion',
                'controles.probabilidad as control_probabilidad',
                'controles.impacto as control_impacto',
    
                'acciones.informacion as accion_informacion',
                'acciones.accion as accion_detalle',
                'acciones.responsable as accion_responsable',
                'acciones.acciones as accion_acciones',
                'acciones.proceso as accion_proceso',
                'acciones.fecha_seguimiento as accion_fecha_seguimiento',
                'acciones.fecha_cierre as accion_fecha_cierre',
    
                'seguimiento.control_actual as seguimiento_control_actual',
                'seguimiento.p1 as seguimiento_p1',
                'seguimiento.p2 as seguimiento_p2',
                'seguimiento.p3 as seguimiento_p3',
                'seguimiento.p4 as seguimiento_p4',
                'seguimiento.probabilidad as seguimiento_probabilidad',
                'seguimiento.fecha as seguimiento_fecha',
                'seguimiento.impacto as seguimiento_impacto',
                'seguimiento.valoracion_riesgo as seguimiento_valoracion_riesgo',
                'seguimiento.valoracion_control as seguimiento_valoracion_control',
                'seguimiento.valoracion_total as seguimiento_valoracion_total',
                'seguimiento.justificacion as seguimiento_justificacion'
            )
            ->orderBy('Dofa.id', 'asc')
            ->get();
    
        return response()->json($prueba, 201);
    }
    
}