<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function login(Request $request)
    {
        try {
            $credentials = $request->only(['email', 'password']);

            if (Auth::attempt($credentials)) {
                $token = $request->user()->createToken('auth_token')->plainTextToken;
                return response()->json($token);
            } else {
                return response()->json(['error' => 'invalid credentials'], 401);
            }
            
        } catch (Exception $e) {
            return response()->json([
                'message' => 'login error',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }

    function logout(Request $request)
    {
        try {
            
        } catch (Exception $e) {
            return response()->json([
                'message' => 'logout error',
                'error' => $e,
                // 'msg' => $e->getMessage(),
            ]);
        }
    }

    // function getAdmin(Request $request)
    // {
    //     try {
    //         $data = User::all();
    //         return response()->json($data);
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'message' => 'login error',
    //             'error' => $e,
    //             // 'msg' => $e->getMessage(),
    //         ]);
    //     }
    // }
}
