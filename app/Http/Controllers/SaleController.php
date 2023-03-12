<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    function listSale()
    {
        try {
            $query = "select a.id, a.id_produk, b.nama_produk, c.nama as nama_pelanggan, a.stok_terjual from sales a, products b, customers c where a.id_produk = b.id and a.id_pelanggan = c.id";
            $data = DB::connection('mysql')->select($query);
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    function deleteSale($id)
    {
        try {
            $data = Sale::find($id);
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

    function updateSale($id, Request $request)
    {
        try {
            $request->validate([
                'id_produk'=>'required',
                'id_pelanggan'=>'required',
                'stok_terjual'=>'required|min_digits:1'
            ]);
            
            $data = Sale::find($id);
            $data -> id_produk = $request -> id_produk;
            $data -> id_pelanggan = $request -> id_pelanggan;
            $data -> stok_terjual = $request -> stok_terjual;
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
