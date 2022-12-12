<?php

namespace App\Http\Controllers;

use App\Models\God;
use App\Http\Requests\StoreGodRequest;
use App\Http\Requests\UpdateGodRequest;
use App\Models\Human;
use App\Models\Quests;
use App\Models\QuestsHumans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GodAuthController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:god', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'god_name' => 'required|string',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('god_name', 'password');

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

    public function updateAvatar(Request $request){
        $requestData = $request -> request;
        $fileName = uniqid().".".$requestData -> get("imageType");
        $user = Auth::user();
        $userAvatar = $user -> getAttribute("avatar");
        if(!str_contains($userAvatar, "MaleVillDE.jpg")){
            Storage::disk('public')->delete($user -> getAttribute("avatar"));
        }
        $user -> setAttribute("avatar", $fileName);
        $user -> save();
        $data = base64_decode($requestData -> get("base64String"));
        Storage::disk('public')->put($fileName, $data);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function humans(){
        $user = Auth::user();
        $id = $user -> getAttribute("id");
        $humans = Human::where("god_id", $id) -> get();
        return response()->json([
            'status' => 'success',
            'humans' => $humans,
        ]);
    }
    public function quests(){
        $user = Auth::user();
        $id = $user -> getAttribute("id");
        $Quests = Quests::where("god_id", $id) -> get();
        return response()->json([
            'status' => 'success',
            'quests' => $Quests,
        ]);
    }
    public function assignQuests(Request $request){
        $questId = $request -> request ->get("quest")["id"];
        $humansId = $request -> request ->get("human");
        foreach ($humansId as $humanId){
            $quest = new QuestsHumans;
            $quest -> setAttribute("human_id", $humanId["id"]);
            $quest -> setAttribute("quest_id", $questId);
            $quest -> save();
        }
        return response()->json([
            'status' => 'success',
        ]);
    }
}
