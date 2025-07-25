<?php

use Pest\Plugins\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BahanbakuController;
use App\Http\Controllers\EoqController;
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

Route::get('/',[BahanbakuController::class, 'index'])->middleware(['auth', 'verified'])->name('bahanbaku');
Route::get('/dashboard', [BahanbakuController::class, 'dashboard'])->name('dashboard');

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
        Route::get('/bahanbaku',[BahanbakuController::class, 'index'])->name('bahanbaku');
        Route::get('/bahanbaku/edit/{id}', [BahanbakuController::class, 'edit'])->name('edit-bahanbaku');
        Route::get('/bahanbaku/detail/{id}', [BahanbakuController::class, 'detail'])->name('detail-bahanbaku');
        Route::put('/bahanbaku/update/{id}', [BahanbakuController::class, 'update'])->name('update-bahanbaku');
        Route::get('/bahanbaku/detail-group/{id}', [BahanbakuController::class, 'detailGroup'])->name('detail-group-bahanbaku');


        //riwayat pengeluaran
        Route::get('/riwayat-pengeluaran',[PengeluaranController::class, 'index'])->name('riwayat-pengeluaran');
        Route::get('/buat-pengeluaran', [PengeluaranController::class, 'create'])->name('buat-pengeluaran');
        Route::post('/tambah-pengeluaran', [PengeluaranController::class, 'store'])->name('tambah-pengeluaran');
        Route::delete('/riwayat-pengeluaran/delete/{id}', [PengeluaranController::class, 'destroy'])->name('delete-riwayatpengeluaran');

        //nama bahan
        Route::get('/namabahan',[NamabahanController::class, 'index'])->name('namabahan');
        Route::get('/namabahan/edit/{id}', [NamabahanController::class, 'edit'])->name('edit-namabahan');
        Route::get('/namabahan/detail/{id}', [NamabahanController::class, 'detail'])->name('detail-namabahan');
        Route::put('/namabahan/update/{id}', [NamabahanController::class, 'update'])->name('update-namabahan');

        //eoq
        Route::get('/eoq',[EoqController::class, 'index'])->name('eoq');
        Route::get('/buat-eoq', [EoqController::class, 'create'])->name('buat-eoq');
        Route::post('/tambah-eoq', [EoqController::class, 'store'])->name('tambah-eoq');
        Route::get('/eoq/edit/{id}', [EoqController::class, 'edit'])->name('edit-eoq');
        Route::delete('/eoq/delete/{id}', [EoqController::class, 'destroy'])->name('delete-eoq');
        Route::put('/eoq/update/{id}', [EoqController::class, 'update'])->name('update-eoq');
        Route::get('/eoq/detail/{id}', [EoqController::class, 'detail'])->name('detail-eoq');

        // datatables
        Route::get('/table_bahanbaku',[BahanbakuController::class, 'datatable_bahanbaku'])->name('table_bahanbaku');
        Route::get('/table_namabahan',[NamabahanController::class, 'datatable_namabahan'])->name('table_namabahan');
        Route::get('/table_eoq',[EoqController::class, 'datatable_eoq'])->name('table_eoq');
        Route::get('/table_riwayatpengeluaran',[PengeluaranController::class, 'datatable_riwayatpengeluaran'])->name('table_riwayatpengeluaran');
        Route::get('/table_riwayatlogin',[ProfileController::class, 'datatable_riwayatlogin'])->name('table_riwayatlogin');
        Route::get('/bahanbaku/detail-group-datatable/{id}', [BahanbakuController::class, 'datatableDetailGroup'])->name('datatable-detail-group-bahanbaku');
        Route::get('/kadaluarsa-bulan-ini', [BahanbakuController::class, 'bahanbaku_kadaluarsa_bulan_ini'])->name('kadaluarsa-bulan-ini');

        //export
        Route::get('/bahanbaku/cetak', [BahanbakuController::class, 'cetakPDF'])->name('bahanbaku.cetak');
        Route::get('/cetak-pengeluaran', [PengeluaranController::class, 'cetakPDF'])->name('cetak-pengeluaran');

});

require __DIR__.'/auth.php';
