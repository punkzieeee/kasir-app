<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function listCustomer()
    {
        try {
            $data = Customer::all();
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat mendapatkan daftar pelanggan',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }

    function insertCustomer(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
                'loyalty_level' => 'required',
                'id_admin' => 'required|min_digits:1'
            ]);
            
            $data = new Customer();
            $data -> nama = $request -> nama;
            $data -> alamat = $request -> alamat;
            $data -> no_telp = $request -> no_telp;
            $data -> loyalty_level = $request -> loyalty_level;
            $data -> id_admin = $request -> id_admin;
            $data -> save();

            return response()->json([
                'message' => 'data berhasil dimasukkan',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat memasukkan data pelanggan',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
        
    }

    function deleteCustomer($id)
    {
        try {
            $data = Customer::find($id);
            $data -> delete();

            return response()->json([
                'message' => 'data berhasil terhapus'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat menghapus data pelanggan',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }

    function updateCustomer($id, Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
                'loyalty_level' => 'required',
                'id_admin' => 'required|min_digits:1'
            ]);
            
            $data = Customer::find($id);
            $data -> nama = $request -> nama;
            $data -> alamat = $request -> alamat;
            $data -> no_telp = $request -> no_telp;
            $data -> loyalty_level = $request -> loyalty_level;
            $data -> id_admin = $request -> id_admin;
            $data -> save();
    
            return response()->json([
                'message' => 'data berhasil terupdate',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat memperbarui data pelanggan',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }
}
