<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    // Método de login
    public function login(Request $request)
    {
        // Validación de los datos de entrada
        $credentials = $request->only('email', 'password');

        // Intentar iniciar sesión con las credenciales
        if (Auth::attempt($credentials)) {
            // Si la autenticación tiene éxito, devolver el usuario autenticado
            return response()->json(['message' => 'Login exitoso', 'user' => Auth::user()], 200);
        }

        // Si la autenticación falla, devolver un mensaje de error
        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }

    // Método de registro (opcional)
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Usuario registrado con éxito'], 201);
    }
}
