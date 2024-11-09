<?php
// Requerir el controlador y el modelo de productos
require_once "../controllers/categoria.controller.php";
require_once "../controllers/marca.controller.php";
require_once "../controllers/producto.controller.php";

require_once "../models/categorias.model.php";
require_once "../models/marcas.model.php";
require_once "../models/productos.model.php";

class AjaxProductos {

    // Propiedad para capturar el id del producto
    public $idProducto;

    /*=============================================
    EDITAR PRODUCTO (obtener información de un producto para edición)
    =============================================*/
    public function ajaxEditarProducto() {
        // Llamar al método del controlador y obtener la información del producto
        $item = "id";
        $valor = $this->idProducto;

        // Llamar al método que muestra los productos y devolver el resultado en JSON
        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, null);
        echo json_encode($respuesta);
    }

    /*=============================================
    CREAR PRODUCTO
    =============================================*/
    public function ajaxCrearProducto() {
        // Llamar al método del controlador para crear el producto
        if (isset($_POST["nuevaDescripcion"])) {
            $respuesta = ControladorProductos::ctrCrearProducto();
            echo $respuesta;
        }
    }

    /*=============================================
    BORRAR PRODUCTO
    =============================================*/
    public $idEliminarProducto;

    public function ajaxBorrarProducto() {
        // Llamar al método del controlador para borrar el producto
        $respuesta = ControladorProductos::ctrBorrarProducto($this->idEliminarProducto);
        echo $respuesta;
    }

}

// Verificar si se envía una petición AJAX para editar un producto
if (isset($_POST["idProducto"])) {
    $editarProducto = new AjaxProductos();
    $editarProducto->idProducto = $_POST["idProducto"];
    $editarProducto->ajaxEditarProducto();
}

// Verificar si se envía una petición AJAX para crear un producto
if (isset($_POST["nuevaDescripcion"])) {
    $crearProducto = new AjaxProductos();
    $crearProducto->ajaxCrearProducto();
}

// Verificar si se envía una petición AJAX para eliminar un producto
if (isset($_POST["idEliminarProducto"])) {
    $borrarProducto = new AjaxProductos();
    $borrarProducto->idEliminarProducto = $_POST["idEliminarProducto"];
    $borrarProducto->ajaxBorrarProducto();
}
