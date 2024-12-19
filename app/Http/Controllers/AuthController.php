<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Authenticate the user
        $user = Auth::attempt($request->only('email', 'password'));

        if (!$user) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return $user;
    }

    public function register(Request $request)
    {
        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'birthday' => $request->birthday,
            'password' => $request->password,
            'role' => 'customer'
        ]);

        Auth::loginUsingId($user->id);

        return $user;
    }

    public function getMe()
    {
        return Auth::user();
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out successfully.']);
    }
}
