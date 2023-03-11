<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function listAdmin()
    {
        try {
            $data = Admin::all();
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    function insertAdmin(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required'
            ]);
            
            $data = new Admin();
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

    function deleteAdmin($id)
    {
        try {
            $data = Admin::find($id);
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

    function updateAdmin($id, Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required'
            ]);
            
            $data = Admin::find($id);
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
