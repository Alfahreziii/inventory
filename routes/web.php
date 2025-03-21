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
use Pest\Plugins\Profile;

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

        //lembur
        Route::get('/lembur', [LaporanController::class, 'index'])->name('lembur');
        Route::post('/cek-lembur', [LaporanController::class, 'cekLembur'])->name('cekLembur');
        Route::get('/lemburs', function () {
            return view('lembur'); // Menampilkan halaman form cek lembur
        });
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

        //nama bahan
        Route::get('/namabahan',[NamabahanController::class, 'index'])->name('namabahan');
        Route::get('/namabahan/edit/{id}', [NamabahanController::class, 'edit'])->name('edit-namabahan');
        Route::get('/namabahan/detail/{id}', [NamabahanController::class, 'detail'])->name('detail-namabahan');
        Route::put('/namabahan/update/{id}', [NamabahanController::class, 'update'])->name('update-namabahan');

        // datatables
        Route::get('/table_kategori',[KategoriController::class, 'datatable_kategori'])->name('table_kategori');
        Route::get('/table_karyawan',[KaryawanController::class, 'datatable_karyawan'])->name('table_karyawan');
        Route::get('/table_lembur',[LaporanController::class, 'datatable_lembur'])->name('table_lembur');
        Route::get('/table_bahanbaku',[BahanbakuController::class, 'datatable_bahanbaku'])->name('table_bahanbaku');
        Route::get('/table_namabahan',[NamabahanController::class, 'datatable_namabahan'])->name('table_namabahan');
        Route::get('/table_riwayatlogin',[ProfileController::class, 'datatable_riwayatlogin'])->name('table_riwayatlogin');

});

require __DIR__.'/auth.php';
