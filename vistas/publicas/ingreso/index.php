<!-- =========================
     SEGMENTO — LOGIN (Bootstrap 5)
     Requiere: Bootstrap 5 cargado en tu layout
========================= -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">

        <!-- Card Login -->
        <div class="card shadow-sm">
          <div class="card-body p-4">

            <!-- Título -->
            <h3 class="text-center mb-4">Iniciar Sesión</h3>

            <!-- Formulario -->
            <form method="post">
              <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email"  name="email" class="form-control" id="email" placeholder="tu@email.com">
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="********">
              </div>

              <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">Ingresar</button>
              </div>

            <?php
              $login = new ControladorUsuarios();
              $login -> ingresoUsuario();
            ?>

              <div class="text-center">
                <small>
                  ¿No tienes cuenta? <a href="registro">Regístrate</a>
                </small>
              </div>
              <div class="text-center">
                <small>
                  Regresar al  <a href="inicio">Inicio</a>
                </small>
              </div>

            </form>



          </div>
        </div>
        <!-- /Card Login -->

      </div>
    </div>
  </div>
</section>
