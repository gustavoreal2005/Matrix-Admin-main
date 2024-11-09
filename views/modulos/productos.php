<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">ADMINISTRAR PRODUCTO</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Administrar Producto
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
                    Agregar producto
                </button>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Marca</th>
                            <th>Imagen</th>
                            <th>Stock</th>
                            <th>Precio Compra</th>
                            <th>Precio Venta</th>
                            <th>Estado</th>
                            <th>Fecha Vencimiento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;
                        // Obtener los productos de la base de datos
                        $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

                        // Iterar sobre los productos obtenidos
                        foreach ($productos as $key => $value) {
                            echo '<tr>
                                    <td>' . ($key + 1) . '</td> <!-- Índice del producto -->
                                    <td>' . $value["descripcion"] . '</td> <!-- Descripción del producto -->
                                    <td>' . $value["id_categoria"] . '</td> <!-- Categoría del producto -->
                                    <td>' . $value["id_marca"] . '</td> <!-- Marca del producto -->
                                    <td><img src="' . $value["imagen"] . '" class="img-thumbnail" width="40px"></td> <!-- Imagen del producto -->
                                    <td>' . $value["stock"] . '</td> <!-- Stock del producto -->
                                    <td>' . $value["precio_compra"] . '</td> <!-- Precio de compra -->
                                    <td>' . $value["precio_venta"] . '</td> <!-- Precio de venta -->
                                    <td>' . ($value["estado"] == 1 ? "Activo" : "Inactivo") . '</td> <!-- Estado: Activo/Inactivo -->
                                    <td>' . $value["fecha_vencimiento"] . '</td> <!-- Fecha de vencimiento -->
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-warning btnEditarProducto" idProducto="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarProducto">
                                            <i class="fa fa-pencil"></i>
                                            </button>
                                            <a href="index.php?ruta=productos&idProducto=' . $value["id"] . '" class="btn btn-danger btnEliminarProducto">
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

<!-- MODAL AGREGAR PRODUCTO -->
<div id="modalAgregarProducto" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar producto</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <!-- CATEGORÍA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <select class="form-control input-lg" name="nuevaCategoria" name="nuevaCategoria" required>
                                    <option value="">Seleccionar categoría</option>
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $categorias = ControladorCategoria::ctrMostrarCategoria($item, $valor);
                                    foreach ($categorias as $key => $value) {
                                        echo '<option value="' . $value["id"] . '">' . $value["categoria"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- MARCA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                <select class="form-control input-lg" name="nuevaMarca" name="nuevaMarca" required>
                                    <option value="">Seleccionar marca</option>
                                    <?php

                                    $item = null;
                                    $valor = null;
                                    $categorias = ControladorMarca::ctrMostrarMarca($item, $valor);
                                    foreach ($categorias as $key => $value) {
                                        echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- DESCRIPCION -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" required>
                            </div>
                        </div>
                        <!-- STOCK -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Ingresar stock" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <!-- PRECIO COMPRA -->
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                                    <input type="number" step="any" class="form-control input-lg" name="nuevoPrecioCompra" placeholder="Precio de compra" required>
                                </div>
                            </div>
                            <!-- PRECIO VENTA -->
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                                    <input type="number" step="any" class="form-control input-lg" name="nuevoPrecioVenta" placeholder="Precio de venta" required>
                                </div>
                            </div>
                        </div>
                        <!-- FECHA VENCIMIENTO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control input-lg" name="nuevaFechaVencimiento" required>
                            </div>
                        </div>
                        <!-- IMAGEN -->
                        <div class="form-group">
                            <div class="panel">Subir Imagen</div>
                            <input type="file" class="nuevaImagen" name="nuevaImagen">
                            <p class="help-block">Peso máximo de la imagen 2MB</p>
                            <img src="views/img/productos/default/anonymous.png" class="img-thumbnail" width="100px">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar producto</button>
                </div>
                <?php
                $crearProducto = new ControladorProductos();
                $crearProducto->ctrCrearProducto();
                ?>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDITAR PRODUCTO -->
<div id="modalEditarProducto" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar producto</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <!-- DESCRIPCIÓN -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                <input type="text" class="form-control input-lg" name="editarDescripcion" id="editarDescripcion" placeholder="Editar descripción" required>
                                <input type="hidden" name="idProducto" id="idProducto" required>
                            </div>
                        </div>
                        <!-- CATEGORÍA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <select class="form-control input-lg" name="editarCategoria" id="editarCategoria" required>
                                    <!-- Aquí puedes cargar las categorías dinámicamente -->
                                </select>
                            </div>
                        </div>
                        <!-- MARCA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                <select class="form-control input-lg" name="editarMarca" id="editarMarca" required>
                                    <!-- Aquí puedes cargar las marcas dinámicamente -->
                                </select>
                            </div>
                        </div>
                        <!-- STOCK -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                <input type="number" class="form-control input-lg" name="editarStock" id="editarStock" min="0" required>
                            </div>
                        </div>
                        <!-- PRECIO COMPRA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                                <input type="number" step="any" class="form-control input-lg" name="editarPrecioCompra" id="editarPrecioCompra" required>
                            </div>
                        </div>
                        <!-- PRECIO VENTA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                                <input type="number" step="any" class="form-control input-lg" name="editarPrecioVenta" id="editarPrecioVenta" required>
                            </div>
                        </div>
                        <!-- ESTADO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-toggle-on"></i></span>
                                <select class="form-control input-lg" name="editarEstado" id="editarEstado" required>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <!-- FECHA VENCIMIENTO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control input-lg" name="editarFechaVencimiento" id="editarFechaVencimiento" required>
                            </div>
                        </div>
                        <!-- IMAGEN -->
                        <div class="form-group">
                            <div class="panel">Subir Imagen</div>
                            <input type="file" class="nuevaImagen" name="editarImagen">
                            <p class="help-block">Peso máximo de la imagen 2MB</p>
                            <img src="views/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                            <input type="hidden" name="imagenActual" id="imagenActual">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
                <?php
                // $editarProducto = new ControladorProducto();
                // $editarProducto->ctrEditarProducto();
                ?>
            </form>
        </div>
    </div>
</div>

<?php
// $eliminarProducto = new ControladorProducto();
// $eliminarProducto->ctrEliminarProducto();
?>