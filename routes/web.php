<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\ManajemenMobilController;
use App\Http\Controllers\PeminjamanMobilController;
use App\Http\Controllers\PengembalianMobilController;

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
    return view('layouts.base');
});

Route::group(['prefix' => ''], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['prefix' => 'manajemen-mobil', 'as' => 'manajemen-mobil.'], function () {
    Route::get('/', [ManajemenMobilController::class, 'index'])->name('index');
    Route::get('/create', [ManajemenMobilController::class, 'create'])->name('create');
    Route::post('/store', [ManajemenMobilController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ManajemenMobilController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [ManajemenMobilController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [ManajemenMobilController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'peminjaman-mobil', 'as' => 'peminjaman-mobil.'], function () {
    Route::get('/', [PeminjamanMobilController::class, 'index'])->name('index');
    Route::get('/create', [PeminjamanMobilController::class, 'create'])->name('create');
    Route::post('/store', [PeminjamanMobilController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PeminjamanMobilController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [PeminjamanMobilController::class, 'update'])->name('update');
});

Route::group(['prefix' => 'pengembalian-mobil', 'as' => 'pengembalian-mobil.'], function () {
    Route::get('/', [PengembalianMobilController::class, 'index'])->name('index');
    Route::get('/create', [PengembalianMobilController::class, 'create'])->name('create');
    Route::post('/store', [PengembalianMobilController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PengembalianMobilController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [PengembalianMobilController::class, 'update'])->name('update');
});
