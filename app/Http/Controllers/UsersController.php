<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::where('role_name', '!=', 'ADMIN')->get();
        $users = User::with('role')->whereHas('role', function ($query) {
            $query->where('name', '!=', 'ADMIN');
        })->get();

        
        return inertia('Users', [
            'roles' => $roles,
            'users' => $users,
            'message' => session('message'), 
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'user_role' => 'required',
            'password' => 'required',
        ]);

        $validatedData['name'] = strtoupper($validatedData['name']);
        $validatedData['email'] = strtolower($validatedData['email']);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $user->user_role()->create([
            'user_id' => $user->id,
            'role_id' => $validatedData['user_role'],
        ]);

        return redirect()->route('users.index')->with('message', 'New user has been successfully created.');
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
            'name' => 'required',
            'email' => 'required',
            'user_role' => 'required',
        ]);

        $user = User::find($id);

        $validatedData['name'] = strtoupper($validatedData['name']);
        $validatedData['email'] = strtolower($validatedData['email']);

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        $user->user_role()->update([
            'role_id' => $validatedData['user_role'],
        ]);

        return redirect()->route('users.index')->with('message', 'User information successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index')->with('message', 'User successfully deleted.'); 
    }
}
