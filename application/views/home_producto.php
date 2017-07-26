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
                    <!--CONTENIDO BODY-->
                    <br/>
                    <br/>
                    <!--TABLA-->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Código Producto</th>
                                    <th>Producto</th>
                                    <th>Modelo</th>
                                    <th>Marca</th>
                                    <th>Código Barras</th>
                                    <th>Precio Compra</th>
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
                                    <td><?php echo $producto->prc_cpr." ".$arr_mnd[$producto->mnd_cpr]; ?></td>
                                    <td><?php echo $producto->prc_vta." ".$arr_mnd[$producto->mnd_vta]; ?></td>
                                    <td><?php echo $producto->cantidad; ?></td>
                                    <td>
                                        <?php if($prod_edit['id_producto'] != $producto->id_producto){?>
                                        <a href="<?php echo site_url("producto_con/editar/{$producto->id_producto}"); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Editar </a>
                                        <?php }?>
                                        <a href="<?php echo site_url("producto_con/eliminar/{$producto->id_producto}"); ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Borrar </a>
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
                                    <td><input onkeyup="doSearch('searchTerm5','5')" id="searchTerm5" type="search" class="form-control input-sm" placeholder="Buscar Precio Compra" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm6','6')" id="searchTerm6" type="search" class="form-control input-sm" placeholder="Buscar Precio Venta" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm7','7')" id="searchTerm7" type="search" class="form-control input-sm" placeholder="Buscar Stock" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <ul class="pagination pagination-lg pager" id="myPager"></ul> 
                    </div><!-- Revisar paginado - Fallan los números -->
                    <div class="col-md-12 text-right">
                        <a href="<?php echo site_url("producto_con/down_productos"); ?>" class="btn btn-primary btn-xs" style="background: #af1416;     box-shadow:none;" > <i class="fa fa-download"></i> Descargar Productos </a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <?php if($clase == 'producto'){ ?>
                        <h3 class="title">Crear Producto</h3>
                        <?php }elseif($clase == 'editar'){ ?>
                        <h3 class="title">Editar Producto <?php echo $prod_edit['cod_prod']; ?></h3>
                        <?php } ?>
                    </div>
                    <br/>
                    <?php echo form_open('producto_con/mod_prod/'.$clase.'/'.$prod_edit['id_producto']);?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Código Producto</th>
                                    <th>Producto</th>
                                    <th>Descripción</th>
                                    <th>Código Barras</th>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <td><div class="form-group"><div><input name="cod_prod" type="number" class="form-control input-sm" 
                                        <?php if($clase == 'producto'){?> placeholder="Código Producto"
                                        <?php }elseif($clase == 'editar'){?> value="<?php echo $prod_edit['cod_prod'];}?>" required></div></div></td>
                                    <td><div class="form-group"><div><input name="producto" type="text" class="form-control input-sm"
                                        <?php if($clase == 'producto'){?> placeholder="Producto"
                                        <?php }elseif($clase == 'editar'){?> value="<?php echo $prod_edit['producto'];}?>" required></div></div></td>
                                    <td><div class="form-group"><div><input name="descripcion" type="text" class="form-control input-sm"
                                        <?php if($clase == 'producto'){?> placeholder="Descripción"
                                        <?php }elseif($clase == 'editar'){?> value="<?php echo $prod_edit['descripcion'];}?>" required></div></div></td>
                                    <td><div class="form-group"><div><input name="cod_bar" type="number" class="form-control input-sm"
                                        <?php if($clase == 'producto'){?> placeholder="Código Barras"
                                        <?php }elseif($clase == 'editar'){?> value="<?php echo $prod_edit['cod_bar'];}?>" required></div></div></td>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <th>Precio Compra</th>
                                    <th>Moneda Compra</th>
                                    <th>Precio Venta</th>
                                    <th>Moneda Venta</th>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <td><div class="form-group"><div><input name="prc_cpr" type="number" class="form-control input-sm"
                                        <?php if($clase == 'producto'){?> placeholder="Precio Compra"
                                        <?php }elseif($clase == 'editar'){?> value="<?php echo $prod_edit['prc_cpr'];}?>" required></div></div></td>
                                    <td><div class="form-group"><div><select class="form-control input-sm" name="mnd_cpr">
                                        <?php foreach ($monedas as $moneda) {?>
                                        <option value="<?php echo $moneda->id_moneda; ?>" <?php if($moneda->id_moneda == $prod_edit['mnd_cpr']) echo "selected";?>><?php echo $moneda->moneda; ?></option>
                                        <?php }?>
                                    </select></div></div></td>
                                    <td><div class="form-group"><div><input name="prc_vta" type="number" class="form-control input-sm"
                                        <?php if($clase == 'producto'){?> placeholder="Precio Venta"
                                        <?php }elseif($clase == 'editar'){?> value="<?php echo $prod_edit['prc_vta'];}?>" required></div></div></td>
                                    <td><div class="form-group"><div><select class="form-control input-sm" name="mnd_vta">
                                        <?php foreach ($monedas as $moneda) {?>
                                        <option value="<?php echo $moneda->id_moneda; ?>" <?php if($moneda->id_moneda == $prod_edit['mnd_vta']) echo "selected";?>><?php echo $moneda->moneda; ?></option>
                                        <?php }?>
                                    </select></div></div></td>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <th>Modelo</th>
                                    <th>Marca</th>
                                    <th>Fecha Compra</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <td><div class="form-group"><div><input name="modelo" type="text" class="form-control input-sm"
                                        <?php if($clase == 'producto'){?> placeholder="Modelo"
                                        <?php }elseif($clase == 'editar'){?> value="<?php echo $prod_edit['modelo'];}?>" required></div></div></td>
                                    <td><div class="form-group"><div><input name="marca" type="text" class="form-control input-sm"
                                        <?php if($clase == 'producto'){?> placeholder="Marca"
                                        <?php }elseif($clase == 'editar'){?> value="<?php echo $prod_edit['marca'];}?>" required></div></div></td>
                                    <td><div class="form-group"><div><input name="f_compra" type="date" class="form-control input-sm"
                                        <?php if($clase == 'producto'){?> placeholder="Fecha Compra"
                                        <?php }elseif($clase == 'editar'){?> value="<?php echo $prod_edit['f_compra'];}?>" required></div></div></td>
                                    <td><div class="form-group"><div><input name="cantidad" type="number" class="form-control input-sm"
                                        <?php if($clase == 'producto'){?> placeholder="Cantidad"
                                        <?php }elseif($clase == 'editar'){?> value="<?php echo $prod_edit['cantidad'];}?>" required></div></div></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <?php if($clase == 'producto'){?>
                        <button class="btn btn-primary btn-xs" style="background: #af1416;     box-shadow:none;" > <i class="fa fa-plus-square"></i> Crear Producto </button>
                        <?php }elseif($clase == 'editar'){?>
                        <button id="btnSubmit" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-edit" ></i> Editar Producto</button>
                        <a href="<?php echo site_url("producto_con/index"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-reply"></i> Volver </a>
                        <?php }?>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>