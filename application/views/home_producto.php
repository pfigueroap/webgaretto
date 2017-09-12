<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">business</i>Productos</h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Productos</h3>
                    </div>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Código Producto</th>
                                    <th>Producto</th>
                                    <th>Modelo</th>
                                    <th>Marca</th>
                                    <th>Código Barras</th>
                                    <th>Precio Venta</th>
                                    <th>Stock</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php foreach ($productos as $producto) { ?>
                                <tr>
                                    <td><?php echo $producto->cod_prod; ?></td>
                                    <td><?php echo $producto->producto; ?></td>
                                    <td><?php echo $producto->modelo; ?></td>
                                    <td><?php echo $producto->marca; ?></td>
                                    <td><?php echo $producto->cod_bar; ?></td>
                                    <td><?php echo number_format($producto->prc_vta,0,",",".")." ".$arr_mnd[$producto->mnd_vta]; ?></td>
                                    <td><?php echo number_format($stock[$producto->id_producto],0,",","."); ?></td>
                                    <td>
                                        <a href="<?php echo site_url("producto_con/gest_prod/editar/{$producto->id_producto}"); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Editar </a>
                                        <a href="<?php echo site_url("producto_con/eliminar/producto/{$producto->id_producto}"); ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Borrar </a>
                                        <a href="<?php echo site_url("producto_con/gest_stock/{$producto->id_producto}"); ?>" class="btn btn-primary btn-xs"><i class="fa fa-archive"></i> Stock </a>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td><input onkeyup="doSearch('searchTerm0','0')" id="searchTerm0" type="search" class="form-control input-sm" placeholder="Buscar Código Producto" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm1','1')" id="searchTerm1" type="search" class="form-control input-sm" placeholder="Buscar Producto" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm2','2')" id="searchTerm2" type="search" class="form-control input-sm" placeholder="Buscar Modelo" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm3','3')" id="searchTerm3" type="search" class="form-control input-sm" placeholder="Buscar Marca" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm4','4')" id="searchTerm4" type="search" class="form-control input-sm" placeholder="Buscar Código Barras" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm5','5')" id="searchTerm6" type="search" class="form-control input-sm" placeholder="Buscar Precio Venta" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm6','6')" id="searchTerm7" type="search" class="form-control input-sm" placeholder="Buscar Stock" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <ul class="pagination pagination-lg pager" id="myPager"></ul> 
                    </div>
                    <div class="col-md-12 text-right">
                        <a href="<?php echo site_url("producto_con/gest_prod/crear"); ?>" class="btn btn-primary btn-xs" style="background: #af1416;     box-shadow:none;" > <i class="fa fa-plus-square"></i> Crear Producto </a>
                        <a href="<?php echo site_url("producto_con/down_productos"); ?>" class="btn btn-primary btn-xs" style="background: #af1416;     box-shadow:none;" > <i class="fa fa-download"></i> Descargar Productos </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>