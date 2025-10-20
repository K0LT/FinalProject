<?php

namespace App\Http\Controllers;

use App\Models\Allergie;
use App\Http\Requests\StoreAllergieRequest;
use App\Http\Requests\UpdateAllergieRequest;

class AllergieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allergies = Allergie::all();
        return response()->json($allergies);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAllergieRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Allergie $allergie)
    {
        return response()->json($allergie);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Allergie $allergie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAllergieRequest $request, Allergie $allergie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Allergie $allergie)
    {
        //
    }
}
