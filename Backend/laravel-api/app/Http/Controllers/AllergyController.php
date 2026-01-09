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
        return AllergyResource::collection(
            Allergy::orderBy('allergen', 'asc')->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAllergyRequest $request)
    {
        $data = $request->validated();
        $allergy = Allergy::create($data);

        return (new AllergyResource($allergy))
            ->response()
            ->setStatusCode(201);
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
        return new AllergyResource($allergy);
    }

    /**
     * Delete
     */
    public function destroy(Allergy $allergy)
    {
        $allergy->delete();
        return response()->json([
            'message' => 'Eliminado'
        ], 204);
    }

    /**
     *User Allergies
     */
    public function userAllergies(Request $request)
    {
        $user = auth('sanctum')->user();

        $patient = $user->patient;

        if (!$patient) {
            return response()->json([
                'message' => 'Paciente não encontrado' //Caso o admin tente entrar
            ], 404);
        }

        $allergies = $patient->allergies()
            ->orderBy('allergen', 'asc')
            ->get();

        return response()->json([
            'allergies' => $allergies
        ], 200);
    }

    /**
     *Admin View for Patient Allergies
     */
    public function patientAllergies(Patient $patient)
    {
        $allergies = $patient->allergies()
            ->orderBy('allergen', 'asc')
            ->get();

        return response()->json([
            'allergies' => $allergies
        ], 200);
    }



    /**
     *Soft Deletes Part:
     */

    /**
     * Index of SoftDelete
     */
    public function indexSoftDelete()
    {
        return AllergyResource::collection(
            Allergy::onlyTrashed()->orderBy('allergen', 'asc')->get()
        );
    }


    /**
     * Restore SoftDelete
     */
    public function restoreSoftDelete($id)
    {
        $allergy = Allergy::onlyTrashed()->findOrFail($id);
        $allergy->restore();
        return new AllergyResource($allergy);
    }

    /**
     * Show SoftDeleted
     */

    public function showSoftDelete($id){
        $allergy = Allergy::onlyTrashed()->findOrFail($id);
        return new AllergyResource(
            Allergy::onlyTrashed()->findOrFail($id)
        );
    }


    /**
     * Show SoftDeleted of a Patient
     */

    public function patientAllergiesSoftDelete(Patient $patient)
    {
        $allergies = $patient->allergies()
            ->onlyTrashed()
            ->get();

        return AllergyResource::collection($allergies);
    }


    /**
     * Add and remove allergies from a patient
     */



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
            'message' => 'Adicionado'
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
            'message' => 'Removido'
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

        if (! $patient) {
            return response()->json([
                'message' => 'Paciente não encontrado'
            ], 404);
        }

        if ($patient->allergies()->where('allergies.id', $allergyId)->exists()) {
            return response()->json([
                'message' => 'Já tem esta alergia associada.'
            ], 409);
        }

        $patient->allergies()->attach($allergyId);

        return response()->json([
            'message' => 'Adicionado'
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

        if (! $patient) {
            return response()->json([
                'message' => 'Paciente não encontrado'
            ], 404);
        }

        if (! $patient->allergies()->where('allergies.id', $allergyId)->exists()) {
            return response()->json([
                'message' => 'Não tem esta alergia.'
            ], 404);
        }

        $patient->allergies()->detach($allergyId);

        return response()->json([
            'message' => 'Removido'
        ], 200);
    }



}
