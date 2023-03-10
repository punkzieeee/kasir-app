<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Exception;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    function listBarang()
    {
        try {
            $data = Barang::all();
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    function insertBarang(Request $request)
    {
        try {
            $request->validate([
                'nama_barang'=>'required',
                'harga'=>'required'
            ]);
            
            $data = new Barang();
            $data -> nama_barang = $request -> nama_barang;
            $data -> harga = $request -> harga;
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

    function deleteBarang($id)
    {
        try {
            $data = Barang::find($id);
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

    function updateBarang($id, Request $request)
    {
        try {
            $request->validate([
                'nama_barang'=>'required',
                'harga'=>'required'
            ]);
            
            $data = Barang::find($id);
            $data -> nama_barang = $request -> nama_barang;
            $data -> harga = $request -> harga;
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
