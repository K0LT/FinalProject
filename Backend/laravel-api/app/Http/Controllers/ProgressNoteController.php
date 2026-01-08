<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProgressNoteResource;
use App\Models\ProgressNote;
use App\Http\Requests\StoreProgressNoteRequest;
use App\Http\Requests\UpdateProgressNoteRequest;

class ProgressNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $progressNotes = ProgressNote::all();
        return progressNoteResource::collection(ProgressNote::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProgressNoteRequest $request)
    {
        $data = $request->validated();
        $progress_note = ProgressNote::create($data);
        return response()->json($progress_note);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgressNote $progressNote)
    {
        return new ProgressNoteResource($progressNote);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgressNoteRequest $request, ProgressNote $progressNote)
    {
        $data = $request->validated();
        $progressNote->update($data);
        return response()->json($progressNote);
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * Soft delete a progress note
     */
    public function destroy(ProgressNote $progressNote)
    {
        $progressNote->delete();
        return response()->json(null, 204);
    }

    /**
     * List all soft deleted progress notes
     */
    public function indexSoftDelete()
    {
        $notes = ProgressNote::onlyTrashed()->get();
        return response()->json($notes, 200);
    }

    /**
     * Show a specific soft deleted progress note
     */
    public function showSoftDelete($id)
    {
        $note = ProgressNote::onlyTrashed()->findOrFail($id);
        return response()->json($note, 200);
    }

    /**
     * Restore a soft deleted progress note
     */
    public function restoreSoftDelete($id)
    {
        $note = ProgressNote::onlyTrashed()->findOrFail($id);
        $note->restore();
        return response()->json($note, 200);
    }


}
