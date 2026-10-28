<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PaketController extends Controller
{
    /**
     * Show the form for creating a new package.
     */
    public function create(): View
    {
        return view('dashboard.paket.create');
    }

    /**
     * Store a newly created package, owned by the authenticated photographer.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['fotografer_id'] = Auth::id();
        $data['is_populer'] = $request->boolean('is_populer');
        $data['tersedia'] = $request->boolean('tersedia');

        Paket::create($data);

        return redirect()
            ->route('dashboard', ['tab' => 'paket'])
            ->with('success', 'Paket berhasil dibuat.');
    }

    /**
     * Show the form for editing a package.
     *
     * Route-model-bound via {paket} => paket_id. Ownership is checked before
     * the form is shown so a photographer can never open another
     * photographer's edit page.
     */
    public function edit(Paket $paket): View
    {
        $this->authorizeOwner($paket);

        return view('dashboard.paket.edit', compact('paket'));
    }

    /**
     * Update an existing package. Ownership is checked before saving.
     */
    public function update(Request $request, Paket $paket): RedirectResponse
    {
        $this->authorizeOwner($paket);

        $data = $this->validated($request);
        $data['is_populer'] = $request->boolean('is_populer');
        $data['tersedia'] = $request->boolean('tersedia');

        $paket->update($data);

        return redirect()
            ->route('dashboard', ['tab' => 'paket'])
            ->with('success', 'Paket berhasil diperbarui.');
    }

    /**
     * Delete a package. Ownership is checked before deleting.
     */
    public function destroy(Paket $paket): RedirectResponse
    {
        $this->authorizeOwner($paket);

        $paket->delete();

        return redirect()
            ->route('dashboard', ['tab' => 'paket'])
            ->with('success', 'Paket berhasil dihapus.');
    }

    /**
     * Shared validation rules for store() and update().
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string', 'max:1000'],
            'harga' => ['required', 'numeric', 'min:0'],
            'durasi' => ['required', 'string', 'max:100'],
            'jumlah_foto' => ['required', 'string', 'max:100'],
            'jumlah_fotografer' => ['required', 'string', 'max:100'],
            'durasi_galeri' => ['required', 'string', 'max:100'],
        ]);
    }

    /**
     * Abort with 403 unless the current user owns this package.
     */
    private function authorizeOwner(Paket $paket): void
    {
        abort_if(
            $paket->fotografer_id !== Auth::id(),
            403,
            'Anda tidak memiliki akses ke paket ini.'
        );
    }
}