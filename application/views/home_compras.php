<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">shopping_cart</i>Comprar</h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php echo form_open('operacion_con/crear_compra'); ?>
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary btn-xs" style="font-size: 15pt;width: 30%;height:50px;margin-right: 30px;margin-bottom: 20px;background: #af1416;     box-shadow:none;" > <i class="fa fa-shopping-basket" style="font-size: 20pt;"></i> &nbsp&nbsp&nbsp Carro de Compras </button>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Compras</h3>
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
                                    <td><?php echo $producto->cantidad; ?></td>
                                    <td><div class="form-group"><div><input onChange="sumcnt(<?php echo "'".$producto->id_producto."'"; ?>);" onKeyup="sumcnt(<?php echo "'".$producto->id_producto."'"; ?>);" onClick="sumcnt(<?php echo "'".$producto->id_producto."'"; ?>);" name="<?php echo 'cnt'.$producto->id_producto; ?>" id="<?php echo 'cnt'.$producto->id_producto; ?>" type="number" class="form-control input-sm" disabled="disabled" value="0"></div></div></td>
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
                </form>
            </div>
        </div>
    </div>
</div>