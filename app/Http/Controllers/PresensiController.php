<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Transaksi;
use App\Models\Anggota;
use App\Http\Requests\PresensiRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Presensi::with(['transaksi.anggota', 'transaksi.paket']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('transaksi.anggota', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        }

        // Filter by date
        if ($request->filled('tanggal')) {
            $query->whereDate('waktu_masuk', $request->tanggal);
        }

        $presensi = $query->latest('waktu_masuk')->paginate(10)->appends($request->query());

        return view('presensi.index', compact('presensi'));
    }

    /**
     * Show the form for creating a new resource (QR Scanner).
     */
    public function create(Request $request)
    {
        $selectedAnggota = $request->anggota;

        $transaksis = Transaksi::with([
            'anggota',
            'paket'
        ])
        ->where('status', 'lunas')
        ->whereDate('waktu_berakhir', '>=', now())
        ->orderBy('created_at', 'desc')
        ->get();

        return view('presensi.create', compact(
            'transaksis',
            'selectedAnggota'
        ));
    }

    /**
     * Store a newly created resource in storage (Manual Entry).
     */
    public function store(PresensiRequest $request)
    {
        $transaksi = Transaksi::find($request->transaksi_id);

        if (!$transaksi || !$transaksi->isMembershipActive()) {
            return redirect()->back()
                ->with('error', 'Transaksi tidak valid atau membership sudah tidak aktif.')
                ->withInput();
        }

        // Check if already checked in today for this transaction
        $existingPresensi = Presensi::where('transaksi_id', $request->transaksi_id)
            ->whereDate('waktu_masuk', today())
            ->first();

        if ($existingPresensi) {
            return redirect()->back()
                ->with('error', 'Anggota sudah melakukan presensi hari ini untuk paket tersebut.')
                ->withInput();
        }

        Presensi::create([
            'transaksi_id' => $request->transaksi_id,
            'waktu_masuk' => $request->waktu_masuk ?? now(),
        ]);

        return redirect()->route('presensi.index')
            ->with('success', 'Presensi berhasil dicatat.');
    }

    /**
     * Handle QR Code Scan (AJAX)
     */
    public function scan(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|string',
        ]);

        $qrCode = $request->qr_code;
        
        // Expected format: TRX-123
        if (strpos($qrCode, 'TRX-') !== 0) {
            return response()->json([
                'success' => false,
                'message' => 'Format QR Code tidak valid.'
            ], 400);
        }

        $transaksiId = str_replace('TRX-', '', $qrCode);
        $transaksi = Transaksi::with('anggota', 'paket')->find($transaksiId);

        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Data Transaksi tidak ditemukan.'
            ], 404);
        }

        // Validasi status lunas
        if ($transaksi->status !== 'lunas') {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi belum lunas.'
            ], 400);
        }

        // Validasi masa aktif
        $today = Carbon::now()->startOfDay();
        $waktuMulai = Carbon::parse($transaksi->waktu_mulai)->startOfDay();
        $waktuBerakhir = Carbon::parse($transaksi->waktu_berakhir)->startOfDay();

        if ($today->isBefore($waktuMulai)) {
            return response()->json([
                'success' => false,
                'message' => 'Membership belum dimulai. (Mulai: ' . $waktuMulai->format('d/m/Y') . ')'
            ], 400);
        }

        if ($today->isAfter($waktuBerakhir)) {
            return response()->json([
                'success' => false,
                'message' => 'Membership sudah kedaluwarsa. (Berakhir: ' . $waktuBerakhir->format('d/m/Y') . ')'
            ], 400);
        }

        // Check if already checked in today
        $existingPresensi = Presensi::where('transaksi_id', $transaksi->id)
            ->whereDate('waktu_masuk', today())
            ->first();

        if ($existingPresensi) {
            return response()->json([
                'success' => false,
                'message' => 'Anggota sudah melakukan presensi hari ini.'
            ], 400);
        }

        // Insert Presensi
        $presensi = Presensi::create([
            'transaksi_id' => $transaksi->id,
            'waktu_masuk' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Presensi berhasil dicatat!',
            'data' => [
                'nama' => $transaksi->anggota->nama,
                'paket' => $transaksi->paket->nama_paket,
                'waktu' => $presensi->waktu_masuk->format('H:i:s'),
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Presensi $presensi)
    {
        $presensi->load('transaksi.anggota', 'transaksi.paket');
        return view('presensi.show', compact('presensi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presensi $presensi)
    {
        $transaksis = Transaksi::with('anggota')->where('status', 'lunas')->get();
        return view('presensi.edit', compact('presensi', 'transaksis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PresensiRequest $request, Presensi $presensi)
    {
        $presensi->update($request->validated());

        return redirect()->route('presensi.index')
            ->with('success', 'Presensi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presensi $presensi)
    {
        $presensi->delete();

        return redirect()->route('presensi.index')
            ->with('success', 'Presensi berhasil dihapus.');
    }

    /**
     * Quick presensi for AJAX request (Legacy fallback)
     */
    public function quickPresensi(Request $request)
    {
        return response()->json([
            'success' => false,
            'message' => 'Metode ini sudah digantikan dengan QR Scanner.',
        ], 400);
    }
}