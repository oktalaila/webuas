<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { dashboard } from '@/routes';

defineProps<{
    totalStok: number;
    totalTransaksi: number;
    totalJenis: number;
    transaksiTerbaru: Array<{
        id: number;
        nomor_invoice: string;
        total_harga: number;
        created_at: string;
    }>;
}>();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Dashboard" />
    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">

        <!-- Stat Cards -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border bg-white dark:bg-sidebar p-6">
                <p class="text-sm text-muted-foreground">Total Stok Ikan</p>
                <p class="text-3xl font-bold mt-1">{{ totalStok }}</p>
            </div>
            <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border bg-white dark:bg-sidebar p-6">
                <p class="text-sm text-muted-foreground">Total Transaksi</p>
                <p class="text-3xl font-bold mt-1">{{ totalTransaksi }}</p>
            </div>
            <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border bg-white dark:bg-sidebar p-6">
                <p class="text-sm text-muted-foreground">Total Jenis Koi</p>
                <p class="text-3xl font-bold mt-1">{{ totalJenis }}</p>
            </div>
        </div>

        <!-- Tabel Transaksi Terbaru -->
        <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border bg-white dark:bg-sidebar p-6">
            <h2 class="text-lg font-semibold mb-4">Transaksi Terbaru</h2>
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-sidebar-border/70 dark:border-sidebar-border text-left text-muted-foreground">
                        <th class="pb-2 font-medium">Kode Transaksi</th>
                        <th class="pb-2 font-medium">Total Harga</th>
                        <th class="pb-2 font-medium">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="trx in transaksiTerbaru"
                        :key="trx.id"
                        class="border-b border-sidebar-border/70 dark:border-sidebar-border last:border-0"
                    >
                        <td class="py-2">{{ trx.nomor_invoice }}</td>
                        <td class="py-2">Rp {{ Number(trx.total_harga).toLocaleString('id-ID') }}</td>
                        <td class="py-2">{{ new Date(trx.created_at).toLocaleDateString('id-ID') }}</td>
                    </tr>
                    <tr v-if="transaksiTerbaru.length === 0">
                        <td colspan="3" class="py-4 text-center text-muted-foreground">Belum ada transaksi</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>