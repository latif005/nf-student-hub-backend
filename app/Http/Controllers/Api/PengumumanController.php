<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    // 1. Tampilkan Semua Pengumuman (Untuk Dashboard)
    public function index()
    {
        // Ambil data terbaru + nama dosen yang nulis
        $pengumuman = Pengumuman::with('user:id_user,nama_lengkap')
                        ->latest()
                        ->get();
        
        return response()->json($pengumuman);
    }

    // 2. Simpan Pengumuman Baru (Khusus Dosen)
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
        ]);

        $pengumuman = Pengumuman::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'id_user' => $request->user()->id_user, // Ambil ID dari token login
        ]);

        return response()->json([
            'message' => 'Pengumuman berhasil dibuat!',
            'data' => $pengumuman
        ], 201);
    }
}