<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return inertia('Roles', [
            'roles' => $roles,
            'message' => session('message')
        ]);
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
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'role_name' => 'required|unique:roles,role_name',
            'description' => 'required',
        ]);

        $validatedData['role_name'] = strtoupper($validatedData['role_name']);

        Role::create($validatedData);

        return redirect()->route('roles.index')->with('message', 'New role has been successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'role_name' => 'required',
            'description' => 'required',
        ]);

        $role = Role::find($id);

        $validatedData['role_name'] = strtoupper($validatedData['role_name']);

        $role->update([
            'role_name' => $validatedData['role_name'],
            'description' => $validatedData['description'],
        ]);

        return redirect()->route('roles.index')->with('message', 'User role has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->delete();

        return redirect()->back()->with('message', 'Role deleted successfully.');
    }
}
