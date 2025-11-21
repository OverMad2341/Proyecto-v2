<script setup lang="ts">
import { computed, h, ref } from 'vue';
import { Head, usePage, Link } from '@inertiajs/vue3';
import { Activo, type BreadcrumbItem, type AppPageProps } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';

import type {
    ColumnDef,
    ColumnFiltersState,
    SortingState,
    VisibilityState,
    Updater,
} from "@tanstack/vue-table"
import {
    FlexRender,
    getCoreRowModel,
    getFilteredRowModel,
    getPaginationRowModel,
    getSortedRowModel,
    useVueTable,
} from "@tanstack/vue-table"
import { valueUpdater } from "@/lib/utils"

import {
    Table, TableBody, TableCell, TableHead, TableHeader, TableRow,
} from '@/components/ui/table'
import { ScrollArea, ScrollBar } from '@/components/ui/scroll-area'
import { Button } from '@/components/ui/button';
import { Checkbox } from "@/components/ui/checkbox"
import {
    DropdownMenu,
    DropdownMenuCheckboxItem,
    DropdownMenuContent,
    DropdownMenuItem, 
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu"
import { Input } from "@/components/ui/input"
import { ArrowUpDown, ChevronDown, Pencil, Download } from 'lucide-vue-next';

interface ActivoPageProps extends AppPageProps {
    activos: Activo[];
}
const props = usePage<ActivoPageProps>().props;
const data = computed(() => props.activos);

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Activos', href: '/activos' },
    { title: 'Lista de activos', href: '/Activo' },
];

const columns: ColumnDef<Activo>[] = [
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
    {
        accessorKey: "codigo",
        header: ({ column }) => h(Button, {
            variant: "ghost",
            onClick: () => column.toggleSorting(column.getIsSorted() === "asc"),
        }, () => ["Código", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })]),
        cell: ({ row }) => h("div", {}, row.getValue("codigo") ?? 'No tiene'),
    },
    {
        accessorKey: "marca",
        header: ({ column }) => h(Button, {
            variant: "ghost",
            onClick: () => column.toggleSorting(column.getIsSorted() === "asc"),
        }, () => ["Marca", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })]),
    },
    {
        accessorKey: "modelo",
        header: ({ column }) => h(Button, {
            variant: "ghost",
            onClick: () => column.toggleSorting(column.getIsSorted() === "asc"),
        }, () => ["Modelo", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })]),
    },
    {
        accessorKey: "serial",
        header: ({ column }) => h(Button, {
            variant: "ghost",
            onClick: () => column.toggleSorting(column.getIsSorted() === "asc"),
        }, () => ["Serial", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })]),
        cell: ({ row }) => h("div", {}, row.getValue("serial") ?? 'No tiene'),
    },
    {
        // ACTUALIZADO: Usamos 'custodio' en lugar de 'empleado'
        id: "empleado",
        accessorFn: row => row.custodio?.name, 
        header: ({ column }) => h(Button, {
            variant: "ghost",
            onClick: () => column.toggleSorting(column.getIsSorted() === "asc"),
        }, () => ["Empleado", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })]),
        cell: ({ row }) => h("div", {}, row.original.custodio?.name ? row.original.custodio?.name + ' ' + row.original.custodio?.surname : 'En almacen'),
    },
    {
        // ACTUALIZADO: Usamos 'gerencia' en lugar de 'ubicacion'
        id: "ubicacion",
        accessorFn: row => row.gerencia?.name,
        header: ({ column }) => h(Button, {
            variant: "ghost",
            onClick: () => column.toggleSorting(column.getIsSorted() === "asc"),
        }, () => ["Ubicación", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })]),
        cell: ({ row }) => h("div", {}, row.original.gerencia?.name ?? 'N/A'),
    },
    {
        id: "categoria",
        accessorFn: row => row.categoria?.name,
        header: ({ column }) => h(Button, {
            variant: "ghost",
            onClick: () => column.toggleSorting(column.getIsSorted() === "asc"),
        }, () => ["Categoria", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })]),
        cell: ({ row }) => h("div", {}, row.original.categoria?.name ?? 'N/A'),
    },
    {
        accessorKey: "estado",
        header: ({ column }) => h(Button, {
            variant: "ghost",
            onClick: () => column.toggleSorting(column.getIsSorted() === "asc"),
        }, () => ["Estado", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })]),
    },
    {
        id: "actions",
        enableHiding: false,
        cell: ({ row }) => {
            const activo = row.original;
            return h('div', { class: 'text-center' }, [
                h(Button, { asChild: true, variant: 'outline', size: 'sm', class: 'mx-1' },
                    () => h(Link, { href: `/Activo/${activo.id}/edit` },
                        () => h(Pencil, { class: 'h-4 w-4' })
                    )
                )
            ]);
        },
    },
]

