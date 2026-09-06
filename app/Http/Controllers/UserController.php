<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curerentUser = Auth::user()->name;
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required','string', 'max:255'],
            'email' => ['string', 'lowercase', 'email', 'max:255'],
            'no_hp' => ['nullable', 'string', 'max:255'],
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ];

        $user->update($updateData);

        return redirect('/dashboard')->with('success', 'Profile updated successfully');




    }
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'new_password' => ['required', 'confirmed', Rules\Password::defaults()],

        ]);

        $updateData = [
            'password' => Hash::make($request->new_password),

        ];
        $user->update($updateData);

        return back()->with('success', 'Password updated successfully');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = auth()->user();

        $user->delete();

    }
}
