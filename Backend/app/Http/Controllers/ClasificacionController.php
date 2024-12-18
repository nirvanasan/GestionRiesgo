<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClasificacionController extends Controller
{
    public function clasificacion(Request $request)
    {

        $request->validate([
            'chimbada' => 'required|integer',
        ]);

        $idUsuario = $request['chimbada'];

        if($idUsuario == 1){
            return response()->json("Melo pa", 200);
        }else{
            return response()->json("Nonas pa", 200);
        }

        
    }
}
