<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    transaksi: {
        id: number
        nomor_invoice: string
        total_harga: number
        bayar: number
        kembalian: number
        tanggal_transaksi: string
        status: string
        user: {
            id: number
            nama: string
            username: string
        }
        detail_transaksi: Array<{
            id: number
            nama_item: string
            harga: number
            qty: number
        }>;
    };
}>();
</script>

<template>
    <Head title="Struk Pembelian" />

    <div class="min-h-screen bg-gray-50 flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md bg-white border border-gray-200 rounded-2xl p-8">
            <div class="text-center mb-6">
                <div class="text-5xl mb-2">✅</div>
                <h1 class="text-xl font-bold">Pembelian Berhasil!</h1>
                <p class="text-gray-500 text-sm">{{ transaksi.nomor_invoice }}</p>
            </div>

            <div class="border-t border-b border-dashed border-gray-300 py-4 my-4">
                <div v-for="d in transaksi.detail_transaksi" :key="d.nama_item" class="flex justify-between text-sm mb-2">
                    <span>{{ d.nama_item }} x{{ d.qty }}</span>
                    <span>Rp {{ Number(d.subtotal).toLocaleString('id-ID') }}</span>
                </div>
            </div>

            <div class="flex justify-between font-bold text-lg mb-6">
                <span>Total</span>
                <span>Rp {{ Number(transaksi.total_harga).toLocaleString('id-ID') }}</span>
            </div>

            <div class="flex flex-col gap-2">
                <Link href="/pesanan-saya" class="bg-black text-white text-center py-2 rounded-lg text-sm font-bold">
                    Lihat Pesanan Saya
                </Link>
                <Link href="/" class="border border-gray-300 text-center py-2 rounded-lg text-sm font-bold">
                    Kembali ke Katalog
                </Link>
            </div>
        </div>
    </div>
</template>