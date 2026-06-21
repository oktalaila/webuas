<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    transaksi: Array<{
        id: number;
        nomor_invoice: string;
        total_harga: number;
        tanggal_transaksi: string;
        status: string;
        detail_transaksi: Array<{
            id: number;
            nama_item: string;
            harga: number;
            qty: number;
        }>;
    }>;
}>();
</script>

<template>
    <Head title="Pesanan Saya" />

    <div class="min-h-screen bg-white px-6 py-10">
        <div class="max-w-2xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold">Pesanan Saya</h1>
                <Link href="/" class="text-sm text-gray-500 hover:text-black">← Kembali ke Katalog</Link>
            </div>

            <div v-if="transaksi.length === 0" class="text-center text-gray-400 py-12">
                Belum ada pesanan.
            </div>

            <div v-for="trx in transaksi" :key="trx.id" class="border border-gray-200 rounded-xl p-4 mb-3 flex justify-between items-center">
                <div>
                    <p class="font-bold">{{ trx.nomor_invoice }}</p>
                    <p class="text-xs text-gray-500">{{ new Date(trx.tanggal_transaksi).toLocaleDateString('id-ID') }}</p>
                </div>
                <div class="text-right">
                    <p class="font-bold text-green-600">Rp {{ Number(trx.total_harga).toLocaleString('id-ID') }}</p>
                    <span class="text-xs px-2 py-1 bg-green-50 text-green-700 rounded-full">{{ trx.status }}</span>
                </div>
                <Link :href="`/struk/${trx.id}`" class="text-sm font-bold underline">Lihat Struk</Link>
            </div>
        </div>
    </div>
</template>