<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FotograferBrowseController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('q');

        $fotografer = User::where('role', 'fotografer')
            ->where('status_akun', 'active')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('lokasi', 'like', "%{$search}%");
                });
            })
            ->with(['pakets' => function ($query) {
                $query->where('tersedia', true);
            }])
            ->paginate(9)
            ->withQueryString();

        return view('fotografer-list', compact('fotografer', 'search'));
    }
}

