<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use App\Models\Symptom;
use App\Http\Requests\StoreSymptomRequest;
use App\Http\Requests\UpdateSymptomRequest;
use Illuminate\Http\Request;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $symptoms = Symptom::all();
        return response()->json($symptoms);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSymptomRequest $request)
    {
        $data = $request->validated();

        $symptom = Symptom::create($data);
        return response()->json($symptom);
    }

    /**
     * Display the specified resource.
     */
    public function show(Symptom $symptom)
    {
        return response()->json($symptom);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSymptomRequest $request, Symptom $symptom)
    {
        $data = $request->validated();
        $symptom->update($data);
        return response()->json($symptom);
    }

    /**
     * Soft delete a symptom.
     */
    public function destroy(Symptom $symptom)
    {
        $symptom->delete();
        return response()->json(null, 204);
    }

    /**
     * List all soft deleted symptoms.
     */
    public function indexSoftDelete()
    {
        $symptoms = Symptom::onlyTrashed()->get();
        return response()->json($symptoms);
    }

    /**
     * Show a specific soft deleted symptom.
     */
    public function showSoftDelete($id)
    {
        $symptom = Symptom::onlyTrashed()->findOrFail($id);
        return response()->json($symptom);
    }

    /**
     * Restore a soft deleted symptom.
     */
    public function restoreSoftDelete($id)
    {
        $symptom = Symptom::onlyTrashed()->findOrFail($id);
        $symptom->restore();

        return response()->json($symptom);
    }

    public function adminAddSymptomToDiagnostic(Request $request, Diagnostic $diagnostic)
    {
        $request->validate([
            'symptom_id' => ['required', 'exists:symptoms,id'],
        ]);

        $symptomId = $request->symptom_id;

        if ($diagnostic->symptoms()->where('symptoms.id', $symptomId)->exists()) {
            return response()->json([
                'message' => 'O diagnóstico já tem esse sintoma associado.'
            ], 409);
        }

        $diagnostic->symptoms()->attach($symptomId);

        return response()->json([
            'message' => 'Sintoma associado com sucesso.'
        ], 201);
    }

    public function adminRemoveSymptomFromDiagnostic(Request $request, Diagnostic $diagnostic)
    {
        $request->validate([
            'symptom_id' => ['required', 'exists:symptoms,id'],
        ]);

        $symptomId = $request->symptom_id;

        if (! $diagnostic->symptoms()->where('symptoms.id', $symptomId)->exists()) {
            return response()->json([
                'message' => 'O diagnóstico não tem esse sintoma associado.'
            ], 404);
        }

        $diagnostic->symptoms()->detach($symptomId);

        return response()->json([
            'message' => 'Sintoma removido com sucesso.'
        ], 200);
    }

}
