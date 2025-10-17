<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { activos } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Form, Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Lista de activos',
        href: activos().url,
    },
];
</script>

<template>
    <Head title="Listas de activos" />

</template>