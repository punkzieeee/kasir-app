<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    function listPurchase()
    {
        try {
            $query = "select a.id, a.id_produk, b.nama_produk, c.nama_supplier, a.stok_masuk from purchases a, products b, suppliers c where a.id_produk = b.id and a.id_supplier = c.id";
            $data = DB::connection('mysql')->select($query);
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    function insertPurchase(Request $request)
    {
        try {
            $request->validate([
                'id_produk'=>'required',
                'id_supplier'=>'required',
                'stok_masuk'=>'required|min_digits:1'
            ]);
            
            $data = new Purchase();
            $data -> id_produk = $request -> id_produk;
            $data -> id_supplier = $request -> id_supplier;
            $data -> stok_masuk = $request -> stok_masuk;
            $data -> save();

            return response()->json([
                'message' => 'data berhasil dimasukkan',
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e,
                'msg' => $e->getMessage(),
            ]);
        }
        
    }

    function deletePurchase($id)
    {
        try {
            $data = Purchase::find($id);
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

    function updatePurchase($id, Request $request)
    {
        try {
            $request->validate([
                'id_produk'=>'required',
                'id_supplier'=>'required',
                'stok_masuk'=>'required|min_digits:1'
            ]);
            
            $data = Purchase::find($id);
            $data -> id_produk = $request -> id_produk;
            $data -> id_supplier = $request -> id_supplier;
            $data -> stok_masuk = $request -> stok_masuk;
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
