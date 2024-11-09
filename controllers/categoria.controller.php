<?php
class ControladorCategoria
{
    // Crear o insertar categorías
    public static function ctrCrearCategoria()
    {
        if (isset($_POST["nuevaCategoria"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])) {
                $tabla = "categorias";
                $datos = array(
                    "categoria" => $_POST["nuevaCategoria"],
                    "estado" => 1 // Estado activo por defecto
                );
                $respuesta = ModeloCategoria::mdlIngresarCategoria($tabla, $datos);
                if ($respuesta == "OK") {
                    echo '<script>
                        swal({
                        type: "success",
                        title: "La categoría ha sido registrada correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "categoria";
                            }
                        })
                    </script>';
                }
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "categoria";
                            }
                        })
                </script>';
            }
        }
    }

    // Mostrar categorías
    public static function ctrMostrarCategoria($item, $valor)
    {
        $tabla = "categorias";
        $respuesta = ModeloCategoria::mdlMostrarCategoria($tabla, $item, $valor);
        return $respuesta;
    }

    // Editar categorías
    public static function ctrEditarCategoria()
    {
        if (isset($_POST["editarCategoria"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])) {
                $tabla = "categorias";
                $datos = array(
                    "id" => $_POST["idCategoria"],
                    "categoria" => $_POST["editarCategoria"],
                    "estado" => ($_POST["estadoCategoria"] === "1") ? 1 : 0,
                    "fecha" => $_POST["fechaCategoria"]
                );
                $respuesta = ModeloCategoria::mdlEditarCategoria($tabla, $datos);
                if ($respuesta == "OK") {
                    echo '<script>
                        swal({
                            type: "success",
                            title: "¡La categoría ha sido actualizada correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "categoria";
                            }
                        })
                    </script>';
                }
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "categoria";
                        }
                    })
                </script>';
            }
        }
    }



    // Eliminar categorías
    public static function ctrEliminarCategoria()
    {
        if (isset($_GET["idCategoria"])) {
            $tabla = "categorias";
            $datos = $_GET["idCategoria"];

            $respuesta = ModeloCategoria::mdlEliminarCategoria($tabla, $datos);

            if ($respuesta == "OK") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "La categoría ha sido eliminada correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "categoria";
                        }
                    });
                </script>';
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "Error al eliminar la categoría",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "categoria";
                        }
                    });
                </script>';
            }
        }
    }
}
