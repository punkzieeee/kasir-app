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
                'error' => $e,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    function insertProduct(Request $request)
    {
        try {
            $request->validate([
                'nama_produk'=>'required',
                'jenis_produk'=>'required',
                'harga'=>'required'
            ]);
            
            $data = new Product();
            $data -> nama_produk = $request -> nama_produk;
            $data -> jenis_produk = $request -> jenis_produk;
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
                'error' => $e,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    function updateProduct($id, Request $request)
    {
        try {
            $request->validate([
                'nama_produk'=>'required',
                'jenis_produk'=>'required',
                'harga'=>'required'
            ]);
            
            $data = Product::find($id);
            $data -> nama_produk = $request -> nama_produk;
            $data -> jenis_produk = $request -> jenis_produk;
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
