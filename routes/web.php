<?php

use App\Models\Karyawan;
use App\Models\Bahanbaku;
use App\Models\Namabahan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpvController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LemburController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BahanbakuController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DepartmenController;
use App\Http\Controllers\NamabahanController;

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
        //create profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        //lembur
        Route::get('/lembur', [LaporanController::class, 'index'])->name('lembur');
        Route::post('/cek-lembur', [LaporanController::class, 'cekLembur'])->name('cekLembur');
        Route::get('/lemburs', function () {
            return view('lembur'); // Menampilkan halaman form cek lembur
        });

        //bahan baku
        Route::get('/dashboard',[BahanbakuController::class, 'index'])->name('dashboard');
        Route::get('/buat-bahanbaku', [BahanbakuController::class, 'create'])->name('buat-bahanbaku');
        Route::post('/tambah-bahanbaku', [BahanbakuController::class, 'store'])->name('tambah-bahanbaku');
        Route::get('/bahanbaku/edit/{id}', [BahanbakuController::class, 'edit'])->name('edit-bahanbaku');
        Route::get('/bahanbaku/detail/{id}', [BahanbakuController::class, 'detail'])->name('detail-bahanbaku');
        Route::put('/bahanbaku/update/{id}', [BahanbakuController::class, 'update'])->name('update-bahanbaku');
        Route::delete('/bahanbaku/delete/{id}', [BahanbakuController::class, 'destroy'])->name('delete-bahanbaku');

        //nama bahan
        Route::get('/namabahan',[NamabahanController::class, 'index'])->name('namabahan');
        Route::get('/buat-namabahan', [NamabahanController::class, 'create'])->name('buat-namabahan');
        Route::post('/tambah-namabahan', [NamabahanController::class, 'store'])->name('tambah-namabahan');
        Route::get('/namabahan/edit/{id}', [NamabahanController::class, 'edit'])->name('edit-namabahan');
        Route::get('/namabahan/detail/{id}', [NamabahanController::class, 'detail'])->name('detail-namabahan');
        Route::put('/namabahan/update/{id}', [NamabahanController::class, 'update'])->name('update-namabahan');
        Route::delete('/namabahan/delete/{id}', [NamabahanController::class, 'destroy'])->name('delete-namabahan');

        //kategori
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
        Route::get('/buat-kategori', [KategoriController::class, 'create'])->name('buat-kategori');
        Route::post('/tambah-kategori', [KategoriController::class, 'store'])->name('tambah-kategori');
        Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('edit-kategori');
        Route::put('/kategori/update/{id}', [KategoriController::class, 'update'])->name('update-kategori');
        Route::delete('/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('delete-kategori');


        // datatables
        Route::get('/table_kategori',[KategoriController::class, 'datatable_kategori'])->name('table_kategori');
        Route::get('/table_karyawan',[KaryawanController::class, 'datatable_karyawan'])->name('table_karyawan');
        Route::get('/table_lembur',[LaporanController::class, 'datatable_lembur'])->name('table_lembur');
        Route::get('/table_bahanbaku',[BahanbakuController::class, 'datatable_bahanbaku'])->name('table_bahanbaku');
        Route::get('/table_namabahan',[NamabahanController::class, 'datatable_namabahan'])->name('table_namabahan');

});

require __DIR__.'/auth.php';
