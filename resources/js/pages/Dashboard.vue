<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import ChartDoughnut from '@/components/ChartDoughnut.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];
</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <!-- Card 1: Total bienes nacionales -->
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border bg-white/50 dark:bg-black/40">
                    <div class="h-full w-full flex flex-col items-center justify-center p-6 text-center">
                        <h3 class="text-sm font-medium text-sidebar-text/90 dark:text-sidebar-text">Bienes Nacionales</h3>
                        <div class="mt-3 text-5xl font-extrabold leading-none text-primary">0</div>
                        <p class="mt-2 text-sm text-[#292929]">Total registrado</p>
                    </div>
                </div>

                <!-- Card 2: En uso -->
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border bg-white/50 dark:bg-black/40">
                    <div class="h-full w-full flex flex-col items-center justify-center p-6 text-center">
                        <h3 class="text-sm font-medium text-sidebar-text/90 dark:text-sidebar-text">En uso</h3>
                        <div class="mt-3 text-5xl font-extrabold leading-none text-emerald-600">0</div>
                        <p class="mt-2 text-sm text-[#292929]">Actualmente asignados</p>
                    </div>
                </div>

                <!-- Card 3: En almacén -->
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border bg-white/50 dark:bg-black/40">
                    <div class="h-full w-full flex flex-col items-center justify-center p-6 text-center">
                        <h3 class="text-sm font-medium text-sidebar-text/90 dark:text-sidebar-text">En almacén</h3>
                        <div class="mt-3 text-5xl font-extrabold leading-none text-amber-600">0</div>
                        <p class="mt-2 text-sm text-[#292929]">Disponibles en inventario</p>
                    </div>
                </div>
            </div>
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                <div class="flex flex-col">
                    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                        <ChartDoughnut />
                        <ChartDoughnut />
                        <ChartDoughnut />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
