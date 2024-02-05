<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function username(){
        return 'run';
    }
    protected function credentials(Request $request)
    {
        //return $request->only($this->username(), 'password');
        return $request->only($this->username(), 'password');
    }
    public function login(UserLoginRequest $request)
    {

        $credentials = $request->only('run', 'password');

        //dd($credentials);

        if (Auth::attempt($credentials)) {

                $user = User::where('run', $credentials['run'])->firstorFail();
                $token = $user->createToken('auth_token')->plainTextToken;
                $cookie = cookie('access_token', $token, 60 * 24);
           
            
            return response()->json([
                'message' => 'Login Correcto',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ],200)->header('Authorization', 'Bearer ' . $token)->withoutCookie($cookie)->withHeaders([
                'X-User-ID' => $user->id,
            ]
                
            );

        } else {
            return response()->json([
                'message' => 'Login Incorrecto'
            ], 401);
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
