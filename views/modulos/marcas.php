<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">ADMINISTRAR MARCA</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Administrar Marca
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarMarca">
                    Agregar marca
                </button>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Nombre Marca</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;
                        // Obtener las marcas de la base de datos
                        $marcas = ControladorMarca::ctrMostrarMarca($item, $valor);

                        // Iterar sobre las marcas obtenidas
                        foreach ($marcas as $key => $value) {
                            echo '<tr>
                                    <td>' . ($key + 1) . '</td> <!-- Índice de la marca -->
                                    <td class="text-uppercase">' . $value["nombre"] . '</td> <!-- Nombre de la marca -->
                                    <td>' . ($value["estado"] == 1 ? "Activo" : "Inactivo") . '</td> <!-- Estado: Activo/Inactivo -->
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-warning btnEditarMarca" idMarca="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarMarca">
                                            <i class="fa fa-pencil"></i>
                                            </button>
                                            <a href="index.php?ruta=marcas&idMarca=' . $value["id"] . '" class="btn btn-danger btnEliminarMarca">
                                            <i class="fa fa-times"></i></a>
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
<!-- MODAL AGREGAR MARCA -->
<div id="modalAgregarMarca" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar marca</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                <input type="text" class="form-control input-lg" name="nuevaMarca" placeholder="Ingresar marca" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar marca</button>
                </div>
                <?php
                $crearMarca = new ControladorMarca();
                $crearMarca->ctrCrearMarca();
                ?>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDITAR MARCA -->
<div id="modalEditarMarca" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar marca</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                <input type="text" class="form-control input-lg" name="editarMarca" id="editarMarca" placeholder="Editar marca" required>
                                <input type="hidden" name="idMarca" id="idMarca" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-toggle-on"></i></span>
                                <select class="form-control input-lg" name="estadoMarca" id="estadoMarca" required>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
                <?php
                $editarMarca = new ControladorMarca();
                $editarMarca->ctrEditarMarca();
                ?>
            </form>
        </div>
    </div>
</div>
<?php
$eliminarMarca = new ControladorMarca();
$eliminarMarca->ctrEliminarMarca();
?>