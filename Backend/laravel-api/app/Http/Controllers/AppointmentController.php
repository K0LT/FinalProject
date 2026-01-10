<?php

namespace App\Http\Controllers;

use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Patient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $appointment->patient->updateNextAppointment();

        return response()->json($appointment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        return response()->json($appointment);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $data = $request->validated();
        $appointment -> update($data);
        $appointment->patient->updateNextAppointment();
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


    public function userAppointments(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'message' => 'Não'
            ], 401);
        }

        $patient = $user->patient;

        if (!$patient) {
            return response()->json([
                'message' => 'Patient not found for this user'
            ], 404);
        }

        $patient->load(['appointments.progressNotes']);

        return response()->json([
            'appointments' => $patient->appointments
        ], 200);
    }

    public function patientAppointments(Patient $patient)
    {
        $patient->load('appointments.progressNotes');

        return response()->json($patient, 200);
    }

    public function patientAppointmentsSoftDelete(Patient $patient)
    {
        $appointments = $patient->appointments()
            ->onlyTrashed()
            ->with('progressNotes')
            ->get();

        return response()->json([
            'patient' => $patient,
            'appointments' => $appointments
        ], 200);
    }

    public function storeForPatient(Request $request)
    {
        $user = auth('sanctum')->user();
        $patient = $user->patient;

        $data = $request->validate([
            'appointment_date_time' => [
                'required',
                'date',
                'after_or_equal:' . now()->addDay()->format('Y-m-d')
            ],
            'duration' => 'nullable|integer',
            'type' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $data['patient_id'] = $patient->id;
        $data['status'] = 'Pendente';

        $appointment = Appointment::create($data);

        return response()->json($appointment, 201);
    }

}
