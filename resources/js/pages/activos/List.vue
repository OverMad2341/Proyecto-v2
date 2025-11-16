<script setup lang="ts">
import { computed, h, ref } from 'vue';
import { Head, usePage, Link, router } from '@inertiajs/vue3';
import { Activo, type BreadcrumbItem, type AppPageProps } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';

// --- Imports de @tanstack/vue-table ---
import type {
    ColumnDef,
    ColumnFiltersState,
    SortingState,
    VisibilityState,
} from "@tanstack/vue-table"
import {
    FlexRender,
    getCoreRowModel,
    getFilteredRowModel,
    getPaginationRowModel,
    getSortedRowModel,
    useVueTable,
} from "@tanstack/vue-table"
import { valueUpdater } from "@/lib/utils" // Asumo que tienes este helper de tu ejemplo

// --- Imports de UI (shadcn/ui) ---
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'
import { Button } from '@/components/ui/button';
import { Checkbox } from "@/components/ui/checkbox"
import {
    DropdownMenu,
    DropdownMenuCheckboxItem,
    DropdownMenuContent,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu"
import { Input } from "@/components/ui/input"
import { ArrowUpDown, ChevronDown, Pencil, FileDown } from 'lucide-vue-next';

// --- Lógica de Props (Tu código original) ---
interface ActivoPageProps extends AppPageProps {
    activos: Activo[];
}
const props = usePage<ActivoPageProps>().props;
// Usamos computed para que los datos sean reactivos para la tabla
const data = computed(() => props.activos);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Activos',
        href: '/activos',
    },
    {
        title: 'Lista de activos',
        href: '/Activo', // Asegúrate que esta ruta es la correcta
    },
];

// --- Definición de Columnas (La parte principal de la adaptación) ---
const columns: ColumnDef<Activo>[] = [
    // 1. Columna de Selección (de tu ejemplo)
    {
        id: "select",
        header: ({ table }) => h(Checkbox, {
            "modelValue": table.getIsAllPageRowsSelected() || (table.getIsSomePageRowsSelected() && "indeterminate"),
            "onUpdate:modelValue": value => table.toggleAllPageRowsSelected(!!value),
            "ariaLabel": "Seleccionar todo",
        }),
        cell: ({ row }) => h(Checkbox, {
            "modelValue": row.getIsSelected(),
            "onUpdate:modelValue": value => row.toggleSelected(!!value),
            "ariaLabel": "Seleccionar fila",
        }),
        enableSorting: false,
        enableHiding: false,
    },
    // 2. Columnas de tus 'Activos'
    {
        accessorKey: "codigo",
        header: ({ column }) => {
            return h(Button, {
                variant: "ghost",
                onClick: () => column.toggleSorting(column.getIsSorted() === "asc"),
            }, () => ["Código", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })])
        },
        cell: ({ row }) => h("div", {}, row.getValue("codigo") ?? 'No tiene'),
    },
    {
        accessorKey: "marca",
        header: ({ column }) => {
            return h(Button, {
                variant: "ghost",
                onClick: () => column.toggleSorting(column.getIsSorted() === "asc"),
            }, () => ["Marca", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })])
        },
    },
    {
        accessorKey: "modelo",
        header: ({ column }) => {
            return h(Button, {
                variant: "ghost",
                onClick: () => column.toggleSorting(column.getIsSorted() === "asc"),
            }, () => ["Modelo", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })])
        },
    },
    {
        accessorKey: "serial",
        header: ({ column }) => {
            return h(Button, {
                variant: "ghost",
                onClick: () => column.toggleSorting(column.getIsSorted() === "asc"),
            }, () => ["Serial", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })])
        },
        cell: ({ row }) => h("div", {}, row.getValue("serial") ?? 'No tiene'),
    },
    // Usamos 'id' y 'accessorFn' para campos anidados (para que el ordenamiento funcione)
    {
        id: "empleado",
        accessorFn: row => row.empleado?.name,
        header: ({ column }) => {
            return h(Button, {
                variant: "ghost",
                onClick: () => column.toggleSorting(column.getIsSorted() === "asc"),
            }, () => ["Empleado", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })])
        },
        cell: ({ row }) => h("div", {}, row.original.empleado?.name ?? 'En almacen'),
    },
    {
        id: "ubicacion",
        accessorFn: row => row.ubicacion?.name,
        header: ({ column }) => {
            return h(Button, {
                variant: "ghost",
                onClick: () => column.toggleSorting(column.getIsSorted() === "asc"),
            }, () => ["Ubicación", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })])
        },
        cell: ({ row }) => h("div", {}, row.original.ubicacion?.name ?? 'N/A'),
    },
    {
        id: "categoria",
        accessorFn: row => row.categoria?.name,
        header: ({ column }) => {
            return h(Button, {
                variant: "ghost",
                onClick: () => column.toggleSorting(column.getIsSorted() === "asc"),
            }, () => ["Categoria", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })])
        },
        cell: ({ row }) => h("div", {}, row.original.categoria?.name ?? 'N/A'),
    },
    {
        accessorKey: "estado",
        header: ({ column }) => {
            return h(Button, {
                variant: "ghost",
                onClick: () => column.toggleSorting(column.getIsSorted() === "asc"),
            }, () => ["Estado", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })])
        },
    },
    // 3. Columna de Acciones (Tu funcionalidad original)
    {
        id: "actions",
        enableHiding: false,
        cell: ({ row }) => {
            const activo = row.original;
            // Usamos h() para renderizar tus botones de Link dentro de la celda
            return h('div', { class: 'text-center' }, [
                h(Button, { asChild: true, variant: 'outline', size: 'sm', class: 'mx-1' },
                    () => h(Link, { href: `/Activo/${activo.id}/edit` },
                        () => h(Pencil, { class: 'h-4 w-4' })
                    )
                ),
                h(Button, { asChild: true, variant: 'outline', size: 'sm', class: 'mx-1' },
                    () => h(Link, { href: `` }, // Tu href estaba vacío, lo mantengo
                        () => h(FileDown, { class: 'h-4 w-4' })
                    )
                )
            ]);
        },
    },
]

