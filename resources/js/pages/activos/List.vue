<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Activo, type BreadcrumbItem, type AppPageProps } from '@/types';
import { Head, usePage, Link, router } from '@inertiajs/vue3';
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'
import { Button } from '@/components/ui/button';
import { Pencil, FileDown } from 'lucide-vue-next';
import { computed } from 'vue';

interface ActivoPageProps extends AppPageProps {
    activos: Activo[];
}

const props = usePage<ActivoPageProps>().props;
const activos = computed(() => props.activos);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Activos',
        href: '/activos',
    },
    {
        title: 'Lista de activos',
        href: '/Activo',
    },
];

</script>

<template>

    <Head title="Listas de activos" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="relative min-h-screen flex-1 rounded-xl text-center border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min m-4">
            <Table>
                <TableCaption>Lista de activos</TableCaption>
                <TableHeader>
                    <TableRow>
                        <TableHead>Código</TableHead>
                        <TableHead>Marca</TableHead>
                        <TableHead>Modelo</TableHead>
                        <TableHead>Serial</TableHead>
                        <TableHead>Color</TableHead>
                        <TableHead>Empleado</TableHead>
                        <TableHead>Ubicación</TableHead>
                        <TableHead>Categoria</TableHead>
                        <TableHead>Estado</TableHead>
                        <TableHead class="text-center">Acciones</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="activo in activos" :key="activo.id">
                        <TableCell>{{ activo.codigo ?? 'No tiene' }}</TableCell>
                        <TableCell>{{ activo.marca }}</TableCell>
                        <TableCell>{{ activo.modelo }}</TableCell>
                        <TableCell>{{ activo.serial ?? 'No tiene' }}</TableCell>
                        <TableCell>{{ activo.color ?? 'No tiene' }}</TableCell>
                        <TableCell>{{ activo.empleado }}</TableCell>
                        <TableCell>{{ activo.ubicacion }}</TableCell>
                        <TableCell>{{ activo.categoria_id }}</TableCell>
                        <TableCell>{{ activo.estado }}</TableCell>
                        <TableCell>
                            <Button as-child variant="outline" size="sm" class="mx-1">
                                <Link :href="`/Activo/${activo.id}/edit`">
                                <Pencil class="h-4 w-4" />
                                </Link>
                            </Button>
                            <Button as-child variant="outline" size="sm" class="mx-1">
                                <Link :href="``">
                                <FileDown class="h-4 w-4" />
                                </Link>
                            </Button>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>