const sorting = ref<SortingState>([])
const columnFilters = ref<ColumnFiltersState>([])
const columnVisibility = ref<VisibilityState>({})
const rowSelection = ref<Record<string, boolean>>({}) 

const table = useVueTable({
    get data() { return data.value },
    columns,
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
    getSortedRowModel: getSortedRowModel(),
    getFilteredRowModel: getFilteredRowModel(),
    getRowId: (row) => row.id.toString(), 
    onSortingChange: (updaterOrValue: Updater<SortingState>) => valueUpdater(updaterOrValue, sorting),
    onColumnFiltersChange: (updaterOrValue: Updater<ColumnFiltersState>) => valueUpdater(updaterOrValue, columnFilters),
    onColumnVisibilityChange: (updaterOrValue: Updater<VisibilityState>) => valueUpdater(updaterOrValue, columnVisibility),
    onRowSelectionChange: (updaterOrValue: Updater<Record<string, boolean>>) => valueUpdater(updaterOrValue, rowSelection),
    state: {
        get sorting() { return sorting.value },
        get columnFilters() { return columnFilters.value },
        get columnVisibility() { return columnVisibility.value },
        get rowSelection() { return rowSelection.value },
    },
})

const handleExport = (format: 'xlsx' | 'ods') => {
    const selectedIds = Object.keys(rowSelection.value);
    if (selectedIds.length === 0) return;
    const url = `/activos/export?ids=${selectedIds.join(',')}&format=${format}`;
    window.location.href = url;
}
</script>

<template>
    <Head title="Listas de activos" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="relative flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min m-4 p-4 bg-background/60">
            
            <div class="flex items-center py-4 gap-2">
                <Input class="max-w-sm" placeholder="Filtrar por código..."
                    :model-value="table.getColumn('codigo')?.getFilterValue() as string"
                    @update:model-value="(value: string) => table.getColumn('codigo')?.setFilterValue(value)" />
                
                <DropdownMenu v-if="Object.keys(rowSelection).length > 0">
                    <DropdownMenuTrigger as-child>
                        <Button variant="outline" class="bg-green-600 text-white hover:bg-green-700 hover:text-white border-green-700">
                            <Download class="mr-2 h-4 w-4" />
                            Exportar ({{ Object.keys(rowSelection).length }})
                            <ChevronDown class="ml-2 h-4 w-4" />
                        </Button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent>
                        <DropdownMenuItem @click="handleExport('xlsx')">
                            Excel (.xlsx)
                        </DropdownMenuItem>
                        <DropdownMenuItem @click="handleExport('ods')">
                            LibreOffice (.ods)
                        </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>

                <DropdownMenu>
                    <DropdownMenuTrigger as-child>
                        <Button variant="outline" class="ml-auto">
                            Columnas <ChevronDown class="ml-2 h-4 w-4" />
                        </Button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end">
                        <DropdownMenuCheckboxItem v-for="column in table.getAllColumns().filter((column) => column.getCanHide())"
                            :key="column.id" class="capitalize" :model-value="column.getIsVisible()"
                            @update:model-value="(value) => column.toggleVisibility(!!value)">
                            {{ column.id }}
                        </DropdownMenuCheckboxItem>
                    </DropdownMenuContent>
                </DropdownMenu>
            </div>

            <ScrollArea class="rounded-md border h-[calc(100vh-300px)]">
                <Table>
                    <TableHeader>
                        <TableRow v-for="headerGroup in table.getHeaderGroups()" :key="headerGroup.id">
                            <TableHead v-for="header in headerGroup.headers" :key="header.id">
                                <FlexRender v-if="!header.isPlaceholder" :render="header.column.columnDef.header" :props="header.getContext()" />
                            </TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <template v-if="table.getRowModel().rows?.length">
                            <TableRow v-for="row in table.getRowModel().rows" :key="row.id" :data-state="row.getIsSelected() && 'selected'">
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
                <ScrollBar orientation="horizontal" />
            </ScrollArea>

            <div class="flex items-center justify-end space-x-2 py-4">
                <div class="flex-1 text-sm text-muted-foreground">
                    {{ table.getFilteredSelectedRowModel().rows.length }} de {{ table.getFilteredRowModel().rows.length }} fila(s) seleccionada(s).
                </div>
                <div class="space-x-2">
                    <Button variant="outline" size="sm" :disabled="!table.getCanPreviousPage()" @click="table.previousPage()">Anterior</Button>
                    <Button variant="outline" size="sm" :disabled="!table.getCanNextPage()" @click="table.nextPage()">Siguiente</Button>
                </div>
            </div>

        </div>
    </AppLayout>
</template>