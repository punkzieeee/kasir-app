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
                'error' => $e,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    function insertCustomer(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required'
            ]);
            
            $data = new Customer();
            $data -> nama = $request -> nama;
            $data -> alamat = $request -> alamat;
            $data -> no_telp = $request -> no_telp;
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
                'error' => $e,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    function updateCustomer($id, Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required'
            ]);
            
            $data = Customer::find($id);
            $data -> nama = $request -> nama;
            $data -> alamat = $request -> alamat;
            $data -> no_telp = $request -> no_telp;
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
