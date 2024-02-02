<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(UserLoginRequest $request)
    {

        $credentials = $request->only('email', 'password');



        if (Auth::attempt($credentials)) {

                $user = User::where('email', $credentials['email'])->firstorFail();
                $token = $user->createToken('auth_token')->plainTextToken;
           
            
            return response()->json([
                'message' => 'Login Correcto',
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]);
        } else {
            return response()->json([
                'message' => 'Login Incorrecto'
            ]);
        }
    }
    /**
     * Logout user (Revoke the token)
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logout Correcto'
        ]);
    }
}
