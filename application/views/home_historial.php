<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">history</i>Historial</h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Historial</h3>
                    </div>
                    <!--CONTENIDO BODY-->
                    <br/>
                    <br/>
                    <!--TABLA-->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Rut Cliente</th>
                                    <th>ID Operación</th>
                                    <th>Fecha Operación</th>
                                    <th>Hora Operación</th>
                                    <th>Tipo Operación</th>
                                    <th>Total</th>
                                    <th>Comprobante</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php foreach ($registros as $registro) { ?>
                                <tr>
                                    <?php if($registro->nombre_1 == ''){ ?>
                                    <td><?php echo $info['nombre_1']." ".$info['apellido_1']; ?></td>
                                    <td><?php echo $info['rut']; ?></td>
                                    <?php }else{ ?>
                                    <td><?php echo $registro->nombre_1." ".$registro->apellido_1; ?></td>
                                    <td><?php echo $registro->rut; ?></td>
                                    <?php } ?>
                                    <td><?php echo $registro->id_tmp_compra; ?></td>
                                    <td><?php echo $registro->f_ingreso; ?></td>
                                    <td><?php echo $registro->h_ingreso; ?></td>
                                    <td><?php 
                                    if($registro->estado == '0') echo "Por pagar"; 
                                    elseif($registro->estado == '1') echo "Transferencia"; 
                                    elseif($registro->estado == '2') echo "WebPay"; 
                                    elseif($registro->estado == '3') echo "Venta"; 
                                    elseif($registro->estado == '4') echo "Arriendo";
                                    elseif($registro->estado == '5') echo "Regalo";
                                    elseif($registro->estado == '6') echo "Validado";
                                    ?></td>
                                    <td><?php echo number_format($registro->total,0,",","."); ?></td>
                                    <td>
                                        <a href="<?php echo site_url("historial_con/comprobante/".$registro->id_tmp_compra); ?>" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Ver </a>
                                    </td>
                                    <td>
                                        <?php if($registro->valida == '0'){ ?>
                                        <a href="#" class="btn btn-warning btn-xs"><i class="fa fa-handshake-o"></i> Pendiente </a>
                                        <?php }else{ ?>
                                        <a href="#" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Validado </a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($registro->valida == '0'){ ?>
                                        <a href="<?php echo site_url("historial_con/eliminar_orden/{$registro->id_tmp_compra}"); ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Borrar </a>
                                        <a href="<?php echo site_url("historial_con/detalle_registro/".$registro->id_tmp_compra); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Editar </a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <ul class="pagination pagination-lg pager" id="myPager"></ul> 
                    </div><!-- Revisar paginado - Fallan los números -->
                    <!--div class="col-md-12 text-right">
                        <a href="#" class="btn btn-primary btn-xs" style="background: #af1416;     box-shadow:none;" > <i class="fa fa-download"></i> Descargar </a>
                    </div-->
                </div>
            </div>
        </div>
    </div>
</div>

	        
