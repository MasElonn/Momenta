<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'role' => ['nullable', 'in:customer,fotografer'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],
        ]);

        $role = $request->input('role', 'customer');
        $statusAkun = $role === 'fotografer' ? 'pending' : 'active';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $role,
            'status_akun' => $statusAkun,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        if ($role === 'fotografer') {
            return redirect()->route('login')->with('status', 'Pendaftaran fotografer berhasil! Akun Anda sedang menunggu persetujuan dari Admin.');
        }

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
