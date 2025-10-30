<!-- =========================
     PAGE 404 — Not Found
     (Diseño moderno, centrado y responsive)
========================= -->
<section id="error-404" class="error-404 vh-100 d-flex align-items-center justify-content-center bg-light text-center">
  <style>
    .error-404 {
      font-family: "Poppins", sans-serif;
      background: linear-gradient(135deg, #0A2A5A, #00A6A6);
      color: #fff;
      position: relative;
      overflow: hidden;
    }
    .error-404::before {
      content: "";
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at 70% 30%, rgba(255,255,255,0.1), transparent 60%);
      z-index: 0;
    }
    .error-404 .content {
      position: relative;
      z-index: 2;
      padding: 2rem;
      max-width: 500px;
    }
    .error-404 h1 {
      font-size: 8rem;
      font-weight: 800;
      letter-spacing: -3px;
      margin-bottom: .5rem;
      color: #F7941D;
      text-shadow: 0 4px 12px rgba(0,0,0,.2);
    }
    .error-404 h2 {
      font-size: 2rem;
      font-weight: 600;
      margin-bottom: 1rem;
    }
    .error-404 p {
      font-size: 1.1rem;
      color: rgba(255,255,255,.85);
      margin-bottom: 2rem;
    }
    .error-404 a.btn-home {
      display: inline-block;
      background: #F7941D;
      color: #fff;
      padding: .75rem 1.5rem;
      font-weight: 600;
      border-radius: 50px;
      text-decoration: none;
      transition: .3s;
    }
    .error-404 a.btn-home:hover {
      background: #fff;
      color: #0A2A5A;
      box-shadow: 0 0 12px rgba(255,255,255,.3);
    }
    @media (max-width: 768px) {
      .error-404 h1 { font-size: 6rem; }
      .error-404 h2 { font-size: 1.5rem; }
    }
  </style>

  <div class="content text-center">
    <h1>404</h1>
    <h2>Página no encontrada</h2>
    <p>Lo sentimos, la página que buscas no existe o ha sido movida.</p>
    <a href="inicio" class="btn-home">
      <i class="fa-solid fa-house me-2"></i>Volver al inicio
    </a>
  </div>
</section>
