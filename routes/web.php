<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController as AdminMenu;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\KasirController;
use App\Http\Controllers\Admin\PromoController;

// Kasir Controllers
use App\Http\Controllers\Kasir\DashboardController as KasirDashboard;
use App\Http\Controllers\Kasir\OrderController as KasirOrder;
use App\Http\Controllers\Kasir\PaymentController as KasirPayment;
use App\Http\Controllers\Kasir\ReceiptController;

// Pelanggan Controllers
use App\Http\Controllers\Pelanggan\MenuController as PelangganMenu;
use App\Http\Controllers\Pelanggan\CartController;
use App\Http\Controllers\Pelanggan\CheckoutController;
use App\Http\Controllers\Pelanggan\OrderController as PelangganOrder;
use App\Http\Controllers\Pelanggan\PaymentController as PelangganPayment;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role === 'kasir') {
        return redirect()->route('kasir.dashboard');
    }
    return redirect()->route('pelanggan.home');
})->middleware(['auth'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('menus', AdminMenu::class);
    Route::resource('customers', CustomerController::class)->only(['index', 'update']);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/pdf', [ReportController::class, 'exportPdf'])->name('reports.pdf');
    Route::get('/kasirs', [KasirController::class, 'index'])->name('kasirs.index');
    Route::put('/kasirs/{kasir}', [KasirController::class, 'update'])->name('kasirs.update');
    Route::patch('/kasirs/{kasir}/toggle', [KasirController::class, 'toggleStatus'])->name('kasirs.toggle');
    Route::resource('promos', PromoController::class);
    Route::patch('/promos/{promo}/toggle', [PromoController::class, 'toggleStatus'])->name('promos.toggle');
});

// Kasir Routes
Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/dashboard', [KasirDashboard::class, 'index'])->name('dashboard');
    Route::resource('orders', KasirOrder::class)->only(['index', 'show', 'update']);
    Route::post('/payments/{order}/confirm', [KasirPayment::class, 'confirm'])->name('payments.confirm');
    Route::get('/receipt/{order}', [ReceiptController::class, 'print'])->name('receipt.print');
});

// Pelanggan Routes
Route::middleware(['auth', 'role:pelanggan'])->prefix('home')->name('pelanggan.')->group(function () {
    Route::get('/', [PelangganMenu::class, 'index'])->name('home');
    Route::get('/rewards', function() { return view('pelanggan.rewards'); })->name('rewards');
    Route::get('/favorites', function() { return view('pelanggan.favorites'); })->name('favorites');
    
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{menu}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/promo', [CartController::class, 'applyPromo'])->name('cart.promo');
    Route::delete('/cart/promo', [CartController::class, 'removePromo'])->name('cart.promo.remove');
    
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    
    Route::resource('orders', PelangganOrder::class)->only(['index', 'show']);
    Route::post('/orders/{order}/upload-bukti', [PelangganPayment::class, 'uploadBukti'])->name('payments.upload-bukti');
    Route::patch('/orders/{order}/change-payment', [PelangganPayment::class, 'changeMethod'])->name('payments.change-method');
});

require __DIR__.'/auth.php';
