<?php

use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // ----------------------------------------------------------------------------------------------------------------------------< Direktur >
    Route::group(['middleware' => ['direktur']], function () {
        Route::GET('/karyawan', [UsersController::class, 'index'])->name('karyawan');
        Route::GET('/karyawan/form/{id?}', [UsersController::class, 'form'])->name('karyawan.form');
        Route::POST('/karyawan/store', [UsersController::class, 'store'])->name('karyawan.store');
        Route::PUT('/karyawan/update/{id}', [UsersController::class, 'update'])->name('karyawan.update');
        Route::POST('/karyawan/delete/{id}', [UsersController::class, 'destroy'])->name('karyawan.delete');
    });

    // ----------------------------------------------------------------------------------------------------------------------------< Finance >
    // Route::group(['middleware' => ['finance']], function () {
    //     Route::GET('/pengajuan', [PengajuanController::class, 'indexFinance'])->name('pengajuan');
    //     // Route::GET('/pengajuan/form/{id?}', [PengajuanController::class, 'form'])->name('pengajuan.form');
    //     // Route::POST('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuan.store');
    //     // Route::PUT('/pengajuan/update/{id}', [PengajuanController::class, 'update'])->name('pengajuan.update');
    //     // Route::POST('/pengajuan/delete/{id}', [PengajuanController::class, 'destroy'])->name('pengajuan.delete');
    // });

    // ----------------------------------------------------------------------------------------------------------------------------< Staff >
    // Route::group(['middleware' => ['staff']], function () {
    Route::GET('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan');
    Route::GET('/pengajuan/form/{id?}', [PengajuanController::class, 'form'])->name('pengajuan.form');
    Route::POST('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::PUT('/pengajuan/update/{id}', [PengajuanController::class, 'update'])->name('pengajuan.update');
    Route::POST('/pengajuan/delete/{id}', [PengajuanController::class, 'destroy'])->name('pengajuan.delete');
    // });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
