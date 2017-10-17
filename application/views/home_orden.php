<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">
    <?php if($estado == '0'){ ?>content_paste</i>Detalle Orden</h3>
    <?php }else{ ?>payment</i>Pagar Orden</h3><?php } ?>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Información de Orden</h3>
                    </div>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody id="myTable">
                                <tr>
                                    <th>ID Orden</th>
                                    <th>Nombre</th>
                                    <th>Total</th>
                                    <th>Moneda</th>
                                </tr>
                                <tr>
                                    <td><?php echo $orden['id_tmp_compra'];?></td>
                                    <?php if($orden['nombre_1'] == ''){ ?>
                                    <td><?php echo $info['nombre_1']." ".$info['apellido_1']; ?></td>
                                    <?php }else{ ?>
                                    <td><?php echo $orden['nombre_1']." ".$orden['apellido_1'];?></td>
                                    <?php } ?>
                                    <td><?php echo number_format($orden['total'],0,",",".");?></td>
                                    <td>CLP</td>
                                </tr>
                                <tr>
                                    <th>Tipo Orden</th>
                                    <th>Rut</th>
                                    <th>Fecha Orden</th>
                                    <th>Hora Orden</th>
                                </tr>
                                <tr>
                                    <td><?php 
                                    if($orden['estado'] == '0') echo "Por pagar"; 
                                    elseif($orden['estado'] == '1') echo "Transferencia"; 
                                    elseif($orden['estado'] == '2') echo "WebPay"; 
                                    elseif($orden['estado'] == '3') echo "Venta"; 
                                    elseif($orden['estado'] == '4') echo "Arriendo";
                                    elseif($orden['estado'] == '5') echo "Regalo";?></td>
                                    <?php if($orden['rut'] == ''){ ?>
                                    <td><?php echo $info['rut']; ?></td>
                                    <?php }else{ ?>
                                    <td><?php echo $orden['rut'];?></td>
                                    <?php } ?>
                                    <td><?php echo $orden['f_ingreso'] ?></td>
                                    <td><?php echo $orden['h_ingreso']?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Productos Orden</h3>
                    </div>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Código Producto</th>
                                    <th>Producto</th>
                                    <th>Modelo</th>
                                    <th>Marca</th>
                                    <th>Precio</th>
                                    <th>Moneda</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php foreach ($registros as $producto) { ?>
                                <tr>
                                    <td id="estadoTfila col1"><?php echo $producto->cod_prod; ?></td>
                                    <td id="estadoTfila col1"><?php echo $producto->producto; ?></td>
                                    <td id="estadoTfila col1"><?php echo $producto->modelo; ?></td>
                                    <td id="estadoTfila col1"><?php echo $producto->marca; ?></td>
                                    <td id="estadoTfila col1"><?php echo number_format($producto->prc_vta,0,",","."); ?></td>
                                    <td id="estadoTfila col1"><?php echo $arr_mnd[$producto->mnd_vta]; ?></td>
                                    <td id="estadoTfila col1"><?php echo number_format($producto->cantidad,0,",","."); ?></td>
                                    <td id="estadoTfila col1"><?php echo number_format($producto->total,0,",","."); ?></td>
                                    <td>
                                        <a href="<?php echo site_url("operacion_con/eliminar_det_orden/{$clase}/".$orden['id_tmp_compra']."/".$producto->id_tmp_detalle); ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Borrar </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <ul class="pagination pagination-lg pager" id="myPager"></ul> 
                    </div><!-- Revisar paginado - Fallan los números -->
                    <div class="col-md-12 text-right">
                        <?php if($clase == 'historial'){ ?>
                        <a href="<?php echo site_url("historial_con/index"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-reply"></i> Volver al Historial </a>
                        <?php }elseif($clase == 'ordenes'){ ?>
                        <a href="<?php echo site_url("operacion_con/ordenes"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-reply"></i> Volver a Ordenes </a>
                        <?php } ?>
                        <a href="<?php echo site_url("operacion_con/eliminar_orden/{$orden['id_tmp_compra']}/{$clase}"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-trash-o"></i> Eliminar Orden </a>
                    </div>
                </div>
                <?php 
                if($estado == '3' or $estado == '4') 
                    echo form_open('operacion_con/comprar/'.$orden['id_tmp_compra']); 
                else
                    echo form_open("operacion_con/actualizar_orden/{$orden['id_tmp_compra']}/{$clase}"); 
                ?>
                <?php if($orden['estado'] != '5'){?>
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
                                            <td style="text-align: center; width:100px;"><input name="t_fact" value="boleta" type="radio" style="height:20px; width:20px; vertical-align: middle;" required
                                            <?php if($orden['t_factura'] == "boleta") echo "checked"; ?>></td>
                                            <td>Boleta</td><td></td><td></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; width:100px;"><input name="t_fact" value="empresa" type="radio" style="height:20px; width:20px; vertical-align: middle;" required 
                                            <?php if($orden['t_factura'] == "empresa") echo "checked"; ?>></td>
                                            <td>Factura Empresa</td>
                                            <td><?php echo $info['empresa'];?></td><td><?php echo $info['rut'];?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; width:100px;"><input name="t_fact" value="otro" type="radio" style="height:20px; width:20px; vertical-align: middle;" required
                                            <?php if($orden['t_factura'] == "otro") echo "checked"; ?>></td>
                                            <td>Factura</td>
                                            <td><input name="name_fact" id="name_fact" type="text" style="width:150px;border: none;border-bottom: 1px solid;"
                                            <?php if($orden['t_factura'] == "otro"){?> value="<?php echo $orden['empresa'];?>" 
                                            <?php }else{ ?> placeholder="Empresa" <?php }?>></td>
                                            <td><input name="rut_fact" id="rut_fact" type="text" style="width:150px;border: none;border-bottom: 1px solid;"
                                            <?php if($orden['t_factura'] == "otro"){?> value="<?php echo $orden['e_rut'];?>" 
                                            <?php }else{ ?> placeholder="Rut Empresa" <?php }?>></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td><input name="giro_fact" id="giro_fact" type="text" style="width:150px;border: none;border-bottom: 1px solid;"
                                            <?php if($orden['t_factura'] == "otro"){?> value="<?php echo $orden['giro'];?>" 
                                            <?php }else{ ?> placeholder="Giro" <?php }?>></td>
                                            <td><input name="dir_fact" id="dir_fact" type="text" style="width:150px;border: none;border-bottom: 1px solid;"
                                            <?php if($orden['t_factura'] == "otro"){?> value="<?php echo $orden['dir_fact'];?>" 
                                            <?php }else{ ?> placeholder="Dirección" <?php }?>></td>
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
                                            <td style="text-align: center; width:100px;"><input name="t_desp" value="laboral" type="radio" style="height:20px; width:20px; vertical-align: middle;" required 
                                                <?php if($orden['t_despacho'] == "laboral") echo "checked"; ?>></td>
                                            <td>Dirección Laboral</td><td><?php echo $info['dir_laboral'];?></td><td></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; width:100px;"><input name="t_desp" value="personal" type="radio" style="height:20px; width:20px; vertical-align: middle;" required 
                                                <?php if($orden['t_despacho'] == "personal") echo "checked"; ?>></td>
                                            <td>Dirección Personal</td><td><?php echo $info['dir_personal'];?></td><td></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; width:100px;"><input name="t_desp" value="otro" type="radio" style="height:20px; width:20px; vertical-align: middle;" required 
                                                <?php if($orden['t_despacho'] == "otro") echo "checked"; ?>></td>
                                            <td>Otra Dirección</td>
                                            <td><input name="dir" id="dir" type="text" style="width:230px;border: none;border-bottom: 1px solid;" 
                                            <?php if($orden['t_despacho'] == "otro"){?> value="<?php echo $orden['direccion'];?>" 
                                            <?php }else{ ?> placeholder="Dirección" <?php }?>></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; width:100px;"><input name="t_desp" value="retiro" type="radio" style="height:20px; width:20px; vertical-align: middle;" required 
                                                <?php if($orden['t_despacho'] == "retiro") echo "checked"; ?>></td>
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
                                                <input name="t_pago" value="webpay" type="radio" style="height:20px; width:20px; vertical-align: middle;" required 
                                                <?php if($orden['f_pago'] == "webpay") echo "checked"; ?>>
                                            </td>
                                            <td>
                                                <img src="<?php echo base_url(); ?>application/images/webpay.png" style="max-width: 150px; max-height: 300px" />
                                            </td>
                                            <td style="text-align: center; width:100px;">
                                                <input name="t_pago" value="transferencia" type="radio" style="height:20px; width:20px; vertical-align: middle;" required
                                                <?php if($orden['f_pago'] == "transferencia") echo "checked"; ?>>
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
                                    <input name="total" id="total" type="text" style="background: white;text-align:center;width:150px;height:60px;font-size: 15pt;" readonly value="<?php echo number_format($orden['total'],0,',','.'); ?>">
                                </td>
                                <td>
                                    <?php if($estado != '0'){ ?>
                                    <button class="btn btn-primary btn-xs" style="font-size: 15pt;width: 105%;height:60px;margin-right: 200px;margin-bottom: 10px;background: #af1416;box-shadow:none;"> <i class="fa fa-shopping-cart" style="font-size: 20pt;"></i> &nbsp&nbsp&nbsp Comprar </button>
                                    <?php }else{ ?>
                                    <button class="btn btn-primary btn-xs" style="font-size: 15pt;width: 105%;height:60px;margin-right: 200px;margin-bottom: 10px;background: #af1416;box-shadow:none;"> <i class="fa fa-refresh" style="font-size: 20pt;"></i> &nbsp&nbsp&nbsp Actualizar Orden </button>
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                </form>
                <?php }?>
            </div>
        </div>
    </div>
</div>