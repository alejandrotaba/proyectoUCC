<?php
 require_once "Modelos/ModeloUsuarios.php";
require_once "Modelos/ModeloLogs.php";

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

    static public function ctrActualizarPerfil() {

    if(isset($_POST["nombre"])){

        $datos = array(
            "id" => $_SESSION["id_usuario"],
            "nombre" => $_POST["nombre"],
            "correo" => $_POST["correo"]
        );

        ModeloUsuarios::mdlActualizarPerfil($datos);

        echo "<script>alert('Perfil actualizado correctamente');</script>";
        }
     }

    static public function ctrEnviarCodigo(){

    if(isset($_POST["correo"])){

        $codigo = rand(100000,999999);
        $_SESSION["codigo_2fa"] = $codigo;
        $_SESSION["correo_2fa"] = $_POST["correo"];

        mail($_POST["correo"], "Código de acceso", "Tu código es: ".$codigo);

        echo "<script>alert('Código enviado a tu correo'); window.location='validar';</script>";
    }
 }

 class ControladorUsuarios {
    static public function ctrMostrarUsuario($id){
        return ModeloUsuarios::mdlObtenerUsuarioPorId($id);
    }

    static public function ctrObtenerPermisos($id){
        return ModeloUsuarios::mdlObtenerPermisos($id);
    }
 }





}
