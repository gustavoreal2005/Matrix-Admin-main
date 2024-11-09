<?php
//invocar al archivo
require_once "controllers/plantilla.controlador.php";
require_once "controllers/categoria.controller.php";
require_once "controllers/producto.controller.php";
require_once "controllers/marca.controller.php";

// models
require_once "models/categorias.model.php";
require_once "models/productos.model.php";
require_once "models/marcas.model.php";

//instancia al controlador
$plantilla = new PlantillaControlador();
$plantilla->plantilla();
