<?php
 require_once "Modelos/ModeloUsuarios.php";

class ControladorUsuarios {

    public function ingresoUsuario(){


        if(isset($_POST['email']) && isset($_POST['password'])){

            $email = $_POST['email'];
            $password = $_POST['password'];

            if(
                filter_var($email, FILTER_VALIDATE_EMAIL) &&
                preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)
            ){

                // busco el usuario
                $usuario= ModeloUsuarios::findByEmail($email);
                
                //para ver la usuario;
                //var_dump($usuario);

                //return;

                //Comparo contraseña traída de base de datos con la dada
                $passBD = $usuario['password_usuario'] ?? null;



                if ($usuario && $passBD !== null && $password === $passBD) {

                    $_SESSION['admin']  = 'ok';
                    $_SESSION['nombre'] = $usuario['nombre_usuario'] ?? 'Administrador';
                    $_SESSION['uid']    = $usuario['id_usuario'] ?? null;
                    header('Location: dashboard');
                    exit;

                    // echo '<script>
                    //     window.location = "dashboard"
                    // </script>';

                }else{
                    echo '<div class="alert alert-danger">Error, por favor vuelve a intentarlo </div>';
                   return;
                }

            } else{
                echo '<div class="alert alert-danger">Error, Ingresa valores válidos </div>';
                return;
            }
        }
    }


}



// class ControladorUsuarios {

//     public function ingresoUsuario(){

//         if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//         $email    = $_POST['email']    ?? null;
//         $password = $_POST['password'] ?? null;

//         if (isset($email, $password)) {

//             // Valida igual que ya lo haces (email + regex). Si quieres, deja solo minlength=6 del form.
//             if (
//                 filter_var($email, FILTER_VALIDATE_EMAIL) &&
//                 preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)
//             ) {
//                 // Usa tu método del modelo (ajusta el nombre que realmente tengas)
//                 $usuario = ModeloUsuarios::findByEmail($email);
//                 // Si prefieres mostrarPorEmail, crea un alias en el modelo y cambia aquí.

//                 // SIN HASH: comparación directa con la columna `password_usuario`
//                 $passBD = $usuario['password_usuario'] ?? null;

//                 if ($usuario && $passBD !== null && $password === $passBD) {
//                     // Login OK
//                     session_regenerate_id(true);
//                     $_SESSION['admin']  = 'ok';
//                     $_SESSION['nombre'] = $usuario['nombre_usuario'] ?? 'Admin';
//                     $_SESSION['uid']    = $usuario['id_usuario'] ?? null;

//                     if (!headers_sent()) {
//                         header('Location: dashboard');
//                         exit;
//                     } else {
//                         echo '<script>location.href="dashboard";</script>';
//                         exit;
//                     }
//                 } else {
//                     // Credenciales inválidas
//                     $_SESSION['login_error'] = 'Credenciales inválidas.';
//                     if (!headers_sent()) {
//                         header('Location: ingreso');
//                         exit;
//                     } else {
//                         echo '<script>location.href="ingreso";</script>';
//                         exit;
//                     }
//                 }
//             } else {
//                 // Formato inválido
//                 $_SESSION['login_error'] = 'Correo o contraseña inválidos.';
//                 if (!headers_sent()) {
//                     header('Location: ingreso');
//                     exit;
//                 } else {
//                     echo '<script>location.href="ingreso";</script>';
//                     exit;
//                 }
//             }
//         } else {
//             // Faltan campos
//             $_SESSION['login_error'] = 'Faltan correo y contraseña.';
//             if (!headers_sent()) {
//                 header('Location: ingreso');
//                 exit;
//             } else {
//                 echo '<script>location.href="ingreso";</script>';
//                 exit;
//             }
//         }
//     }

// }

