<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Transaksi;
use App\Models\Presensi;
use App\Models\AlatGym;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display dashboard
     */
    public function index()
    {
        // Statistics
        $totalAnggota = Anggota::count();
        $anggotaAktif = Anggota::where('status', 'aktif')->count();
        $totalTransaksi = Transaksi::count();
        $totalPendapatan = Transaksi::where('status', 'lunas')->sum('total_harga');
        
        // Today's attendance
        $presensiHariIni = Presensi::whereDate('waktu_masuk', today())->count();
        
        // Equipment condition summary
        $alatBaik = AlatGym::where('kondisi', 'baik')->count();
        $alatRusak = AlatGym::whereIn('kondisi', ['rusak_ringan', 'rusak_berat'])->count();

        // Chart data for last 6 months
        $chartData = $this->getChartData();

        // Recent transactions
        $recentTransactions = Transaksi::with('anggota', 'paket')
            ->latest()
            ->take(5)
            ->get();

        // Members with expiring membership (within 7 days)
        $expiringMemberships = Transaksi::with('anggota')
            ->where('waktu_berakhir', '>=', now())
            ->where('waktu_berakhir', '<=', now()->addDays(7))
            ->where('status', 'lunas')
            ->orderBy('waktu_berakhir')
            ->get();

        return view('dashboard', compact(
            'totalAnggota',
            'anggotaAktif',
            'totalTransaksi',
            'totalPendapatan',
            'presensiHariIni',
            'alatBaik',
            'alatRusak',
            'chartData',
            'recentTransactions',
            'expiringMemberships'
        ));
    }

    /**
     * Get chart data for last 6 months
     */
    private function getChartData(): array
    {
        $data = [
            'labels' => [],
            'pendapatan' => [],
            'transaksi' => [],
        ];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $data['labels'][] = $date->format('M Y');

            $pendapatan = Transaksi::where('status', 'lunas')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('total_harga');

            $jumlahTransaksi = Transaksi::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();

            $data['pendapatan'][] = $pendapatan;
            $data['transaksi'][] = $jumlahTransaksi;
        }

        return $data;
    }
}