<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">receipt</i>Comprobante</h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <?php   if($clase == 'historial' or  $clase == 'ordenes'){ ?>
                        <h3 class="title">
                        <?php   if($estado == '0') echo "Información de compra - Por pagar"; 
                                elseif($estado == '1') echo "Información de compra - Transferencia Bancaria"; 
                                elseif($estado == '2') echo "Información de compra - WebPay Rechazada"; 
                                elseif($estado == '3') echo "Información de Venta - por Validar"; 
                                elseif($estado == '4') echo "Información de Arriendo - por Validar";
                                elseif($estado == '5') echo "Información de Regalo - por Validar";
                                elseif($estado == '6') echo "Información de Transacción Validada";?>
                        </h3>
                        <?php }else{ ?>
                        <?php if($pago == 'transferencia'){?>
                        <h3 class="title">Información de compra - Transferencia Bancaria</h3>
                        <?php }elseif($pago == 'webpay' and $validador == '1'){ ?>
                        <h3 class="title">Información de Compra Exitosa</h3>
                        <?php }elseif($pago == 'webpay' and $validador == '0'){ ?>
                        <h3 class="title">Información de Compra Rechazada</h3>
                        <?php }} ?>
                    </div>
                    <br/>
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
                                    <td><?php echo $usuario;?></td>
                                    <td><?php echo $total;?></td>
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
                                <?php if($pago == 'webpay' and $validador == '0'){ ?>
                                <tr><th colspan="4" style="background: LightGray;">La compra a sido declinada, por favor validar con su banco el origen del problema.</th></tr>
                                <?php }elseif($pago == 'transferencia'){?>
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
                    <div class="col-md-12 text-right">
                        <ul class="pagination pagination-lg pager" id="myPager"></ul> 
                    </div><!-- Revisar paginado - Fallan los números -->
                    <div class="col-md-12 text-right">
                        <?php if($clase == 'historial'){ ?>
                        <a href="<?php echo site_url("historial_con/index"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-reply"></i> Volver </a>
                        <?php }elseif($clase == 'ordenes'){ ?>
                        <a href="<?php echo site_url("operacion_con/ordenes"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-reply"></i> Volver </a>
                        <?php } ?>
                        <!--a href="<?php echo site_url("operacion_con/down_comprobante/".$id_tmp_compra); ?>" target="_blank" class="btn btn-primary btn-xs" style="background: #af1416;     box-shadow:none;" > <i class="fa fa-file-pdf-o"></i> Descargar Comprobante</a-->
                        <button onclick="window.print();" class="btn btn-primary btn-xs" style="background: #af1416;     box-shadow:none;" > <i class="fa fa-file-pdf-o"></i> Imprimir Comprobante</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

	        
