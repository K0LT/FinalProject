<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use App\Http\Requests\StoreDiagnosticRequest;
use App\Http\Requests\UpdateDiagnosticRequest;

class DiagnosticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diagnostics = Diagnostic::all();
        return response()->json($diagnostics);
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
    public function store(StoreDiagnosticRequest $request)
    {
        $data = $request->validated();
        $diagnostic = Diagnostic::create($data);
        return response()->json($diagnostic);
    }

    /**
     * Display the specified resource.
     */
    public function show(Diagnostic $diagnostic)
    {
        return response()->json($diagnostic);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diagnostic $diagnostic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiagnosticRequest $request, Diagnostic $diagnostic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diagnostic $diagnostic)
    {
        //
    }
}
