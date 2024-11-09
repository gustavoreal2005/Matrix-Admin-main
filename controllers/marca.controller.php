<?php
class ControladorMarca
{
    // Crear o insertar marca
    public static function ctrCrearMarca()
    {
        if (isset($_POST["nuevaMarca"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaMarca"])) {
                $tabla = "marcas";
                $datos = array(
                    "nombre" => $_POST["nuevaMarca"],
                    "estado" => 1 // Estado activo por defecto
                );
                $respuesta = ModeloMarca::mdlIngresarMarca($tabla, $datos);
                if ($respuesta == "OK") {
                    echo '<script>
                        swal({
                        type: "success",
                        title: "La marca ha sido registrada correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "marcas";
                            }
                        })
                    </script>';
                }
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡La marca no puede ir vacía o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "marcas";
                            }
                        })
                </script>';
            }
        }
    }

    // Mostrar marcas
    public static function ctrMostrarMarca($item, $valor)
    {
        $tabla = "marcas";
        $respuesta = ModeloMarca::mdlMostrarMarca($tabla, $item, $valor);
        return $respuesta;
    }

    // Editar marcas
    public static function ctrEditarMarca()
    {
        if (isset($_POST["editarMarca"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarMarca"])) {
                $tabla = "marcas";
                $datos = array(
                    "id" => $_POST["idMarca"],
                    "nombre" => $_POST["editarMarca"],
                    "estado" => ($_POST["estadoMarca"] === "1") ? 1 : 0
                );
                $respuesta = ModeloMarca::mdlEditarMarca($tabla, $datos);
                if ($respuesta == "OK") {
                    echo '<script>
                        swal({
                            type: "success",
                            title: "¡La marca ha sido actualizada correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "marcas";
                            }
                        })
                    </script>';
                }
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡La marca no puede ir vacía o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "marcas";
                        }
                    })
                </script>';
            }
        }
    }

    // Eliminar marcas
    public static function ctrEliminarMarca()
    {
        if (isset($_GET["idMarca"])) {
            $tabla = "marcas";
            $datos = $_GET["idMarca"];

            $respuesta = ModeloMarca::mdlEliminarMarca($tabla, $datos);

            if ($respuesta == "OK") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "La marca ha sido eliminada correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "marcas";
                        }
                    });
                </script>';
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "Error al eliminar la marca",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "marcas";
                        }
                    });
                </script>';
            }
        }
    }
}
?>
