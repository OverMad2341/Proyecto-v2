<script setup lang="ts">
import ActivosController from '@/actions/App/Http/Controllers/ActivosController';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router, Form } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import InputError  from '@/components/InputError.vue';
import { Label } from '@/components/ui/label';
import { Ref, ref, onMounted } from 'vue';
import type { Empleado, Ubicacion } from '@/types';
import { LoaderCircle } from 'lucide-vue-next';
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card'
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectLabel,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'

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

// estado local para empleados
const empleados = ref<Empleado[]>([]);
const gerencias = ref<Ubicacion[]>([]);
const loadingEmpleados = ref(false);

onMounted(async () => {
    loadingEmpleados.value = true;
    try {
        const res = await fetch('/empleados');
        const res1 = await fetch('/gerencias')
        if (!res1.ok) throw new Error('Error fetching gerencias')
        if (!res.ok) throw new Error('Error fetching empleados');
        const data = await res.json();
        const data1 = await res1.json();
        empleados.value = data;
        gerencias.value = data1;
    } catch (e) {
        // aquí podrías manejar el error (toast/log)
        console.error(e);
    } finally {
        loadingEmpleados.value = false;
    }
});


</script>
<template>

    <Head title="Crear activo" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <Form v-bind="ActivosController.store.form()" 
            :reset-on-success="['codigo', 'Nombre', 'serial', 'marca', 'modelo', 'color', 'empleado',
            'ubicacion', 'categoria_id', 'subcategoria_id', 'subsubcategoria_id', 'estado']"
            v-slot="{ errors, processing }">
            <Card class="flex flex-1 mx-40 my-10">
                <CardHeader class="text-center gap-2">
                    <CardTitle>Crear Bien Nacional</CardTitle>
                    <CardDescription>Complete el formulario para agregar un nuevo bien nacional.</CardDescription>
                </CardHeader>
                <CardContent>
                    <div class="flex flex-col gap-1 rounded-xl p-4 ">
                        <div v-for="(label, key) in { codigo: 'Codigo', name: 'Nombre', marca: 'Marca', modelo: 'Modelo', serial: 'Serial', color: 'Color'}"
                            :key="key" class="grid gap-2 mb-4">
                            <Label :for="key">{{ label }}</Label>
                            <Input :id="key" :type="key === 'codigo' ? 'number' : 'text'" :placeholder="label" />
                        </div>
                        <div v-for="(label, key) in {empleado:'Empleado', ubicacion:'Ubicacion', categoria_id:'Categoria', subcategoria_id:'Subcategoria', subsubcategoria_id:'Subsubcategoria', estado: 'Estado'}"
                            class="grid gap-2 mb-4">
                            <Label :for="key">{{ label }}</Label>
                            <Select :for="key">
                                <SelectTrigger>
                                    <SelectValue :placeholder="label" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectLabel>{{ label }}</SelectLabel>
                                        <SelectItem v-if="key === 'empleado'" v-for="emp in empleados" :key="emp.id" :value="emp.id">
                                            {{ emp.name + ' ' + emp.surname }}{{ emp.cedula ? ' - ' + emp.cedula : '' }}
                                        </SelectItem>
                                        <SelectItem v-if="key === 'ubicacion'" v-for="gern in gerencias" :key="gern.id" :value="gern.id">
                                            {{ gern.name }}
                                        </SelectItem>
                                        <SelectItem v-if="key === 'estado'" v-for="status in ['Buen estado', 'Regular', 'Mal estado', 'Dañado']" :key="status" :value="status">
                                            {{ status }}
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
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