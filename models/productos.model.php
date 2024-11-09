<?php
require_once "conexion.php";

class ModeloProductos
{
    /*=============================================
    MOSTRAR PRODUCTOS
    =============================================*/
    static public function mdlMostrarProductos($tabla, $item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");
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

    /*=============================================
    REGISTRO DE PRODUCTO
    =============================================*/
    static public function mdlIngresarProducto($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, id_marca, descripcion, imagen, stock, precio_compra, precio_venta, estado, fecha_vencimiento) 
                                               VALUES (:id_categoria, :id_marca, :descripcion, :imagen, :stock, :precio_compra, :precio_venta, :estado, :fecha_vencimiento)");

        $stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
        $stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
        $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
        $stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
        $stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    EDITAR PRODUCTO
    =============================================*/
    static public function mdlEditarProducto($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, id_marca = :id_marca, descripcion = :descripcion, imagen = :imagen, stock = :stock, 
                                                precio_compra = :precio_compra, precio_venta = :precio_venta, estado = :estado, fecha_vencimiento = :fecha_vencimiento 
                                                WHERE id = :id");

        $stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
        $stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
        $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
        $stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
        $stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    BORRAR PRODUCTO
    =============================================*/
    static public function mdlBorrarProducto($tabla, $id)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    ACTUALIZAR PRODUCTO
    =============================================*/
    static public function mdlActualizarProducto($tabla, $item1, $valor1, $item2, $valor2)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    MOSTRAR SUMA VENTAS
    =============================================*/
    static public function mdlMostrarSumaVentas($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }
}
