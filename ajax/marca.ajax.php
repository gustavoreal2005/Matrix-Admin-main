<?php
require_once "../controllers/marca.controller.php";
require_once "../models/marcas.model.php";

class AjaxMarca {
    public $idMarca;

    public function ajaxEditarMarca() {
        $item = "id";
        $valor = $this->idMarca;

        // Llama al controlador para obtener la marca con el id especificado
        $respuesta = ControladorMarca::ctrMostrarMarca($item, $valor);

        // Devuelve la respuesta en formato JSON
        echo json_encode($respuesta);
    }
}

// Procesa la petición AJAX si se envía un idMarca
if (isset($_POST["idMarca"])) {
    $editar = new AjaxMarca();
    $editar->idMarca = $_POST["idMarca"];
    $editar->ajaxEditarMarca();
}
?>
