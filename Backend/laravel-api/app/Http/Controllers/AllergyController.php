<?php

namespace App\Http\Controllers;

use App\Models\Allergy;
use App\Http\Requests\StoreAllergyRequest;
use App\Http\Requests\UpdateAllergyRequest;
use Illuminate\Http\Request;
class AllergyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allergies = Allergy::all();
        return response()->json($allergies, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAllergyRequest $request)
    {
        $data = $request->validated();
        $allergy = Allergy::create($data);

        return response()->json($allergy, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Allergy $allergy)
    {
        return response()->json($allergy, 200);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAllergyRequest $request, Allergy $allergy)
    {
        $data = $request->validated();
        $allergy -> update($data);
        return response()->json($allergy, 200);
    }

    /**
     * SoftDelete
     */
    public function destroy(Allergy $allergy)
    {
        $allergy->delete();
        return response()->json(null, 204);
    }


    /**
     * Index of SoftDelete
     */
    public function indexSoftDelete()
    {
        return response()->json(Allergy::onlyTrashed()->get(), 200);
    }


    /**
     * Restore SoftDelete
     */
    public function restoreSoftDelete($id)
    {
        $allergy = Allergy::onlyTrashed()->findOrFail($id);
        $allergy->restore();
        return response()->json($allergy, 200);
    }

    /**
     * Show SoftDeleted
     */

    public function showSoftDelete($id){
        $allergy = Allergy::onlyTrashed()->findOrFail($id);
        return response()->json($allergy, 200);
    }

    /**
    *User Allergies
    */

    //Dentro do Request vem automaticamente o user, o front-end não precisa de enviar nada.
    public function userAllergies(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'message' => 'Não está autenticado'
            ], 401);
        }

        $patient = $user->patient;

        if (!$patient) {
            return response()->json([
                'message' => 'Paciente não encontrado' //Caso o admin tente entrar
            ], 404);
        }

        return response()->json([
            'patient_id' => $patient->id,
            'allergies' => $patient->allergies
        ]);
    }
}
