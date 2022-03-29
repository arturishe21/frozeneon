<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Login $request)
    {
        if (Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status' => 'success',
                'user' => Auth::user()
            ]);
        }

        return response()->json([
            'status' => 'error',
        ]);
    }

    public function logout()
    {
        Auth::logout();
    }

    public function getUser()
    {
        return Auth::user();
    }

}
