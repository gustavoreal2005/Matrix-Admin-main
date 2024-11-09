<div class="page-wrapper">
    <div class="content-fluid">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">ADMINISTRAR CATEGORIA</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Administrar Categoria
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">

            <div class="box">

                <div class="box-header with-border">

                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">

                        Agregar categoría

                    </button>

                </div>

                <div class="box-body">

                    <table class="table table-bordered table-striped dt-responsive tablas">

                        <thead>

                            <tr>

                                <th style="width:10px">#</th>
                                <th>Nombre Categoria</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Acciones</th>

                            </tr>

                        </thead>

                        <tbody>
                            <?php
                            $item = null;
                            $valor = null;
                            // Obtener las categorías de la base de datos
                            $categorias = ControladorCategoria::ctrMostrarCategoria($item, $valor);

                            // Iterar sobre las categorías obtenidas
                            foreach ($categorias as $key => $value) {
                                // Mostrar cada fila con los datos de id, nombre, fecha y estado
                                echo '<tr>
            <td>' . ($key + 1) . '</td> <!-- Índice de la categoría -->
            <td class="text-uppercase">' . $value["categoria"] . '</td> <!-- Nombre de la categoría -->
            <td>' . $value["fecha"] . '</td> <!-- Fecha de creación -->
            <td>' . ($value["estado"] == 1 ? "Activo" : "Inactivo") . '</td> <!-- Estado: Activo/Inactivo -->
            <td>
                <div class="btn-group">
                    <!-- Botón para editar la categoría -->
                    <button class="btn btn-warning btnEditarCategoria" idCategoria="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarCategoria">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <!-- Botón para eliminar la categoría -->
                    <a href="index.php?ruta=categoria&idCategoria=' . $value["id"] . '" class="btn btn-danger btnEliminarCategoria"><i class="fa fa-times"></i></a>
                </div>
            </td>
        </tr>';
                            }
                            ?>
                        </tbody>


                    </table>

                </div>

            </div>

        </section>

    </div>

    <!-- MODAL AGREGAR CATEGORIA -->
    <div id="modalAgregarCategoria" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" method="post">
                    <div class="modal-header" style="background:#3c8dbc; color:white">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Agregar categoría</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                    <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Ingresar categoría" required>
                                </div>
                            </div>
                            <div class="form-group">

                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="date" class="form-control input-lg" name="fechaCategoria" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Guardar categoría</button>
                    </div>
                    <?php
                    $crearCategoria = new ControladorCategoria();
                    $crearCategoria->ctrCrearCategoria();
                    ?>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL EDITAR CATEGORIA -->
    <div id="modalEditarCategoria" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" method="post">
                    <div class="modal-header" style="background:#3c8dbc; color:white">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Editar categoría</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                    <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria" placeholder="Editar categoría" required>
                                    <input type="hidden" name="idCategoria" id="idCategoria" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on"></i></span>
                                    <select class="form-control input-lg" name="estadoCategoria" id="estadoCategoria" required>
                                        <option value="1">Activo</option>
                                        <option value="0">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="date" class="form-control input-lg" name="fechaCategoria" id="fechaCategoria" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                    <?php
                    $editarCategoria = new ControladorCategoria();
                    $editarCategoria->ctrEditarCategoria();
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
$eliminarCategoria = new ControladorCategoria();
$eliminarCategoria->ctrEliminarCategoria();
?>