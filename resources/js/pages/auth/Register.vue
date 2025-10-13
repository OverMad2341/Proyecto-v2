<script setup lang="ts">
import RegisteredUserController from '@/actions/App/Http/Controllers/Auth/RegisteredUserController';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { login } from '@/routes';
import { Form, Head } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
</script>

<template>
    <AuthBase
        title="Crear una cuenta"
        description="Ingrese sus datos para crear su cuenta"
    >
        <Head title="Register" />

        <Form
            v-bind="RegisteredUserController.store.form()"
            :reset-on-success="['password', 'password_confirmation']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-6"
        >
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="name">Primer nombre</Label>
                    <Input
                        id="name"
                        type="text"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="name"
                        name="name"
                        placeholder="Primer nombre"
                    />
                    <InputError :message="errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label for="name_02">Segundo nombre</Label>
                    <Input
                        id="name_02"
                        type="text"
                        required
                        :tabindex="2"
                        autocomplete="name_02"
                        name="name_02"
                        placeholder="Segundo nombre"
                    />
                    <InputError :message="errors.name_02" />
                </div>

                <div class="grid gap-2">
                    <Label for="surname_01">Primer apellido</Label>
                    <Input
                        id="surname_01"
                        type="text"
                        required
                        :tabindex="3"
                        autocomplete="surname_01"
                        name="surname_01"
                        placeholder="Primer apellido"
                    />
                    <InputError :message="errors.surname_01" />
                </div>

                <div class="grid gap-2">
                    <Label for="surname_02">Segundo apellido</Label>
                    <Input
                        id="surname_02"
                        type="text"
                        required
                        :tabindex="4"
                        autocomplete="surname_02"
                        name="surname_02"
                        placeholder="Segundo apellido"
                    />
                    <InputError :message="errors.surname_02" />
                </div>

                <div class="grid gap-2">
                    <Label for="cedula">Cédula</Label>
                    <Input
                        id="cedula"
                        type="text"
                        required
                        :tabindex="5"
                        autocomplete="cedula"
                        name="cedula"
                        placeholder="Cédula"
                    />
                    <InputError :message="errors.cedula" />
                </div>

                <div class="grid gap-2">
                    <Label for="birth_date">Fecha de nacimiento</Label>
                    <Input
                        id="birth_date"
                        type="date"
                        required
                        :tabindex="6"
                        autocomplete="birth_date"
                        name="birth_date"
                        placeholder="Fecha de nacimiento"
                    />
                    <InputError :message="errors.birth_date" />
                </div>

                <div class="grid gap-2">
                    <Label for="birth_place">Lugar de nacimiento</Label>
                    <Input
                        id="birth_place"
                        type="text"
                        required
                        :tabindex="7"
                        autocomplete="birth_place"
                        name="birth_place"
                        placeholder="Lugar de nacimiento"
                    />
                    <InputError :message="errors.birth_place" />
                </div>

                <div class="grid gap-2">
                    <Label for="sex">Sexo</Label>
                    <select
                        id="sex"
                        name="sex"
                        required
                        :tabindex="8"
                        class="border rounded px-3 py-2"
                    >
                        <option value="">Seleccione...</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                        <option value="O">Otro</option>
                    </select>
                    <InputError :message="errors.sex" />
                </div>

                <div class="grid gap-2">
                    <Label for="nationality">Nacionalidad</Label>
                    <Input
                        id="nationality"
                        type="text"
                        required
                        :tabindex="9"
                        autocomplete="nationality"
                        name="nationality"
                        placeholder="Nacionalidad"
                    />
                    <InputError :message="errors.nationality" />
                </div>

                <div class="grid gap-2">
                    <Label for="email">Email</Label>
                    <Input
                        id="email"
                        type="email"
                        required
                        :tabindex="10"
                        autocomplete="username"
                        name="email"
                        placeholder="email@example.com"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-2">
                    <Label for="password">Password</Label>
                    <Input
                        id="password"
                        type="password"
                        required
                        :tabindex="11"
                        autocomplete="new-password"
                        name="password"
                        placeholder="Password"
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation">Confirmar Password</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        required
                        :tabindex="12"
                        autocomplete="new-password"
                        name="password_confirmation"
                        placeholder="Confirmar Password"
                    />
                    <InputError :message="errors.password_confirmation" />
                </div>

                <Button
                    type="submit"
                    class="mt-2 w-full"
                    tabindex="13"
                    :disabled="processing"
                    data-test="register-user-button"
                >
                    <LoaderCircle
                        v-if="processing"
                        class="h-4 w-4 animate-spin"
                    />
                    Registrarse
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                ¿Ya estás registrado?
                <TextLink
                    :href="login()"
                    class="underline underline-offset-4"
                    :tabindex="14"
                    >Iniciar sesión</TextLink
                >
            </div>
        </Form>
    </AuthBase>
</template>
