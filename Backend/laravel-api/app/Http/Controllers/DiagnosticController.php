<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiagnosticResource;
use App\Models\Diagnostic;
use App\Http\Requests\StoreDiagnosticRequest;
use App\Http\Requests\UpdateDiagnosticRequest;
use App\Models\Patient;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DiagnosticResource::collection(Diagnostic::all());
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

        return response()->json(['data' => $diagnostic->load('symptoms')], 200);
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
     * Delete a diagnostic (soft delete)
     */
    public function destroy(Diagnostic $diagnostic)
    {
        $diagnostic->delete();
        return response()->json([
            'message' => 'Eliminado'
        ], 204);
    }

    /**
     * user View: User Diagnostics
     */
    public function userDiagnostics(Request $request)
    {
        $user = auth('sanctum')->user();


        $patient = $user->patient;

        if (!$patient) {
            return response()->json([
                'message' => 'Paciente não encontrado'
            ], 404);
        }

        $diagnostics = $patient->diagnostics;

        $symptoms = $patient->diagnostics
            ->pluck('symptoms')
            ->flatten()
            ->values();


        return response()->json([
            'diagnostics' => $diagnostics
        ], 200);
    }

    /**
     * Admin View: User Diagnostics
     */
    public function patientDiagnostics(Patient $patient)
    {
        $diagnostics = $patient->diagnostics;

        $symptoms = $patient->diagnostics
            ->pluck('symptoms')
            ->flatten()
            ->values();

        return response()->json([
            'diagnostics' => $diagnostics
        ], 200);
    }







    /**
     * List all soft deleted diagnostics
     */
    public function indexSoftDelete()
    {
        $diagnostics = Diagnostic::onlyTrashed()->get();
        return response()->json($diagnostics, 200);
    }

    /**
     * Show a specific soft deleted diagnostic
     */
    public function showSoftDelete($id)
    {
        $diagnostic = Diagnostic::onlyTrashed()->findOrFail($id);
        return response()->json($diagnostic, 200);
    }

    /**
     * Restore a soft deleted diagnostic
     */
    public function restoreSoftDelete($id)
    {
        $diagnostic = Diagnostic::onlyTrashed()->findOrFail($id);
        $diagnostic->restore();
        return response()->json($diagnostic, 200);
    }


    public function patientDiagnosticsSoftDelete(Patient $patient)
    {
        $diagnostics = $patient->diagnostics()
            ->onlyTrashed()
            ->with('symptoms')
            ->get();

        return response()->json([
            'patient' => $patient,
            'diagnostics' => $diagnostics
        ], 200);
    }


}
