<?php

require_once "Modelos/ModeloCategorias.php";

class ControladorCategorias
{
    public static function crearCategoria()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['categoria']) || isset($_POST['id_categoria'])) {
            // Nota: si viene id_categoria, NO es creación
            return;
        }

        $categoria = trim($_POST['categoria']);
        if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñÜü0-9\s\-]+$/u', $categoria)) {
            echo self::swal('Cuidado', 'No se permiten caracteres especiales.', 'error', 'categorias');
            return;
        }

        $nuevoId = ModeloCategorias::registrarCategoria($categoria);
        if ($nuevoId) {
            echo self::swal('Registro exitoso', 'La categoría ha sido guardada exitosamente.', 'success', 'categorias');
        } else {
            echo self::swal('Error', 'No fue posible guardar la categoría. Intenta nuevamente.', 'error', 'categorias');
        }
    }

    // ====== NUEVO: EDICIÓN SEPARADA ======
    public static function editarCategoria()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id_categoria'], $_POST['categoria'])) {
            return;
        }

        $id        = (int)($_POST['id_categoria'] ?? 0);
        $categoria = trim($_POST['categoria'] ?? '');

        if ($id <= 0) {
            echo self::swal('Cuidado', 'ID inválido.', 'error', 'categorias');
            return;
        }

        if ($categoria === '' || !preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñÜü0-9\s\-]+$/u', $categoria)) {
            echo self::swal('Cuidado', 'No se permiten caracteres especiales.', 'error', 'categorias');
            return;
        }

        $ok = ModeloCategorias::actualizarCategoria($id, $categoria);

        if ($ok) {
            echo self::swal('Actualización exitosa', 'La categoría se actualizó correctamente.', 'success', 'categorias');
        } else {
            echo self::swal('Error', 'No fue posible actualizar la categoría.', 'error', 'categorias');
        }
    }

    // Listado
    public static function mostrarCategorias()
    {
        return ModeloCategorias::mostrarCategorias();
    }

    // Helper SweetAlert+redirect
    private static function swal(string $title, string $text, string $icon, string $redirect): string
    {
        $titleEsc = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        $textEsc  = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        $redirEsc = htmlspecialchars($redirect, ENT_QUOTES, 'UTF-8');

        return '
            <script>
                Swal.fire({
                    title: "'.$titleEsc.'",
                    text: "'.$textEsc.'",
                    icon: "'.$icon.'",
                    confirmButtonText: "Entendido"
                }).then(() => { window.location = "'.$redirEsc.'"; });
            </script>
        ';
    }

    //Eliminar categorias
    public static function eliminarCategoria(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id_categoria_eliminar'])) {
            return;
        }

        $id = (int)($_POST['id_categoria_eliminar'] ?? 0);
        if ($id <= 0) {
            echo self::swal('Cuidado', 'ID inválido para eliminar.', 'error', 'categorias');
            return;
        }

        try {
            // Eliminación FÍSICA. (Más abajo te dejo variante lógica)
            $ok = ModeloCategorias::eliminarCategoria($id);

            if ($ok) {
                echo self::swal('Eliminado', 'La categoría fue eliminada correctamente.', 'success', 'categorias');
            } else {
                echo self::swal('Error', 'No fue posible eliminar la categoría.', 'error', 'categorias');
            }
        } catch (Throwable $e) {
            // Si hay FK (productos asociados), MySQL lanza 1451
            $msg = 'Ocurrió un error inesperado.';
            if ($e instanceof PDOException) {
                $code = (int)($e->errorInfo[1] ?? 0);
                if ($code === 1451) {
                    $msg = 'No se puede eliminar: la categoría tiene registros asociados.';
                }
            }
            error_log("Error en eliminarCategoria: " . $e->getMessage());
            echo self::swal('Error', $msg, 'error', 'categorias');
        }
    }


}
