<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

defineOptions({
    layout: {
        breadcrumbs: [
            { title: 'Dashboard', href: '/dashboard' },
            { title: 'Mutasi Stok', href: '/mutasi-stok' },
        ],
    },
});

// Data dummy sementara
const mutasiStok = ref([
    { id: 1, kode_item: 'KOI-001', nama_item: 'Koi Kohaku', jenis_mutasi: 'masuk', jumlah: 10, stok_sebelum: 0, stok_sesudah: 10, keterangan: 'Stok awal', created_at: '2026-06-12' },
    { id: 2, kode_item: 'KOI-001', nama_item: 'Koi Kohaku', jenis_mutasi: 'keluar', jumlah: 2, stok_sebelum: 10, stok_sesudah: 8, keterangan: 'Terjual', created_at: '2026-06-13' },
    { id: 3, kode_item: 'KOI-002', nama_item: 'Koi Showa', jenis_mutasi: 'masuk', jumlah: 8, stok_sebelum: 0, stok_sesudah: 8, keterangan: 'Stok awal', created_at: '2026-06-12' },
    { id: 4, kode_item: 'PKN-001', nama_item: 'Pakan Koi Premium', jenis_mutasi: 'keluar', jumlah: 5, stok_sebelum: 20, stok_sesudah: 15, keterangan: 'Terjual', created_at: '2026-06-14' },
]);
</script>

<template>
    <Head title="Mutasi Stok" />
    <div class="flex flex-col gap-4 p-4">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Mutasi Stok</h1>
        </div>

        <!-- Tabel -->
        <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border bg-white dark:bg-sidebar overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr class="text-left text-muted-foreground">
                        <th class="px-4 py-3 font-medium">Kode Item</th>
                        <th class="px-4 py-3 font-medium">Nama Item</th>
                        <th class="px-4 py-3 font-medium">Jenis</th>
                        <th class="px-4 py-3 font-medium">Jumlah</th>
                        <th class="px-4 py-3 font-medium">Stok Sebelum</th>
                        <th class="px-4 py-3 font-medium">Stok Sesudah</th>
                        <th class="px-4 py-3 font-medium">Keterangan</th>
                        <th class="px-4 py-3 font-medium">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="mutasi in mutasiStok"
                        :key="mutasi.id"
                        class="border-t border-sidebar-border/70 dark:border-sidebar-border hover:bg-gray-50 dark:hover:bg-gray-800"
                    >
                        <td class="px-4 py-3 font-medium">{{ mutasi.kode_item }}</td>
                        <td class="px-4 py-3">{{ mutasi.nama_item }}</td>
                        <td class="px-4 py-3">
                            <span
                                :class="mutasi.jenis_mutasi === 'masuk'
                                    ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300'
                                    : 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300'"
                                class="px-2 py-1 rounded-full text-xs font-medium"
                            >
                                {{ mutasi.jenis_mutasi === 'masuk' ? '↑ Masuk' : '↓ Keluar' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">{{ mutasi.jumlah }}</td>
                        <td class="px-4 py-3">{{ mutasi.stok_sebelum }}</td>
                        <td class="px-4 py-3">{{ mutasi.stok_sesudah }}</td>
                        <td class="px-4 py-3 text-muted-foreground">{{ mutasi.keterangan }}</td>
                        <td class="px-4 py-3">{{ mutasi.created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>