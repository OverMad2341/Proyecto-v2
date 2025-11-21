<script setup lang="ts">
import { computed } from "vue";
import { Bar } from 'vue-chartjs';
import { 
    Chart as ChartJS, 
    Title, 
    Tooltip, 
    Legend, 
    BarElement, 
    CategoryScale, 
    LinearScale, 
    type ChartOptions 
} from 'chart.js';

// Registrar módulos de ChartJS
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

// --- 1. Props ---
interface ChartDataPoint {
    fecha: string;
    creados: number;
    editados: number;
}

const props = defineProps<{
    data: ChartDataPoint[];
}>();

// --- 2. Datos Computados ---
const chartData = computed(() => {
    const labels = props.data.map(item => {
        // Aseguramos que la fecha se interprete correctamente añadiendo 'T00:00:00' si es necesario
        // o dejando que el constructor de Date trabaje si el formato es YYYY-MM-DD
        const date = new Date(item.fecha + 'T12:00:00'); // Truco para evitar problemas de zona horaria
        return date.toLocaleDateString('es-ES', { month: 'short', year: 'numeric' });
    });

    return {
        labels: labels,
        datasets: [
            {
                label: 'Activos Creados',
                data: props.data.map(item => item.creados),
                backgroundColor: '#3b82f6', // Blue-500
                borderRadius: 4, // Bordes redondeados en las barras
            },
            {
                label: 'Activos Editados',
                data: props.data.map(item => item.editados),
                backgroundColor: '#10b981', // Emerald-500
                borderRadius: 4,
            }
        ]
    };
});

// --- 3. Opciones ---
const chartOptions: ChartOptions<'bar'> = {
    responsive: true,
    maintainAspectRatio: false, // Importante para diseños fluidos
    scales: {
        y: {
            beginAtZero: true,
            grid: {
                color: '#e5e7eb', // Color suave para la rejilla
            }
        },
        x: {
            grid: {
                display: false // Ocultar rejilla vertical para limpieza
            }
        }
    },
    plugins: {
        legend: {
            position: 'bottom', // Leyenda abajo queda mejor en dashboard
        }
    }
};
</script>

<template>
    <!-- 
        SOLUCIÓN DEL BUCLE:
        El contenedor DEBE tener 'relative' y una altura definida (ej. h-72 o h-80).
        Esto evita que Chart.js entre en un bucle infinito de redimensionamiento.
    -->
    <div class="relative w-full h-80 p-2">
        <Bar
            :data="chartData"
            :options="chartOptions"
        />
    </div>
</template>