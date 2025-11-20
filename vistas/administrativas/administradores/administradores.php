<?php
require_once 'Controladores/ControladorAdministradores.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
// Process POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'create_admin') {
        $data = [
            'nombre' => $_POST['nombre'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
            'foto' => $_POST['foto'] ?? '',
            'estado' => $_POST['estado'] ?? 1
        ];
        $res = ControladorAdministradores::crear($data);
        if ($res) {
            header('Location: /inventarioUcc/administradores');
            exit;
        } else {
            $errorCrear = 'Error al crear administrador';
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'edit_admin') {
        $id = intval($_POST['id_usuario']);
        $data = [
            'nombre' => $_POST['nombre'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
            'foto' => $_POST['foto'] ?? '',
            'estado' => $_POST['estado'] ?? 1
        ];
        $res = ControladorAdministradores::editar($id, $data);
        if ($res) {
            header('Location: /inventarioUcc/administradores');
            exit;
        } else {
            $errorEditar = 'Error al editar administrador';
        }
    }
}
// Process delete via GET delete_id
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $res = ControladorAdministradores::eliminar($id);
    header('Location: /inventarioUcc/administradores');
    exit;
}

// Get list for display
$admins = ControladorAdministradores::listar();
?>

<div class="content-wrapper" style="min-height: 1504.06px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Administradores</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Administradores</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php

      if(!empty($arrayRutas[2])){

        if(
          $arrayRutas[2] == "listado" ||
          $arrayRutas[2] == "creacion" ||
          $arrayRutas[2] == "editar"
        ){
          include "modulos/".$arrayRutas[2].".php";
        }
        else{
          echo '<script>
              window.location= "'.$path.'404";
            </script>';
        }
      }else{
        include "modulos/listado.php";
      }

    ?>

  </div>