<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use App\Models\User;

class ProfileController extends Controller
{
    public function index() 
    {

        $user_id = auth()->user()->id;
        $user = User::with('role')->find($user_id);
        return inertia('Profile', [
            'user' => $user,
            'message' => session('message'),
        ]);
    }

    public function update(Request $request, string $id) 
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
        ]);

        $validatedData['name'] = strtoupper($validatedData['name']);
        $validatedData['email'] = strtolower($validatedData['email']);


        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        return redirect()->route('profile.index')->with('message', 'User information updated successfully');
    }

    public function resetPassword(Request $request, string $id) 
    {
        sleep(1);
        // dd($request);
        $validatedData = $request->validate([
            'password' => ['required'],
        ]);

        $user = User::find($id);

        $user->update([
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('profile.index')->with('message', 'Password updated successfully');
        dd($request);
    }
}
