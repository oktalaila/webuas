<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';

defineOptions({
    layout: {
        breadcrumbs: [
            { title: 'Dashboard', href: '/dashboard' },
            { title: 'Kode Items', href: '/kode-items' },
        ],
    },
});

defineProps({
    kodeItems: Array
});

const showModal = ref(false);
const isEdit = ref(false);
const showDeleteConfirm = ref(false);
const selectedId = ref<number | null>(null);

const form = ref({ id: 0, kode_prefix: '', nama_kode: '' });

function openTambah() {
    isEdit.value = false;
    form.value = { id: 0, kode_prefix: '', nama_kode: '' };
    showModal.value = true;
}

function openEdit(item: any) {
    isEdit.value = true;
    form.value = { ...item };
    showModal.value = true;
}

function simpan() {
    if (isEdit.value) {
        router.put(`/kode-items/${form.value.id}`, form.value, {
            onSuccess: () => { showModal.value = false; }
        });
    } else {
        router.post('/kode-items', form.value, {
            onSuccess: () => { showModal.value = false; }
        });
    }
}

function konfirmasiHapus(id: number) {
    selectedId.value = id;
    showDeleteConfirm.value = true;
}

function hapus() {
    if (selectedId.value) {
        router.delete(`/kode-items/${selectedId.value}`, {
            onSuccess: () => { showDeleteConfirm.value = false; }
        });
    }
}
</script>

<template>
    <Head title="Kode Items" />
    <div class="flex flex-col gap-5 p-6" style="font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 style="font-size: 1.5rem; font-weight: 700; color: #0b1c30;">Kode Items</h1>
                <p style="font-size: 0.85rem; color: #3f484a; margin-top: 2px;">Kelola kategori dan kode ikan koi</p>
            </div>
            <button
                @click="openTambah"
                style="background: #004349; color: #fff; padding: 9px 18px; border-radius: 8px; font-size: 0.875rem; font-weight: 600; border: none; cursor: pointer;"
                class="hover:opacity-90 transition-opacity"
            >
                + Tambah Kode
            </button>
        </div>

        <!-- Tabel -->
        <div style="background: #fff; border: 1px solid #bfc8c9; border-radius: 12px; overflow: hidden;">
            <table class="w-full" style="font-size: 0.875rem; border-collapse: collapse;">
                <thead>
                    <tr style="background: #eff4ff;">
                        <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #3f484a; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.04em;">No</th>
                        <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #3f484a; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.04em;">Kode</th>
                        <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #3f484a; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.04em;">Nama Kategori</th>
                        <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #3f484a; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.04em;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(item, index) in kodeItems"
                        :key="item.id"
                        style="border-top: 1px solid #e5eeff; transition: background 0.15s;"
                        class="hover:bg-[#f8f9ff]"
                    >
                        <td style="padding: 12px 16px; color: #90a4b4; font-size: 0.8rem;">{{ index + 1 }}</td>
                        <td style="padding: 12px 16px;">
                            <span style="background: #dce9ff; color: #004349; padding: 3px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; font-family: monospace;">
                                {{ item.kode_prefix }}
                            </span>
                        </td>
                        <td style="padding: 12px 16px; font-weight: 600; color: #0b1c30;">{{ item.nama_kode }}</td>
                        <td style="padding: 12px 16px;">
                            <div class="flex gap-3">
                                <button
                                    @click="openEdit(item)"
                                    style="color: #004349; font-size: 0.8rem; font-weight: 600; background: none; border: none; cursor: pointer;"
                                    class="hover:underline"
                                >
                                    Edit
                                </button>
                                <button
                                    @click="konfirmasiHapus(item.id)"
                                    style="color: #ba1a1a; font-size: 0.8rem; font-weight: 600; background: none; border: none; cursor: pointer;"
                                    class="hover:underline"
                                >
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="!kodeItems || kodeItems.length === 0">
                        <td colspan="4" style="padding: 40px; text-align: center; color: #90a4b4;">
                            Belum ada kode item.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal Tambah/Edit -->
        <div v-if="showModal" class="fixed inset-0 flex items-center justify-center z-50" style="background: rgba(11,28,48,0.5);">
            <div style="background: #fff; border-radius: 16px; padding: 24px; width: 100%; max-width: 420px; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
                <h2 style="font-size: 1.1rem; font-weight: 700; color: #0b1c30; margin-bottom: 20px;">
                    {{ isEdit ? 'Edit Kode Item' : 'Tambah Kode Item' }}
                </h2>
                <div class="flex flex-col gap-3">
                    <div>
                        <label style="font-size: 0.8rem; font-weight: 600; color: #3f484a; display: block; margin-bottom: 4px;">Kode Prefix</label>
                        <input
                            v-model="form.kode_prefix"
                            placeholder="Contoh: KOI"
                            style="width: 100%; border: 1px solid #bfc8c9; border-radius: 8px; padding: 8px 12px; font-size: 0.875rem; color: #0b1c30; outline: none; box-sizing: border-box;"
                        />
                    </div>
                    <div>
                        <label style="font-size: 0.8rem; font-weight: 600; color: #3f484a; display: block; margin-bottom: 4px;">Nama Kategori</label>
                        <input
                            v-model="form.nama_kode"
                            placeholder="Contoh: Ikan Koi"
                            style="width: 100%; border: 1px solid #bfc8c9; border-radius: 8px; padding: 8px 12px; font-size: 0.875rem; color: #0b1c30; outline: none; box-sizing: border-box;"
                        />
                    </div>
                </div>
                <div class="flex justify-end gap-2" style="margin-top: 20px;">
                    <button
                        @click="showModal = false"
                        style="padding: 8px 18px; border-radius: 8px; border: 1px solid #bfc8c9; font-size: 0.875rem; font-weight: 600; color: #3f484a; background: #fff; cursor: pointer;"
                        class="hover:bg-[#f8f9ff]"
                    >
                        Batal
                    </button>
                    <button
                        @click="simpan"
                        style="padding: 8px 18px; border-radius: 8px; background: #004349; color: #fff; font-size: 0.875rem; font-weight: 600; border: none; cursor: pointer;"
                        class="hover:opacity-90"
                    >
                        Simpan
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi Hapus -->
        <div v-if="showDeleteConfirm" class="fixed inset-0 flex items-center justify-center z-50" style="background: rgba(11,28,48,0.5);">
            <div style="background: #fff; border-radius: 16px; padding: 24px; width: 100%; max-width: 360px; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
                <div class="text-3xl mb-3">🗑️</div>
                <h2 style="font-size: 1.1rem; font-weight: 700; color: #0b1c30; margin-bottom: 8px;">Konfirmasi Hapus</h2>
                <p style="font-size: 0.875rem; color: #3f484a; margin-bottom: 20px;">Apakah Anda yakin ingin menghapus kode item ini? Tindakan ini tidak dapat dibatalkan.</p>
                <div class="flex justify-end gap-2">
                    <button
                        @click="showDeleteConfirm = false"
                        style="padding: 8px 18px; border-radius: 8px; border: 1px solid #bfc8c9; font-size: 0.875rem; font-weight: 600; color: #3f484a; background: #fff; cursor: pointer;"
                        class="hover:bg-[#f8f9ff]"
                    >
                        Batal
                    </button>
                    <button
                        @click="hapus"
                        style="padding: 8px 18px; border-radius: 8px; background: #ba1a1a; color: #fff; font-size: 0.875rem; font-weight: 600; border: none; cursor: pointer;"
                        class="hover:opacity-90"
                    >
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>

    </div>
</template>