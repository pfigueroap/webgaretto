<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">timeline</i>Detalle Arriendo</h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Información Contrato Arriendo</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody id="myTable">
                                <tr>
                                    <th>ID Arriendo</th>
                                    <th>Operador</th>
                                    <th>Costo Mensual</th>
                                    <th>Cantidad de Trabajadores</th>
                                </tr>
                                <tr>
                                    <td><?php echo $arriendo['id_arriendo'];?></td>
                                    <td><?php echo $arriendo['usuario'];?></td>
                                    <td><?php echo number_format($arriendo['costo_mensual'],3,",",".")." ".$arr_mnd[$arriendo['id_moneda']];?></td>
                                    <td><?php echo $arriendo['cant_trab'];?></td>
                                </tr>
                                <tr>
                                    <th>Periodo de Gracia</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Fecha/Hora de Creación</th>
                                    <th>ID Activación</th>
                                </tr>
                                <tr>
                                    <td><?php echo $arriendo['per_gracia'];?></td>
                                    <td><?php echo $arriendo['f_inicio'];?></td>
                                    <td><?php echo $arriendo['f_creacion']." - ".$arriendo['h_creacion'];?></td>
                                    <td><?php echo $arriendo['id_tmp_compra'];?></td>
                                </tr>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Rut Cliente</th>
                                    <th>Correo</th>
                                    <th>Usuario</th>
                                </tr>
                                <tr>
                                    <td><?php echo $arriendo['nombre_1']." ".$arriendo['nombre_2']." ".$arriendo['apellido_1']." ".$arriendo['apellido_2'];?></td>
                                    <td><?php echo $arriendo['rut']?></td>
                                    <td><?php echo $arriendo['correo']?></td>
                                    <td><?php echo $arriendo['user_client']?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Detalle de productos</h3>
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
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php foreach ($arriendo['productos'] as $producto) { ?>
                                <tr>
                                    <td><?php echo $producto->cod_prod; ?></td>
                                    <td><?php echo $producto->producto; ?></td>
                                    <td><?php echo $producto->marca; ?></td>
                                    <td><?php echo $producto->modelo; ?></td>
                                    <td><?php echo $producto->cod_bar; ?></td>
                                    <td><?php echo number_format($producto->cantidad,0,",","."); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Detalle Periodos de Arriendo</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID Cuota</th>
                                    <th>Inicio Periodo</th>
                                    <th>Fin Periodo</th>
                                    <th>Total Pago</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php foreach($periodos as $periodo){?>
                                <tr>
                                    <td><?php echo $periodo['id']; ?></td>
                                    <td><?php echo $periodo['f_inicio']; ?></td>
                                    <td><?php echo $periodo['f_fin']; ?></td>
                                    <td><?php echo number_format($periodo['prc_pago']*$arriendo['costo_mensual'],3,",",".")." ".$arr_mnd[$arriendo['id_moneda']]; ?></td>
                                    <td><?php if($periodo['id'] <= $arriendo['per_gracia']){?>
                                        <a href="#" class="btn btn-success btn-xs"><i class="fa fa-gift"></i> Período de Gracia </a>
                                        <?php }else{ ?>
                                        <a href="<?php echo site_url("operacion_con/pago_arriendo/".$arriendo['id_arriendo']."/".$periodo['id']); ?>" class="btn btn-warning btn-xs"><i class="fa fa-credit-card-alt"></i> Pagar </a>
                                        <?php }?> 
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    <a href="<?php echo site_url("operacion_con/arriendos"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-reply"></i> Volver </a>
                </div>
            </div>
        </div>
    </div>
</div>

	        
