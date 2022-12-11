<?php

namespace App\Http\Controllers;

use App\Models\Human;
use App\Http\Requests\StoreHumanRequest;
use App\Http\Requests\UpdateHumanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HumanAuthController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:human', ['except' => ['login','register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = auth()->guard("human")-> attempt($credentials);//Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = auth()->guard("human")-> user();//Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);

    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:humans',
            'password' => 'required|string|min:6',
        ]);

        $virtues = [
            rand(1, 5),
            rand(1, 5),
            rand(1, 5),
            rand(1, 5),
            rand(1, 5)
        ];

        $gods = DB::table("gods") -> select('wisdom', 'nobility', 'virtue', 'wickedness', 'audacity') -> get();
        $godIds = DB::table("gods") -> select('id') -> get();

        $compatibility = $gods -> map(function($item) use ($virtues) {
            $array = (array)$item;
            return array_sum(array_map(function($godVirtue, $humanVirtue){
                    return abs($godVirtue - $humanVirtue);
                },$array, $virtues)
            );
        }); // Algoritmo para el mas compatible

        $mostCompatible = array_search(min($compatibility ->all()), $compatibility ->all());  // Algoritmo para el mas compatible
        $request -> request ->add([
            "fate" => 0,
            'god_id' => $godIds -> get($mostCompatible) -> id,
            'wisdom' => $virtues[0],
            'nobility' => $virtues[1],
            'virtue' => $virtues[2],
            'wickedness' => $virtues[3],
            'audacity' => $virtues[4],
            'alive' => 1,
            'destiny' => "heaven"
        ]);
        $password = $request -> request -> get("password");
        $request -> request -> set("password", Hash::make($password));
        $user = new Human;
        $user -> forceFill($request -> request -> all());
        $user -> save();

        $token = auth() -> guard("human") -> login($user);//Auth::login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
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

    public function updatePassword(Request $request){
        $user = Auth::user();
        $user -> setAttribute("password", Hash::make($request -> request ->get("password")));
        $user -> save();
        return response()->json([
            'status' => 'success',
        ]);
    }
}
