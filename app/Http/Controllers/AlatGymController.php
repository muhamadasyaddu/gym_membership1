<?php

namespace App\Http\Controllers;

use App\Models\AlatGym;
use App\Http\Requests\AlatGymRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlatGymController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = AlatGym::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('merek', 'like', "%{$search}%");
            });
        }

        // Filter by kondisi
        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }

        $alat = $query->latest()->paginate(10)->appends($request->query());

        return view('alat-gym.index', compact('alat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alat-gym.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlatGymRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                ->store('alat-gym', 'public');
        }

        AlatGym::create($data);

        return redirect()->route('alat-gym.index')
            ->with('success', 'Alat gym berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AlatGym $alatGym)
    {
        return view('alat-gym.show', compact('alatGym'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AlatGym $alatGym)
    {
        return view('alat-gym.edit', compact('alatGym'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlatGymRequest $request, AlatGym $alatGym)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {

            if ($alatGym->gambar) {
                Storage::disk('public')->delete($alatGym->gambar);
            }

            $data['gambar'] = $request->file('gambar')
                ->store('alat-gym', 'public');
        }

        $alatGym->update($data);

        return redirect()->route('alat-gym.index')
            ->with('success', 'Alat gym berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AlatGym $alatGym)
    {
        if ($alatGym->gambar) {
            Storage::disk('public')->delete($alatGym->gambar);
        }

        $alatGym->delete();

        return redirect()->route('alat-gym.index')
            ->with('success', 'Alat gym berhasil dihapus.');
    }
}