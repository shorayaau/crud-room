<?php

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
    return view('home');
});

Route::resource('/room_type', \App\Http\Controllers\RoomTypeController::class)->middleware('isLogin');
Route::resource('/room', \App\Http\Controllers\RoomController::class)->middleware('isLogin');
Route::resource('/transaction', \App\Http\Controllers\TransactionController::class)->middleware('isLogin');
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'chart'])->name('chart')->middleware('isLogin');
Route::resource('/laporan', \App\Http\Controllers\LaporanController::class)->middleware('isLogin');
Route::get('/laporan/penjualan/cetak/{tglawal}/{tglakhir}/{type_room}', [\App\Http\Controllers\LaporanController::class, 'laporanpenjualan'])->name('laporanpenjualan');
Route::get('/auth', [\App\Http\Controllers\AuthController::class, 'index'])->middleware('isTamu');
Route::post('/auth/login', [\App\Http\Controllers\AuthController::class, 'login'])->middleware('isTamu');
Route::get('/auth/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
