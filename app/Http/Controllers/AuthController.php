<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['Not authorized' => 'Incorrect data'], 401);
        }

        // Guardar el token en la sesión
        $request->session()->put('token', $token);

        // Autenticar al usuario manualmente
        $user = Auth::user();
        return redirect()->route('dashboard')->with(['user' => $user]);
    }
}
