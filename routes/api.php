<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
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

Route::get('/list-produk', [ProductController::class, 'listProduct']);
Route::post('/insert-produk', [ProductController::class, 'insertProduct']);
Route::delete('/delete-produk/{id}', [ProductController::class, 'deleteProduct']);
Route::put('/update-produk/{id}', [ProductController::class, 'updateProduct']);

Route::get('/list-transaksi', [TransactionController::class, 'listTransaction']);
Route::post('/insert-transaksi', [TransactionController::class, 'insertTransaction']);
Route::delete('/delete-transaksi/{id}', [TransactionController::class, 'deleteTransaction']);
Route::put('/update-transaksi/{id}', [TransactionController::class, 'updateTransaction']);

Route::get('/list-supplier', [SupplierController::class, 'listSupplier']);
Route::post('/insert-supplier', [SupplierController::class, 'insertSupplier']);
Route::delete('/delete-supplier/{id}', [SupplierController::class, 'deleteSupplier']);
Route::put('/update-supplier/{id}', [SupplierController::class, 'updateSupplier']);

Route::get('/list-admin', [AdminController::class, 'listAdmin']);
Route::post('/insert-admin', [AdminController::class, 'insertAdmin']);
Route::delete('/delete-admin/{id}', [AdminController::class, 'deleteAdmin']);
Route::put('/update-admin/{id}', [AdminController::class, 'updateAdmin']);

Route::get('/list-pelanggan', [CustomerController::class, 'listCustomer']);
Route::post('/insert-pelanggan', [CustomerController::class, 'insertCustomer']);
Route::delete('/delete-pelanggan/{id}', [CustomerController::class, 'deleteCustomer']);
Route::put('/update-pelanggan/{id}', [CustomerController::class, 'updateCustomer']);