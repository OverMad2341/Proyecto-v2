<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed, watch } from 'vue';
import type { Empleado, Ubicacion, Categoria, SubCategoria, SubSubCategoria, Activo, BreadcrumbItem } from '@/types';

// Componentes de UI (Button, Input, Selects, etc.)
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import InputError from '@/components/InputError.vue';
import { Label } from '@/components/ui/label';
import { LoaderCircle } from 'lucide-vue-next';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from '@/components/ui/select';

// 1. RECIBIMOS TODO POR PROPS
const props = defineProps<{
    activo: Activo; // ¡Singular! El activo a editar
    // Listas para los Selects
    empleados: Empleado[];
    gerencias: Ubicacion[];
    categorias: Categoria[];
    subcategorias: SubCategoria[];
    subsubcategorias: SubSubCategoria[];
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Activos', href: '/activos' },
    { title: 'Editar', href: '#' },
];

// 2. INICIALIZAMOS 'useForm' CON LOS PROPS
const form = useForm({
    // Usamos '?? ""' para campos de texto por si son 'null'
    codigo: props.activo.codigo ?? '',
    serial: props.activo.serial ?? '',
    marca: props.activo.marca ?? '',
    modelo: props.activo.modelo ?? '',
    color: props.activo.color ?? '',
    estado: props.activo.estado ?? 'Buen estado',

    // Usamos 'as number | null' para FKs opcionales
    // y dejamos los requeridos tal cual.
    empleado: props.activo.empleado as number | null, 
    ubicacion: props.activo.ubicacion, 
    categoria_id: props.activo.categoria_id,
    subcategoria_id: props.activo.subcategoria_id as number | null,
    sub_subcategoria_id: props.activo.subsubcategoria_id as number | null,
});

// 3. FUNCIÓN DE ENVÍO
const submit = () => {
    // Usamos 'form.put' y el 'id' del prop
    form.put(`/Activo/${props.activo.id}`, {
        // Opcional: preservar 'scroll' al guardar
        preserveScroll: true,
    });
};

// --- Lógica de filtrado y 'watchers' (ahora usan 'props.lista') ---

const filteredSubcategorias = computed(() => {
    if (!form.categoria_id) return [];
    // ¡Usa la lista de props, no un 'ref' local!
    return props.subcategorias.filter(
        subcat => subcat.categoria_id === Number(form.categoria_id)
    );
});

const filteredSubSubCategorias = computed(() => {
    if (!form.subcategoria_id) return [];
    return props.subsubcategorias.filter(
        subsubcat => subsubcat.subcategoria_id === Number(form.subcategoria_id)
    );
});

const isAlmacenSelected = computed(() => {
    if (!form.ubicacion) return false;
    const selectedUbicacion = props.gerencias.find(
        gern => gern.id === Number(form.ubicacion)
    );
    return selectedUbicacion?.name === 'Almacen';
});

// Watchers (ahora funcionan porque 'as number | null' lo permite)
watch(() => form.categoria_id, () => {
    form.subcategoria_id = null;
    form.sub_subcategoria_id = null;
});

watch(() => form.subcategoria_id, () => {
    form.sub_subcategoria_id = null;
});

watch(isAlmacenSelected, (isAlmacen) => {
    if (isAlmacen) {
        form.empleado = null;
    }
});

watch(() => form.codigo, (newValue) => {
    if (newValue) {
        form.codigo = newValue.replace(/\D/g, '');
    }
});

</script>

