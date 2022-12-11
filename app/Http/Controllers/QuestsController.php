<?php

namespace App\Http\Controllers;

use App\Models\Quests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:god');
    }

    public function index()
    {
        $todos = Quests::all();
        return response()->json([
            'status' => 'success',
            'todos' => $todos,
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request -> request ->add([
            "god_id" => $user -> getAttribute("id")
        ]);
        $quest = new Quests();
        $quest -> forceFill($request -> request -> all());
        $quest -> save();

        return response()->json([
            'status' => 'success',
            'message' => 'Quest created successfully',
            'todo' => $quest,
        ]);
    }

    public function show($id)
    {
        $todo = Quests::find($id);
        return response()->json([
            'status' => 'success',
            'todo' => $todo,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $todo = Quests::find($id);
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Todo updated successfully',
            'todo' => $todo,
        ]);
    }

    public function destroy($id)
    {
        $todo = Quests::find($id);
        $todo->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Todo deleted successfully',
            'todo' => $todo,
        ]);
    }
}
