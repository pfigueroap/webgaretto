<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">receipt</i>Comprobante</h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">
                    <?php   if($estado == '0' and $f_pago == 'webpay') echo "Información de compra - Webpay Rechazada";
                            if($estado == '0' and $f_pago != 'webpay') echo "Información de compra - Por Pagar";
                            elseif($estado == '1') echo "Información de compra - Transferencia Bancaria"; 
                            elseif($estado == '2' and $valida == '0') echo "Información de compra - WebPay Rechazada"; 
                            elseif($estado == '2' and $valida == '1') echo "Información de compra - WebPay Aprobada"; 
                            elseif($estado == '3') echo "Información de Venta - por Validar"; 
                            elseif($estado == '4') echo "Información de Arriendo";
                            elseif($estado == '5') echo "Información de Regalo";
                            elseif($estado == '6') echo "Información de Transacción Validada"; ?>
                    </h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody id="myTable">
                                <tr>
                                    <th>ID Compra</th>
                                    <th>Usuario</th>
                                    <th>Total</th>
                                    <th>Moneda</th>
                                </tr>
                                <tr>
                                    <td><?php echo $id_compra;?></td>
                                    <td><?php echo $user;?></td>
                                    <td><?php echo number_format($total,0,",",".");?></td>
                                    <td>CLP</td>
                                </tr>
                                <tr>
                                    <th>Tipo de Pago</th>
                                    <th>Cantidad Productos</th>
                                    <th>Tipo de Despacho</th>
                                    <th>Dirección</th>
                                </tr>
                                <tr>
                                    <td><?php echo $pago;?></td>
                                    <td><?php echo number_format(count($compras),0,",",".");?></td>
                                    <td><?php echo $despacho;?></td>
                                    <td><?php echo $direccion;?></td>
                                </tr>
                                <?php if($id_tmp_compra != '0'){ ?>
                                <tr>
                                    <th>Fecha  -  Hora Compra</th>
                                    <th>Facturación</th>
                                    <th>Empresa</th>
                                    <th>Rut</th>
                                </tr>
                                <tr>
                                    <td><?php echo $orden_compra['f_compra'].' - '.$orden_compra['h_compra'];?></td>
                                    <td><?php echo $orden_compra['factura'];?></td>
                                    <td><?php echo $orden_compra['empresa'];?></td>
                                    <td><?php echo $orden_compra['rut'];?></td>
                                </tr>
                                <?php } ?>
                                <?php if($pago == 'webpay' and $valida == '0'){ ?>
                                <tr><th colspan="4" style="background: LightGray;">La compra a sido declinada, por favor validar con su banco el origen del problema.</th></tr>
                                <?php }elseif($pago == 'transferencia' and $valida == '0'){?>
                                <tr><th colspan="4" style="background: LightGray;">Está compra aún no se encuentra validada, una vez realizada la tansferencia a la cuenta señala a continuación, informando el ID de compra en el asunto, se procederá al despacho del producto.</th></tr>
                                <tr>
                                    <th>Banco/Tipo de Cuenta</th>
                                    <th>Nº Cuenta</th>
                                    <th>Nombre/Rut</th>
                                    <th>Correo</th>
                                </tr>
                                <tr>
                                    <td>Banco de Chile - Cta Corriente</td>
                                    <td>XXXX-XXXX-XXXX</td>
                                    <td>11.111.111-1</td>
                                    <td>contacto@garetto.cl</td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Registro de compras</h3>
                    </div>
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
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if($valida == '1'){?>
                <hr>
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Voucher</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID Compra</th>
                                    <th>Monto Total</th>
                                    <th>Tipo Pago</th>
                                    <th>Fecha - Hora</th>
                                    <th>Facturación</th>
                                    <th>Validado</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <tr>
                                    <td><?php echo $id_compra; ?></td>
                                    <td><?php echo number_format($total,0,",",".");?> CLP</td>
                                    <td><?php echo $pago;?></td>
                                    <td><?php echo $orden_compra['f_compra'].' - '.$orden_compra['h_compra'];?></td>
                                    <td><?php echo $orden_compra['factura'];?></td>
                                    <td><img src="<?php echo base_url(); ?>application/images/check.png" style="width: 30px;" /></td>
                                </tr>
                            </tbody>
                        </table>
                        <textarea style="width: 100%;height: 60px;font-size: 8pt;text-align: justify;background-color: whitesmoke;" readonly>Estimado Cliente, gracias por preferirnos, en Garetto estamos para ayudarlo, una vez recibido su producto, agradeceremos tomar contacto con Nuestra área de Servicios y Soporte, para asesorarlo en su Instalación y respectiva validación. El nombre de la persona encargada es <?php echo $info_comp->nombre; ?>, su N° telefónico es <?php echo $info_comp->telefono; ?> y su mail es <?php echo $info_comp->correo; ?>.</textarea>
                    </div>
                </div>
                <?php } ?>
                <div class="col-md-12 text-right">
                    <?php if($clase == 'historial'){ ?>
                    <a href="<?php echo site_url("historial_con/index"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-reply"></i> Volver </a>
                    <?php }elseif($clase == 'ordenes'){ ?>
                    <a href="<?php echo site_url("operacion_con/ordenes"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-reply"></i> Volver </a>
                    <?php }elseif($clase == 'arriendo'){ ?>
                    <a href="<?php echo site_url("operacion_con/arriendos"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-reply"></i> Volver </a>
                    <?php } ?>
                    <?php if($valida == '1'){?>
                    <a href="<?php echo site_url("operacion_con/down_comprobante/".$id_tmp_compra); ?>" target="_blank" class="btn btn-primary btn-xs" style="background: #af1416;     box-shadow:none;" > <i class="fa fa-file-pdf-o"></i> Descargar Comprobante</a>
                    <button onclick="window.print();" class="btn btn-primary btn-xs" style="background: #af1416;     box-shadow:none;" > <i class="fa fa-print"></i> Imprimir Comprobante</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

	        
