<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Agentes</h1>

    <ul>
      <li v-for="agent in agents" :key="agent.id">
        {{ agent.name }} — {{ agent.email }}
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const agents = ref([])

onMounted(async () => {
  const { data } = await axios.get('/api/agents')
  agents.value = data
})
</script>
