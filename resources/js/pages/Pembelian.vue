<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps<{
    item: {
        id: number
        kode: string
        nama_item: string
        harga_jual: number
        stok: number
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

    <div class="min-h-screen flex items-center justify-center px-6 py-12"
        style="background: #f8f9ff; font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;">

        <div style="width: 100%; max-width: 420px;">

            <!-- Back link -->
            <a href="/" style="display: inline-flex; align-items: center; gap: 6px; color: #3f484a; font-size: 0.875rem; font-weight: 500; text-decoration: none; margin-bottom: 24px;"
                class="hover:opacity-70">
                ← Kembali ke Katalog
            </a>

            <!-- Card -->
            <div style="background: #fff; border: 1px solid #bfc8c9; border-radius: 16px; padding: 32px;">

                <!-- Info produk -->
                <div style="background: linear-gradient(135deg, #dce9ff 0%, #e5eeff 100%); border-radius: 12px; padding: 24px; text-align: center; margin-bottom: 24px;">
                    <div style="font-size: 3rem; margin-bottom: 8px;">🎏</div>
                    <h1 style="font-size: 1.25rem; font-weight: 700; color: #0b1c30; margin-bottom: 4px;">{{ item.nama_item }}</h1>
                    <p style="font-size: 0.8rem; color: #3f484a; margin-bottom: 8px;">Sisa stok: {{ item.stok }} ekor</p>
                    <p style="font-size: 1.5rem; font-weight: 800; color: #004349;">
                        Rp {{ item.harga_jual.toLocaleString('id-ID') }}
                    </p>
                </div>

                <!-- Form -->
                <form @submit.prevent="submit" class="flex flex-col gap-4">
                    <div>
                        <label for="qty" style="font-size: 0.85rem; font-weight: 600; color: #3f484a; display: block; margin-bottom: 6px;">
                            Jumlah yang dibeli
                        </label>
                        <input
                            id="qty"
                            type="number"
                            v-model.number="form.qty"
                            min="1"
                            :max="item.stok"
                            style="width: 100%; border: 1px solid #bfc8c9; border-radius: 8px; padding: 10px 14px; font-size: 0.95rem; color: #0b1c30; outline: none; box-sizing: border-box;"
                        />
                        <p v-if="form.errors.qty" style="color: #ba1a1a; font-size: 0.75rem; margin-top: 4px;">{{ form.errors.qty }}</p>
                    </div>

                    <!-- Subtotal -->
                    <div style="background: #f8f9ff; border-radius: 8px; padding: 14px; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.875rem; color: #3f484a;">Subtotal</span>
                        <span style="font-size: 1.1rem; font-weight: 800; color: #004349;">
                            Rp {{ (item.harga_jual * (form.qty || 0)).toLocaleString('id-ID') }}
                        </span>
                    </div>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        style="width: 100%; background: #004349; color: #fff; padding: 12px; border-radius: 8px; font-size: 0.95rem; font-weight: 700; border: none; cursor: pointer; transition: opacity 0.2s;"
                        :style="form.processing ? 'opacity: 0.5; cursor: not-allowed;' : 'opacity: 1;'"
                        class="hover:opacity-90"
                    >
                        {{ form.processing ? 'Memproses...' : 'Konfirmasi Beli' }}
                    </button>
                </form>

            </div>
        </div>
    </div>
</template>