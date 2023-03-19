<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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

Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::prefix('logged')->middleware('auth')->group(function () {
    Route::prefix('kasir')->middleware('kasir')->group(
        function () {
            Route::get('/list-transaksi', [TransactionController::class, 'listTransaction']);
            Route::group(
                ['prefix' => 'list-transaksi'],
                function () {
                        Route::get('/penjualan', [TransactionController::class, 'listSale']);
                        Route::get('/pembelian', [TransactionController::class, 'listPurchase']);
                    }
            );
            Route::post('/insert-transaksi', [TransactionController::class, 'insertTransaction']);
            Route::get('/list-detail-transaksi', [DetailController::class, 'listDetail']);
        }
    );
    Route::prefix('gudang')->middleware('gudang')->group(
        function () {
            Route::get('/list-produk', [ProductController::class, 'listProduct']);
            Route::post('/insert-produk', [ProductController::class, 'insertProduct']);
            Route::delete('/delete-produk/{id}', [ProductController::class, 'deleteProduct']);
            Route::put('/update-produk/{id}', [ProductController::class, 'updateProduct']);

            Route::get('/list-supplier', [SupplierController::class, 'listSupplier']);
            Route::post('/insert-supplier', [SupplierController::class, 'insertSupplier']);
            Route::delete('/delete-supplier/{id}', [SupplierController::class, 'deleteSupplier']);
            Route::put('/update-supplier/{id}', [SupplierController::class, 'updateSupplier']);
        }
    );
    Route::prefix('admin')->middleware('admin')->group(
        function () {
            Route::get('/list-transaksi', [TransactionController::class, 'listTransaction']);
            Route::group(
                ['prefix' => 'list-transaksi'],
                function () {
                        Route::get('/penjualan', [TransactionController::class, 'listSale']);
                        Route::get('/pembelian', [TransactionController::class, 'listPurchase']);
                    }
            );
            Route::delete('/delete-transaksi/{id}', [TransactionController::class, 'deleteTransaction']);
            Route::put('/update-transaksi/{id}', [TransactionController::class, 'updateTransaction']);

            Route::get('/list-admin', [UserController::class, 'listAdmin']);
            Route::post('/insert-admin', [UserController::class, 'insertAdmin']);
            Route::delete('/delete-admin/{id}', [UserController::class, 'deleteAdmin']);
            Route::put('/update-admin/{id}', [UserController::class, 'updateAdmin']);

            Route::get('/list-pelanggan', [CustomerController::class, 'listCustomer']);
            Route::post('/insert-pelanggan', [CustomerController::class, 'insertCustomer']);
            Route::delete('/delete-pelanggan/{id}', [CustomerController::class, 'deleteCustomer']);
            Route::put('/update-pelanggan/{id}', [CustomerController::class, 'updateCustomer']);

            Route::get('/list-detail-transaksi', [DetailController::class, 'listDetail']);
            Route::delete('/delete-detail-transaksi/{id}', [DetailController::class, 'deleteDetail']);
            Route::put('/update-detail-transaksi/{id}', [DetailController::class, 'updateDetail']);
        }
    );
});