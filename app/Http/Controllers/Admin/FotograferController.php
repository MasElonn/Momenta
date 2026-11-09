<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FotograferController extends Controller
{
    public function index(Request $request)
    {
        $fotografer = User::where('role', 'fotografer')
            ->when($request->search, function ($q, $search) {
                $q->where(fn($sub) => $sub->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"));
            })
            ->orderByRaw("FIELD(status_akun, 'pending', 'active', 'rejected')")
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.fotografer.index', compact('fotografer'));
    }

    public function accept($id)
    {
        User::where('user_id', $id)->where('role', 'fotografer')->update(['status_akun' => 'active']);
        return back()->with('success', 'Fotografer berhasil disetujui.');
    }

    public function reject($id)
    {
        User::where('user_id', $id)->where('role', 'fotografer')->update(['status_akun' => 'rejected']);
        return back()->with('success', 'Fotografer ditolak.');
    }

    public function destroy($id)
    {
        User::where('user_id', $id)->where('role', 'fotografer')->delete();
        return back()->with('success', 'Akun fotografer dihapus.');
    }
}
