<script setup lang="ts">
import { ref } from 'vue';
import AuthenticatedSessionController from '@/actions/App/Http/Controllers/Auth/AuthenticatedSessionController';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { register } from '@/routes';
import { request } from '@/routes/password';
import { Form, Head, useForm } from '@inertiajs/vue3'; // MODIFICADO: Importa useForm
import { LoaderCircle } from 'lucide-vue-next';
import VueHcaptcha from '@hcaptcha/vue3-hcaptcha'

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

// MODIFICADO: Usamos useForm directamente para tener una instancia que podamos controlar.
// ¡Asegúrate de añadir 'h-captcha-response'!
const form = useForm({
    email: '',
    password: '',
    remember: false,
    'h-captcha-response': '',
});

const showCaptchaModal = ref(false);

// MODIFICADO: Esta función intercepta el envío del formulario.
function handleLoginAttempt() {
    // Abre el modal en lugar de dejar que Inertia envíe el formulario.
    showCaptchaModal.value = true;
}

// MODIFICADO: Esta función se llama después de verificar el captcha.
function onCaptchaVerified(token: string) {
    // 1. Asigna el token al objeto del formulario.
    form['h-captcha-response'] = token;

    // 2. Cierra el modal.
    showCaptchaModal.value = false;

    // 3. Envía el formulario de Inertia.
    form.post(AuthenticatedSessionController.store.url(), {
        onFinish: () => form.reset('password'),
    });
}

function onCaptchaExpired() {
    form['h-captcha-response'] = '';
}
</script>

<template>
    <AuthBase
        title="Ingresa en tu cuenta"
        description="Coloca tu correo y contrasela para iniciar sesión"
    >
        <Head title="Iniciar Sesión" />

        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <Form
            :form="form"
            @submit.prevent="handleLoginAttempt"
            :reset-on-success="['password']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-6"
        >
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="email">Correo electronico</Label>
                    <Input
                        id="email"
                        type="email"
                        name="email"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="email"
                        placeholder="email@example.com"
                    />
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <Label for="password">Contraseña</Label>
                        <TextLink
                            v-if="canResetPassword"
                            :href="request()"
                            class="text-sm"
                            :tabindex="5"
                        >
                            Olvidaste tu Contraseña?
                        </TextLink>
                    </div>
                    <Input
                        id="password"
                        type="password"
                        name="password"
                        required
                        :tabindex="2"
                        autocomplete="current-password"
                        placeholder="Password"
                    />
                    <InputError :message="errors.email" />
                    <InputError :message="errors['h-captcha-response']" />
                </div>

                <div class="flex items-center justify-between">
                    <Label for="remember" class="flex items-center space-x-3">
                        <Checkbox id="remember" name="remember" :tabindex="3" />
                        <span>Recuerdame</span>
                    </Label>
                </div>

                <Button
                    type="submit"
                    class="mt-4 w-full"
                    :tabindex="4"
                    :disabled="processing"
                    data-test="login-button"
                >
                    <LoaderCircle
                        v-if="processing"
                        class="h-4 w-4 animate-spin"
                    />
                    Iniciar Sesión
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                No tienes Cuenta?
                <TextLink :href="register()" :tabindex="5">Registrate</TextLink>
            </div>
        </Form>

        <div v-if="showCaptchaModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white dark:bg-gray-900 p-8 rounded-lg shadow-lg flex flex-col items-center">
                <span class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-100">Completa el captcha para continuar</span>
                <VueHcaptcha
                    sitekey="41283496-4348-4dce-beb8-3eac7418c6f0" @verify="onCaptchaVerified"
                    @expired="onCaptchaExpired"
                />
                <Button class="mt-4" @click="showCaptchaModal = false" variant="outline">
                    Cancelar
                </Button>
            </div>
        </div>
    </AuthBase>
</template>