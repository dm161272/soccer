<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
   
    public function register(Request $request)
    {
        $data = $request->validate([

            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|string|unique:users,email',
            'password' => [ 'required', 'confirmed',

            Password::min(8)
            ]

        ]);

/** @var \app\Models\User $user */

        $user = User::create([

            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ]);

    }
}
