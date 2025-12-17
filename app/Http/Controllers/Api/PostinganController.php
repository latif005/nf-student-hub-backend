<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Postingan;
use Illuminate\Support\Facades\Storage;

class PostinganController extends Controller
{
    // 1. GET: Ambil Semua Postingan (Timeline)
    public function index(Request $request)
    {
        // Ambil User ID yang sedang login
        $currentUserId = $request->user()->id_user;

        $posts = Postingan::with('user:id_user,nama_lengkap') // Ambil data penulis
                    ->withCount('komentars') // <--- HITUNG JUMLAH KOMENTAR OTOMATIS
                    ->latest()
                    ->get();

        // Cek manual: Apakah user ini sudah like postingan tersebut?
        $posts->map(function ($post) use ($currentUserId) {
            // Cek apakah ada data di tabel likes yang cocok dengan user ini
            $post->is_liked = $post->likes()->where('id_user', $currentUserId)->exists();
            
            // Format URL gambar
            if ($post->image) {
                $post->image_url = url('storage/' . $post->image);
            }
            return $post;
        });

        return response()->json($posts);
    }

    // 2. POST: Buat Status Baru
    public function store(Request $request)
    {
        // Validasi Sesuai SRS: Teks min 1 char, Media max 10MB (10240 KB)
        $request->validate([
            'konten' => 'required|min:1', 
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240' 
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan gambar ke folder 'public/posts'
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $post = Postingan::create([
            'id_user' => $request->user()->id_user,
            'konten'  => $request->konten,
            'image'   => $imagePath
        ]);

        return response()->json([
            'message' => 'Status berhasil diposting!',
            'data' => $post
        ], 201);
    }
}