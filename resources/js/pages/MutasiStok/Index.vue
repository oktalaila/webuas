<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

defineOptions({
    layout: {
        breadcrumbs: [
            { title: 'Dashboard', href: '/dashboard' },
            { title: 'Mutasi Stok', href: '/mutasi-stok' },
        ],
    },
});

const props = defineProps({
    mutasiStok: Array,
});

const filterJenis = ref('semua');

const filtered = computed(() => {
    if (filterJenis.value === 'semua') return props.mutasiStok;
    return props.mutasiStok?.filter((m: any) => m.jenis_mutasi === filterJenis.value);
});
</script>

<template>
    <Head title="Mutasi Stok" />
    <div class="flex flex-col gap-5 p-6" style="font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 style="font-size: 1.5rem; font-weight: 700; color: #0b1c30;">Mutasi Stok</h1>
                <p style="font-size: 0.85rem; color: #3f484a; margin-top: 2px;">Riwayat perubahan stok masuk dan keluar</p>
            </div>
            <select
                v-model="filterJenis"
                style="border: 1px solid #bfc8c9; border-radius: 8px; padding: 8px 14px; font-size: 0.875rem; color: #0b1c30; outline: none; background: #fff; cursor: pointer;"
            >
                <option value="semua">Semua Jenis</option>
                <option value="masuk">↑ Masuk</option>
                <option value="keluar">↓ Keluar</option>
            </select>
        </div>

        <!-- Tabel -->
        <div style="background: #fff; border: 1px solid #bfc8c9; border-radius: 12px; overflow: hidden;">
            <table class="w-full" style="font-size: 0.875rem; border-collapse: collapse;">
                <thead>
                    <tr style="background: #eff4ff;">
                        <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #3f484a; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.04em;">Kode Item</th>
                        <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #3f484a; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.04em;">Nama Item</th>
                        <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #3f484a; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.04em;">Jenis</th>
                        <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #3f484a; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.04em;">Jumlah</th>
                        <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #3f484a; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.04em;">Stok Sebelum</th>
                        <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #3f484a; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.04em;">Stok Sesudah</th>
                        <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #3f484a; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.04em;">Keterangan</th>
                        <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #3f484a; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.04em;">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="mutasi in filtered"
                        :key="mutasi.id"
                        style="border-top: 1px solid #e5eeff; transition: background 0.15s;"
                        class="hover:bg-[#f8f9ff]"
                    >
                        <td style="padding: 12px 16px;">
                            <span style="background: #dce9ff; color: #004349; padding: 3px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; font-family: monospace;">
                                {{ mutasi.kode_item }}
                            </span>
                        </td>
                        <td style="padding: 12px 16px; font-weight: 600; color: #0b1c30;">{{ mutasi.nama_item }}</td>
                        <td style="padding: 12px 16px;">
                            <span
                                :style="mutasi.jenis_mutasi === 'masuk'
                                    ? 'background: #dce9ff; color: #004349;'
                                    : 'background: #ffdad6; color: #ba1a1a;'"
                                style="padding: 3px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;"
                            >
                                {{ mutasi.jenis_mutasi === 'masuk' ? '↑ Masuk' : '↓ Keluar' }}
                            </span>
                        </td>
                        <td style="padding: 12px 16px; font-weight: 700; color: #0b1c30;">{{ mutasi.jumlah }}</td>
                        <td style="padding: 12px 16px; color: #3f484a;">{{ mutasi.stok_sebelum }}</td>
                        <td style="padding: 12px 16px; color: #3f484a;">{{ mutasi.stok_sesudah }}</td>
                        <td style="padding: 12px 16px; color: #90a4b4; font-size: 0.8rem;">{{ mutasi.keterangan }}</td>
                        <td style="padding: 12px 16px; color: #3f484a; font-size: 0.8rem;">
                            {{ new Date(mutasi.created_at).toLocaleDateString('id-ID') }}
                        </td>
                    </tr>
                    <tr v-if="!filtered || filtered.length === 0">
                        <td colspan="8" style="padding: 40px; text-align: center; color: #90a4b4;">
                            Tidak ada data mutasi stok.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>