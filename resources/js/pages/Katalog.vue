<script lang="ts">
export default {
    layout: null,
}
</script>

<script setup lang="ts">
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps<{
    katalogIkan: Array<{
        id: number;
        kode: string;
        nama_item: string;
        harga_jual: number;
        stok: number;
    }>;
}>();

const page = usePage();
const showLoginModal = ref(false);

function handleBeli(itemId: number) {
    if (!page.props.auth.user) {
        showLoginModal.value = true;
        return;
    }
    router.visit(`/checkout/${itemId}`);
}
</script>

<template>
    <Head title="Toko Ikan Koi" />

    <div class="min-h-screen bg-white text-gray-900 flex flex-col font-sans">

        <nav class="flex items-center justify-between px-8 py-4 border-b border-gray-200">
            <div class="flex items-center gap-2 font-bold text-lg">
                🐟 Toko Ikan Koi
            </div>

            <div class="flex items-center gap-4">
                <template v-if="!$page.props.auth.user">
                    <Link href="/login" class="text-gray-600 hover:text-black font-medium text-sm">
                        Masuk
                    </Link>
                    <Link href="/register" class="bg-black text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-gray-800">
                        Daftar
                    </Link>
                </template>

                <template v-else>
                    <span class="text-sm font-medium text-gray-600">
                        Halo, {{ $page.props.auth.user.nama || $page.props.auth.user.username }}!
                    </span>

                    <Link v-if="$page.props.auth.user.role !== 'pembeli'" href="/dashboard" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700">
                        Dashboard Kasir
                    </Link>

                    <Link href="/logout" method="post" as="button" class="text-red-600 hover:text-red-800 font-medium text-sm border border-red-200 px-4 py-2 rounded-lg hover:bg-red-50">
                        Keluar
                    </Link>
                </template>
            </div>
        </nav>

        <div class="flex flex-col items-center justify-center text-center px-6 pt-20 pb-12 gap-6">
            <div class="text-6xl">🐠</div>
            <h1 class="text-4xl font-black tracking-tight">Katalog Ikan Koi Pilihan</h1>
            <p class="text-gray-500 text-lg max-w-md">
                Pilih dan temukan ikan koi impianmu dengan kualitas terbaik langsung dari kolam kami.
            </p>
        </div>

        <div class="px-8 pb-20 max-w-6xl mx-auto w-full flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                <div
                    v-for="ikan in katalogIkan"
                    :key="ikan.id"
                    class="border border-gray-200 rounded-2xl p-6 flex flex-col items-center text-center hover:shadow-xl transition-shadow duration-300"
                >
                    <div class="text-6xl mb-4 bg-gray-50 w-full py-6 rounded-xl">🎏</div>
                    <h3 class="font-bold text-lg mb-1">{{ ikan.nama_item }}</h3>
                    <p class="text-xs font-mono text-gray-500 mb-4">Sisa Stok: {{ ikan.stok }} ekor</p>

                    <div class="w-full mt-auto">
                        <div class="text-xl font-black text-green-600 mb-4">
                            Rp {{ ikan.harga_jual.toLocaleString('id-ID') }}
                        </div>
                        <button
                            @click="handleBeli(ikan.id)"
                            class="w-full bg-black text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-gray-800"
                        >
                            Beli Sekarang
                        </button>
                    </div>
                </div>

            </div>

            <div v-if="katalogIkan.length === 0" class="text-center py-12 text-gray-400 font-medium">
                Mohon maaf, stok ikan sedang kosong saat ini.
            </div>
        </div>

        <footer class="text-center text-sm text-gray-400 py-6 border-t border-gray-100">
            © 2026 Toko Ikan Koi. All rights reserved.
        </footer>

        <!-- Modal: wajib login dulu -->
        <div v-if="showLoginModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 px-4">
            <div class="bg-white rounded-2xl p-6 max-w-sm w-full text-center">
                <h3 class="font-bold text-lg mb-2">Login Diperlukan</h3>
                <p class="text-gray-500 text-sm mb-5">Silakan masuk atau daftar dulu untuk membeli ikan koi ini.</p>
                <div class="flex gap-2">
                    <Link href="/login" class="flex-1 bg-black text-white py-2 rounded-lg text-sm font-bold">Masuk</Link>
                    <Link href="/register" class="flex-1 border border-gray-300 py-2 rounded-lg text-sm font-bold">Daftar</Link>
                </div>
                <button @click="showLoginModal = false" class="mt-3 text-xs text-gray-400 hover:text-gray-600">
                    Batal
                </button>
            </div>
        </div>

    </div>
</template>