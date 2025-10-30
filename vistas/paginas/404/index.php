                <!-- Begin Page Content -->
                <!-- <div class="container-fluid"> -->

<!-- =========================
     SECTION — 404 · FUTURISTA INTERACTIVO
========================= -->
<section id="page-404" class="py-5 position-relative overflow-hidden" data-theme="dark" aria-labelledby="e404-title">
  <!-- Fondos interactivos -->
  <div class="e404-bg">
    <div class="e404-stars" aria-hidden="true"></div>
    <div class="e404-grid" aria-hidden="true"></div>
    <div class="e404-scanlines" aria-hidden="true"></div>
  </div>

  <div class="container position-relative z-2">
    <div class="row align-items-center g-5">
      
      <!-- Lado Izquierdo: Mensaje -->
      <div class="col-12 col-lg-6">
        <div class="e404-kicker mb-2">
          <i class="fa-solid fa-satellite-dish me-2"></i> Signal Lost
        </div>

        <h1 id="e404-title" class="e404-title mb-2">
          <span class="glitch" data-text="404">404</span>
        </h1>

        <p class="e404-subtitle mb-3">
          Ups… aterrizaste en un <strong>sector no mapeado</strong>. La página que buscas
          podría haberse movido a otra órbita o nunca existir.
        </p>

        <!-- Acciones -->
        <div class="d-flex flex-wrap gap-3 mb-4">
          <a href="/" class="btn btn-primario e404-btn">
            <i class="fa-solid fa-rocket-launch me-2"></i> Ir al inicio
          </a>
          <a href="/sitemap" class="btn btn-outline-light e404-btn">
            <i class="fa-solid fa-map me-2"></i> Ver mapa del sitio
          </a>
          <a href="/contact" class="btn btn-outline-light e404-btn">
            <i class="fa-solid fa-life-ring me-2"></i> Soporte
          </a>
        </div>

        <!-- Buscador -->
        <form action="/search" method="get" class="e404-search" role="search" aria-label="Buscar en el sitio">
          <div class="input-group">
            <span class="input-group-text bg-transparent border-0 pe-0">
              <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="search" name="q" class="form-control e404-input"
                   placeholder="Buscar contenido..." aria-label="Buscar contenido">
            <button class="btn btn-primario e404-btn" type="submit">
              Buscar
            </button>
          </div>
        </form>
      </div>

      <!-- Lado Derecho: Holograma 3D -->
      <div class="col-12 col-lg-6">
        <div class="e404-holo-wrap mx-auto">
          <div class="e404-holo" aria-hidden="true" data-parallax>
            <div class="e404-planet"></div>
            <div class="e404-ring ring-a" data-speed="-.03"></div>
            <div class="e404-ring ring-b" data-speed=".02"></div>
            <div class="e404-orbit orbit-1" data-speed=".05"><span></span></div>
            <div class="e404-orbit orbit-2" data-speed="-.06"><span></span></div>
            <div class="e404-orbit orbit-3" data-speed=".08"><span></span></div>
            <div class="e404-sparkles"></div>
          </div>
          <div class="e404-holo-base" aria-hidden="true"></div>
        </div>
      </div>

    </div>
  </div>
</section>

