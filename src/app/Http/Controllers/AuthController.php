<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'username'  =>  'required|string',
            'password'  =>  'required|string|min:8'
        ]);

        $credentials = [
            'email'     => $request->username,
            'password'  => $request->password
        ];

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return redirect()->route('chat');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login.form');
    }
}
