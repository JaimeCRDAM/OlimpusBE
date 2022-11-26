<?php

namespace App\Http\Controllers;

use App\Models\God;
use App\Http\Requests\StoreGodRequest;
use App\Http\Requests\UpdateGodRequest;
use App\Models\Human;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GodController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGodRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\God  $god
     * @return \Illuminate\Http\Response
     */
    public function show(God $god)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\God  $god
     * @return \Illuminate\Http\Response
     */
    public function edit(God $god)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGodRequest  $request
     * @param  \App\Models\God  $god
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGodRequest $request, God $god)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\God  $god
     * @return \Illuminate\Http\Response
     */
    public function destroy(God $god)
    {
        //
    }
}
