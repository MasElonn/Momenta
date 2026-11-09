<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Foto;
use App\Models\Paket;
use App\Models\Transaksi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $transaksis = Transaksi::with(['acara.foto', 'paket.fotografer'])
                ->where('customer_id', $user->user_id)
                ->orderBy('created_at', 'desc')
                ->paginate(3);

            return view('dashboard.customer', compact('transaksis'));
        } elseif ($user->role === 'fotografer') {
            return $this->fotograferDashboard($user);
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.fotografer.index');
        }

        abort(403);
    }

    protected function fotograferDashboard($user): View|RedirectResponse
    {
        if ($user->status_akun === 'pending') {
            Auth::logout();
            return redirect()->route('login')->with('warning', 'Pendaftaran Anda sedang ditinjau oleh Admin. Silakan tunggu persetujuan akun.');
        }

        if ($user->status_akun === 'rejected') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Mohon maaf, pendaftaran fotografer Anda ditolak oleh Admin.');
        }

        $fotograferId = $user->user_id;

        $transaksis = Transaksi::with(['customer', 'acara.foto', 'paket.fotografer'])
            ->whereHas('paket', fn($q) => $q->where('fotografer_id', $fotograferId))
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $queryTransaksi = Transaksi::whereHas('paket', fn($q) => $q->where('fotografer_id', $fotograferId));

        $totalPaket = Paket::where('fotografer_id', $fotograferId)->count();
        $totalTransaksi = (clone $queryTransaksi)->count();
        $totalBooking = Acara::whereHas('transaksi.paket', fn($q) => $q->where('fotografer_id', $fotograferId))
            ->whereDate('tanggal', '>=', now()->toDateString())
            ->count();
        $totalFoto = Foto::whereHas('acara.transaksi.paket', fn($q) => $q->where('fotografer_id', $fotograferId))->count();

        $paidTransaksis = Transaksi::with('paket')
            ->whereHas('paket', fn($q) => $q->where('fotografer_id', $fotograferId))
            ->where('status', 'paid')
            ->get();

        $totalPendapatan = (float) $paidTransaksis->sum(fn($t) => $t->paket?->harga ?? 0);

        $revenueLabels = [];
        $revenueData = [];
        for ($i = 5; $i >= 0; $i--) {
            $mDate = now()->subMonths($i);
            $revenueLabels[] = $mDate->translatedFormat('M Y');
            $mSum = $paidTransaksis->filter(function ($t) use ($mDate) {
                $d = $t->paid_at ?? $t->created_at;
                return $d && $d->format('Y-m') === $mDate->format('Y-m');
            })->sum(fn($t) => (float) ($t->paket?->harga ?? 0));
            $revenueData[] = (float) $mSum;
        }

        $rentangPeriode = [
            '7_hari' => [
                now()->copy()->subDays(6)->startOfDay(),
                now()->copy()->endOfDay()
            ],
            'bulan_ini' => [
                now()->copy()->startOfMonth(),
                now()->copy()->endOfMonth()
            ],
            'bulan_lalu' => [
                now()->copy()->subMonthNoOverflow()->startOfMonth(),
                now()->copy()->subMonthNoOverflow()->endOfMonth()
            ],
        ];

        $filterPeriode = [
            'semua' => 'Semua',
            '7_hari' => '7 Hari Terakhir',
            'bulan_ini' => 'Bulan Ini',
            'bulan_lalu' => 'Bulan Lalu',
        ];

        $rekapTransaksi = [
            'semua' => $totalTransaksi,
        ];
        foreach ($rentangPeriode as $key => $rentang) {
            $rekapTransaksi[$key] = (clone $queryTransaksi)
                ->whereBetween('created_at', $rentang)
                ->count();
        }

        $riwayatTransaksi = (clone $queryTransaksi)
            ->with(['customer', 'paket'])
            ->latest()
            ->take(10)
            ->get();

        foreach ($riwayatTransaksi as $transaksi) {
            $transaksi->periode_filter = 'lainnya';
            if ($transaksi->created_at) {
                foreach ($rentangPeriode as $key => $rentang) {
                    if ($transaksi->created_at->between($rentang[0], $rentang[1])) {
                        $transaksi->periode_filter = $key;
                        break;
                    }
                }
            }
        }

        $upcomingSessions = Acara::with(['transaksi.customer', 'transaksi.paket'])
            ->whereHas('transaksi.paket', fn($q) => $q->where('fotografer_id', $fotograferId))
            ->whereDate('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal')
            ->take(4)
            ->get();

        $paketSaya = Paket::where('fotografer_id', $fotograferId)
            ->latest()
            ->take(4)
            ->get();

        return view('dashboard.fotografer', compact(
            'transaksis',
            'totalPaket',
            'totalTransaksi',
            'totalBooking',
            'totalFoto',
            'totalPendapatan',
            'revenueLabels',
            'revenueData',
            'filterPeriode',
            'rekapTransaksi',
            'riwayatTransaksi',
            'upcomingSessions',
            'paketSaya'
        ));
    }
}
