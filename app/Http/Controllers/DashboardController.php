<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Laptop;
use App\Models\Component;

class DashboardController extends Controller
{
    public function index()
{
    $totalOrders = Order::count();
    $totalLaptops = Laptop::sum('stock');
    $totalComponents = Component::sum('stock');
    $totalIncome = Order::sum('total_price');

    $recentOrders = Order::latest()->take(5)->get();
    $recentLaptops = Laptop::latest()->take(5)->get();
    $recentComponents = Component::latest()->take(5)->get();

    return view('admin.index', compact(
        'totalOrders', 'totalLaptops', 'totalComponents', 'totalIncome',
        'recentOrders', 'recentLaptops', 'recentComponents'
    ));
}

}
