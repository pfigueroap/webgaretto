<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">account_circle</i>Registro</h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php echo form_open('activa_con/add_user_ti/'.$id_empresa); ?>
                    <div class="card-header">
                        <h3 class="title">Registro de Usuario TI</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Selección</th>
                                    <th style="text-align: center;">ID Usuario</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Rut</th>
                                    <th>Email</th>
                                    <th>Celular</th>
                                    <th>Usuario</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php foreach ($usuarios as $usuario) { ?>
                                <tr>
                                    <td style="text-align: center;"><input name="user_ti" value="<?php echo $usuario->usuario; ?>" type="radio" style="height:15px; width:15px; vertical-align: middle;" required <?php if($empresa['user_ti'] == $usuario->usuario){?> checked <?php } ?>></td>
                                    <td style="text-align: center;"><?php echo $usuario->id_usuario; ?></td>
                                    <td><?php echo $usuario->nombre_1." ".$usuario->nombre_2; ?></td>
                                    <td><?php echo $usuario->apellido_1." ".$usuario->apellido_2; ?></td>
                                    <td><?php echo $usuario->rut; ?></td>
                                    <td><?php echo $usuario->correo; ?></td>
                                    <td><?php echo $usuario->celular; ?></td>
                                    <td><?php echo $usuario->usuario; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <button class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-plus"></i> Agregar Usuario TI </button>
                        <a href="<?php echo site_url("activa_con/index"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-reply"></i> Volver </a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

	        