// --- Estado de la Tabla (de tu ejemplo) ---
const sorting = ref<SortingState>([])
const columnFilters = ref<ColumnFiltersState>([])
const columnVisibility = ref<VisibilityState>({})
const rowSelection = ref({})

// --- Instancia de la Tabla (de tu ejemplo, pero con 'data' y 'columns' adaptados) ---
const table = useVueTable({
    // data: data, // Antes era `data` (hardcoded), ahora es la prop reactiva
    // columns: columns, // Antes eran `columns` (hardcoded), ahora son las de Activo
    get data() { return data.value },
    columns,
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
    getSortedRowModel: getSortedRowModel(),
    getFilteredRowModel: getFilteredRowModel(),
    onSortingChange: updaterOrValue => valueUpdater(updaterOrValue, sorting),
    onColumnFiltersChange: updaterOrValue => valueUpdater(updaterOrValue, columnFilters),
    onColumnVisibilityChange: updaterOrValue => valueUpdater(updaterOrValue, columnVisibility),
    onRowSelectionChange: updaterOrValue => valueUpdater(updaterOrValue, rowSelection),
    state: {
        get sorting() { return sorting.value },
        get columnFilters() { return columnFilters.value },
        get columnVisibility() { return columnVisibility.value },
        get rowSelection() { return rowSelection.value },
    },
})

</script>

<template>

    <Head title="Listas de activos" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <!-- Contenedor principal de tu layout original -->
        <div
            class="relative flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min m-4 p-4 bg-background/60">
            <!-- Toolbar de Filtros (de tu ejemplo) -->
            <div class="flex items-center py-4">
                <Input class="max-w-sm" placeholder="Filtrar por código..."
                    :model-value="table.getColumn('codigo')?.getFilterValue() as string"
                    @update:model-value=" table.getColumn('codigo')?.setFilterValue($event)" />
                <DropdownMenu>
                    <DropdownMenuTrigger as-child>
                        <Button variant="outline" class="ml-auto">
                            Columnas <ChevronDown class="ml-2 h-4 w-4" />
                        </Button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end">
                        <DropdownMenuCheckboxItem v-for="column in table.getAllColumns().filter((column) => column.getCanHide())"
                            :key="column.id" class="capitalize" :model-value="column.getIsVisible()"
                            @update:model-value="(value) => {
                                column.toggleVisibility(!!value)
                            }">
                            {{ column.id }}
                        </DropdownMenuCheckboxItem>
                    </DropdownMenuContent>
                </DropdownMenu>
            </div>

            <!-- La Tabla (de tu ejemplo) -->
            <div class="rounded-md border">
                <Table>
                    <TableHeader>
                        <TableRow v-for="headerGroup in table.getHeaderGroups()" :key="headerGroup.id">
                            <TableHead v-for="header in headerGroup.headers" :key="header.id">
                                <FlexRender v-if="!header.isPlaceholder" :render="header.column.columnDef.header"
                                    :props="header.getContext()" />
                            </TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <template v-if="table.getRowModel().rows?.length">
                            <TableRow v-for="row in table.getRowModel().rows" :key="row.id"
                                :data-state="row.getIsSelected() && 'selected'">
                                <TableCell v-for="cell in row.getVisibleCells()" :key="cell.id">
                                    <FlexRender :render="cell.column.columnDef.cell" :props="cell.getContext()" />
                                </TableCell>
                            </TableRow>
                        </template>

                        <TableRow v-else>
                            <TableCell :colspan="columns.length" class="h-24 text-center">
                                No hay resultados.
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>

            <!-- Paginación y conteo (de tu ejemplo) -->
            <div class="flex items-center justify-end space-x-2 py-4">
                <div class="flex-1 text-sm text-muted-foreground">
                    {{ table.getFilteredSelectedRowModel().rows.length }} de
                    {{ table.getFilteredRowModel().rows.length }} fila(s) seleccionada(s).
                </div>
                <div class="space-x-2">
                    <Button variant="outline" size="sm" :disabled="!table.getCanPreviousPage()"
                        @click="table.previousPage()">
                        Anterior
                    </Button>
                    <Button variant="outline" size="sm" :disabled="!table.getCanNextPage()" @click="table.nextPage()">
                        Siguiente
                    </Button>
                </div>
            </div>

        </div>
    </AppLayout>
</template>