<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreHumanRequest;
use App\Models\Human;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthGodController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:god', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        if(str_contains($request ->url(), "olimpus/humans/login")){
            $response = $this->loginHumans($request);
        } elseif(str_contains($request ->url(), "olimpus/gods/login")){
            $response = $this -> loginGods($request);
        }else{
            $response = response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        return $response;
    }

    public function register(Request $request){

        if(str_contains($request ->url(), "olimpus/humans/register")){
            $response = $this->registerHuman(StoreHumanRequest::createFrom($request));
        }else{
            $response = response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        return $response;

    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }


    private function loginGods(Request $request){
        $request->validate([
            'godname' => 'required|string',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('godname', 'password');


        $token = auth()->guard("god")-> attempt($credentials);//Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = auth()->guard("god")-> user();//Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

}
