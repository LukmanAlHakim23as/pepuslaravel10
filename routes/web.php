<?php

use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'authenticate']);

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [AdminDashboard::class, 'index']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/datalaporan', [PeminjamanController::class, 'history'])->name('history');
    Route::get('/generate-pdf', [PeminjamanController::class, 'generatePDF'])->name('generate.pdf');

});

Route::middleware(['auth', 'role:pustakawan,admin'])->group(function () {
    Route::resource('/datapeminjaman',PeminjamanController::class);

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::resource('/databuku', BukuController::class);
        Route::resource('/datauser', UserController::class);
        Route::resource('/datakategori', KategoriController::class);
    });
});
