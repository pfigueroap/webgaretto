<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">cloud</i>Arriendo</h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php echo form_open('operacion_con/crear_orden/arriendo'); ?>
                <div class="col-md-12 text-right card">
                    <table class="text-left">
                        <tr>
                            <td style="width:120px;text-align:right;">Fecha de Inicio</td>
                            <td style="width:10px;text-align:right;">:</td>
                            <td>
                                <input name="f_inicio" type="date" class="form-control col-md-7 col-xs-12 parsley-success" required>
                            </td>
                            <td style="width:150px;text-align:right;">Periodo de Gracia</td>
                            <td style="width:10px;text-align:right;">:</td>
                            <td>
                                <input name="per_gracia" type="number" min="0" style="margin-bottom: 15px;" class="form-control col-md-7 col-xs-12" style="width:70px;" placeholder="mes" required>
                            </td>
                            <td style="width:120px;text-align:right;">Costo Mensual</td>
                            <td style="width:10px;text-align:right;">:</td>
                            <td style="width:150px;">
                                <input name="costo_mensual" type="number" min="0" class="form-control col-md-7 col-xs-12 parsley-success" style="margin-bottom: 15px;" placeholder="Cuota" required>
                            </td>
                            <td style="width:100px;">
                                <select style="font-size: 10pt;width: 80px;height:30px;" name="id_moneda">
                                <?php foreach ($monedas as $mnd) {?>
                                <option value="<?php echo $mnd->id_moneda;?>"><?php echo $mnd->moneda;?></option>
                                <?php }?></select>
                            </td>
                            <td style="width:300px;">
                                <select style="font-size: 12pt;width: 250px;height:30px;" name="id_cliente">
                                <?php foreach ($clientes as $cliente) {?>
                                <option value="<?php echo $cliente->id_usuario; ?>"><?php echo $cliente->nombre_1." ".$cliente->apellido_1." (".$cliente->usuario.")"; ?></option>
                                <?php }?>
                                </select>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-xs" style="font-size: 12pt;width: 200px;height:30px;background: #af1416;box-shadow:none;" > <i class="fa fa-credit-card-alt" style="font-size: 15pt;"></i> &nbsp&nbsp&nbsp Arriendo </button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Arriendos</h3>
                    </div>
                    <!--CONTENIDO BODY-->
                    <br/>
                    <br/>
                    <!--TABLA-->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td><input onkeyup="doSearch('searchTerm1','1')" id="searchTerm1" type="search" class="form-control input-sm" placeholder="Buscar Código Producto" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm2','2')" id="searchTerm2" type="search" class="form-control input-sm" placeholder="Buscar Producto" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm3','3')" id="searchTerm3" type="search" class="form-control input-sm" placeholder="Buscar Marca" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm4','4')" id="searchTerm4" type="search" class="form-control input-sm" placeholder="Buscar Modelo" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm5','5')" id="searchTerm5" type="search" class="form-control input-sm" placeholder="Buscar Código Barras" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <th>Comprar</th>
                                    <th>Código Producto</th>
                                    <th>Producto</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Código Barras</th>
                                    <th>Precio</th>
                                    <th>Moneda</th>
                                    <th>Stock</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php foreach ($productos as $producto) { ?>
                                <tr>
                                    <td><input name="<?php echo 'chk'.$producto->id_producto; ?>" id="<?php echo 'chk'.$producto->id_producto; ?>" onChange="validarchk(<?php echo "'".$producto->id_producto."'"; ?>);" type="checkbox" style="height:20px; width:20px; vertical-align: middle;"></td>
                                    <td><?php echo $producto->cod_prod; ?></td>
                                    <td><?php echo $producto->producto; ?></td>
                                    <td><?php echo $producto->marca; ?></td>
                                    <td><?php echo $producto->modelo; ?></td>
                                    <td><?php echo $producto->cod_bar; ?></td>
                                    <td id="<?php echo 'prc'.$producto->id_producto; ?>"><?php echo number_format($producto->prc_vta,0,",","."); ?></td>
                                    <td><?php echo $arr_mnd[$producto->mnd_vta]; ?></td>
                                    <td id="<?php echo 'stk'.$producto->id_producto; ?>"><?php echo $stock[$producto->id_producto]; ?></td>
                                    <td><div class="form-group"><div><input onChange="sumcnt(<?php echo "'".$producto->id_producto."'"; ?>);" onKeyup="sumcnt(<?php echo "'".$producto->id_producto."'"; ?>);" onClick="sumcnt(<?php echo "'".$producto->id_producto."'"; ?>);" name="<?php echo 'cnt'.$producto->id_producto; ?>" id="<?php echo 'cnt'.$producto->id_producto; ?>" type="number" min="0" class="form-control input-sm" disabled="disabled" value="0"></div></div></td>
                                    <td><div class="form-group"><div><input name="<?php echo 'tot'.$producto->id_producto; ?>" id="<?php echo 'tot'.$producto->id_producto; ?>" type="number" class="form-control input-sm" readonly value="0"></div></div></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <ul class="pagination pagination-lg pager" id="myPager"></ul> 
                    </div><!-- Revisar paginado - Fallan los números -->
                </div>
                <!--/form-->
            </div>
        </div>
    </div>
</div>

	        
