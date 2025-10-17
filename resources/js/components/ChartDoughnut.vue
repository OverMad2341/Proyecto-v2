<template>
  <Doughnut class="mx-auto my-2" id="my-chart-id" :options="chartOptions" :data="chartData" />
</template>

<script>
import { Doughnut } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, ArcElement, CategoryScale, LinearScale, Colors } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, Colors, ArcElement, CategoryScale, LinearScale)

export default {
  name: 'DoughnutChart',
  components: { Doughnut },
  data() {
    return {
      chartData: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
        datasets: [
          {
            label: 'vue',
            data: [100, 20, 50, 20, 10, 2],
            hoverOffset: 5,
          },

        ],

      },
      chartOptions: {
        responsive: false,
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