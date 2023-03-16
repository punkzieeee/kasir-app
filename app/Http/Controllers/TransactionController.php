<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Product;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    function listTransaction()
    {
        try {
            $data = Transaction::all();
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat mendapatkan daftar transaksi',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }

    function listPurchase()
    {
        try {
            $query = "SELECT a.id, b.nama as admin_kasir, c.nama_supplier, d.id_produk, e.nama_produk, e.harga as harga_satuan, d.quantity, a.total_harga FROM transactions a, admins b, suppliers c, details d, products e WHERE a.id_admin = b.id and a.id_supplier = c.id and a.id = d.id_transaksi and d.id_produk = e.id and a.id_supplier is not null";
            $data = DB::connection('mysql')->select($query);
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat mendapatkan daftar pembelian',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }

    function listSale()
    {
        try {
            $query = "SELECT a.id, b.nama as admin_kasir, c.nama as nama_pelanggan, d.id_produk, e.nama_produk, e.harga as harga_satuan, d.quantity, a.total_harga FROM transactions a, admins b, customers c, details d, products e WHERE a.id_admin = b.id and a.id_pelanggan = c.id and a.id = d.id_transaksi and d.id_produk = e.id and a.id_pelanggan is not null";
            $data = DB::connection('mysql')->select($query);
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat mendapatkan daftar penjualan',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }

    function insertTransaction(Request $request)
    {
        try {
            $request->validate([
                'id_admin'=>'required|min_digits:1',
                'id_pelanggan'=>'min_digits:1|exclude_unless:id_supplier,null',
                'id_supplier'=>'min_digits:1|exclude_unless:id_pelanggan,null',
                'quantity' => 'required|min_digits:1'
            ]);
            
            $produk = DB::connection('mysql')->select("select * from products where id = {$request -> id_produk}");
            $quantity = $request -> quantity;
            $id_pelanggan = $request -> id_pelanggan;
            $id_supplier = $request -> id_supplier;
            $tipe_transaksi = 0;
            
            $data = new Transaction();
            $data -> id_admin = $request -> id_admin;
            $data -> id_pelanggan = $id_pelanggan;
            $data -> id_supplier = $id_supplier;
            $data -> total_harga = $produk[0]->harga * $request -> quantity;
            if (is_null($id_pelanggan)) { // stok masuk - supplier
                $tipe_transaksi = 1;
            } else if (is_null($id_supplier)) { // stok terjual - pelanggan
                $tipe_transaksi = 2;
            } else {
                return response()->json([
                    'message' => 'id_pelanggan atau id_supplier harus diisi'
                ]);
            }
            $data -> tipe_transaksi = $tipe_transaksi;
            $data -> save();

            $detail = new Detail();
            $detail -> id_produk = $request -> id_produk;
            $detail -> quantity = $quantity;
            $detail -> save();

            $update_stok = Product::find($request -> id_produk);
            if ($tipe_transaksi === 1) { // stok masuk - supplier
                $update_stok -> stok = $update_stok->stok + $quantity;
            } else if ($tipe_transaksi === 2) { // stok terjual - pelanggan
                $update_stok -> stok = $update_stok->stok - $quantity;
            } else {
                return response()->json([
                    'message' => 'transaction unknown'
                ]);
            }
            $update_stok -> save();
    
            return response()->json([
                'message' => 'data berhasil dimasukkan',
                // 'data_transaksi' => $data,
                // 'detail_transaksi' => $detail
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat memasukkan data transaksi',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }

    function deleteTransaction($id)
    {
        try {
            $data = Transaction::find($id);
            $data -> delete();

            return response()->json([
                'message' => 'data berhasil terhapus'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat menghapus data transaksi',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
        
    }

    function updateTransaction($id, Request $request)
    {
        try {
            $request->validate([
                'id_admin'=>'required|min_digits:1',
                'id_pelanggan'=>'min_digits:1|exclude_unless:id_supplier,null',
                'id_supplier'=>'min_digits:1|exclude_unless:id_pelanggan,null',
            ]);
            
            $produk = DB::connection('mysql')->select("select * from products where id = {$request -> id_produk}");
            $id_pelanggan = $request -> id_pelanggan;
            $id_supplier = $request -> id_supplier;
            $tipe_transaksi = 0;
            
            $data = Transaction::find($id);
            $data -> id_admin = $request -> id_admin;
            $data -> id_pelanggan = $request -> id_pelanggan;
            $data -> id_supplier = $request -> id_supplier;
            $data -> total_harga = $produk[0]->harga * $request -> quantity;
            if (is_null($id_pelanggan)) { // stok masuk - supplier
                $tipe_transaksi = 1;
            } else if (is_null($id_supplier)) { // stok terjual - pelanggan
                $tipe_transaksi = 2;
            } else {
                return response()->json([
                    'message' => 'id_pelanggan atau id_supplier harus diisi'
                ]);
            }
            $data -> tipe_transaksi = $tipe_transaksi;
            $data -> save();

            return response()->json([
                'message' => 'data berhasil terupdate',
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat memperbarui data transaksi',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }
}
