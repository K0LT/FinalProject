<?php

namespace App\Http\Controllers;

use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::all();
        return response()->json($appointments);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        $data = $request->validated();
        $data['status'] = 'Confirmado';
        $appointment = Appointment::create($data);

        return response()->json($appointment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $appointment->load(['patient.user', 'profile.user']);
        return new AppointmentResource($appointment);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $data = $request->validated();
        $appointment -> update($data);
        return response()->json($appointment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return response()->json(null, 204);
    }

    /**
     * Index of SoftDelete
     */
    public function indexSoftDelete()
    {
        return response()->json(Appointment::onlyTrashed()->get(), 200);
    }

    /**
     * Restore SoftDelete
     */
    public function restoreSoftDelete($id)
    {
        $appointment = Appointment::onlyTrashed()->findOrFail($id);
        $appointment->restore();
        return response()->json($appointment, 200);
    }

    /**
     * Show SoftDeleted
     */
    public function showSoftDelete($id)
    {
        $appointment = Appointment::onlyTrashed()->findOrFail($id);
        return response()->json($appointment, 200);
    }

}
