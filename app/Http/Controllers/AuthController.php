<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreHumanRequest;
use App\Models\Human;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function register(StoreHumanRequest $request){
        $validated = $request -> validate($request -> rules());

        if(!$validated) return null;
        $virtues = [
            rand(1, 5),
            rand(1, 5),
            rand(1, 5),
            rand(1, 5),
            rand(1, 5)
        ];

        $gods = DB::table("god") -> select('wisdom', 'nobility', 'virtue', 'wickedness', 'audacity') -> get();
        $godNames = DB::table("god") -> select('godname') -> get();

        $compatibility = $gods -> map(function($item) use ($virtues) {
            $array = (array)$item;
            return array_sum(array_map(function($godVirtue, $humanVirtue){
                    return abs($godVirtue - $humanVirtue);
                },$array, $virtues)
            );
        }); // Algoritmo para el mas compatible

        $mostCompatible = array_search(min($compatibility ->all()), $compatibility ->all());  // Algoritmo para el mas compatible

        $request -> request -> set('password', Hash::make($request -> password));

        $request->request->add([
            'fate' => 0,
            'blessed' => $godNames ->all()[$mostCompatible] -> godname,
            'wisdom' => $virtues[0],
            'nobility' => $virtues[1],
            'virtue' => $virtues[2],
            'wickedness' => $virtues[3],
            'audacity' => $virtues[4],
            'alive' => 1,
            'destiny' => null
        ]);

        $newHuman = new Human;
            $newHuman -> forceFill($request -> request -> all());
            $newHuman -> save();
            $token = Auth::login($newHuman);
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $newHuman,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
        /*} catch (\Exception $e){
            echo $e -> getTraceAsString();
            return response()->json(['mens' => 'Bad request'],400);
        }*/
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

}
