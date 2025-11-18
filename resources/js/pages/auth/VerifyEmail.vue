<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import AuthLayout from '@/layouts/AuthLayout.vue'; // 1. Usar AuthLayout
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

const props = defineProps<{
    email: string;
    status?: string;
}>();

const form = useForm({
    code: '',
    email: props.email,
});

const submit = () => {
    form.post('/verify-email');
};

const resendCode = () => {
    useForm({ email: props.email }).post('/send-verification-code');
};

const verificationSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <AuthLayout>
        <Head title="Verificar Email" />

        <div class="min-h-screen flex flex-col pt-6 sm:pt-0">
            <Card class="w-full sm:max-w-md">
                <CardHeader>
                    <CardTitle>Verificar tu Correo</CardTitle>
                    <CardDescription>
                        ¡Gracias por registrarte! Revisa tu correo para el código de 6 dígitos que te acabamos de enviar.
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div v-if="verificationSent" class="mb-4 font-medium text-sm text-green-600">
                        Se ha enviado un nuevo código de verificación al correo electrónico que proporcionaste.
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="space-y-2">
                            <Label for="code">Código de Verificación</Label>
                            <Input
                                id="code"
                                type="text"
                                v-model="form.code"
                                required
                                autofocus
                                autocomplete="one-time-code"
                                maxlength="6"
                                placeholder="123456"
                            />
                            <div v-if="form.errors.code" class="mt-2 text-sm text-red-600">
                                {{ form.errors.code }}
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Verificar
                            </Button>

                            <Button
                                @click.prevent="resendCode"
                                type="button"
                                variant="link"
                                class="p-0 h-auto"
                            >
                                Reenviar código
                            </Button>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </div>
    </AuthLayout>
</template>