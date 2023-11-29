<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'user' => $user,
            'auth' => [
                'token' => $token,
                'type' => 'bearer'
            ]
        ]);
    }

    public function register(RegisterRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'User created successfully'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Logged out'
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'token' => Auth::refresh()
        ]);
    }

    public function profile()
    {
        $profile = Auth::user();
        return response()->json([
            'profile' => $profile,
        ]);
    }
}
