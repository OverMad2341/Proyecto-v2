<script setup lang="ts">
import ActivosController from '@/actions/App/Http/Controllers/ActivosController';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import InputError from '@/components/InputError.vue';
import { Label } from '@/components/ui/label';
import { computed, ref, onMounted, watch } from 'vue';
import type { Empleado, Ubicacion, Categoria, SubCategoria, SubSubCategoria } from '@/types';
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
        href: '/activos',
    },
    {
        title: 'Crear',
        href: '#',
    },
];

// estado local para empleados
const empleados = ref<Empleado[]>([]);
const gerencias = ref<Ubicacion[]>([]);
const categorias = ref<Categoria[]>([]);
const subcategorias = ref<SubCategoria[]>([]);
const subsubcategorias = ref<SubSubCategoria[]>([]);
const loadingEmpleados = ref(false);

// --- 2. Define tu formulario con useForm ---
// Esto reemplaza la lógica de 'ActivosController.store.form()'
// y nos da un objeto reactivo 'form' para usar con v-model.
const form = useForm({
    codigo: '',
    serial: '',
    marca: '',
    modelo: '',
    color: '',
    empleado: null as number | null,
    ubicacion: null as number | null,
    categoria_id: null as number | null,
    subcategoria_id: null as number | null,
    subsubcategoria_id: null as number | null,
    estado: null as string | null,
});
// --- 3. Define tu función de submit ---
const submit = () => {
    // Asumo que la ruta para guardar es '/activos'
    form.post('/Activo', {
        // Tu lógica de reset al tener éxito
        onSuccess: () => form.reset(),
    });
};


onMounted(async () => {
    loadingEmpleados.value = true;
    try {
        const res = await fetch('/empleados');
        const res1 = await fetch('/gerencias');
        const res2 = await fetch('/categorias');
        const res3 = await fetch('/subcategorias');
        const res4 = await fetch('/subsubcategorias');
        if (!res.ok) throw new Error('Error fetching empleados');
        if (!res1.ok) throw new Error('Error fetching gerencias');
        if (!res2.ok) throw new Error('Error fetching categorias');
        if (!res3.ok) throw new Error('Error fetching subcategorias');
        if (!res4.ok) throw new Error('Error fetching subsubcategorias');
        const data = await res.json();
        const data1 = await res1.json();
        const data2 = await res2.json();
        const data3 = await res3.json();
        const data4 = await res4.json();
        empleados.value = data;
        gerencias.value = data1;
        categorias.value = data2;
        subcategorias.value = data3;
        subsubcategorias.value = data4;
    } catch (e) {
        // aquí podrías manejar el error (toast/log)
        console.error(e);
    } finally {
        loadingEmpleados.value = false;
    }
});

// --- 4. (LA CLAVE) Crea propiedades computadas para filtrar ---

// Filtra subcategorías basado en la categoría seleccionada
const filteredSubcategorias = computed(() => {
    if (!form.categoria_id) {
        return []; // Si no hay categoría, no muestra nada
    }
    // Asume que tu tipo SubCategoria tiene una propiedad 'categoria_id'
    return subcategorias.value.filter(
        subcat => subcat.categoria_id === form.categoria_id
    );
});

// (BONUS) Lo mismo para sub-subcategorías
const filteredSubSubCategorias = computed(() => {
    if (!form.subcategoria_id) {
        return [];
    }
    // Asume que tu tipo SubSubCategoria tiene 'sub_categoria_id'
    return subsubcategorias.value.filter(
        subsubcat => subsubcat.subcategoria_id === form.subcategoria_id
    );
});

const isAlmacenSelected = computed(() => {
    if (!form.ubicacion) {
        return false; // Si no hay ubicación, no está deshabilitado
    }
    // Busca el objeto 'ubicacion' (gerencia) basado en el ID seleccionado
    const selectedUbicacion = gerencias.value.find(
        gern => gern.id === form.ubicacion
    );

    // Retorna true si el nombre es 'Almacen'
    return selectedUbicacion?.name === 'Almacen';
});

// --- 5. (IMPORTANTE) Observa cambios para limpiar selecciones ---

// Si el usuario cambia la categoría, resetea la subcategoría
watch(() => form.categoria_id, (newCategoriaId) => {
    form.subcategoria_id = null;
    form.subsubcategoria_id = null; // También resetea la sub-subcategoría
});

// Si el usuario cambia la subcategoría, resetea la sub-subcategoría
watch(() => form.subcategoria_id, (newSubCategoriaId) => {
    form.subsubcategoria_id = null;
});

// --- 2. Observador para limpiar 'empleado' si se selecciona 'Almacen' ---
watch(isAlmacenSelected, (isAlmacen) => {
    if (isAlmacen) {
        form.empleado = null; // Limpia el empleado seleccionado
    }
});

watch(() => form.codigo, (newValue) => {
    if (newValue) {
        // Usa una expresión regular para eliminar cualquier cosa que NO sea un dígito (\D)
        const numericValue = newValue.replace(/\D/g, '');

        // Vuelve a asignar el valor ya limpio al formulario.
        // Esto pasa tan rápido que el usuario nunca ve la letra.
        form.codigo = numericValue;
    }
});

