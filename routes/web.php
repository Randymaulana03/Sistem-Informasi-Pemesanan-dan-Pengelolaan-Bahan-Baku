<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\LaptopController;
use App\Models\Laptop;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root ke dashboard jika sudah login, kalau belum ke login user
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboardUser');
    }
    return redirect()->route('loginUser');
});

// --- User Authentication Routes ---

// Halaman login user (GET)
Route::get('/loginUser', function () {
    return view('loginUser');
})->name('loginUser');

// Proses login user (POST)
Route::post('/loginUser', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();
        return redirect()->route('dashboardUser');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->withInput();
})->name('loginUser.post');

// Proses logout user (POST)
Route::post('/logoutUser', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('loginUser');
})->name('logoutUser');

// --- Dashboard User (hanya untuk user yang login) ---
Route::middleware('auth')->group(function () {
    Route::get('/dashboardUser', function () {
        $laptops = Laptop::with('components')->get();
        return view('dashboardUser', compact('laptops'));
    })->name('dashboardUser');

    // Order Routes
    Route::get('/orders/create/{laptop}', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/order-now/{laptop}', [OrderController::class, 'orderNow'])->name('order.now');
    Route::post('/order-custom', [OrderController::class, 'orderCustom'])->name('order.custom');

    // User Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- Admin Login (tanpa database) ---
Route::prefix('admin')->group(function () {
    // Halaman login admin (GET)
    Route::get('/login', function () {
        return view('admin.login');
    })->name('admin.login');

    // Proses login admin manual (POST)
    Route::post('/login', function (Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');

        if ($username === 'admin' && $password === '12345') {
            session(['is_admin' => true]);
            return redirect()->route('dashboard.index');
        }

        return back()->with('error', 'Username atau Password salah');
    })->name('admin.login.post');

    // Dashboard admin (GET)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Logout admin (POST)
    Route::post('/logout', function () {
        session()->forget('is_admin');
        return redirect()->route('admin.login');
    })->name('admin.logout');
});

// --- Resource Controllers ---
Route::resource('components', ComponentController::class);

Route::resource('laptops', LaptopController::class)->middleware('auth');

// --- Laravel Default Auth (jika menggunakan Breeze/Fortify) ---
require __DIR__.'/auth.php';
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store')->middleware('auth');
Route::get('/orders/create/{laptop}', [OrderController::class, 'create'])->name('orders.create');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::middleware('auth')->group(function () {
    // Route lain...

    // Tambahkan route ini untuk export PDF invoice
    Route::get('orders/{order}/pdf', [OrderController::class, 'exportPdf'])->name('orders.pdf');
});
Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
Route::resource('laptops', LaptopController::class);
