<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    function listSupplier()
    {
        try {
            $query = "select a.id, b.nama_produk, a.nama_supplier, a.alamat, a.no_telp from suppliers a, products b where a.id_produk = b.id";
            $data = DB::connection('mysql')->select($query);
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat mendapatkan daftar supplier',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }

    function insertSupplier(Request $request)
    {
        try {
            $request->validate([
                'id_produk' => 'required|min_digits:1',
                'nama_supplier' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
                'id_admin' => 'required|min_digits:1'
            ]);
            
            $data = new Supplier();
            $data -> id_produk = $request -> id_produk;
            $data -> nama_supplier = $request -> nama_supplier;
            $data -> alamat = $request -> alamat;
            $data -> no_telp = $request -> no_telp;
            $data -> id_admin = $request -> id_admin;
            $data -> save();

            return response()->json([
                'message' => 'data berhasil dimasukkan',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat memasukkan data supplier',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
        
    }

    function deleteSupplier($id)
    {
        try {
            $data = Supplier::find($id);
            $data -> delete();

            return response()->json([
                'message' => 'data berhasil terhapus'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat menghapus data supplier',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }

    function updateSupplier($id, Request $request)
    {
        try {
            $request->validate([
                'id_produk' => 'required|min_digits:1',
                'nama_supplier' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
                'id_admin' => 'required|min_digits:1'
            ]);
            
            $data = Supplier::find($id);
            $data -> id_produk = $request -> id_produk;
            $data -> nama_supplier = $request -> nama_supplier;
            $data -> alamat = $request -> alamat;
            $data -> no_telp = $request -> no_telp;
            $data -> id_admin = $request -> id_admin;
            $data -> save();
    
            return response()->json([
                'message' => 'data berhasil terupdate'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat memperbarui data supplier',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }
}
