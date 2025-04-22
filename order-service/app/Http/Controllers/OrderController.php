<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    // Consumer: Membuat pesanan baru dengan validasi pengguna
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'total_price' => 'required|numeric|min:0',
        ]);

        // Mengambil data pengguna dari UserService
        $response = Http::get('http://localhost:8001/api/users/' . $validated['user_id']);

        if ($response->failed()) {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
        }

        $order = Order::create([
            'user_id' => $validated['user_id'],
            'total_price' => $validated['total_price'],
        ]);

        return response()->json([
            'id' => $order->id,
            'user_id' => $order->user_id,
            'total_price' => $order->total_price,
            'created_at' => $order->created_at,
        ], 201);
    }

    // Provider: Mendapatkan pesanan berdasarkan user_id
    public function getByUser($userId)
    {
        $orders = Order::where('user_id', $userId)->get();

        return response()->json($orders->map(function ($order) {
            return [
                'id' => $order->id,
                'user_id' => $order->user_id,
                'total_price' => $order->total_price,
                'created_at' => $order->created_at,
            ];
        }));
    }
}