<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KasirController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/list-barang', [BarangController::class, 'listBarang']);
Route::post('/insert-barang', [BarangController::class, 'insertBarang']);
Route::delete('/delete-barang/{id}', [BarangController::class, 'deleteBarang']);
Route::put('/update-barang/{id}', [BarangController::class, 'updateBarang']);

Route::get('/list-kasir', [KasirController::class, 'listKasir']);
Route::post('/insert-kasir', [KasirController::class, 'insertKasir']);
Route::delete('/delete-kasir/{id}', [KasirController::class, 'deleteKasir']);
Route::put('/update-kasir/{id}', [KasirController::class, 'updateKasir']);