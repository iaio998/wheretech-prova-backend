<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(['message' => 'You are logged in']);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}