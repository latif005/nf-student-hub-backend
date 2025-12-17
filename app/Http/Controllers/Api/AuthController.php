<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // LOGIN
    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Login gagal'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login sukses',
            'token' => $token,
            'role' => $user->role, // Penting buat Frontend
            'data' => $user
        ]);
    }

    // REGISTER
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'password' => 'required|min:3',
            'nama_lengkap' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:Mahasiswa,Dosen,Admin Keuangan'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'username'     => $request->username,
            'password'     => Hash::make($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'role'         => $request->role,
        ]);

        return response()->json(['message' => 'Registrasi Berhasil', 'data' => $user], 201);
    }


    // TAMBAHAN: Update Profil (NIM & Prodi)
    public function updateProfile(Request $request)
    {
        $user = $request->user(); // Ambil user yang sedang login via token
        
        $user->update([
            'nim' => $request->nim,
            'prodi' => $request->prodi,
        ]);

        return response()->json([
            'message' => 'Profil berhasil diupdate',
            'data' => $user
        ]);
    }
}