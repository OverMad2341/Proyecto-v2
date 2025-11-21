<script setup lang="ts">
import axios from 'axios';
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { 
    Dialog, 
    DialogContent, 
    DialogDescription, 
    DialogFooter, 
    DialogHeader, 
    DialogTitle 
} from '@/components/ui/dialog';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import { 
    Alert, 
    AlertDescription, 
    AlertTitle 
} from '@/components/ui/alert';
import { UploadCloud, FileSpreadsheet, AlertCircle, CheckCircle, Loader2, XCircle } from 'lucide-vue-next';
import { ScrollArea, ScrollBar } from '@/components/ui/scroll-area';
import type { BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Activos', href: '/activos' },
    { title: 'Importar', href: '#' },
];


// --- Tipos ---
interface PreviewActivo {
    temp_id: number;
    codigo: string;
    serial: string;
    marca: string;
    modelo: string;
    color: string;
    estado: string;
    
    ubicacion_nombre: string;
    categoria_nombre: string;
    subcategoria_nombre: string;
    subsubcategoria_nombre: string;
    
    ubicacion_id: number | null;
    categoria_id: number | null;
    subcategoria_id: number | null;
    subsubcategoria_id: number | null;
    
    has_error: boolean;
    error_message: string;
}

// --- Estado ---
const fileInput = ref<HTMLInputElement | null>(null);
const file = ref<File | null>(null);
const isPreviewOpen = ref(false);
const isProcessing = ref(false);
const isSaving = ref(false);
const errorMessage = ref<string | null>(null);
const previewData = ref<PreviewActivo[]>([]);
const isDragging = ref(false); // <--- Nuevo estado para efecto visual

// --- Funciones ---

const triggerFileInput = () => {
    errorMessage.value = null;
    fileInput.value?.click();
};

const handleFileChange = (event: Event) => {
    const target = event.target as HTMLInputElement;
    if (target.files && target.files.length > 0) {
        processFile(target.files[0]);
    }
};

// --- Lógica de Drag & Drop ---
const handleDragOver = (e: DragEvent) => {
    e.preventDefault(); // Necesario para permitir el drop
    isDragging.value = true;
};

const handleDragLeave = (e: DragEvent) => {
    e.preventDefault();
    isDragging.value = false;
};

const handleDrop = (e: DragEvent) => {
    e.preventDefault();
    isDragging.value = false;

    if (e.dataTransfer?.files && e.dataTransfer.files.length > 0) {
        processFile(e.dataTransfer.files[0]);
    }
};

// Función común para procesar el archivo (venga de input o drop)
const processFile = (selectedFile: File) => {
    file.value = selectedFile;
    errorMessage.value = null;
    uploadAndPreview();
};

const uploadAndPreview = async () => {
    if (!file.value) return;
    
    isProcessing.value = true;
    errorMessage.value = null;

    const formData = new FormData();
    formData.append('file', file.value);

    try {
        const response = await axios.post('/activos/import-preview', formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
        });
        
        previewData.value = response.data.data;
        isPreviewOpen.value = true; 
    } catch (error: any) {
        console.error(error);
        
        file.value = null;
        if (fileInput.value) fileInput.value.value = ''; 

        if (error.response && error.response.data && error.response.data.message) {
            errorMessage.value = error.response.data.message;
        } else {
            errorMessage.value = "Ocurrió un error al procesar el archivo. Verifica el formato (.xlsx, .ods).";
        }
    } finally {
        isProcessing.value = false;
    }
};

const saveBatch = () => {
    isSaving.value = true;
    router.post('/activos/import-store', { activos: previewData.value }, {
        onSuccess: () => {
            isPreviewOpen.value = false;
            file.value = null;
            previewData.value = [];
            isSaving.value = false;
        },
        onError: () => {
            isSaving.value = false;
        }
    });
};

const removeRow = (index: number) => {
    previewData.value.splice(index, 1);
};
</script>

