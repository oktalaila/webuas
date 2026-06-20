<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Item;

class HomeController extends Controller
{
    /**
     * Menampilkan katalog ikan koi di halaman depan (Welcome).
     */
    public function index()
    {
        // 1. Ambil data ikan dari database (hanya yang stoknya masih ada / lebih dari 0)
        $ikanKoi = Item::where('stok', '>', 0)->get();

        // 2. Kirim data ikan tersebut menyeberang jembatan ke file Welcome.vue
        return Inertia::render('Katalog', [
           'katalogIkan' => $ikanKoi
        ]);
    }
}