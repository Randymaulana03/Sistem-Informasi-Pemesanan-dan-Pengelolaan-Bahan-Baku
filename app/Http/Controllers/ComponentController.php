<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    // Menampilkan daftar komponen dengan filter jenis (opsional)
    public function index(Request $request)
    {
        $type = $request->query('type');

        $componentsQuery = Component::query();

        if ($type) {
            $componentsQuery->where('type', $type);
        }

        $components = $componentsQuery->get();
        $types = Component::select('type')->distinct()->pluck('type');

        return view('components.index', compact('components', 'types'));
    }

    // Tampilkan form tambah komponen
    public function create()
    {
        return view('components.create');
    }

    // Simpan komponen baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'stock' => 'required|integer',
            'unit_price' => 'required|integer',
        ]);

        Component::create($request->all());

        return redirect()->route('components.index')->with('success', 'Komponen berhasil ditambahkan.');
    }

    // Tampilkan form edit komponen
    public function edit(Component $component)
    {
        return view('components.edit', compact('component'));
    }

    // Update komponen
    public function update(Request $request, Component $component)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'stock' => 'required|integer',
            'unit_price' => 'required|integer',
        ]);

        $component->update($request->all());

        return redirect()->route('components.index')->with('success', 'Komponen berhasil diperbarui.');
    }

    // Hapus komponen
    public function destroy(Component $component)
    {
        $component->delete();

        return redirect()->route('components.index')->with('success', 'Komponen berhasil dihapus.');
    }
}
