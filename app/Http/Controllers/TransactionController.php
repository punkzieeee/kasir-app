<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    function listTransaction()
    {
        try {
            $query = "select a.id, c.nama as admin_kasir, d.nama as nama_pelanggan, b.id as id_produk, b.nama_produk, b.harga as harga_satuan, a.quantity, a.total_harga from transactions a, products b, admins c, customers d where a.id_produk = b.id and a.id_admin = c.id and a.id_pelanggan = d.id";
            $data = DB::connection('mysql')->select($query);
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e,
                'msg' => $e->getMessage(),
            ]);
        }
        
    }

    function insertTransaction(Request $request)
    {
        try {
            $request->validate([
                'id_admin'=>'required',
                'id_pelanggan'=>'required',
                'id_produk'=>'required',
                'quantity'=>'required|min_digits:1'
            ]);
            
            $harga = DB::connection('mysql')->select("select * from products where id = {$request -> id_produk}");
            $quantity = $request -> quantity;
            
            $data = new Transaction();
            $data -> id_admin = $request -> id_admin;
            $data -> id_pelanggan = $request -> id_pelanggan;
            $data -> id_produk = $request -> id_produk;
            $data -> quantity = $quantity;
            $data -> total_harga = $harga[0]->harga * $request -> quantity;
            $data -> save();

            $data_jual = new Sale();
            $data_jual -> id_produk = $request -> id_produk;
            $data_jual -> id_pelanggan = $request -> id_pelanggan;
            $data_jual -> stok_terjual = $quantity;
            $data_jual -> save();
    
            return response()->json([
                'message' => 'data berhasil dimasukkan',
                'data_transaksi' => $data,
                'data_penjualan' => $data_jual
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e,
                'msg' => $e->getMessage(),
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
                'error' => $e,
                'msg' => $e->getMessage(),
            ]);
        }
        
    }

    function updateTransaction($id, Request $request)
    {
        try {
            $request->validate([
                'id_admin'=>'required',
                'id_pelanggan'=>'required',
                'id_produk'=>'required',
                'quantity'=>'required|min_digits:1'
            ]);
            
            $harga = DB::connection('mysql')->select("select * from products where id = {$request -> id_produk}");
            
            $data = Transaction::find($id);
            $data -> id_admin = $request -> id_admin;
            $data -> id_pelanggan = $request -> id_pelanggan;
            $data -> id_produk = $request -> id_produk;
            $data -> quantity = $request -> quantity;
            $data -> total_harga = $harga[0]->harga * $request -> quantity;
            $data -> save();

            return response()->json([
                'message' => 'data berhasil terupdate',
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e,
                'msg' => $e->getMessage(),
            ]);
        }
    }
}
