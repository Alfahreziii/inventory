<?php

use Pest\Plugins\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BahanbakuController;
use App\Http\Controllers\NamabahanController;
use App\Http\Controllers\PengeluaranController;

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

Route::get('/',[BahanbakuController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
        //profile
        Route::get('/user', [ProfileController::class, 'index'])->name('user');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::middleware(['auth', 'status:admin'])->group(function () {
            //bahanbaku
            Route::get('/buat-bahanbaku', [BahanbakuController::class, 'create'])->name('buat-bahanbaku');
            Route::post('/tambah-bahanbaku', [BahanbakuController::class, 'store'])->name('tambah-bahanbaku');
            Route::delete('/bahanbaku/delete/{id}', [BahanbakuController::class, 'destroy'])->name('delete-bahanbaku');

            //namabahan
            Route::get('/buat-namabahan', [NamabahanController::class, 'create'])->name('buat-namabahan');
            Route::post('/tambah-namabahan', [NamabahanController::class, 'store'])->name('tambah-namabahan');
            Route::delete('/namabahan/delete/{id}', [NamabahanController::class, 'destroy'])->name('delete-namabahan');
        });
        //bahan baku
        Route::get('/dashboard',[BahanbakuController::class, 'index'])->name('dashboard');
        Route::get('/bahanbaku/edit/{id}', [BahanbakuController::class, 'edit'])->name('edit-bahanbaku');
        Route::get('/bahanbaku/detail/{id}', [BahanbakuController::class, 'detail'])->name('detail-bahanbaku');
        Route::put('/bahanbaku/update/{id}', [BahanbakuController::class, 'update'])->name('update-bahanbaku');

        //riwayat pengeluaran
        Route::get('/riwayat-pengeluaran',[PengeluaranController::class, 'index'])->name('riwayat-pengeluaran');
        Route::get('/buat-pengeluaran', [PengeluaranController::class, 'create'])->name('buat-pengeluaran');
        Route::post('/tambah-pengeluaran', [PengeluaranController::class, 'store'])->name('tambah-pengeluaran');
        Route::get('/riwayat-pengeluaran/edit/{id}', [PengeluaranController::class, 'edit'])->name('edit-riwayatpengeluaran');

        //nama bahan
        Route::get('/namabahan',[NamabahanController::class, 'index'])->name('namabahan');
        Route::get('/namabahan/edit/{id}', [NamabahanController::class, 'edit'])->name('edit-namabahan');
        Route::get('/namabahan/detail/{id}', [NamabahanController::class, 'detail'])->name('detail-namabahan');
        Route::put('/namabahan/update/{id}', [NamabahanController::class, 'update'])->name('update-namabahan');

        // datatables
        Route::get('/table_bahanbaku',[BahanbakuController::class, 'datatable_bahanbaku'])->name('table_bahanbaku');
        Route::get('/table_namabahan',[NamabahanController::class, 'datatable_namabahan'])->name('table_namabahan');
        Route::get('/table_riwayatpengeluaran',[PengeluaranController::class, 'datatable_riwayatpengeluaran'])->name('table_riwayatpengeluaran');
        Route::get('/table_riwayatlogin',[ProfileController::class, 'datatable_riwayatlogin'])->name('table_riwayatlogin');

});

require __DIR__.'/auth.php';