<style>
/* ====== Base (usa tus tokens si existen) ====== */
#page-404 { 
  --c1: var(--color-primario, #6cf);
  --c2: var(--color-secundario, #8f7aff);
  --txt: var(--color-blanco, #f5f7ff);
  --bg: #0a0d14;
  --grid: rgba(140,160,255,.08);
  color: var(--txt);
  background: radial-gradient(1200px 600px at 80% -10%, rgba(100,140,255,.2), transparent 60%),
              linear-gradient(180deg, #0a0d14 0%, #06080e 100%);
}

/* ====== Fondos ====== */
.e404-bg { position:absolute; inset:0; overflow:hidden; }
.e404-stars, .e404-grid, .e404-scanlines { position:absolute; inset:0; pointer-events:none; }

.e404-stars::before, .e404-stars::after {
  content:""; position:absolute; inset:-50% -50% 0 -50%;
  background:
    radial-gradient(2px 2px at 20% 30%, #fff 50%, transparent 60%),
    radial-gradient(1.5px 1.5px at 70% 60%, #dff 50%, transparent 60%),
    radial-gradient(1.5px 1.5px at 40% 80%, #cdf 50%, transparent 60%),
    radial-gradient(1px 1px at 85% 20%, #fff 50%, transparent 60%),
    radial-gradient(1px 1px at 10% 70%, #eef 50%, transparent 60%);
  animation: drift 100s linear infinite;
  opacity:.6;
}
.e404-stars::after { animation-duration: 160s; opacity:.35; }

@keyframes drift { to { transform: translateY(50%); } }

.e404-grid {
  background: 
    linear-gradient(transparent 70%, rgba(255,255,255,.06) 71%) 0 0 / 100% 14px,
    linear-gradient(90deg, transparent 70%, rgba(255,255,255,.06) 71%) 0 0 / 14px 100%;
  mask-image: linear-gradient(to top, transparent 0%, #000 35%, #000 100%);
  transform: perspective(900px) rotateX(60deg) translateY(-20%);
  opacity:.35;
}

.e404-scanlines {
  background: repeating-linear-gradient(0deg, rgba(255,255,255,.03) 0 1px, transparent 1px 3px);
  mix-blend-mode: soft-light; opacity:.25;
}

/* ====== Texto y glitch ====== */
.e404-kicker {
  letter-spacing:.15em; text-transform:uppercase; font-weight:700; color: #b7c2ff; opacity:.85;
}
.e404-title { font-size: clamp(72px, 12vw, 160px); line-height: .85; font-weight: 900; }
.glitch {
  position: relative; display:inline-block; color: var(--txt); text-shadow: 0 0 24px var(--c1);
  filter: drop-shadow(0 8px 24px rgba(0,0,0,.6));
}
.glitch::before, .glitch::after {
  content: attr(data-text); position:absolute; inset:0;
  clip-path: inset(0 0 0 0);
}
.glitch::before { left:2px; text-shadow:-2px 0 var(--c1); animation: glitch-anim 2.2s infinite linear alternate-reverse; }
.glitch::after  { left:-2px; text-shadow:2px 0 var(--c2); animation: glitch-anim 1.8s infinite linear alternate; }

@keyframes glitch-anim {
  0% { clip-path: inset(0 0 90% 0); }
  10% { clip-path: inset(0 0 50% 0); }
  20% { clip-path: inset(10% 0 40% 0); }
  30% { clip-path: inset(80% 0 0 0); }
  40% { clip-path: inset(50% 0 10% 0); }
  50% { clip-path: inset(30% 0 50% 0); }
  60% { clip-path: inset(60% 0 20% 0); }
  70% { clip-path: inset(40% 0 40% 0); }
  80% { clip-path: inset(70% 0 5% 0); }
  100% { clip-path: inset(0 0 90% 0); }
}

.e404-subtitle { color: #d9defb; opacity:.9; }

/* ====== Botones ====== */
.e404-btn {
  --ring: color-mix(in oklab, var(--c1), white 20%);
  border-radius: 999px;
  box-shadow: 0 0 0 0 transparent, 0 8px 28px rgba(0,0,0,.25);
  transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
}
.e404-btn:hover { transform: translateY(-2px); box-shadow: 0 0 0 4px var(--ring), 0 16px 36px rgba(0,0,0,.35); }

/* ====== Buscador ====== */
.e404-search .input-group { background: rgba(255,255,255,.06); border-radius: 14px; backdrop-filter: blur(8px); }
.e404-input {
  color: var(--txt); background: transparent; border: 0; padding-top:.8rem; padding-bottom:.8rem;
}
.e404-input::placeholder { color: #bfc7ff; opacity:.6; }
.e404-search .input-group-text { color:#cfe3ff; }

/* ====== Holograma ====== */
.e404-holo-wrap { width: min(560px, 90%); aspect-ratio: 1/1.05; position:relative; }
.e404-holo {
  position: absolute; inset: 0; display:grid; place-items:center;
  perspective: 900px; transform-style: preserve-3d;
}
.e404-holo-base {
  position:absolute; left:50%; bottom:-18px; transform:translateX(-50%);
  width: 72%; height: 16px; border-radius: 50%;
  background: radial-gradient(closest-side, color-mix(in oklab, var(--c1), transparent 60%) 0%, transparent 70%);
  filter: blur(8px); opacity:.8;
}
.e404-planet {
  width: 54%; aspect-ratio: 1/1; border-radius: 50%;
  background:
    radial-gradient(circle at 30% 30%, rgba(255,255,255,.25) 0%, transparent 35%),
    conic-gradient(from 210deg, color-mix(in oklab, var(--c1), #fff 10%), color-mix(in oklab, var(--c2), #fff 10%));
  box-shadow: inset 0 -12px 40px rgba(0,0,0,.35), 0 0 80px color-mix(in oklab, var(--c2), transparent 60%);
  transform: translateZ(40px) rotateZ(-8deg);
}

/* Anillos */
.e404-ring {
  position:absolute; border: 2px solid color-mix(in oklab, var(--c1), transparent 65%);
  border-radius: 50%; width: 84%; aspect-ratio: 1/1;
  transform: rotateX(70deg) translateZ(8px);
  filter: drop-shadow(0 0 24px color-mix(in oklab, var(--c1), transparent 70%));
}
.ring-a { animation: spin 24s linear infinite; }
.ring-b { width: 68%; animation: spin 18s linear infinite reverse; border-color: color-mix(in oklab, var(--c2), transparent 65%); }

@keyframes spin { to { transform: rotateX(70deg) rotateZ(360deg) translateZ(8px); } }

/* Órbitas y chispas */
.e404-orbit {
  position:absolute; inset:0; display:grid; place-items:center; transform: rotateX(70deg);
}
.e404-orbit span {
  width: 8px; height: 8px; border-radius:50%; background: white; 
  box-shadow: 0 0 14px 4px color-mix(in oklab, var(--c1), white 30%);
  animation: orbit 9s linear infinite;
}
.orbit-1 span { animation-duration: 9s; }
.orbit-2 span { animation-duration: 7s; }
.orbit-3 span { animation-duration: 5.5s; }

@keyframes orbit { 
  from { transform: rotateZ(0deg) translateX(38%) rotateZ(0deg); }
  to   { transform: rotateZ(360deg) translateX(38%) rotateZ(-360deg); }
}

.e404-sparkles {
  position:absolute; inset:0; background:
    radial-gradient(3px 3px at 20% 70%, #fff 50%, transparent 60%),
    radial-gradient(2px 2px at 40% 40%, #def 50%, transparent 60%),
    radial-gradient(2px 2px at 70% 20%, #cfe 50%, transparent 60%),
    radial-gradient(1.5px 1.5px at 80% 75%, #fff 50%, transparent 60%);
  opacity:.45; filter: blur(.2px);
}

/* ====== Responsivo ====== */
@media (min-width: 992px) {
  #page-404 { padding-block: 6rem; }
}
</style>

<script>
/* ====== Interacción: Parallax 3D y luces de foco ====== */
(() => {
  const holo = document.querySelector('#page-404 .e404-holo');
  if (!holo) return;

  const handler = (e) => {
    const rect = holo.getBoundingClientRect();
    const cx = rect.left + rect.width / 2;
    const cy = rect.top + rect.height / 2;
    const dx = (e.clientX - cx) / rect.width;
    const dy = (e.clientY - cy) / rect.height;

    // Inclinación general
    holo.style.transform = `perspective(900px) rotateX(${(-dy * 6).toFixed(2)}deg) rotateY(${(dx * 8).toFixed(2)}deg)`;

    // Capas con data-speed
    holo.querySelectorAll('[data-speed]').forEach(el => {
      const s = parseFloat(el.dataset.speed || 0);
      el.style.transform = `translate3d(${(dx * 40 * s).toFixed(1)}px, ${(dy * 40 * s).toFixed(1)}px, 0)`;
    });
  };

  window.addEventListener('mousemove', handler, { passive: true });

  // Efecto “pulse” al pasar por los botones
  document.querySelectorAll('#page-404 .e404-btn').forEach(btn => {
    btn.addEventListener('pointerenter', () => btn.animate([
      { transform: 'translateY(0)' }, 
      { transform: 'translateY(-3px)' }, 
      { transform: 'translateY(0)' }
    ], { duration: 320, easing: 'ease-out' }));
  });
})();
</script>


                <!-- </div> -->
                <!-- /.container-fluid -->