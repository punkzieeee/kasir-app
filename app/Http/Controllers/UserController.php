<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Str;

class UserController extends Controller
{
    function listAdmin()
    {
        try {
            $data = User::all();
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat mendapatkan daftar admin',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }

    function insertAdmin(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'level' => 'required',
                'password' => 'required|min:8|max:12'
            ]);
            
            $data = new User();
            $data -> name = $request -> name;
            $data -> email = $request -> email;
            $data -> level = $request -> level;
            $data -> password = Hash::make($request -> password);
            $data -> remember_token = Str::random(10);
            $data -> save();

            return response()->json([
                'message' => 'data berhasil dimasukkan',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat memasukkan data admin',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
        
    }

    function deleteAdmin($id)
    {
        try {
            $data = User::find($id);
            $data -> delete();

            return response()->json([
                'message' => 'data berhasil terhapus'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat menghapus data admin',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }

    function updateAdmin($id, Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'level' => 'required',
                'password' => 'required|min:8|max:12'
            ]);
            
            $data = User::find($id);
            $data -> name = $request -> name;
            $data -> email = $request -> email;
            $data -> level = $request -> level;
            $data -> password = Hash::make($request -> password);
            $data -> save();
    
            return response()->json([
                'message' => 'data berhasil terupdate',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'tidak dapat memperbarui data admin',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }
}
