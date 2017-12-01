<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">receipt</i>Registro</h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Datos Empresa</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody id="myTable">
                                <tr>
                                    <th>ID Empresa</th>
                                    <th>Empresa</th>
                                    <th>Dirección</th>
                                    <th>Rut</th>
                                    <th>Giro</th>
                                </tr>
                                <tr>
                                    <td><?php echo $empresa['id_empresa'];?></td>
                                    <td><?php echo $empresa['empresa'];?></td>
                                    <td><?php echo $empresa['direccion'];?></td>
                                    <td><?php echo $empresa['rut'];?></td>
                                    <td><?php echo $empresa['giro'];?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Registro de Actividad</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID Registro</th>
                                    <th>ID Compra</th>
                                    <th>Tipo Compra</th>
                                    <th>Fecha de Registro</th>
                                    <th>Hora de Registro</th>
                                    <th>Fecha de Caducidad</th>
                                    <th>Cantidad de Trabajadores</th>
                                    <th>Usuario de Registro</th>
                                    <th>Cantidad</th>
                                    <th style="text-align: center;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php foreach ($registros as $registro) { ?>
                                <tr>
                                    <td><?php echo $registro->id_registro; ?></td>
                                    <td><?php echo $registro->id_compra; ?></td>
                                    <td><?php echo $registro->tipo_orden; ?></td>
                                    <td><?php echo $registro->f_registro; ?></td>
                                    <td><?php echo $registro->h_registro; ?></td>
                                    <td><?php echo $registro->f_caducidad; ?></td>
                                    <td><?php echo $registro->cant_trabajadores; ?></td>
                                    <td><?php echo $registro->usuario; ?></td>
                                    <td><?php echo $registro->cantidad; ?></td>
                                    <td style="text-align: center;"><?php if($registro->activo == '0'){ ?>
                                        <?php if($empresa['user_ti'] != ''){?>
                                        <a href="<?php echo site_url("activa_con/sincro_registro/".$registro->id_empresa."/".$registro->id_registro); ?>" class="btn btn-warning btn-xs" style="width: 120px"><i class="fa fa-cloud-upload"></i> Sincronizar </a>
                                        <?php } ?>
                                        <a href="<?php echo site_url("activa_con/borrar_registro/".$registro->id_empresa."/".$registro->id_registro); ?>" class="btn btn-danger btn-xs" style="width: 120px"><i class="fa fa-trash-o"></i> Borrar </a>
                                        <?php }elseif($registro->cantidad == $registro->activo){ ?>
                                        <a href="#" class="btn btn-success btn-xs" style="width: 250px"><i class="fa fa-cloud"></i> Sincronizado </a>
                                        <?php } ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <a href="<?php echo site_url("activa_con/index"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-reply"></i> Volver </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

	        
