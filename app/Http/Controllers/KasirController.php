<?php

namespace App\Http\Controllers;

use App\Models\Kasir;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    function listKasir()
    {
        try {
            $query = "select a.id, b.id as id_barang, b.nama_barang, b.harga as harga_satuan, a.quantity, a.total_harga from kasirs a, barangs b where a.id_barang = b.id";
            $data = DB::connection('mysql')->select($query);
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e,
                'msg' => $e->getMessage(),
            ]);
        }
        
    }

    function insertKasir(Request $request)
    {
        try {
            $request->validate([
                'id_barang'=>'required',
                'quantity'=>'required|min_digits:1'
            ]);
            
            $harga = DB::connection('mysql')->select("select* from barangs where id = {$request -> id_barang}");
            
            $data = new Kasir();
            $data -> id_barang = $request -> id_barang;
            $data -> quantity = $request -> quantity;
            $data -> total_harga = $harga[0]->harga * $request -> quantity;
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

    function deleteKasir($id)
    {
        try {
            $data = Kasir::find($id);
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

    function updateKasir($id, Request $request)
    {
        try {
            $request->validate([
                'id_barang'=>'required',
                'quantity'=>'required|min_digits:1'
            ]);
            
            $harga = DB::connection('mysql')->select("select* from barangs where id = {$request -> id_barang}");
            
            $data = Kasir::find($id);
            $data -> id_barang = $request -> id_barang;
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
