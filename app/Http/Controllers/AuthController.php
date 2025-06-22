<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $user = JWTAuth::user();
        if ($user->role !== 'admin') {
            return response()->json(['error' => 'Access denied'], 403);
        }

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function register(Request $request)
    {
        try {   
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'nullable|string|in:admin,user',
        ]);

        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'] ?? 'admin',
        ]);

        \Log::info('Admin registered successfully', ['user' => $user] );

        $token = JWTAuth::fromUser($user);
        \Log::info('Admin registered successfully', ['user' => $user] );
        \Log::info('Token generated', ['token' => $token]);
        return response()->json([
            'message' => 'Admin registered successfully.',
            'user' => $user,
            'token' => $token,
        ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'message' => 'Validation failed.',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        \Log::error('Error registering admin', ['error' => $e->getMessage()]);

        return response()->json([
            'message' => 'An error occurred during registration.',
            'error' => $e->getMessage()
        ], 500);
    }
    }
}
