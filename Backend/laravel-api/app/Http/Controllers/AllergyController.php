<?php

namespace App\Http\Controllers;

use App\Models\Allergy;
use App\Http\Requests\StoreAllergyRequest;
use App\Http\Requests\UpdateAllergyRequest;

class AllergyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $allergies = Allergy::all();
            return response()->json([
                'data' => $allergies,
                ], 200);

        }catch(\Exception $e){

            \Log::error('Ocorreu um erro ao obter alergias.' . $e->getMessage());
            return response()->json([
                'message' => 'Ocorreu um erro ao obter alergias.',
            ], 500);
        }

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
    public function store(StoreAllergyRequest $request)
    {
        try {
            $data = $request->validated();
            $allergy = Allergy::create($data);
            return Response()->json([
                'success' => true,
                'data' => $allergy
            ], 200);
        }
            catch (\Exception $e) {
            \Log::error('Ocorreu um erro a criar alergia' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Ocorreu um erro a criar alergia:'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Allergy $allergy)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $allergy
                ]);
        }catch(\Exception $e){
            \Log::error('Ocorreu um erro a mostrar uma alergia' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Ocorreu um erro a mostrar uma alergia',
            ], 500);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Allergy $allergy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAllergyRequest $request, Allergy $allergy)
    {

        try {
            $data = $request->validated();
            $allergy -> update($data);
            return response()->json([
                'success' => true,
                'data' => $allergy
            ]);
        }catch(\Exception $e){
            \Log::error('Ocorreu um erro a editar uma alergia' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Ocorreu um erro a editar uma alergia.'
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Allergy $allergy)
    {
        //
    }

    public function patientAllergies()
    {
        $patient = auth()->user()->patient;
        $patientWithAllergies = $patient->load('allergies');
        return response()->json(['data'=>$patientWithAllergies], 200);
    }
}
