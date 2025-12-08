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
        return response()->json([$diagnostics],200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiagnosticRequest $request)
    {
        $data = $request->validated();
        $diagnostic = Diagnostic::create($data);

        if (!empty($data['symptom_ids'])) {
            $diagnostic->symptoms()->sync($data['symptom_ids']);
        }

        return response()->json($diagnostic->load('symptoms'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Diagnostic $diagnostic)
    {
        $diagnostic->load('symptoms');

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
        $data = $request->validated();
        $diagnostic->update($data);

        //Depois do diagnostico já estar editado, é preciso adicionar na tabela intermédia o diagnostico e os sintomas.
        //Consoante o que vier, dá sync e atualiza a tabela intermédia.

        $diagnostic->symptoms()->sync($data['symptom_ids'] ?? []);

        return response()->json($diagnostic->load('symptoms'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diagnostic $diagnostic)
    {
        //
    }

    public function patientDiagnostics()
    {
        $patient = auth()->user()->patient;
        $patientWithDiagnostics = $patient->load('diagnostics.symptoms');
        return response()->json(['data'=>$patientWithDiagnostics], 200);
    }


}
