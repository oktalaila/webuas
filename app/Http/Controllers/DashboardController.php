<?php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaksi;
use App\Models\KodeItem;
use Inertia\Inertia;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $transaksiSukses = Transaksi::whereIn('status', ['selesai', 'menunggu_konfirmasi']);

        return Inertia::render('Dashboard', [
            'totalStok'          => Item::sum('stok'),
            'totalTransaksi'     => $transaksiSukses->count(),
            'totalPendapatan'    => $transaksiSukses->sum('total_harga'),
            'totalJenis'         => KodeItem::count(),
            'transaksiTerbaru'   => $transaksiSukses->latest()->take(5)->get(),

            'pendapatanHariIni'  => Transaksi::where('status', 'selesai')
                                        ->whereDate('tanggal_transaksi', Carbon::today())
                                        ->sum('total_harga'),

            'pendapatanBulanIni' => Transaksi::where('status', 'selesai')
                                        ->whereMonth('tanggal_transaksi', Carbon::now()->month)
                                        ->whereYear('tanggal_transaksi', Carbon::now()->year)
                                        ->sum('total_harga'),
        ]);
    }
}