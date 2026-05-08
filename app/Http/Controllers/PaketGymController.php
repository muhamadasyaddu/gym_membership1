<?php

namespace App\Http\Controllers;

use App\Models\PaketGym;
use App\Http\Requests\PaketGymRequest;
use Illuminate\Http\Request;

class PaketGymController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PaketGym::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_paket', 'like', "%{$search}%");
        }

        $paket = $query->latest()->paginate(10)->appends($request->query());

        return view('paket-gym.index', compact('paket'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('paket-gym.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaketGymRequest $request)
    {
        PaketGym::create($request->validated());

        return redirect()->route('paket-gym.index')
            ->with('success', 'Paket gym berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaketGym $paketGym)
    {
        $paketGym->load(['transaksi.anggota' => function ($query) {
            $query->latest()->take(10);
        }]);

        return view('paket-gym.show', compact('paketGym'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaketGym $paketGym)
    {
        return view('paket-gym.edit', compact('paketGym'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaketGymRequest $request, PaketGym $paketGym)
    {
        $paketGym->update($request->validated());

        return redirect()->route('paket-gym.index')
            ->with('success', 'Paket gym berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaketGym $paketGym)
    {
        // Check if package has transactions
        if ($paketGym->transaksi()->exists()) {
            return redirect()->route('paket-gym.index')
                ->with('error', 'Paket tidak dapat dihapus karena sudah digunakan dalam transaksi.');
        }

        $paketGym->delete();

        return redirect()->route('paket-gym.index')
            ->with('success', 'Paket gym berhasil dihapus.');
    }
}