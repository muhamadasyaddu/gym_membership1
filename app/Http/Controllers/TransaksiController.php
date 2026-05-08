<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Anggota;
use App\Models\PaketGym;
use App\Http\Requests\TransaksiRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transaksi::with('anggota', 'paket');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('anggota', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $transaksi = $query->latest()->paginate(10)->appends($request->query());

        return view('transaksi.index', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $anggota = Anggota::orderBy('nama')->get();
        $paket = PaketGym::orderBy('nama_paket')->get();

        return view('transaksi.create', compact('anggota', 'paket'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransaksiRequest $request)
    {
        $paket = PaketGym::findOrFail($request->paket_id);

        // Calculate waktu_berakhir
        $waktuMulai = Carbon::parse($request->waktu_mulai);
        $waktuBerakhir = $waktuMulai->copy()->addDays($paket->durasi_hari);

        // Create transaction
        $transaksi = Transaksi::create([
            'anggota_id' => $request->anggota_id,
            'paket_id' => $request->paket_id,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_berakhir' => $waktuBerakhir,
            'total_harga' => $paket->harga,
            'payment_method' => $request->payment_method,
            'status' => $request->status ?? 'lunas',
            'keterangan' => $request->keterangan,
        ]);

        // Update anggota status to aktif
        $anggota = Anggota::find($request->anggota_id);
        $anggota->update(['status' => 'aktif']);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan. Membership berlaku hingga ' . $waktuBerakhir->format('d/m/Y'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        $transaksi->load('anggota', 'paket');

        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        $anggota = Anggota::orderBy('nama')->get();
        $paket = PaketGym::orderBy('nama_paket')->get();

        return view('transaksi.edit', compact('transaksi', 'anggota', 'paket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransaksiRequest $request, Transaksi $transaksi)
    {
        $paket = PaketGym::findOrFail($request->paket_id);

        // Calculate waktu_berakhir
        $waktuMulai = Carbon::parse($request->waktu_mulai);
        $waktuBerakhir = $waktuMulai->copy()->addDays($paket->durasi_hari);

        $transaksi->update([
            'anggota_id' => $request->anggota_id,
            'paket_id' => $request->paket_id,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_berakhir' => $waktuBerakhir,
            'total_harga' => $paket->harga,
            'payment_method' => $request->payment_method,
            'status' => $request->status ?? 'lunas',
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}