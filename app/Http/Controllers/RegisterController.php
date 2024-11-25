<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /**
     * Registra un nuevo usuario en la base de datos.
     */
    public function register(Request $request)
    {
        

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',  // Validación para contraseñas
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); // Si la validación falla, devolvemos un error
        }

        // Crear el nuevo usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Usamos Hash::make para encriptar la contraseña
         
        ]);

        // Emitir el evento de registrado (opcional, por ejemplo, para enviar un correo de bienvenida)
        //event(new Registered($user));

        // Retornar una respuesta exitosa
        return response()->json([
            'message' => 'Usuario registrado con éxito',
            'user' => $user,
        ], 201);
    }
}
