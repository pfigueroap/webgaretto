<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">business</i>Productos</h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Agregar Stock Producto</h3>
                    </div>
                    <br/>
                    <?php echo form_open('producto_con/add_stock/'.$producto['id_producto']);?>
                        <div class="row">
                            <div class="col-md-2" style="width:180px;"> 
                                <img src="<?php echo base_url(); ?>application/images/productos/<?php echo $producto['imagen'];?>">
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Documento</th>
                                                <th>Proveedor</th>
                                                <th>Feha de Compra</th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <td><div class="form-group"><div><input name="documento" type="text" class="form-control input-sm" placeholder="Nº documento" required></div></div></td>
                                                <td><div class="form-group"><div><input name="proveedor" type="text" class="form-control input-sm" placeholder="Proveedor" required></div></div></td>
                                                <td><div class="form-group"><div><input name="f_compra" type="date" class="form-control input-sm" required></div></div></td>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <th>Cantidad</th>
                                                <th>Precio compra</th>
                                                <th>Moneda</th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <td><div class="form-group"><div><input name="cantidad" type="number" min="0" class="form-control input-sm" placeholder="Cantidad de productos" required></div></div></td>
                                                <td><div class="form-group"><div><input name="prc_compra" type="number" min="0" class="form-control input-sm" placeholder="Precio de compra" required></div></div></td>
                                                <td><div class="form-group"><div><select class="form-control input-sm" name="id_moneda">
                                                    <?php foreach ($monedas as $mnd) {?>
                                                    <option value="<?php echo $mnd->id_moneda;?>"><?php echo $mnd->moneda;?></option>
                                                    <?php }?></select></div></div></td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-2"> 
                                <br/><br/>
                                <button class="btn btn-primary btn-xs" style="background: #af1416;box-shadow:none;width:200px;height:60px;" > <i class="fa fa-plus-square"></i> Agregar Stock </button>
                                <a href="<?php echo site_url("producto_con/index"); ?>" class="btn btn-default btn-xs" style="background: #af1416;width:200px;"><i class="fa fa-reply"></i> Volver </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Stock Producto</h3>
                    </div>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Documento</th>
                                    <th>Proveedor</th>
                                    <th>Feha de Compra</th>
                                    <th>Cantidad</th>
                                    <th>Precio compra</th>
                                    <th>Moneda</th>
                                    <th>Feha de Ingreso</th>
                                    <th>Usuario</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php foreach ($stock as $det) { ?>
                                <tr>
                                    <td><?php echo $det->documento; ?></td>
                                    <td><?php echo $det->proveedor; ?></td>
                                    <td><?php echo $det->f_compra; ?></td>
                                    <td><?php echo number_format($det->cantidad,0,",","."); ?></td>
                                    <td><?php echo number_format($det->prc_compra,0,",","."); ?></td>
                                    <td><?php echo $arr_mnd[$det->id_moneda]; ?></td>
                                    <td><?php echo $det->f_creacion; ?></td>
                                    <td><?php echo $det->usuario; ?></td>
                                    <td><a href="<?php echo site_url("producto_con/eliminar/stock/{$det->id_prod_stock}"); ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Borrar </a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>