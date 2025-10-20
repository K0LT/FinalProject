<?php

namespace App\Http\Controllers;

use App\Models\ProgressNote;
use App\Http\Requests\StoreProgressNoteRequest;
use App\Http\Requests\UpdateProgressNoteRequest;

class ProgressNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $progressNotes = ProgressNote::all();
        return response()->json($progressNotes);
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
    public function store(StoreProgressNoteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgressNote $progressNote)
    {
        return response()->json($progressNote);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgressNote $progressNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgressNoteRequest $request, ProgressNote $progressNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgressNote $progressNote)
    {
        //
    }
}