<template>
    <Head title="Editar Activo" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <form @submit.prevent="submit">
            <Card class="flex flex-1 mx-40 my-4">
                <CardHeader class="text-center gap-2">
                    <CardTitle>Editar Bien Nacional</CardTitle>
                    <CardDescription>Actualice los datos del bien nacional.</CardDescription>
                </CardHeader>
                <CardContent>
                    <div class="flex flex-col gap-1 rounded-xl p-4">

                        <div class="grid gap-2 mb-3">
                            <Label for="codigo">Codigo de Bien</Label>
                            <Input id="codigo" v-model="form.codigo" maxlength="7" type="text" inputmode="numeric" placeholder="Codigo" />
                            <InputError class="mt-2" :message="form.errors.codigo" />
                        </div>

                        <div v-for="(label, key) in { marca: 'Marca *', modelo: 'Modelo *', serial: 'Serial', color: 'Color' }"
                            :key="key" class="grid gap-2 mb-3">
                            <Label :for="key">{{ label }}</Label>
                            <Input :id="key" v-model="form[key]" type="text" :placeholder="label" />
                            <InputError class="mt-2" :message="form.errors[key]" />
                        </div>

                        <div class="grid grid-cols-[repeat(auto-fit,_minmax(250px,_1fr))] gap-4 mt-4">

                            <div class="grid gap-2">
                                <Label for="ubicacion">Ubicacion *</Label>
                                <Select id="ubicacion" v-model="form.ubicacion">
                                    <SelectTrigger><SelectValue placeholder="Ubicacion" /></SelectTrigger>
                                    <SelectContent>
                                        <SelectGroup>
                                            <SelectLabel>Ubicacion</SelectLabel>
                                            <SelectItem v-for="gern in props.gerencias" :key="gern.id" :value="gern.id">
                                                {{ gern.name }}
                                            </SelectItem>
                                        </SelectGroup>
                                    </SelectContent>
                                </Select>
                                <InputError class="mt-2" :message="form.errors.ubicacion" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="empleado">Empleado</Label>
                                <Select id="empleado" v-model="form.empleado" :disabled="isAlmacenSelected">
                                    <SelectTrigger><SelectValue placeholder="Empleado" /></SelectTrigger>
                                    <SelectContent>
                                        <SelectGroup>
                                            <SelectLabel>Empleado</SelectLabel>
                                            <SelectItem v-for="emp in props.empleados" :key="emp.id" :value="emp.id">
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
                                    <SelectTrigger><SelectValue placeholder="Categoria" /></SelectTrigger>
                                    <SelectContent>
                                        <SelectGroup>
                                            <SelectLabel>Categoria</SelectLabel>
                                            <SelectItem v-for="cat in props.categorias" :key="cat.id" :value="cat.id">
                                                {{ cat.name }}
                                            </SelectItem>
                                        </SelectGroup>
                                    </SelectContent>
                                </Select>
                                <InputError class="mt-2" :message="form.errors.categoria_id" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="subcategoria_id">Subcategoria</Label>
                                <Select id="subcategoria_id" v-model="form.subcategoria_id"
                                    :disabled="!form.categoria_id || filteredSubcategorias.length === 0">
                                    <SelectTrigger><SelectValue placeholder="Subcategoria" /></SelectTrigger>
                                    <SelectContent>
                                        <SelectGroup>
                                            <SelectLabel>Subcategoria</SelectLabel>
                                            <SelectItem v-for="subcat in filteredSubcategorias" :key="subcat.id" :value="subcat.id">
                                                {{ subcat.name }}
                                            </SelectItem>
                                        </SelectGroup>
                                    </SelectContent>
                                </Select>
                                <InputError class="mt-2" :message="form.errors.subcategoria_id" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="sub_subcategoria_id">Sub-subcategoria</Label>
                                <Select id="sub_subcategoria_id" v-model="form.sub_subcategoria_id"
                                    :disabled="!form.subcategoria_id || filteredSubSubCategorias.length === 0">
                                    <SelectTrigger><SelectValue placeholder="Sub-subcategoria" /></SelectTrigger>
                                    <SelectContent>
                                        <SelectGroup>
                                            <SelectLabel>Sub-subcategoria</SelectLabel>
                                            <SelectItem v-for="subsubcat in filteredSubSubCategorias" :key="subsubcat.id" :value="subsubcat.id">
                                                {{ subsubcat.name }}
                                            </SelectItem>
                                        </SelectGroup>
                                    </SelectContent>
                                </Select>
                                <InputError class="mt-2" :message="form.errors.sub_subcategoria_id" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="estado">Estado *</Label>
                                <Select id="estado" v-model="form.estado">
                                    <SelectTrigger><SelectValue placeholder="Estado" /></SelectTrigger>
                                    <SelectContent>
                                        <SelectGroup>
                                            <SelectLabel>Estado</SelectLabel>
                                            <SelectItem v-for="status in ['Buen estado', 'Regular', 'Mal estado', 'Dañado']" :key="status" :value="status">
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
                    <Button typeD="submit" class="mx-auto mt-2 items-center justify-center w-md" :disabled="form.processing">
                        <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                        Actualizar Bien Nacional
                    </Button>
                </CardFooter>
            </Card>
        </form>
    </AppLayout>
</template>