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
        $allergies = Allergy::all();

        return response()->json([
            'data' => $allergies], 200
        );

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAllergyRequest $request)
    {
        $data = $request->validated();
        $allergy = Allergy::create($data);
        return Response()->json([
            'success' => true,
            'data' => $allergy
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Allergy $allergy)
    {

        return response()->json([
            'data' => $allergy], 200
        );

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAllergyRequest $request, Allergy $allergy)
    {
        $data = $request->validated();
        $allergy -> update($data);
        return response()->json([
            'success' => true,
            'data' => $allergy
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Allergy $allergy)
    {
        //
    }
}
