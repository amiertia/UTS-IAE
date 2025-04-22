<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    // Provider: Mendapatkan data pengguna berdasarkan ID
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
        }

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    // Consumer: Mendapatkan riwayat pesanan dari OrderService
    public function orders($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
        }

        // Mengambil data pesanan dari OrderService
        $response = Http::get('http://localhost:8002/api/orders/user/' . $id);

        if ($response->failed()) {
            return response()->json(['message' => 'Gagal mengambil riwayat pesanan'], 500);
        }

        return response()->json($response->json());
    }
}