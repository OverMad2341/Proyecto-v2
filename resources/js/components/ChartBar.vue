<template>
  <Bar id="my-chart-id" :options="chartOptions" :data="chartData" />
</template>

<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, Colors } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, Colors, BarElement, CategoryScale, LinearScale)

export default {
  name: 'BarChart',
  components: { Bar },
  data() {
    return {
      chartData: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
        datasets: [
          {
            label: 'Vue',
            data: [100, 20, 50, 20, 10, 2],

          },
          {
            label: 'React',
            data: [12, 23, 50, 25, 9, 5],
          } 
        ],

      },
      chartOptions: {
        responsive: true,
        plugins: {
          colors: {
            enabled: true
          }
        }
      }
    }
  }
}
</script>