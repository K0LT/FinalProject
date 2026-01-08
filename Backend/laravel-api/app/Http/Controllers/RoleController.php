<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RoleResource::collection(Role::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $data = $request->validated();
        $role = Role::create($data);
        return response()->json($role);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return new RoleResource($role);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $data = $request->validated();
        $role->update($data);
        return response()->json($role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(null, 204);
    }

    /**
     * List all soft deleted roles.
     */
    public function indexSoftDelete()
    {
        $roles = Role::onlyTrashed()->get();
        return response()->json($roles, 200);
    }

    /**
     * Show a specific soft deleted role.
     */
    public function showSoftDelete($id)
    {
        $role = Role::onlyTrashed()->findOrFail($id);
        return response()->json($role, 200);
    }

    /**
     * Restore a soft deleted role.
     */
    public function restoreSoftDelete($id)
    {
        $role = Role::onlyTrashed()->findOrFail($id);
        $role->restore();
        return response()->json($role, 200);
    }
}
