<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Patient;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::all();
        return response()->json(['data' => $appointments],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    //Só para admin.
    public function store(StoreAppointmentRequest $request)
    {
        $data = $request;
        $data = $request->validated();
        $appointment = Appointment::create($data);
        return response()->json($appointment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $appointment->load(['patient.user', 'patient']);
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
        //
    }

    public function patientCreateAppointment(StorePatientAppointmentRequest $request){
        $data = $request->validated();
        $appointment = Appointment::create($data);
        return response()->json($appointment);
    }

    public function patientAppointments(){
        $patient = auth()->user()->patient;
        $patientWithAppointments = $patient->load('appointments');
        return response()->json($patientWithAppointments);
    }
}
