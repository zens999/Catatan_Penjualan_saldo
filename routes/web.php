<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SetorController;
use Illuminate\Notifications\Notification;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminTransaksiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::post('/dashboard/add-saldo', [DashboardController::class, 'addSaldo'])->middleware(['auth', 'verified'])->name('dashboard.addSaldo');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// Route Untik transaksi
Route::get('/transaksis', [TransaksiController::class, 'index'])->name('transaksis.index');
Route::get('/transaksis/create', [TransaksiController::class, 'create'])->name('transaksis.create');
Route::post('/transaksis', [TransaksiController::class, 'store'])->name('transaksis.store');
Route::get('/transaksis/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksis.edit');
Route::put('/transaksis/{id}', [TransaksiController::class, 'update'])->name('transaksis.update');
Route::resource('transaksis', TransaksiController::class);


// Route untuk Setor
Route::get('/setors', [SetorController::class, 'index'])->name('setors.index');
Route::get('/setors/create', [SetorController::class, 'create'])->name('setors.create');
Route::post('/setors', [SetorController::class, 'store'])->name('setors.store');
Route::patch('/{id}/markAsRead', [SetorController::class, 'markAsRead'])->name('markAsRead');
Route::resource('setor', SetorController::class)->middleware('auth');

// Route::prefix('admin')->middleware('role:admin')->group(function () {
    Route::get('transaksilogs', [AdminTransaksiController::class, 'index'])->name('admin.transaksilogs.index');
    Route::get('transaksilogs/{karyawan}', [AdminTransaksiController::class, 'showLogs'])->name('admin.transaksilogs.showLogs');
    Route::get('transaksilogs/tarik/{karyawan}', [AdminTransaksiController::class, 'tarikSetor'])->name('admin.tarikSetor');
// });

// Route untuk user admin
Route::resource('users', UserController::class);

Route::get('admin/users/{user}/add-saldo', [UserController::class, 'showAddSaldoForm'])->name('admin.users.addSaldo');
Route::post('admin/users/{user}/add-saldo', [UserController::class, 'addSaldo'])->name('admin.users.storeSaldo');

Route::patch('/notifications/{id}/markAsRead', [NotificationController::class, 'markAsRead'])->name('notifications.markAsread');


