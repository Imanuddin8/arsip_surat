<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TentangController;

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

// Arsip surat
Route::get('/', [ArsipController::class, 'index'])->name('arsip');
Route::get('/arsip/create', [ArsipController::class, 'create'])->name('arsip.create');
Route::post('/arsip/store', [ArsipController::class, 'store'])->name('arsip.store');
Route::get('/arsip/edit/{id}', [ArsipController::class, 'edit'])->name('arsip.edit');
Route::put('/arsip/{id}', [ArsipController::class, 'update'])->name('arsip.update');
Route::get('/arsip/download/{id}', [ArsipController::class, 'download'])->name('arsip.download');
Route::delete('/arsip/destroy/{id}', [ArsipController::class, 'destroy'])->name('arsip.destroy');
Route::get('/arsip/lihat/{id}', [ArsipController::class, 'lihat'])->name('arsip.lihat');
Route::get('/arsip/pencarian', [ArsipController::class, 'cari'])->name('arsip.cari');

// Menampilkan semua item
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/destroy/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
Route::get('/kategori/pencarian', [KategoriController::class, 'cari'])->name('kategori.cari');

// Tentang Saya
Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');
