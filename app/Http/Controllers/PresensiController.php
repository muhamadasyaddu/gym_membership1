<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Anggota;
use App\Http\Requests\PresensiRequest;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Presensi::with('anggota');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('anggota', function ($q) use ($search) {
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $anggota = Anggota::where('status', 'aktif')->orderBy('nama')->get();

        return view('presensi.create', compact('anggota'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PresensiRequest $request)
    {
        // Check if already checked in today
        $existingPresensi = Presensi::where('anggota_id', $request->anggota_id)
            ->whereDate('waktu_masuk', today())
            ->first();

        if ($existingPresensi) {
            return redirect()->back()
                ->with('error', 'Anggota sudah melakukan presensi hari ini.')
                ->withInput();
        }

        Presensi::create([
            'anggota_id' => $request->anggota_id,
            'waktu_masuk' => $request->waktu_masuk ?? now(),
        ]);

        return redirect()->route('presensi.index')
            ->with('success', 'Presensi berhasil dicatat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Presensi $presensi)
    {
        $presensi->load('anggota');

        return view('presensi.show', compact('presensi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presensi $presensi)
    {
        $anggota = Anggota::orderBy('nama')->get();

        return view('presensi.edit', compact('presensi', 'anggota'));
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
     * Quick presensi for AJAX request
     */
    public function quickPresensi(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
        ]);

        // Check if member is active
        $anggota = Anggota::find($request->anggota_id);
        if ($anggota->status !== 'aktif') {
            return response()->json([
                'success' => false,
                'message' => 'Anggota tidak aktif. Silakan perpanjang membership.',
            ], 400);
        }

        // Check if already checked in today
        $existingPresensi = Presensi::where('anggota_id', $request->anggota_id)
            ->whereDate('waktu_masuk', today())
            ->first();

        if ($existingPresensi) {
            return response()->json([
                'success' => false,
                'message' => 'Anggota sudah melakukan presensi hari ini.',
            ], 400);
        }

        $presensi = Presensi::create([
            'anggota_id' => $request->anggota_id,
            'waktu_masuk' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Presensi berhasil dicatat pada ' . $presensi->waktu_masuk->format('H:i'),
            'data' => [
                'nama' => $anggota->nama,
                'waktu' => $presensi->formatted_waktu,
            ],
        ]);
    }
}