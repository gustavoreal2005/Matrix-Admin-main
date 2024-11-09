<?php
require_once "conexion.php";

class ModeloMarca
{
    // Crear o registrar marca
    public static function mdlIngresarMarca($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, estado) VALUES (:nombre, :estado)");
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_BOOL);

        if ($stmt->execute()) {
            return "OK";
        } else {
            return "Error";
        }

        $stmt->close();
        $stmt = null;
    }

    // Mostrar marcas
    public static function mdlMostrarMarca($tabla, $item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt->close();
        $stmt = null;
    }

    // Editar marca
    public static function mdlEditarMarca($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, estado = :estado WHERE id = :id");
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_BOOL);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "OK";
        } else {
            return "Error";
        }

        $stmt->close();
        $stmt = null;
    }

    // Eliminar marca
    public static function mdlEliminarMarca($tabla, $datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "OK";
            } else {
                return "Error";
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }

        $stmt->close();
        $stmt = null;
    }
}
