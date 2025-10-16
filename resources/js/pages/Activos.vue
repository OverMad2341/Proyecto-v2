<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { activos } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Form, Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';




const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Activos',
    href: activos().url,
  },
];
</script>

<template>

  <Head title="Activos" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-row gap-4 overflow-x-auto rounded-xl p-4">

      <!-- Lista de activos -->
      <Link
        class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-0">
          <img src="/iconcnti.svg" alt="Logo CNTI" class="opacity-25">
        </div>
        <div class="relative z-10 min-h-[100vh] flex items-center justify-center">
          <div class="flex flex-col items-center text-center w-full max-w-2xl mx-auto">
            <div class="text-2xl mb-4">
              <span class="mb-0.5 truncate leading-tight font-semibold">Lista de activos</span>
            </div>
            <div class="text-lg">
              <span class="mb-0.5 truncate leading-tight italic whitespace-break-spaces">
                Lista controlada de recursos tecnológicos, inmuebles y equipos, para gestionar y proteger el valor.
              </span>
            </div>
          </div>
        </div>
      </Link>

      <!-- Crear o Modificar activos -->
      <Link
        class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">

        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-0">
          <img src="/iconcnti.svg" alt="Logo CNTI" class="opacity-25">
        </div>
        <div class="relative z-10 min-h-[100vh] flex items-center justify-center">
          <div class="flex flex-col items-center text-center w-full max-w-2xl mx-auto">
            <div class="text-2xl mb-4">
              <span class="mb-0.5 truncate leading-tight font-semibold">Crear o Modificar de activos</span>
            </div>
            <div class="text-lg">
              <span class="mb-0.5 truncate leading-tight italic whitespace-break-spaces">
                Agregar o modificar activos para llevar un control de los bienes de la empresa.
              </span>
            </div>
          </div>
        </div>
      </Link>

      <!-- Exportar activos -->
      <Link
        class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-0">
          <img src="/iconcnti.svg" alt="Logo CNTI" class="opacity-25">
        </div>
        <div class="relative z-10 min-h-[100vh] flex items-center justify-center">
          <div class="flex flex-col items-center text-center w-full max-w-2xl mx-auto">
            <div class="text-2xl mb-4">
              <span class="mb-0.5 truncate leading-tight font-semibold">Exportar activos</span>
            </div>
            <div class="text-lg">
              <span class="mb-0.5 truncate leading-tight italic whitespace-break-spaces">
                Exportar activos a otros archivos y tener un respaldo de la información.
              </span>
            </div>
          </div>
        </div>
      </Link>
    </div>
  </AppLayout>
</template>
