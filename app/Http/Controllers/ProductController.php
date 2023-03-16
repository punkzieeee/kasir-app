<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function listProduct()
    {
        try {
            $data = Product::all();
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat mendapatkan daftar produk',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }

    function insertProduct(Request $request)
    {
        try {
            $request->validate([
                'nama_produk'=>'required',
                'jenis_produk'=>'required',
                'harga'=>'required|min_digits:500',
                'stok' => 'required|min_digits:1',
                'id_admin' => 'required|min_digits:1'
            ]);
            
            $data = new Product();
            $data -> nama_produk = $request -> nama_produk;
            $data -> jenis_produk = $request -> jenis_produk;
            $data -> harga = $request -> harga;
            $data -> stok = $request -> stok;
            $data -> id_admin = $request -> id_admin;
            $data -> save();

            return response()->json([
                'message' => 'data berhasil dimasukkan',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat memasukkan data produk',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
        
    }

    function deleteProduct($id)
    {
        try {
            $data = Product::find($id);
            $data -> delete();

            return response()->json([
                'message' => 'data berhasil terhapus'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat menghapus data produk',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }

    function updateProduct($id, Request $request)
    {
        try {
            $request->validate([
                'nama_produk'=>'required',
                'jenis_produk'=>'required',
                'harga'=>'required|min_digits:500',
                'stok' => 'required|min_digits:1',
                'id_admin' => 'required|min_digits:1'
            ]);
            
            $data = Product::find($id);
            $data -> nama_produk = $request -> nama_produk;
            $data -> jenis_produk = $request -> jenis_produk;
            $data -> harga = $request -> harga;
            $data -> stok = $request -> stok;
            $data -> id_admin = $request -> id_admin;
            $data -> save();
    
            return response()->json([
                'message' => 'data berhasil terupdate',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat memperbarui data produk',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }
}
