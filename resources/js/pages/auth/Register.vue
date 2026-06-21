<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { login } from '@/routes';
import { store } from '@/routes/register';

defineProps<{
    passwordRules: string;
}>();

defineOptions({
    layout: {
        title: 'Buat Akun Pembeli',
        description: 'Daftar untuk mulai berbelanja ikan koi pilihan',
    },
});
</script>

<template>
    <Head title="Daftar" />

    <Form
        v-bind="store.form()"
        :reset-on-success="['password']"
        v-slot="{ errors, processing }"
        class="flex flex-col gap-6"
    >
        <div class="grid gap-5">
            <div class="grid gap-2">
                <Label for="nama" style="font-size: 0.85rem; font-weight: 600; color: #3f484a;">Nama Lengkap</Label>
                <Input
                    id="nama"
                    type="text"
                    required
                    autofocus
                    :tabindex="1"
                    autocomplete="name"
                    name="nama"
                    placeholder="Nama lengkap kamu"
                    style="border-color: #bfc8c9; border-radius: 8px;"
                />
                <InputError :message="errors.nama" />
            </div>

            <div class="grid gap-2">
                <Label for="username" style="font-size: 0.85rem; font-weight: 600; color: #3f484a;">Username</Label>
                <Input
                    id="username"
                    type="text"
                    required
                    :tabindex="2"
                    autocomplete="username"
                    name="username"
                    placeholder="Pilih username unikmu"
                    style="border-color: #bfc8c9; border-radius: 8px;"
                />
                <InputError :message="errors.username" />
            </div>

            <div class="grid gap-2">
                <Label for="password" style="font-size: 0.85rem; font-weight: 600; color: #3f484a;">Password</Label>
                <PasswordInput
                    id="password"
                    required
                    :tabindex="3"
                    autocomplete="new-password"
                    name="password"
                    placeholder="Buat password yang kuat"
                    :passwordrules="passwordRules"
                    style="border-color: #bfc8c9; border-radius: 8px;"
                />
                <InputError :message="errors.password" />
            </div>

            <Button
                type="submit"
                class="mt-2 w-full"
                tabindex="4"
                :disabled="processing"
                data-test="register-user-button"
                style="background: #004349; border-radius: 8px; font-weight: 600; font-size: 0.9rem;"
            >
                <Spinner v-if="processing" />
                Buat Akun
            </Button>
        </div>

        <div style="text-align: center; font-size: 0.875rem; color: #3f484a;">
            Sudah punya akun?
            <TextLink :href="login()" style="color: #004349; font-weight: 600; text-decoration: underline;" :tabindex="5">
                Masuk di sini
            </TextLink>
        </div>
    </Form>
</template>