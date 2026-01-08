<?php

namespace App\Http\Controllers;

use App\Http\Resources\AllergyResource;

use App\Models\Allergy;
use App\Http\Requests\StoreAllergyRequest;
use App\Http\Requests\UpdateAllergyRequest;
use App\Models\Patient;
use Illuminate\Http\Request;
class AllergyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AllergyResource::collection(Allergy::all());
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
        return new AllergyResource($allergy);

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

        $patient = $user->patient;

        if (!$patient) {
            return response()->json([
                'message' => 'Paciente não encontrado' //Caso o admin tente entrar
            ], 404);
        }

        return response()->json([
            'patient' => $patient,
            'allergies' => $patient->allergies
        ]);
    }


    public function patientAllergies(Patient $patient)
    {
        $patient->load('allergies');
        return response()->json($patient, 200);
    }


    public function patientAllergiesSoftDelete(Patient $patient)
    {
        $allergies = $patient->allergies()
            ->onlyTrashed()
            ->get();

        return response()->json([
            'patient' => $patient,
            'allergies' => $allergies
        ], 200);
    }


    public function adminAddAllergyToPatient(Request $request, Patient $patient)
    {
        $request->validate([
            'allergy_id' => ['required', 'exists:allergies,id'],
        ]);

        $allergyId = $request->allergy_id;

        if ($patient->allergies()->where('allergies.id', $allergyId)->exists()) {
            return response()->json([
                'message' => 'Paciente já tem essa alergia associada.'
            ], 409);
        }

        $patient->allergies()->attach($allergyId);

        return response()->json([
            'message' => 'Added'
        ], 201);
    }


    public function adminRemoveAllergyFromPatient(Request $request, Patient $patient)
    {
        $request->validate([
            'allergy_id' => ['required', 'exists:allergies,id'],
        ]);

        $allergyId = $request->allergy_id;

        if (! $patient->allergies()->where('allergies.id', $allergyId)->exists()) {
            return response()->json([
                'message' => 'Paciente não tem essa alergia.'
            ], 404);
        }

        $patient->allergies()->detach($allergyId);

        return response()->json([
            'message' => 'Removed'
        ], 200);
    }


    public function userAddAllergy(Request $request)
    {
        $request->validate([
            'allergy_id' => ['required', 'exists:allergies,id'],
        ]);

        $user = auth('sanctum')->user();

        $patient = $user->patient;
        $allergyId = $request->allergy_id;

        if ($patient->allergies()->where('allergies.id', $allergyId)->exists()) {
            return response()->json([
                'message' => 'Já tem esta alergia associada.'
            ], 409);
        }

        $patient->allergies()->attach($allergyId);

        return response()->json([
            'message' => 'Added'
        ], 201);
    }


    public function userRemoveAllergy(Request $request)
    {
        $request->validate([
            'allergy_id' => ['required', 'exists:allergies,id'],
        ]);

        $user = auth('sanctum')->user();

        $patient = $user->patient;
        $allergyId = $request->allergy_id;

        if (! $patient->allergies()->where('allergies.id', $allergyId)->exists()) {
            return response()->json([
                'message' => 'Não tem esta alergia.'
            ], 404);
        }

        $patient->allergies()->detach($allergyId);

        return response()->json([
            'message' => 'Removed'
        ], 200);
    }



}
