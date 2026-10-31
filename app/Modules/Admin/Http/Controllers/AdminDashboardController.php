<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            ['label' => 'Total Mitra', 'value' => '24', 'note' => '+12 dari bulan lalu'],
            ['label' => 'Makanan Tersedia', 'value' => '168', 'note' => '+8 dari bulan lalu'],
            ['label' => 'Transaksi Hari Ini', 'value' => '86', 'note' => '+18 dari kemarin'],
            ['label' => 'Payout Pending', 'value' => 'Rp 2.500.000', 'note' => '3 pengajuan'],
        ];

        $chart = [
            'labels' => ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            'transaksi' => [5, 22, 40, 48, 55, 62, 90],
            'mitra' => [2, 14, 25, 32, 38, 45, 58],
        ];

        $topFoods = [
            ['name' => 'Roti Sari Roti', 'sold' => 23, 'percent' => 73],
            ['name' => 'Seri Bakery', 'sold' => 20, 'percent' => 18],
            ['name' => 'Donat Kentang', 'sold' => 12, 'percent' => 11],
        ];

        return view('admin::dashboard', compact('stats', 'chart', 'topFoods'));
    }
}