<?php
// Load id from URL if present
$id = null;
$parts = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
if (isset($parts[1]) && $parts[0] == 'inventarioUcc' && isset($parts[2]) && $parts[1] == 'administradores') {
    // URL may be /inventarioUcc/administradores/editar/{id}
}
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}
if (isset($parts[2]) && $parts[1] == 'administradores' && $parts[2] == 'editar' && isset($parts[3])) {
    $id = intval($parts[3]);
}
$admin = null;
if ($id) {
    $admin = ControladorAdministradores::obtenerPorId($id);
}
?>
<div class="content">
    <div class="container">
        <div class="card">
            <form method="post" action="/inventarioUcc/administradores" novalidate>
                <input type="hidden" name="action" value="edit_admin">
                <input type="hidden" name="id_usuario" value="<?php echo $admin ? $admin['id_usuario'] : ''; ?>">
                <div class="card-header">
                    <h4>Editar Administrador</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $admin ? htmlspecialchars($admin['nombre_usuario']) : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $admin ? htmlspecialchars($admin['email_usuario']) : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label>Contraseña (dejar vacío para no cambiar)</label>
                        <input type="password" name="password" class="form-control" value="">
                    </div>
                    <div class="mb-3">
                        <label>Estado</label>
                        <select name="estado" class="form-control">
                            <option value="1" <?php echo ($admin && $admin['estado_usuario']) ? 'selected' : ''; ?>>Activo</option>
                            <option value="0" <?php echo ($admin && !$admin['estado_usuario']) ? 'selected' : ''; ?>>Inactivo</option>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <a href="/inventarioUcc/administradores" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
