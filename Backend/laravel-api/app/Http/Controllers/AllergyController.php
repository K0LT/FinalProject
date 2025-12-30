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
     * Index With SoftDelete
     */

    public function indexWithSoftDelete()
    {
        return response()->json(Allergy::onlyTrashed()->get(), 200);
    }
    

    /**
     * Restore SoftDelete
     */

    public function restore($id)
    {
        $allergy = Allergy::onlyTrashed()->findOrFail($id);
        $allergy->restore();
        return response()->json($allergy, 200);
    }



}
