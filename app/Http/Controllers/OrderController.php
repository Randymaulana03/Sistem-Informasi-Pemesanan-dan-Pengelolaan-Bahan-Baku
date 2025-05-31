<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Laptop;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Pastikan harus login dulu
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Tampilkan list order user login
    // public function index()
    // {
    //     $orders = Order::where('user_id', auth()->id())->latest()->paginate(10);
    //     return view('orders.index', compact('orders'));
    //     $recentOrders = Order::with('laptop')->latest()->take(10)->get();
    // }

    public function index()
{
    // Kalau ini buat tampilan order user biasa
    $orders = Order::where('user_id', auth()->id())->latest()->paginate(10);

    // Kalau ini data pesanan terbaru (misal buat dashboard admin)
    $recentOrders = Order::with('laptop')->latest()->take(10)->get();

    // Kirim keduanya ke view
    return view('orders.index', compact('orders', 'recentOrders'));
}


    // Form buat pesanan baru
    public function create()
    {
        $laptops = Laptop::all();
        return view('orders.create', compact('laptops'));
    }

    // Simpan pesanan baru
   public function store(Request $request)
{
   $request->validate([
        'customer_name' => 'required|string|max:255',
        'customer_phone' => 'nullable|string|max:20',
        'customer_address' => 'nullable|string|max:500',
        'laptops' => 'required|array',
        'payment_method' => 'required|string|in:COD',
        'laptops.*' => 'integer|exists:laptops,id',
        'quantities' => 'required|array',
        'quantities.*' => 'integer|min:1',
    ]);

    DB::beginTransaction();
    try {
        $total = 0;

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'payment_method' => $request->payment_method,
            'total_price' => 0,
            'user_id' => auth()->id(),
        ]);

        foreach ($request->laptops as $laptopId) {
            $laptop = Laptop::findOrFail($laptopId);
            $quantity = isset($request->quantities[$laptopId]) ? (int) $request->quantities[$laptopId] : 1;

            if ($laptop->stock < $quantity) {
                DB::rollBack();
                return back()->withErrors("Stok laptop {$laptop->name} tidak mencukupi. Tersisa: {$laptop->stock}")->withInput();
            }

            $laptop->stock -= $quantity;
            $laptop->save();

            $total += $laptop->total_price * $quantity;

            $order->laptops()->attach($laptopId, [
                'quantity' => $quantity,
                'price' => $laptop->total_price,
            ]);
        }

        $order->update(['total_price' => $total]);
        DB::commit();

        return redirect()->route('orders.show', $order)->with('success', 'Pesanan berhasil dibuat!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors('Terjadi kesalahan: ' . $e->getMessage())->withInput();
    }
}



    // Detail pesanan
    public function show(Order $order)
    {
        // Pastikan user hanya bisa lihat order miliknya sendiri
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('laptops');
        return view('orders.show', compact('order'));
    }


    // Export invoice PDF
    public function exportPdf(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('laptops');
        $pdf = Pdf::loadView('orders.pdf', compact('order'));
        return $pdf->download('invoice-order-' . $order->id . '.pdf');
    }
    public function orderNow(Request $request, Laptop $laptop)
{
    $order = Order::create([
        'customer_name' => auth()->user()->name,    // contoh ambil nama user login
        'customer_phone' => '',
        'customer_address' => '',
        'total_price' => $laptop->total_price,
        'user_id' => auth()->id(),   // wajib diisi user_id
    ]);

    $order->laptops()->attach($laptop->id, [
    'quantity' => 1,
    'price' => $laptop->total_price,
]);

    return redirect()->route('orders.index')->with('success', 'Order berhasil dikirim.');
}


public function destroy($id)
{
    // Cari pesanan berdasarkan id
    $order = Order::findOrFail($id);

    foreach ($order->laptops as $laptop) {
        $laptop->stock += $laptop->pivot->quantity;
        $laptop->save();
    }
    // Hapus pesanan
    $order->delete();

    // Redirect ke halaman daftar pesanan dengan pesan sukses
    return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
}





    // (Optional) Tambah edit, update, delete kalau perlu
}
