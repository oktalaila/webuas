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
     * Proses submit pembelian — status awal: menunggu_pembayaran
     */
    public function store(Request $request, Item $item)
    {
        $validated = $request->validate([
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        try {
            $transaksi = DB::transaction(function () use ($validated, $item) {

                $item = Item::lockForUpdate()->find($item->id);

                if ($validated['qty'] > $item->stok) {
                    throw new \Exception('Stok tidak mencukupi.');
                }

                $subtotal = $item->harga_jual * $validated['qty'];

                // Nominal unik: tambah angka random 1-999 biar mudah diverifikasi
                $nominal_unik = $subtotal + rand(1, 999);

                $transaksi = Transaksi::create([
                    'nomor_invoice'     => 'INV-' . strtoupper(uniqid()),
                    'user_id'           => Auth::id(),
                    'sumber'            => 'online',
                    'status'            => 'menunggu_pembayaran',
                    'total_harga'       => $nominal_unik,
                    'bayar'             => 0,
                    'kembalian'         => 0,
                    'tanggal_transaksi' => now(),
                ]);

                $transaksi->detailTransaksi()->create([
                    'item_id'   => $item->id,
                    'nama_item' => $item->nama_item,
                    'harga'     => $item->harga_jual,
                    'qty'       => $validated['qty'],
                ]);

                // Stok BELUM dikurangi — dikurangi setelah pembayaran dikonfirmasi

                return $transaksi;
            });

            return redirect()->route('pembayaran.show', $transaksi->id)
                ->with('success', "Pesanan dibuat! Silakan selesaikan pembayaran.");

        } catch (\Exception $e) {
            return back()->withErrors([
                'qty' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Halaman instruksi pembayaran
     */
    public function pembayaran(Transaksi $transaksi)
    {
        if ($transaksi->user_id !== Auth::id()) {
            abort(403);
        }

        $transaksi->load('detailTransaksi');

        return Inertia::render('Pembayaran', [
            'transaksi' => $transaksi,
        ]);
    }

    /**
     * Konfirmasi "Saya Sudah Transfer" — potong stok & ubah status
     */
    public function konfirmasiTransfer(Transaksi $transaksi)
    {
        if ($transaksi->user_id !== Auth::id()) {
            abort(403);
        }

        if ($transaksi->status !== 'menunggu_pembayaran') {
            return back()->withErrors(['error' => 'Transaksi ini sudah diproses.']);
        }

        DB::transaction(function () use ($transaksi) {
            $transaksi->load('detailTransaksi');

            // Potong stok setelah konfirmasi transfer
            foreach ($transaksi->detailTransaksi as $detail) {
                $item = Item::lockForUpdate()->find($detail->item_id);
                if ($item) {
                    if ($item->stok < $detail->qty) {
                        throw new \Exception("Stok {$item->nama_item} tidak mencukupi saat konfirmasi.");
                    }
                    $item->decrement('stok', $detail->qty);
                }
            }

            $transaksi->update([
                'status' => 'menunggu_konfirmasi',
                'bayar'  => $transaksi->total_harga,
            ]);
        });

        return redirect()->route('pesanan.index')
            ->with('success', 'Konfirmasi transfer berhasil! Pesanan sedang diverifikasi admin.');
    }

    /**
     * Tampilkan struk/invoice
     */
    public function struk(Transaksi $transaksi)
    {
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