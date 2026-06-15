<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

defineOptions({
    layout: {
        breadcrumbs: [
            { title: 'Dashboard', href: '/dashboard' },
            { title: 'Kode Items', href: '/kode-items' },
        ],
    },
});

const kodeItems = ref([
    { id: 1, kode: 'KOI', nama_jenis: 'Ikan Koi', deskripsi: 'Berbagai jenis ikan koi' },
    { id: 2, kode: 'PKN', nama_jenis: 'Pakan', deskripsi: 'Pakan ikan koi' },
    { id: 3, kode: 'ACC', nama_jenis: 'Aksesoris', deskripsi: 'Aksesoris kolam koi' },
    { id: 4, kode: 'OBT', nama_jenis: 'Obat', deskripsi: 'Obat dan vitamin koi' },
]);

// Modal state
const showModal = ref(false);
const isEdit = ref(false);
const showDeleteConfirm = ref(false);
const selectedId = ref<number | null>(null);

const form = ref({ id: 0, kode: '', nama_jenis: '', deskripsi: '' });

function openTambah() {
    isEdit.value = false;
    form.value = { id: 0, kode: '', nama_jenis: '', deskripsi: '' };
    showModal.value = true;
}

function openEdit(item: any) {
    isEdit.value = true;
    form.value = { ...item };
    showModal.value = true;
}

function simpan() {
    if (isEdit.value) {
        const index = kodeItems.value.findIndex(i => i.id === form.value.id);
        if (index !== -1) kodeItems.value[index] = { ...form.value };
    } else {
        kodeItems.value.push({ ...form.value, id: Date.now() });
    }
    showModal.value = false;
}

function konfirmasiHapus(id: number) {
    selectedId.value = id;
    showDeleteConfirm.value = true;
}

function hapus() {
    kodeItems.value = kodeItems.value.filter(i => i.id !== selectedId.value);
    showDeleteConfirm.value = false;
}
</script>

<template>
    <Head title="Kode Items" />
    <div class="flex flex-col gap-4 p-4">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Kode Items</h1>
            <button @click="openTambah" class="bg-black text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-800">
                + Tambah Kode
            </button>
        </div>

        <!-- Tabel -->
        <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border bg-white dark:bg-sidebar overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr class="text-left text-muted-foreground">
                        <th class="px-4 py-3 font-medium">No</th>
                        <th class="px-4 py-3 font-medium">Kode</th>
                        <th class="px-4 py-3 font-medium">Nama Jenis</th>
                        <th class="px-4 py-3 font-medium">Deskripsi</th>
                        <th class="px-4 py-3 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(item, index) in kodeItems"
                        :key="item.id"
                        class="border-t border-sidebar-border/70 dark:border-sidebar-border hover:bg-gray-50 dark:hover:bg-gray-800"
                    >
                        <td class="px-4 py-3 text-muted-foreground">{{ index + 1 }}</td>
                        <td class="px-4 py-3 font-medium">{{ item.kode }}</td>
                        <td class="px-4 py-3">{{ item.nama_jenis }}</td>
                        <td class="px-4 py-3 text-muted-foreground">{{ item.deskripsi }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <button @click="openEdit(item)" class="text-blue-600 hover:underline text-xs">Edit</button>
                                <button @click="konfirmasiHapus(item.id)" class="text-red-600 hover:underline text-xs">Hapus</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal Tambah/Edit -->
        <div v-if="showModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-sidebar rounded-xl p-6 w-full max-w-md shadow-xl">
                <h2 class="text-lg font-bold mb-4">{{ isEdit ? 'Edit Kode Item' : 'Tambah Kode Item' }}</h2>
                <div class="flex flex-col gap-3">
                    <div>
                        <label class="text-sm font-medium">Kode</label>
                        <input v-model="form.kode" class="w-full mt-1 border rounded-lg px-3 py-2 text-sm" placeholder="Contoh: KOI" />
                    </div>
                    <div>
                        <label class="text-sm font-medium">Nama Jenis</label>
                        <input v-model="form.nama_jenis" class="w-full mt-1 border rounded-lg px-3 py-2 text-sm" placeholder="Contoh: Ikan Koi" />
                    </div>
                    <div>
                        <label class="text-sm font-medium">Deskripsi</label>
                        <textarea v-model="form.deskripsi" class="w-full mt-1 border rounded-lg px-3 py-2 text-sm" rows="3" placeholder="Deskripsi singkat"></textarea>
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-4">
                    <button @click="showModal = false" class="px-4 py-2 text-sm rounded-lg border hover:bg-gray-50">Batal</button>
                    <button @click="simpan" class="px-4 py-2 text-sm rounded-lg bg-black text-white hover:bg-gray-800">Simpan</button>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi Hapus -->
        <div v-if="showDeleteConfirm" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-sidebar rounded-xl p-6 w-full max-w-sm