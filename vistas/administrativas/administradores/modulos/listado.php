<?php
require_once "Controladores/ControladorAdministradores.php";
?>

<div class="container-fluid">

  <div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">
      <i class="fas fa-user-shield me-2 text-primary"></i> Administradores
    </h1>

    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAdministrador">
      <i class="fas fa-plus me-1"></i> Nuevo administrador
    </button>
  </div>

  <p class="mb-4">
    Administra los <strong>usuarios con rol de administrador</strong>. Puedes crear, editar o eliminar.
  </p>

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center">
      <h6 class="m-0 font-weight-bold text-primary">
        <i class="fas fa-list me-2"></i> Listado de administradores
      </h6>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered align-middle tablas" id="tablaAdmins" width="100%" cellspacing="0">
          <thead class="thead-light">
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Estado</th>
              <th>Último login</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $admins = ControladorAdministradores::listar();
              if (!empty($admins)) {
                $i = 1;
                foreach ($admins as $a) {
                  $estado = $a['estado_usuario'] ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-danger">Inactivo</span>';
                  echo "
                    <tr>
                      <td class='text-center'>{$i}</td>
                      <td>".htmlspecialchars($a['nombre_usuario'])."</td>
                      <td>".htmlspecialchars($a['email_usuario'])."</td>
                      <td class='text-center'>{$estado}</td>
                      <td>".($a['ultimo_login'] ?: '<em>No registrado</em>')."</td>
                      <td class='text-center'>
                        <button class='btn btn-outline-primary btn-sm me-1' data-action='edit' data-id='{$a['id_usuario']}'><i class='fas fa-edit'></i></button>
                        <button class='btn btn-outline-danger btn-sm' data-action='delete' data-id='{$a['id_usuario']}'><i class='fas fa-trash'></i></button>
                      </td>
                    </tr>
                  ";
                  $i++;
                }
              } else {
                echo '<tr><td colspan="6" class="text-center text-muted">No hay administradores registrados.</td></tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

<!-- ========== MODAL CREAR ========== -->
<div class="modal fade" id="modalAdministrador" tabindex="-1" aria-labelledby="modalAdministradorLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAdministradorLabel">
          <i class="fas fa-user-plus me-1 text-primary"></i> Nuevo administrador
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label>Nombre</label>
          <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Contraseña</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" name="estado" value="1" checked>
          <label class="form-check-label">Activo</label>
        </div>

        <?php
          if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'], $_POST['email'])) {
            ControladorAdministradores::crear($_POST);
          }
        ?>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
  </div>
</div>

<!-- ========== MODAL EDITAR ========== -->
<div class="modal fade" id="modalEditarAdmin" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="post">
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="fas fa-edit me-1 text-primary"></i> Editar administrador
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="hidden" name="id" id="editIdAdmin">
        <div class="mb-3">
          <label>Nombre</label>
          <input type="text" name="nombre" id="editNombreAdmin" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" id="editEmailAdmin" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Nueva contraseña (opcional)</label>
          <input type="password" name="password" class="form-control">
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" name="estado" id="editEstadoAdmin" value="1">
          <label class="form-check-label">Activo</label>
        </div>

        <?php
          if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            ControladorAdministradores::editar($_POST['id'], $_POST);
          }
        ?>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
    </form>
  </div>
</div>

<!-- FORM ELIMINAR -->
<form id="formEliminarAdmin" method="post" class="d-none">
  <input type="hidden" name="id_eliminar" id="inputEliminarAdmin">
</form>

<?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_eliminar'])) {
    ControladorAdministradores::eliminar($_POST['id_eliminar']);
  }
?>

<!-- ========== JS FUNCIONAL ========== -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const tabla = document.getElementById('tablaAdmins');
  const modalEditar = new bootstrap.Modal(document.getElementById('modalEditarAdmin'));
  const formEliminar = document.getElementById('formEliminarAdmin');
  const inputEliminar = document.getElementById('inputEliminarAdmin');

  tabla.addEventListener('click', (e) => {
    const btn = e.target.closest('button[data-action]');
    if (!btn) return;

    const id = btn.dataset.id;
    const tr = btn.closest('tr');
    const nombre = tr.children[1].textContent.trim();
    const email = tr.children[2].textContent.trim();

    if (btn.dataset.action === 'edit') {
      document.getElementById('editIdAdmin').value = id;
      document.getElementById('editNombreAdmin').value = nombre;
      document.getElementById('editEmailAdmin').value = email;
      modalEditar.show();
    }

    if (btn.dataset.action === 'delete') {
      if (confirm(`¿Eliminar al administrador ${nombre}?`)) {
        inputEliminar.value = id;
        formEliminar.submit();
      }
    }
  });
});
</script>
