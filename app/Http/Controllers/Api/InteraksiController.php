<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Like;      // <--- INI YANG TADI HILANG
use App\Models\Komentar;  // <--- INI JUGA PENTING
use App\Models\Postingan;

class InteraksiController extends Controller
{
    // === FITUR LIKE (FR-004) ===
    public function toggleLike($id_post, Request $request)
    {
        $id_user = $request->user()->id_user;
        
        $existingLike = Like::where('postingan_id', $id_post)
                            ->where('id_user', $id_user)
                            ->first();

        if ($existingLike) {
            $existingLike->delete();
            $status = false; // Jadi gak like (Abu-abu)
            $increment = -1;
        } else {
            Like::create([
                'postingan_id' => $id_post,
                'id_user' => $id_user
            ]);
            $status = true; // Jadi like (Merah)
            $increment = 1;
        }

        $post = Postingan::find($id_post);
        $post->increment('likes_count', $increment);

        // Kembalikan status 'liked': true/false ke frontend
        return response()->json([
            'liked' => $status, 
            'total_likes' => $post->likes_count
        ]);
    }

    // === FITUR KOMENTAR (FR-004) ===
    public function kirimKomentar($id_post, Request $request)
    {
        $request->validate(['isi_komentar' => 'required']);

        $komentar = Komentar::create([
            'postingan_id' => $id_post,
            'id_user' => $request->user()->id_user,
            'isi_komentar' => $request->isi_komentar
        ]);

        // Return data komentar lengkap dengan nama user
        $komentar->load('user:id_user,nama_lengkap');

        return response()->json($komentar, 201);
    }
    
    // Ambil daftar komentar per postingan
    public function getKomentar($id_post)
    {
        $komentar = Komentar::with('user:id_user,nama_lengkap')
                    ->where('postingan_id', $id_post)
                    ->latest()
                    ->get();
        return response()->json($komentar);
    }
}