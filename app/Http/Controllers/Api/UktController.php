<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ukt;

class UktController extends Controller
{
    // ADMIN: Lihat Semua Data
    public function all()
    {
        // Mengambil data UKT beserta nama User-nya
        $data = Ukt::with('user')->latest()->get();
        return response()->json($data);
    }

    // ADMIN: Update Status
    public function updateStatus($id, Request $request)
    {
        $ukt = Ukt::find($id);
        if (!$ukt) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        $ukt->update(['status' => $request->status]);

        return response()->json(['message' => 'Status berhasil diperbarui']);
    }

    // MAHASISWA: Lihat Data Sendiri
    public function index(Request $request)
    {
        $id_user = $request->user()->id_user;
        $data = Ukt::where('id_user', $id_user)->latest()->get();
        return response()->json($data);
    }

    // TESTING: Buat Data Tagihan Baru
    public function store(Request $request)
    {
        $ukt = Ukt::create($request->all());
        return response()->json($ukt, 201);
    }
}