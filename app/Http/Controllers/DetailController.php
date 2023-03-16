<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{
    function listDetail()
    {
        try {
            $query = "select a.id_transaksi, a.id_produk, b.nama_produk, a.quantity from details a, products b where a.id_produk = b.id";
            $data = DB::connection('mysql')->select($query);
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat mendapatkan daftar detail transaksi',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }

    function deleteDetail($id)
    {
        try {
            $data = Detail::find($id);
            $data -> delete();

            return response()->json([
                'message' => 'data berhasil terhapus'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat menghapus data detail transaksi',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
        
    }

    function updateDetail($id, Request $request)
    {
        try {
            $request->validate([
                'id_produk'=>'required',
                'quantity'=>'required|min_digits:1'
            ]);
            
            $data = Detail::find($id);
            $data -> id_produk = $request -> id_produk;
            $data -> quantity = $request -> quantity;
            $data -> save();
    
            return response()->json([
                'message' => 'data berhasil terupdate',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat memperbarui data detail transaksi',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }
}