<template>
    <Head title="Importar Activos" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-col items-center justify-center p-8 min-h-[80vh]">
            
            <div class="flex flex-col items-center justify-center w-full max-w-2xl space-y-4">
                
                <Alert v-if="errorMessage" variant="destructive" class="mb-4 animate-in fade-in slide-in-from-top-2">
                    <XCircle class="h-4 w-4" />
                    <AlertTitle>Error</AlertTitle>
                    <AlertDescription>
                        {{ errorMessage }}
                    </AlertDescription>
                </Alert>

                <!-- 
                    ZONA DROPZONE ACTIVADA 
                    Agregamos los eventos @dragover, @dragleave y @drop
                    Y una clase dinámica para cambiar el borde cuando arrastras
                -->
                <div 
                    @dragover="handleDragOver"
                    @dragleave="handleDragLeave"
                    @drop="handleDrop"
                    :class="[
                        'flex flex-col items-center justify-center text-center space-y-6 rounded-xl border border-dashed p-14 transition-colors w-full bg-background/60',
                        isDragging ? 'border-blue-500 bg-blue-500/10' : 'border-border hover:bg-muted/50'
                    ]"
                >
                    
                    <div class="rounded-full bg-muted p-4 pointer-events-none"> <!-- pointer-events-none evita conflictos al soltar sobre el icono -->
                        <Loader2 v-if="isProcessing" class="h-12 w-12 animate-spin text-blue-600" />
                        <FileSpreadsheet v-else-if="file" class="h-12 w-12 text-green-600" />
                        <UploadCloud v-else class="h-12 w-12 text-muted-foreground" />
                    </div>

                    <div class="space-y-2 pointer-events-none">
                        <h3 class="text-2xl font-bold tracking-tight">
                            {{ isProcessing ? 'Procesando...' : (file ? 'Archivo listo' : (isDragging ? 'Suelta el archivo aquí' : 'Importar Bienes Nacionales')) }}
                        </h3>
                        <p class="text-sm text-muted-foreground max-w-xs mx-auto">
                            {{ file 
                                ? `Archivo: ${file.name}` 
                                : 'Arrastra un archivo Excel (.xlsx, .ods) o haz clic para seleccionar.' 
                            }}
                        </p>
                    </div>

                    <input 
                        type="file" 
                        ref="fileInput" 
                        class="hidden" 
                        accept=".xlsx, .xls, .ods"
                        @change="handleFileChange"
                    />

                    <div class="flex gap-4">
                        <Button v-if="!file" @click="triggerFileInput" size="lg">
                            Seleccionar Archivo
                        </Button>
                        <Button v-else variant="outline" @click="triggerFileInput" :disabled="isProcessing">
                            Cambiar Archivo
                        </Button>
                        
                        <Button v-if="file && !isProcessing && previewData.length > 0" @click="isPreviewOpen = true" variant="secondary">
                            Ver Previsualización
                        </Button>
                    </div>
                </div>
            </div>

            <!-- MODAL DE PREVISUALIZACIÓN -->
            <Dialog :open="isPreviewOpen" @update:open="isPreviewOpen = $event">
                <DialogContent class="max-w-7xl h-[90vh] flex flex-col p-0">
                    <DialogHeader class="p-6 pb-2">
                        <DialogTitle>Verificar Datos de Importación</DialogTitle>
                        <DialogDescription>
                            Revisa los datos detectados. Puedes editar los campos de texto directamente.
                        </DialogDescription>
                    </DialogHeader>

                    <ScrollArea class="flex-1 p-6 pt-0">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead class="w-[50px]">#</TableHead>
                                    <TableHead>Código</TableHead>
                                    <TableHead>Marca</TableHead>
                                    <TableHead>Modelo</TableHead>
                                    <TableHead>Serial</TableHead>
                                    <TableHead>Estado</TableHead>
                                    <TableHead>Ubicación (Detectada)</TableHead>
                                    <TableHead>Categoría (Detectada)</TableHead>
                                    <TableHead>Status</TableHead>
                                    <TableHead class="text-right">Acción</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                <TableRow v-for="(row, index) in previewData" :key="row.temp_id" class="hover:bg-muted/50">
                                    <TableCell>{{ index + 1 }}</TableCell>
                                    <TableCell><Input v-model="row.codigo" class="h-8 w-[100px]" /></TableCell>
                                    <TableCell><Input v-model="row.marca" class="h-8 w-[100px]" /></TableCell>
                                    <TableCell><Input v-model="row.modelo" class="h-8 w-[100px]" /></TableCell>
                                    <TableCell><Input v-model="row.serial" class="h-8 w-[120px]" /></TableCell>
                                    <TableCell><Input v-model="row.estado" class="h-8 w-[100px]" /></TableCell>
                                    <TableCell>
                                        <div class="flex flex-col text-xs">
                                            <span :class="{'text-red-500 font-bold': !row.ubicacion_id}">
                                                {{ row.ubicacion_nombre || 'Vacio' }}
                                            </span>
                                            <span v-if="!row.ubicacion_id" class="text-[10px] text-muted-foreground">No encontrado en BD</span>
                                        </div>
                                    </TableCell>
                                    <TableCell>
                                        <div class="flex flex-col text-xs">
                                            <span :class="{'text-red-500 font-bold': !row.categoria_id}">
                                                {{ row.categoria_nombre || 'Vacio' }}
                                            </span>
                                            <span v-if="row.subcategoria_nombre" class="text-muted-foreground">
                                                > {{ row.subcategoria_nombre }}
                                            </span>
                                        </div>
                                    </TableCell>
                                    <TableCell>
                                        <div v-if="row.has_error || !row.ubicacion_id || !row.categoria_id" class="flex items-center text-red-500">
                                            <AlertCircle class="w-5 h-5" />
                                        </div>
                                        <div v-else class="flex items-center text-green-500">
                                            <CheckCircle class="w-5 h-5" />
                                        </div>
                                    </TableCell>
                                    <TableCell class="text-right">
                                        <Button variant="ghost" size="icon" class="h-8 w-8 text-red-500 hover:text-red-700" @click="removeRow(index)">
                                            X
                                        </Button>
                                    </TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                        <ScrollBar orientation="horizontal" />
                    </ScrollArea>

                    <DialogFooter class="p-6 pt-2 border-t bg-background z-10">
                        <div class="flex justify-between w-full items-center">
                            <span class="text-sm text-muted-foreground">
                                Total: {{ previewData.length }} activos
                            </span>
                            <div class="space-x-2">
                                <Button variant="outline" @click="isPreviewOpen = false">Cancelar</Button>
                                <Button @click="saveBatch" :disabled="isSaving || previewData.length === 0">
                                    <Loader2 v-if="isSaving" class="mr-2 h-4 w-4 animate-spin" />
                                    {{ isSaving ? 'Guardando...' : 'Confirmar e Importar' }}
                                </Button>
                            </div>
                        </div>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        </div>
    </AppLayout>
</template>