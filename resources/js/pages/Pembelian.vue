<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps<{
    item: {
        id: number;
        nama_item: string;
        harga_jual: number;
        stok: number;
    };
}>();

const form = useForm({
    qty: 1,
});

function submit() {
    form.post(`/checkout/${props.item.id}`);
}
</script>

<template>
    <Head :title="`Beli ${item.nama_item}`" />

    <div class="min-h-screen bg-white flex items-center justify-center px-6">
        <div class="w-full max-w-md border border-gray-200 rounded-2xl p-8">
            <h1 class="text-2xl font-bold mb-1">{{ item.nama_item }}</h1>
            <p class="text-gray-500 text-sm mb-4">Sisa stok: {{ item.stok }} ekor</p>
            <p class="text-xl font-black text-green-600 mb-6">
                Rp {{ item.harga_jual.toLocaleString('id-ID') }}
            </p>

            <form @submit.prevent="submit" class="flex flex-col gap-4">
                <div>
                    <label for="qty" class="text-sm font-medium block mb-1">Jumlah</label>
                    <input
                        id="qty"
                        type="number"
                        v-model.number="form.qty"
                        min="1"
                        :max="item.stok"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2"
                    />
                    <p v-if="form.errors.qty" class="text-red-600 text-xs mt-1">{{ form.errors.qty }}</p>
                </div>

                <p class="font-bold">
                    Subtotal: Rp {{ (item.harga_jual * (form.qty || 0)).toLocaleString('id-ID') }}
                </p>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full bg-black text-white py-3 rounded-lg font-bold hover:bg-gray-800 disabled:opacity-50"
                >
                    {{ form.processing ? 'Memproses...' : 'Konfirmasi Beli' }}
                </button>
            </form>
        </div>
    </div>
</template>