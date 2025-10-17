<script setup lang="ts">
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import VueHcaptcha from '@hcaptcha/vue3-hcaptcha';

// ... (importa tus otros componentes como Button, Input, etc.)
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
import { LoaderCircle } from 'lucide-vue-next';


defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

// --- PUNTO CRÍTICO #1 ---
// Creamos una instancia del formulario de Inertia que controlaremos nosotros.
// Es VITAL que incluyas aquí TODOS los campos que se enviarán, incluido el captcha.
const form = useForm({
    email: '',
    password: '',
    remember: false,
    'h-captcha-response': '', // El token del captcha se guardará aquí.
});

const showCaptchaModal = ref(false);

// --- PUNTO CRÍTICO #2 ---
// Esta función se ejecutará cuando se intente enviar el formulario.
// Previene el envío al backend y en su lugar, abre nuestro modal.
const handleLoginAttempt = () => {
    // Para depurar: Abre la consola de tu navegador (F12) y verifica que este mensaje aparece al hacer clic.
    console.log('Intento de login interceptado. Mostrando captcha...');
    showCaptchaModal.value = true;
};

// Esta función se ejecuta CUANDO el captcha se resuelve con éxito.
const onCaptchaVerified = (token: string) => {
    console.log('Captcha verificado. Enviando formulario al backend...');
    
    // 1. Asignamos el token recibido al campo del formulario.
    form['h-captcha-response'] = token;
    
    // 2. Cerramos el modal.
    showCaptchaModal.value = false;

    // 3. AHORA SÍ, enviamos el formulario al backend usando Inertia.
    form.post(AuthenticatedSessionController.store.url(), {
        // Esto es opcional, pero es buena práctica limpiar la contraseña después de un envío.
        onFinish: () => form.reset('password'),
    });
};

const onCaptchaExpired = () => {
    form['h-captcha-response'] = '';
};
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

        <form @submit.prevent="handleLoginAttempt" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="email">Correo electronico</Label>
                    <Input
                        id="email"
                        type="email"
                        v-model="form.email" required
                        autofocus
                        autocomplete="email"
                        placeholder="email@example.com"
                    />
                    <InputError :message="form.errors.email" />
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
                        v-model="form.password" required
                        autocomplete="current-password"
                        placeholder="Password"
                    />
                    <InputError :message="form.errors.password" />
                    
                    <InputError :message="form.errors['h-captcha-response']" />
                </div>

                <div class="flex items-center">
                    <Checkbox id="remember" name="remember" v-model:checked="form.remember" />
                    <Label for="remember" class="ml-2 text-sm">Recuérdame</Label>
                </div>

                <Button type="submit" class="w-full" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="mr-2 h-4 w-4 animate-spin" />
                    Iniciar Sesión
                </Button>
                
            </div>
            <div class="text-center text-sm text-muted-foreground">
                No tienes Cuenta?
                <TextLink :href="register()" :tabindex="5">Registrate</TextLink>
            </div>
            
            </form>

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