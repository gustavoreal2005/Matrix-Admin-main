<?php

class ControladorProductos
{
    /*=============================================
    MOSTRAR PRODUCTOS
    =============================================*/
    static public function ctrMostrarProductos($item, $valor)
    {
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);
        return $respuesta;
    }

    /*=============================================
    CREAR PRODUCTO
    =============================================*/
    static public function ctrCrearProducto()
    {
        if (isset($_POST["nuevaDescripcion"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
                preg_match('/^[0-9]+$/', $_POST["nuevoStock"]) &&
                preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"]) &&
                preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])
            ) {
                /*=============================================
                VALIDAR IMAGEN
                =============================================*/
                $ruta = "views/img/productos/default/anonymous.png";

                if (isset($_FILES["nuevaImagen"]["tmp_name"]) && !empty($_FILES["nuevaImagen"]["tmp_name"])) {
                    list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;
                    $directorio = "views/img/productos/" . $_POST["nuevoCodigo"];
                    if (!file_exists($directorio)) {
                        mkdir($directorio, 0755);
                    }

                    if ($_FILES["nuevaImagen"]["type"] == "image/jpeg") {
                        $aleatorio = mt_rand(100, 999);
                        $ruta = $directorio . "/" . $aleatorio . ".jpg";
                        $origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["nuevaImagen"]["type"] == "image/png") {
                        $aleatorio = mt_rand(100, 999);
                        $ruta = $directorio . "/" . $aleatorio . ".png";
                        $origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "productos";
                $datos = array(
                    "id_categoria" => $_POST["nuevaCategoria"],
                    "id_marca" => $_POST["nuevaMarca"],
                    "descripcion" => $_POST["nuevaDescripcion"],
                    "stock" => $_POST["nuevoStock"],
                    "precio_compra" => $_POST["nuevoPrecioCompra"],
                    "precio_venta" => $_POST["nuevoPrecioVenta"],
                    "estado" => $_POST["nuevoEstado"],
                    "fecha_vencimiento" => $_POST["nuevaFechaVencimiento"],
                    "imagen" => $ruta
                );

                $respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        swal({
                            type: "success",
                            title: "El producto ha sido guardado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "productos";
                            }
                        });
                    </script>';
                }
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡El producto no puede tener campos vacíos o contener caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "productos";
                        }
                    });
                </script>';
            }
        }
    }

    /*=============================================
    EDITAR PRODUCTO
    =============================================*/
    static public function ctrEditarProducto()
    {
        if (isset($_POST["editarDescripcion"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) &&
                preg_match('/^[0-9]+$/', $_POST["editarStock"]) &&
                preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"]) &&
                preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])
            ) {
                /*=============================================
                VALIDAR IMAGEN NUEVA
                =============================================*/
                $ruta = $_POST["imagenActual"];

                if (isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])) {
                    list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    /*=============================================
                    ELIMINAR IMAGEN ANTIGUA
                    =============================================*/
                    if (!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "views/img/productos/default/anonymous.png") {
                        unlink($_POST["imagenActual"]);
                        rmdir('views/img/productos/' . $_POST["editarCodigo"]);
                    }

                    /*=============================================
                    CREAMOS DIRECTORIO PARA IMAGEN NUEVA
                    =============================================*/
                    $directorio = "views/img/productos/" . $_POST["editarCodigo"];
                    mkdir($directorio, 0755);

                    if ($_FILES["editarImagen"]["type"] == "image/jpeg") {
                        $aleatorio = mt_rand(100, 999);
                        $ruta = "views/img/productos/" . $_POST["editarCodigo"] . "/" . $aleatorio . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["editarImagen"]["type"] == "image/png") {
                        $aleatorio = mt_rand(100, 999);
                        $ruta = "views/img/productos/" . $_POST["editarCodigo"] . "/" . $aleatorio . ".png";

                        $origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "productos";
                $datos = array(
                    "id_categoria" => $_POST["editarCategoria"],
                    "id_marca" => $_POST["editarMarca"],
                    "descripcion" => $_POST["editarDescripcion"],
                    "stock" => $_POST["editarStock"],
                    "precio_compra" => $_POST["editarPrecioCompra"],
                    "precio_venta" => $_POST["editarPrecioVenta"],
                    "estado" => $_POST["editarEstado"],
                    "fecha_vencimiento" => $_POST["editarFechaVencimiento"],
                    "imagen" => $ruta,
                    "id" => $_POST["editarId"]
                );

                $respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        swal({
                            type: "success",
                            title: "El producto ha sido editado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "productos";
                            }
                        });
                    </script>';
                }
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡El producto no puede tener campos vacíos o contener caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "productos";
                        }
                    });
                </script>';
            }
        }
    }

    /*=============================================
    BORRAR PRODUCTO
    =============================================*/
    static public function ctrBorrarProducto()
    {
        if (isset($_GET["idProducto"])) {
            $tabla = "productos";
            $datos = $_GET["idProducto"];

            if ($_GET["imagen"] != "" && $_GET["imagen"] != "views/img/productos/default/anonymous.png") {
                unlink($_GET["imagen"]);
                rmdir('views/img/productos/' . $_GET["codigo"]);
            }

            $respuesta = ModeloProductos::mdlBorrarProducto($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "El producto ha sido borrado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "productos";
                        }
                    });
                </script>';
            }
        }
    }

    /*=============================================
    MOSTRAR SUMA DE VENTAS
    =============================================*/
    static public function ctrMostrarSumaVentas()
    {
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);
        return $respuesta;
    }
}
