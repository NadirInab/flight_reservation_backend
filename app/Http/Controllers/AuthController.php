<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User ;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Registration
    public function register(Request $request)
    {
        // return $request ;
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        $response = [
            "user" => $user , 
            "token" => $token
        ] ;

        return response($response, 201) ;

        // return response()->json(['token' => $token], 201);
    }

    // Authentication
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($validatedData)) {
            return response()->json(['message' => 'Invalid login details'], 401);
        }

        $token = auth()->user()->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    // Logout
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out'], 200);
    }
}
