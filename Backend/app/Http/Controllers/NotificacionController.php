<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;

class NotificacionController extends Controller
{
    // Obtener las notificaciones de un usuario específico
    public function index(Request $request)
    {
        $usuarioId = $request->query('usuario');

        if (!$usuarioId) {
            return response()->json(['error' => 'Usuario no especificado'], 400);
        }

        $notificaciones = Notificacion::where('id_usuario', $usuarioId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notificaciones);
    }

    // Crear una nueva notificación
    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:users,id',
            'mensaje' => 'required|string'
        ]);

        Notificacion::create([
            'id_usuario' => $request->id_usuario,
            'mensaje' => $request->mensaje,
            'leida' => false
        ]);

        return response()->json(['message' => 'Notificación registrada con éxito'], 200);
    }

    // Marcar una notificación como leída
    public function marcarComoLeida($id)
    {
        $notificacion = Notificacion::find($id);

        if (!$notificacion) {
            return response()->json(['error' => 'Notificación no encontrada'], 404);
        }

        $notificacion->update(['leida' => true]);

        return response()->json(['message' => 'Notificación marcada como leída'], 200);
    }
}
