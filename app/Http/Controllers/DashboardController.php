<?php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaksi;
use App\Models\KodeItem;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'totalStok' => Item::sum('stok'),
            'totalTransaksi' => Transaksi::count(),
            'totalJenis' => KodeItem::count(),
            'transaksiTerbaru' => Transaksi::latest()->take(5)->get(),
        ]);
    }
}