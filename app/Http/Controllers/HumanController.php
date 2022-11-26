<?php

namespace App\Http\Controllers;

use App\Models\Human;
use App\Http\Requests\StoreHumanRequest;
use App\Http\Requests\UpdateHumanRequest;

class HumanController extends Controller
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
     * @param  \App\Http\Requests\StoreHumanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHumanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Human  $human
     * @return \Illuminate\Http\Response
     */
    public function show(Human $human)
    {
        //
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
