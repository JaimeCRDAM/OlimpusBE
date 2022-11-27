<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHumanRequest;
use App\Http\Requests\UpdateHumanRequest;
use App\Models\God;
use App\Models\Human;
use Hash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class HumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index()
    {
        return Human::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Human  $human
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Human $human)
    {
        return response()->json($human,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Human  $human
     * @return \Illuminate\Http\Response
     */
    public function edit(Human $human)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHumanRequest  $request
     * @param  \App\Models\Human  $human
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHumanRequest $request, Human $human)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Human  $human
     * @return \Illuminate\Http\Response
     */
    public function destroy(Human $human)
    {
        //
    }
}
