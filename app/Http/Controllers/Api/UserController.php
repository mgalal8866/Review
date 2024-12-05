<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function login(Request $request)
    {

        $creadebtions = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if (!Auth::attempt($creadebtions)) {
            return response()->json(['message' => 'Invalid credentials']);
        }
        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $user->token = $token;
        return  response()->json(['user' => $user, 'message' => 'Success']);
    }
}
