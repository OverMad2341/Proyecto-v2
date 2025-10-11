<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';
import { dashboard, login, register } from '@/routes';
import { Head, Link } from '@inertiajs/vue3';

const dynamicText = ref('Sistema');

onMounted(() => {
  const canvas = document.getElementById('dots-bg') as HTMLCanvasElement | null;
  const dynamicEl = document.getElementById('dynamic-text') as HTMLElement | null;
  let ctx: CanvasRenderingContext2D | null = null;
  if (canvas) ctx = canvas.getContext('2d');

  // Helper to get current dot color based on theme
  function getDotColor() {
    return document.documentElement.classList.contains('dark') ? '#fff' : '#000';
  }

  let width = window.innerWidth;
  let height = window.innerHeight;
  function resizeCanvas() {
    width = window.innerWidth;
    height = window.innerHeight;
    if (canvas) {
      canvas.width = width;
      canvas.height = height;
    }
  }

  resizeCanvas();
  window.addEventListener('resize', resizeCanvas);

  const dots: Array<any> = [];
  function randomBetween(a: number, b: number) {
    return Math.random() * (b - a) + a;
  }

  function spawnDot() {
    const size = randomBetween(8, 18);
    const x = randomBetween(0, width);
    const y = randomBetween(0, height);
    const duration = randomBetween(3.5, 6);
    const created = performance.now();
    dots.push({ x, y, size, created, duration });
  }

  function drawDots(now: number) {
    if (!ctx) return;
    ctx.clearRect(0, 0, width, height);
    const dotColor = getDotColor();
    for (let i = dots.length - 1; i >= 0; i--) {
      const dot = dots[i];
      const age = (now - dot.created) / 1000;
      if (age > dot.duration) {
        dots.splice(i, 1);
        continue;
      }
      let alpha = 1;
      if (age < 0.5) alpha = age / 0.5;
      else if (age > dot.duration - 1) alpha = (dot.duration - age) / 1;
      ctx.globalAlpha = Math.max(0, Math.min(1, alpha * 0.7));
      ctx.beginPath();
      ctx.arc(dot.x, dot.y, dot.size, 0, 2 * Math.PI);
      ctx.fillStyle = dotColor;
      ctx.shadowColor = dotColor;
      ctx.shadowBlur = 12;
      ctx.fill();
      ctx.shadowBlur = 0;
    }
    ctx.globalAlpha = 1;
  }
  // Listen for theme changes to redraw dots with correct color
  const themeObserver = new MutationObserver(() => {
    drawDots(performance.now());
  });
  themeObserver.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });

  let rafId = 0;
  function animate(now: number) {
    if (dots.length < 22 && Math.random() < 0.10) spawnDot();
    drawDots(now);
    rafId = requestAnimationFrame(animate);
  }
  rafId = requestAnimationFrame(animate);

  const words = ['Sistema', 'Nacional', 'de Gestión', 'y Registro', 'de Bienes'];
  let currentIndex = 0;
  let intervalId = 0 as number | null;
  let fadeTimeout = 0 as number | null;

  function startTextRotation() {
    intervalId = window.setInterval(() => {
      if (dynamicEl) dynamicEl.style.opacity = '0';
      fadeTimeout = window.setTimeout(() => {
        currentIndex = (currentIndex + 1) % words.length;
        dynamicText.value = words[currentIndex];
        if (dynamicEl) dynamicEl.style.opacity = '1';
      }, 500) as unknown as number;
    }, 1500) as unknown as number;
  }

  startTextRotation();

  onUnmounted(() => {
    cancelAnimationFrame(rafId);
    window.removeEventListener('resize', resizeCanvas);
    if (intervalId) clearInterval(intervalId);
    if (fadeTimeout) clearTimeout(fadeTimeout);
    themeObserver.disconnect();
  });
});
</script>

<template>
  <Head title="Homepage">
    <link rel="preconnect" href="https://rsms.me/" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
  </Head>

  <div class="relative min-h-screen flex flex-col bg-background text-foreground">
    <!-- Background canvas -->
  <div class="absolute inset-0 bg-background bg-fixed overflow-hidden">
      <canvas id="dots-bg" class="w-full h-full block"></canvas>
    </div>

    <!-- Overlay -->
  <div class="absolute inset-0 bg-muted/50 backdrop-blur-md"></div>

  <div class="relative z-10 flex flex-col min-h-screen">
  <header class="py-4 px-6 md:px-10">
  <nav class="container mx-auto flex justify-between items-center">
          <div class="flex items-center space-x-2">
            <img src="/iconcnti.svg" alt="Logo SINAGER" class="h-10 w-auto" />
            <span class="font-bold text-xl hidden sm:block">Centro Nacional de Tecnologías de Información</span>
          </div>

          <div class="flex items-center space-x-4">
            <Link v-if="$page.props.auth.user"
              :href="dashboard()"
              class="bg-primary hover:bg-primary/80 text-primary-foreground font-semibold py-2 px-4 rounded-lg transition duration-300">
              Dashboard
            </Link>

            <template v-else>
              <Link :href="login()"
                class="bg-transparent hover:bg-muted/20 text-foreground font-semibold py-2 px-4 border border-border rounded-lg transition duration-300">
                Inicio de Sesión
              </Link>
              <Link :href="register()"
                class="bg-primary hover:bg-primary/80 text-primary-foreground font-semibold py-2 px-4 rounded-lg transition duration-300">
                Registro
              </Link>
            </template>
          </div>
        </nav>
      </header>

      <main class="flex-grow flex items-center justify-center text-center px-4">
        <div class="flex flex-col items-center">
          <h1 class="text-6xl md:text-8xl font-black uppercase tracking-wider drop-shadow-lg">SINAGER</h1>
          <p id="dynamic-text" class="text-2xl md:text-3xl mt-4 font-light text-muted-foreground transition-opacity duration-500 ease-in-out">{{ dynamicText }}</p>
        </div>
      </main>

      <footer class="py-4 px-6 md:px-10">
        <div class="container mx-auto text-center text-sm text-muted-foreground">&copy; 2025 CNTI - Todos los derechos reservados.</div>
      </footer>
    </div>
  </div>
</template>
