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


    private function registerHuman(StoreHumanRequest $request){

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
        //auth()->guard("human")->login($newHuman);
        $token = auth()->guard("human")->login($newHuman);    //Auth::login($newHuman);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $newHuman,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    private function loginHumans(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');


        $token = auth()->guard("human") ->attempt($credentials);   //Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = auth()->guard("human") ->user();//Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
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
