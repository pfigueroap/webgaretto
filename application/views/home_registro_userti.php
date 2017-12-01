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
                                    <th>Usuario</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php foreach ($usuarios as $usuario) { ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <input name="user_ti" value="<?php echo $usuario['username']; ?>"   type="radio" style="height:15px; width:15px; vertical-align:middle;" required <?php if($empresa['user_ti'] == $usuario['username']){?> checked <?php } ?>>
                                        <input type="hidden" name="<?php echo split('@',$usuario['username'])[0]; ?>" value="<?php echo $usuario['id']; ?>">
                                    </td>
                                    <td style="text-align: center;"><?php echo $usuario['id']; ?></td>
                                    <td><?php echo $usuario['nombres']; ?></td>
                                    <td><?php echo $usuario['apellido_paterno']." ".$usuario['apellido_materno']; ?></td>
                                    <td><?php echo $usuario['rut']; ?></td>
                                    <td><?php echo $usuario['correo']; ?></td>
                                    <td><?php echo $usuario['username']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <button class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-cloud-upload"></i> Sincronizar Usuario TI </button>
                        <a href="<?php echo site_url("activa_con/index"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-reply"></i> Volver </a>
                    </div>
                    </form>
                </div>
                <div class="card">
                    <?php echo form_open('activa_con/crear_ti/'.$id_empresa); ?>
                    <div class="card-header">
                        <h3 class="title">Crear Usuario TI</h3>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-6 col-xs-12" style="width: 300px;">
                            <input name="user_ti" type="text" class="form-control col-md-7 col-xs-12 parsley-success" placeholder="Nombre Usuario" required>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12" style="width: 400px;">
                            <input name="rut_ti" type="text" onkeypress="return soloRut(event)" class="form-control col-md-7 col-xs-12 parsley-success" placeholder="Rut" required>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12" style="width: 400px;">
                            <input name="correo_ti" type="email" class="form-control col-md-7 col-xs-12 parsley-success" placeholder="Correo" required>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12" style="width: 100px;">
                            <button class="btn btn-primary btn-xs" style="height:50px;background: #af1416;box-shadow:none;"><i class="fa fa-plus"></i> Crear Usuario TI </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if($mensaje != ''){ 
echo '<script type="text/javascript">
    var txt;
    txt = "'.$mensaje.'";
    alert(txt);
</script>';
 } ?>
	        
