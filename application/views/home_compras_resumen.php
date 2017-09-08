<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">add_shopping_cart</i>Carro de Compras</h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php echo form_open('operacion_con/comprar/carro'); ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Resumen de compra</h3>
                    </div>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Código Producto</th>
                                    <th>Producto</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Código Barras</th>
                                    <th>Precio</th>
                                    <th>Moneda</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php foreach ($compras as $compra) { ?>
                                <tr>
                                    <td><?php echo $compra->cod_prod; ?></td>
                                    <td><?php echo $compra->producto; ?></td>
                                    <td><?php echo $compra->marca; ?></td>
                                    <td><?php echo $compra->modelo; ?></td>
                                    <td><?php echo $compra->cod_bar; ?></td>
                                    <td><?php echo number_format($compra->prc_vta,0,",","."); ?></td>
                                    <td><?php echo $arr_mnd[$compra->mnd_vta]; ?></td>
                                    <td><?php echo number_format($compra->cantidad,0,",","."); ?></td>
                                    <td><?php echo number_format($compra->total,0,",","."); ?></td>
                                    <td><a href="<?php echo site_url("operacion_con/eliminar_detalle/{$compra->id_tmp_detalle}"); ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Borrar </a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <ul class="pagination pagination-lg pager" id="myPager"></ul> 
                    </div><!-- Revisar paginado - Fallan los números -->
                    <div class="col-md-12 text-right">
                        <a href="<?php echo site_url("operacion_con/index/1"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-reply"></i> Volver a Compras </a>
                        <a href="<?php echo site_url("operacion_con/vaciar_carrito/".$compra->id_tmp_compra); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-trash-o"></i> Vaciar Carrito </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="title">Facturación</h4>
                            </div>
                            <br/>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; width:100px;">Seleccion</th>
                                            <th>Tipo Documento</th><th>Empresa</th><th>Rut</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                        <tr>
                                            <td style="text-align: center; width:100px;height:64px;"><input name="t_fact" value="boleta" type="radio" style="height:20px; width:20px; vertical-align: middle;" required></td>
                                            <td>Boleta</td><td></td><td></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; width:100px;height:64px;"><input name="t_fact" value="empresa" type="radio" style="height:20px; width:20px; vertical-align: middle;" required></td>
                                            <td>Factura Empresa</td>
                                            <td><?php echo $info['empresa'];?></td><td><?php echo $info['rut'];?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; width:100px;height:64px;"><input name="t_fact" value="otro" type="radio" style="height:20px; width:20px; vertical-align: middle;" required></td>
                                            <td>Factura</td>
                                            <td><input name="name_fact" id="name_fact" type="text" style="width:150px;border: none;border-bottom: 1px solid;" placeholder="Empresa"></td>
                                            <td><input name="rut_fact" id="rut_fact" type="text" style="width:150px;border: none;border-bottom: 1px solid;" placeholder="Rut"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="title">Despacho de productos</h4>
                            </div>
                            <br/>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; width:100px;">Seleccion</th><th>Tipo despacho</th><th>Dirección</th><th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                        <tr>
                                            <td style="text-align: center; width:100px;"><input name="t_desp" value="laboral" type="radio" style="height:20px; width:20px; vertical-align: middle;" required></td>
                                            <td>Dirección Laboral</td><td><?php echo $info['dir_laboral'];?></td><td></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; width:100px;"><input name="t_desp" value="personal" type="radio" style="height:20px; width:20px; vertical-align: middle;" required></td>
                                            <td>Dirección Personal</td><td><?php echo $info['dir_personal'];?></td><td></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; width:100px;"><input name="t_desp" value="otro" type="radio" style="height:20px; width:20px; vertical-align: middle;" required></td>
                                            <td>Otra Dirección</td>
                                            <td><input name="dir" id="dir" type="text" style="width:230px;border: none;border-bottom: 1px solid;" placeholder="Dirección"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; width:100px;"><input name="t_desp" value="retiro" type="radio" style="height:20px; width:20px; vertical-align: middle;" required></td>
                                            <td>Retiro en Local</td><td>Nueva York 47, Santiago</td><td>0 CLP</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="title">Medio de Pago</h4>
                            </div>
                            <br/>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody id="myTable">
                                        <tr>
                                            <td style="text-align: center; width:100px;">
                                                <input name="t_pago" value="webpay" type="radio" style="height:20px; width:20px; vertical-align: middle;" required>
                                            </td>
                                            <td>
                                                <img src="<?php echo base_url(); ?>application/images/webpay.png" style="max-width: 150px; max-height: 300px" />
                                            </td>
                                            <td style="text-align: center; width:100px;">
                                                <input name="t_pago" value="transferencia" type="radio" style="height:20px; width:20px; vertical-align: middle;" required>
                                            </td>
                                            <td>
                                                <img src="<?php echo base_url(); ?>application/images/transferencia.png" style="max-width: 150px; max-height: 300px" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <br><br><br><br>
                        <table align="center">
                            <tr>
                                <td>
                                    <input name="total" id="total" type="text" style="background: white;text-align:center;width:150px;height:60px;font-size: 15pt;" readonly value="<?php echo number_format($total,0,',','.'); ?>">
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-xs" style="font-size: 15pt;width: 105%;height:60px;margin-right: 200px;margin-bottom: 10px;background: #af1416;box-shadow:none;"> <i class="fa fa-shopping-cart" style="font-size: 20pt;"></i> &nbsp&nbsp&nbsp Comprar </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>