</script>
<template>

    <Head title="Crear activo" />
    <AppLayout :breadcrumbs="breadcrumbs">

        <form @submit.prevent="submit">
            <Card class="flex flex-1 mx-40 my-4 ">
                <CardHeader class="text-center gap-2">
                    <CardTitle>Crear Bien Nacional</CardTitle>
                    <CardDescription>Complete el formulario para agregar un nuevo bien nacional.</CardDescription>
                </CardHeader>
                <CardContent>
                    <div class="flex flex-col gap-1 rounded-xl p-4 ">

                        <div class="grid gap-2 mb-3">
                            <Label for="codigo">Codigo de Bien</Label>
                            <Input id="codigo" v-model="form.codigo" maxlength="7" type="text" inputmode="numeric"
                                placeholder="codigo" />
                        </div>

                        <div v-for="(label, key) in { marca: 'Marca *', modelo: 'Modelo *', serial: 'Serial', color: 'Color' }"
                            :key="key" class="grid gap-2 mb-3">
                            <Label :for="key">{{ label }}</Label>
                            <Input :id="key" v-model="form[key]" :type="'text'" :placeholder="key" />
                            <InputError class="mt-2" :message="form.errors[key]" />
                        </div>

                        <div class="grid grid-cols-[repeat(auto-fit,_minmax(250px,_1fr))] gap-4 mt-4">

                            <div class="grid gap-2">
                                <Label for="ubicacion">Ubicacion *</Label>
                                <Select id="ubicacion" v-model="form.ubicacion">
                                    <SelectTrigger>
                                        <SelectValue placeholder="Ubicacion" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectGroup>
                                            <SelectLabel>Ubicacion</SelectLabel>
                                            <SelectItem v-for="gern in gerencias" :key="gern.id" :value="gern.id">
                                                {{ gern.name }}
                                            </SelectItem>
                                        </SelectGroup>
                                    </SelectContent>
                                </Select>
                                <InputError class="mt-2" :message="form.errors.ubicacion" />
                            </div>
                            
                            <div class="grid gap-2">
                                <Label for="empleado">Empleado *</Label>
                                <Select id="empleado" v-model="form.empleado" :disabled="isAlmacenSelected">
                                    <SelectTrigger>
                                        <SelectValue placeholder="Empleado" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectGroup>
                                            <SelectLabel>Empleado</SelectLabel>
                                            <SelectItem v-for="emp in empleados" :key="emp.id" :value="emp.id">
                                                {{ emp.name + ' ' + emp.surname }}{{ emp.cedula ? ' - ' + emp.cedula : '' }}
                                            </SelectItem>
                                        </SelectGroup>
                                    </SelectContent>
                                </Select>
                                <InputError class="mt-2" :message="form.errors.empleado" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="categoria_id">Categoria *</Label>
                                <Select id="categoria_id" v-model="form.categoria_id">
                                    <SelectTrigger>
                                        <SelectValue placeholder="Categoria" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectGroup>
                                            <SelectLabel>Categoria</SelectLabel>
                                            <SelectItem v-for="cat in categorias" :key="cat.id" :value="cat.id">
                                                {{ cat.name }}
                                            </SelectItem>
                                        </SelectGroup>
                                    </SelectContent>
                                </Select>
                                <InputError class="mt-2" :message="form.errors.categoria_id" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="subcategoria_id">Subcategoria *</Label>
                                <Select id="subcategoria_id" v-model="form.subcategoria_id"
                                    :disabled="!form.categoria_id || filteredSubcategorias.length === 0">
                                    <SelectTrigger>
                                        <SelectValue placeholder="Subcategoria" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectGroup>
                                            <SelectLabel>Subcategoria</SelectLabel>
                                            <SelectItem v-for="subcat in filteredSubcategorias" :key="subcat.id"
                                                :value="subcat.id">
                                                {{ subcat.name }}
                                            </SelectItem>
                                            <SelectItem v-if="form.categoria_id && filteredSubcategorias.length === 0"
                                                value="null" disabled>
                                                No hay subcategorías para esta categoría
                                            </SelectItem>
                                        </SelectGroup>
                                    </SelectContent>
                                </Select>
                                <InputError class="mt-2" :message="form.errors.subcategoria_id" />
                            </div>


                            <div class="grid gap-2">
                                <Label for="subsubcategoria_id">Sub-subcategoria *</Label>
                                <Select id="subsubcategoria_id" v-model="form.subsubcategoria_id"
                                    :disabled="!form.subcategoria_id || filteredSubSubCategorias.length === 0">
                                    <SelectTrigger>
                                        <SelectValue placeholder="Sub-subcategoria" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectGroup>
                                            <SelectLabel>Sub-subcategoria</SelectLabel>
                                            <SelectItem v-for="subsubcat in filteredSubSubCategorias"
                                                :key="subsubcat.id" :value="subsubcat.id">
                                                {{ subsubcat.name }}
                                            </SelectItem>
                                            <SelectItem
                                                v-if="form.subcategoria_id && filteredSubSubCategorias.length === 0"
                                                value="null" disabled>
                                                No hay sub-subcategorías
                                            </SelectItem>
                                        </SelectGroup>
                                    </SelectContent>
                                </Select>
                                <InputError class="mt-2" :message="form.errors.subsubcategoria_id" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="estado">Estado *</Label>
                                <Select id="estado" v-model="form.estado">
                                    <SelectTrigger>
                                        <SelectValue placeholder="Estado" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectGroup>
                                            <SelectLabel>Estado</SelectLabel>
                                            <SelectItem
                                                v-for="status in ['Buen estado', 'Regular', 'Mal estado', 'Dañado']"
                                                :key="status" :value="status" class="w-64">
                                                {{ status }}
                                            </SelectItem>
                                        </SelectGroup>
                                    </SelectContent>
                                </Select>
                                <InputError class="mt-2" :message="form.errors.estado" />
                            </div>

                        </div>
                    </div>
                </CardContent>
                <CardFooter>
                    <Button type="submit" class="mx-auto mt-2 items-center justify-center w-md" tabindex="13"
                        :disabled="form.processing" data-test="register-activo-button">
                        <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                        Crear Bien Nacional
                    </Button>
                </CardFooter>
            </Card>
        </form>
    </AppLayout>
</template>
