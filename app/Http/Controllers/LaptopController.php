<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaptopController extends Controller
{
    public function index()
    {
        $laptops = Laptop::with('components')->get();
        return view('laptops.index', compact('laptops'));
    }

    public function create()
    {
        $components = Component::where('stock', '>', 0)->get();
        return view('laptops.create', compact('components'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'components' => 'required|array',
            'components.*' => 'integer|exists:components,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
        ]);

        // Load all selected components at once to reduce queries
        $selectedComponents = Component::whereIn('id', $request->components)->get()->keyBy('id');

        // Hitung total harga dan cek stok
        $totalPrice = 0;
        foreach ($request->components as $index => $componentId) {
    $component = $selectedComponents[$componentId];  // ambil dari koleksi yg sudah di-query sekali
    $qty = $request->quantities[$index];

    if ($component->stock < $qty) {
        return back()->withErrors("Stok komponen {$component->name} tidak cukup.");
    }
    $totalPrice += $component->unit_price * $qty;
}


        // Tambah 5 juta ke total harga
        $totalPrice += 2000000;

        DB::transaction(function () use ($request, $selectedComponents, $totalPrice) {
            $laptop = Laptop::create([
                'name' => $request->name,
                'total_price' => $totalPrice,
                'stock' => 1,
            ]);

            foreach ($request->components as $index => $componentId) {
                $qty = $request->quantities[$index];
                $laptop->components()->attach($componentId, ['quantity' => $qty]);

                $component = $selectedComponents[$componentId];
                $component->stock -= $qty;
                $component->save();
            }
        });

        return redirect()->route('laptops.index')->with('success', 'Laptop berhasil dirakit.');
    }
    public function destroy($id)
{
    $laptop = Laptop::findOrFail($id);
    $laptop->components()->detach(); // Lepas relasi komponen dulu, biar bersih
    $laptop->delete();

    return redirect()->route('laptops.index')->with('success', 'Rakitan laptop berhasil dihapus.');
}
public function edit($id)
    {
        $laptop = Laptop::findOrFail($id);
        return view('laptops.edit', compact('laptop'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $laptop = Laptop::findOrFail($id);
        $laptop->name = $request->name;
        $laptop->save();

        return redirect()->route('laptops.index')->with('success', 'Nama laptop berhasil diupdate!');
    }

}
