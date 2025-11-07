<script setup lang="ts">
import ActivosController from '@/actions/App/Http/Controllers/ActivosController';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router, Form } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import InputError  from '@/components/InputError.vue';
import { Label } from '@/components/ui/label';
import { Ref } from 'vue';
import { LoaderCircle } from 'lucide-vue-next';
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card'

type Breadcrumb = {
    title: string;
    href: string;
};
const breadcrumbs: Breadcrumb[] = [
    {
        title: 'Activos',
        href: '/Activos',
    },
    {
        title: 'Crear',
        href: '#',
    },
];


</script>
<template>

    <Head title="Crear activo" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <Form v-bind="ActivosController.store.form()" 
            :reset-on-success="['codigo', 'name', 'serial', 'marca', 'modelo', 'color', 'empleado',
            'ubicacion', 'categoria_id', 'subcategoria_id', 'subsubcategoria_id', 'estado']"
            v-slot="{ errors, processing }">
            <Card class="flex flex-1 mx-60 my-10">
                <CardHeader class="text-center gap-2">
                    <CardTitle>Crear Bien Nacional</CardTitle>
                    <CardDescription>Complete el formulario para agregar un nuevo bien nacional.</CardDescription>
                </CardHeader>
                <CardContent>
                    <div class="flex flex-col gap-1 rounded-xl p-4 ">
                        <div v-for="(label, key) in { codigo: 'Codigo', name: 'Name', marca: 'Marca', modelo: 'Modelo', serial: 'Serial', color: 'Color', empleado: 'Empleado', ubicacion: 'Ubicacion', categoria_id: 'Categoria', subcategoria_id: 'Subcategoria', subsubcategoria_id: 'Subsubcategoria', estado: 'Estado' }"
                            :key="key" class="grid gap-2 mb-4">
                            <Label :for="key">{{ label }}</Label>
                            <Input :id="key" :type="key === 'codigo' ? 'number' : 'text'" :placeholder="label" />
                        </div>
                    </div>
                </CardContent>
                <CardFooter>
                    <Button type="submit" class="mt-2 items-center w-full" tabindex="13" :disabled="processing"
                        data-test="register-activo-button">
                        <LoaderCircle v-if="processing" class="h-4 w-4 animate-spin" />
                        Crear Bien Nacional
                    </Button>
                </CardFooter>
            </Card>
        </Form>
    </AppLayout>
</template>