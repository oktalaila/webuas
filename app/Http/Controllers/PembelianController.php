<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PembelianController extends Controller
{
    /**
     * Tampilkan form jumlah beli
     */
    public function create(Item $item)
    {
        return Inertia::render('Pembelian', [
            'item' => $item,
        ]);
    }

    /**
     * Proses submit pembelian
     */
    public function store(Request $request, Item $item)
    {
        $validated = $request->validate([
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        try {
            $transaksi = DB::transaction(function () use ($validated, $item) {

                // Kunci row item dulu sebelum cek stok
                // Ini cegah dua request masuk bersamaan (race condition)
                $item = Item::lockForUpdate()->find($item->id);

                // Validasi stok di dalam transaksi DB, bukan di luar
                if ($validated['qty'] > $item->stok) {
                    throw new \Exception('Stok tidak mencukupi.');
                }

                $subtotal = $item->harga_jual * $validated['qty'];

                $transaksi = Transaksi::create([
                    'nomor_invoice'     => 'INV-' . strtoupper(uniqid()),
                    'user_id'           => Auth::id(),
                    'sumber'            => 'online',
                    'status'            => 'selesai',
                    'total_harga'       => $subtotal,
                    'bayar'             => $subtotal,
                    'kembalian'         => 0,
                    'tanggal_transaksi' => now(),
                ]);

                $transaksi->detailTransaksi()->create([
                    'item_id'   => $item->id,
                    'nama_item' => $item->nama_item,
                    'harga'     => $item->harga_jual,
                    'qty'       => $validated['qty'],
                ]);

                $item->decrement('stok', $validated['qty']);

                return $transaksi;
            });

            return redirect()->route('struk.show', $transaksi)
                ->with('success', "Pembelian berhasil! No. Invoice: {$transaksi->nomor_invoice}");

        } catch (\Exception $e) {
            return back()->withErrors([
                'qty' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Tampilkan struk/invoice 1 transaksi
     */
    public function struk(Transaksi $transaksi)
    {
        // Hanya pemilik transaksi atau admin/pegawai yang boleh lihat
        if ($transaksi->user_id !== Auth::id() && !in_array(Auth::user()->role, ['admin', 'pegawai'])) {
            abort(403, 'Anda tidak berhak melihat struk ini.');
        }

        $transaksi->load('detailTransaksi', 'user');

        return Inertia::render('Struk', [
            'transaksi' => $transaksi,
        ]);
    }

    /**
     * Riwayat pembelian milik user yang login
     */
    public function riwayat()
    {
        $transaksi = Transaksi::where('user_id', Auth::id())
            ->where('sumber', 'online')
            ->with('detailTransaksi')
            ->orderByDesc('id')
            ->get();

        return Inertia::render('PesananSaya', [
            'transaksi' => $transaksi,
        ]);
    }
}