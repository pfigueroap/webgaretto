<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">content_paste</i>Ordenes</h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!--TABLA ORDENES-->
                <?php #echo form_open('operacion_con/vender'); ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Resumen de Ordenes</h3>
                    </div>
                    <br/>
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
                                    <?php if($registro->factura == 'empresa' or $registro->factura == 'otro'){ ?>
                                    <td><?php echo $registro->empresa; ?></td>
                                    <td><?php echo $registro->e_rut; ?></td>
                                    <?php }else{ ?>
                                    <?php if($registro->t_factura == 'empresa' or $registro->t_factura == 'otro'){ ?>
                                    <td><?php echo $registro->em_name; ?></td>
                                    <td><?php echo $registro->em_rut; ?></td>
                                    <?php }else{ ?>
                                    <td><?php echo $registro->nombre_1." ".$registro->apellido_1; ?></td>
                                    <td><?php echo $registro->rut; ?></td>
                                    <?php }} ?>
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
                                    ?></td>
                                    <td><?php echo number_format($registro->total,0,",","."); ?></td>
                                    <td><a href="<?php echo site_url("operacion_con/comprobante/".$registro->id_tmp_compra."/ordenes"); ?>" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Ver </a></td>
                                    <td>
                                        <?php if($registro->valida == '0'){ ?>
                                        <?php if($registro->estado == '1'){ ?>
                                        <a href="<?php echo site_url("operacion_con/genera_validacion/".$registro->id_tmp_compra); ?>" class="btn btn-warning btn-xs"><i class="fa fa-handshake-o"></i> Validar </a>
                                        <?php }else{ ?>
                                        <a href="#" class="btn btn-basic btn-xs"><i class="fa fa-spinner"></i> Pendiente </a>
                                        <?php }}elseif($registro->valida == '1'){ ?>
                                        <a href="#" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Validado </a>
                                        <?php }elseif($registro->valida == '2'){ ?>
                                        <a href="#" class="btn btn-basic btn-xs"><i class="fa fa-spinner"></i> Finanzas </a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($registro->valida == '0'){ ?>
                                        <a href="<?php echo site_url("operacion_con/eliminar_orden/{$registro->id_tmp_compra}/ordenes"); ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Borrar </a>
                                        <a href="<?php echo site_url("operacion_con/detalle_registro/{$registro->id_tmp_compra}/ordenes"); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Editar </a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td><input onkeyup="doSearch('searchTerm0','0')" id="searchTerm0" type="search" class="form-control input-sm" placeholder="Buscar Cliente" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm1','1')" id="searchTerm1" type="search" class="form-control input-sm" placeholder="Buscar Rut" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm2','2')" id="searchTerm2" type="search" class="form-control input-sm" placeholder="Buscar ID" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm3','3')" id="searchTerm3" type="search" class="form-control input-sm" placeholder="Buscar Fecha" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm4','4')" id="searchTerm4" type="search" class="form-control input-sm" placeholder="Buscar Hora" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm5','5')" id="searchTerm5" type="search" class="form-control input-sm" placeholder="Buscar Tipo" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm6','6')" id="searchTerm6" type="search" class="form-control input-sm" placeholder="Buscar Total" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td></td><td></td><td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <ul class="pagination pagination-lg pager" id="myPager"></ul> 
                    </div><!-- Revisar paginado - Fallan los números -->
                    <div class="col-md-12 text-right">
                        <a href="<?php echo site_url("operacion_con/index/2"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-money"></i> &nbsp Ventas </a>
                        <a href="<?php echo site_url("operacion_con/index/3"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-credit-card-alt"></i> &nbsp Arriendos </a>
                        <a href="<?php echo site_url("operacion_con/index/4"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-gift"></i> &nbsp Regalos </a>
                    </div>
                </div>
                <!--/form-->
            </div>
        </div>
    </div>
</div>