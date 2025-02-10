<?php

use App\Models\jadwal;
use App\Models\bandara;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\BandaraController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MaskapaiController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\userController;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::group(['middleware' => ['auth', function ($request, $next) {
        if (!in_array($request->user()->role, ['admin', 'maskapai'])) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }]], function () {
        // Gunakan hanya resource route
        Route::resource('master/maskapai', MaskapaiController::class);
        Route::resource('master/bandara', BandaraController::class);
        Route::resource('master/user', userController::class);
        Route::resource('/jadwal', JadwalController::class);

        // Route untuk konfirmasi pesanan
        Route::get('/konfirmasi-pesanan', [PemesananController::class, 'konfirmasiPesanan'])
            ->name('konfirmasi.pesanan');
        Route::patch('/konfirmasi-pesanan', [PemesananController::class, 'updateStatus'])
            ->name('konfirmasi.update');
    });
});

Route::middleware(['auth'])->group(function () {
    // Route untuk menampilkan list tiket
    Route::get('/tiket', [PemesananController::class, 'listTiket'])->name('tiket.list');

    // Route untuk pemesanan
    Route::get('/pemesanan/{no_penerbangan}', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');

    // Route untuk menampilkan riwayat pembelian tiket user
    Route::get('/my-tickets', [PemesananController::class, 'myTickets'])
        ->name('tiket.my-tickets');
});

Route::get('/list-tiket', function() {
    $jadwals = jadwal::with(['maskapai', 'bandaraKeberangkatan', 'bandaraTujuan'])->get();
    $bandaras = bandara::all();
    return view('user.list-tiket', compact('jadwals', 'bandaras'));
})->name('list-tiket');

require __DIR__.'/auth.php';
