<?php

require_once "Modelos/Conexion.php";

class ModeloCategorias
{
    /**
     * Registra una categoría y devuelve el ID insertado, o null si falla.
     */
    public static function registrarCategoria(string $nombre): ?int
    {
        // Opcional: recortar y limitar longitud para cuidar la BD
        $nombre = trim($nombre);
        if ($nombre === '') {
            return null;
        }

        $sql = "INSERT INTO categorias (nombre_categoria) VALUES (:nombre_categoria)";

        try {
            $pdo  = Conexion::pdo();
            $stmt = $pdo->prepare($sql);

            // Enlazar el valor correcto al placeholder correcto
            $stmt->bindValue(':nombre_categoria', $nombre, PDO::PARAM_STR);

            if (!$stmt->execute()) {
                return null;
            }

            // Devolver el último ID insertado
            $id = (int) $pdo->lastInsertId();
            return $id > 0 ? $id : null;

        } catch (PDOException $e) {
            // Nunca mostrar detalles al usuario; solo loguear
            error_log("Error en registrarCategoria: " . $e->getMessage());
            return null;
        }
    }


    // ✅ Nuevo método para obtener todas las categorías
    public static function mostrarCategorias(): array
    {
        try {
            $pdo = Conexion::pdo();
            $stmt = $pdo->prepare("SELECT id_categoria, nombre_categoria FROM categorias ORDER BY id_categoria DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en mostrarCategorias: " . $e->getMessage());
            return [];
        }
    }


    //actualizar
    public static function actualizarCategoria(int $id, string $nombre): bool
    {
        $nombre = trim($nombre);
        if ($id <= 0 || $nombre === '') return false;

        $sql = "UPDATE categorias SET nombre_categoria = :nombre WHERE id_categoria = :id";

        try {
            $pdo  = Conexion::pdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en actualizarCategoria: " . $e->getMessage());
            return false;
        }
    }


    //Eliminar
    public static function eliminarCategoria(int $id): bool
    {
        if ($id <= 0) return false;

        $sql = "DELETE FROM categorias WHERE id_categoria = :id";
        try {
            $pdo  = Conexion::pdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Propagamos para que el controlador decida el mensaje (FK 1451, etc.)
            throw $e;
        }
    }



}



