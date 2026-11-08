<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class FotograferController extends Controller
{
    private function checkAdmin(): void
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'admin',
            403
        );
    }

    public function index(Request $request)
    {
        $this->checkAdmin();

        $search = $request->input('search');

        $fotografer = User::query()
            ->where('role', 'fotografer')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        $totalFotografer = User::where('role', 'fotografer')->count();

        return view('admin.fotografer.index', compact(
            'fotografer',
            'totalFotografer',
            'search'
        ));
    }

    public function create()
    {
        $this->checkAdmin();

        return view('admin.fotografer.form', [
            'fotografer' => null,
        ]);
    }

    public function store(Request $request)
    {
        $this->checkAdmin();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $fotografer = new User();
        $fotografer->name = $validated['name'];
        $fotografer->email = $validated['email'];
        $fotografer->password = Hash::make($validated['password']);
        $fotografer->role = 'fotografer';
        $fotografer->save();

        return redirect()
            ->route('admin.fotografer.index')
            ->with('success', 'Akun fotografer berhasil dibuat.');
    }

    public function edit(string $id)
    {
        $this->checkAdmin();

        $fotografer = User::where('user_id', $id)
            ->where('role', 'fotografer')
            ->firstOrFail();

        return view('admin.fotografer.form', compact('fotografer'));
    }

    public function update(Request $request, string $id)
    {
        $this->checkAdmin();

        $fotografer = User::where('user_id', $id)
            ->where('role', 'fotografer')
            ->firstOrFail();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($fotografer->user_id, 'user_id'),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $fotografer->name = $validated['name'];
        $fotografer->email = $validated['email'];

        if (!empty($validated['password'])) {
            $fotografer->password = Hash::make($validated['password']);
        }

        $fotografer->save();

        return redirect()
            ->route('admin.fotografer.index')
            ->with('success', 'Data fotografer berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $this->checkAdmin();

        $fotografer = User::where('user_id', $id)
            ->where('role', 'fotografer')
            ->firstOrFail();

        $hasPackages = DB::table('paket')
            ->where('fotografer_id', $fotografer->user_id)
            ->exists();

        if ($hasPackages) {
            return back()->with(
                'error',
                'Fotografer tidak dapat dihapus karena masih memiliki paket. Hapus atau pindahkan paket terlebih dahulu.'
            );
        }

        $fotografer->delete();

        return redirect()
            ->route('admin.fotografer.index')
            ->with('success', 'Akun fotografer berhasil dihapus.');
    }
}