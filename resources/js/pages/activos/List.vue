<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Activos, ListaActivos } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Form, Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

interface Activo {
  nombre: string;
  tipo: string;
  estado: string;
  ubicacion: string;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Lista de activos',
        href: ListaActivos().url,
    },
];

const activosList = (usePage().props.activos as Activo[]) ?? [];
</script>

<template>
    <Head title="Listas de activos" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="w-full max-w-3xl mx-auto mt-8">
            <h2 class="text-2xl font-bold mb-4 text-center">Activos de la empresa</h2>
            <ul class="divide-y divide-gray-200 rounded-xl border border-gray-200 bg-white shadow">
                <li v-if="activosList.length === 0" class="p-6 text-center text-gray-500">No hay activos registrados.</li>
                <li v-for="(activo, idx) in activosList" :key="idx" class="p-6 flex flex-col md:flex-row md:items-center gap-2">
                    <div class="flex-1">
                        <div class="font-semibold text-lg">{{ activo.nombre }}</div>
                        <div class="text-sm text-gray-500">Tipo: {{ activo.tipo }}</div>
                    </div>
                    <div class="flex-1">
                        <div class="text-sm">Estado: <span class="font-medium text-emerald-700">{{ activo.estado }}</span></div>
                        <div class="text-sm">Ubicación: <span class="font-medium text-blue-700">{{ activo.ubicacion }}</span></div>
                    </div>
                </li>
            </ul>
        </div>
    </AppLayout>
</template>