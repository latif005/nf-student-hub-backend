<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    // 1. GET: Ambil Semua Jadwal (Untuk Mahasiswa)
    public function index()
    {
        $jadwal = Jadwal::all();
        return response()->json($jadwal);
    }

    // 2. POST: Tambah Jadwal (Untuk Dosen)
    public function store(Request $request)
    {
        $request->validate([
            'kode_matkul' => 'required',
            'nama_matkul' => 'required',
            'hari' => 'required',
            'jam' => 'required',
            'ruangan' => 'required',
            'dosen_pengampu' => 'required',
        ]);

        $jadwal = Jadwal::create($request->all());

        return response()->json([
            'message' => 'Jadwal berhasil ditambahkan!',
            'data' => $jadwal
        ], 201);
    }
}