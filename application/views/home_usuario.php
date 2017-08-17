<div>
<?php if($clase == 'perfil'){ ?>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">assignment_ind</i>Perfil</h3>
<?php }elseif($clase == 'usuario'){ ?>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">assignment_ind</i><?php echo $title;?></h3>
<?php }elseif($clase == 'editar'){ ?>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">assignment_ind</i>Editar</h3>
<?php }elseif($clase == 'registrar'){ ?>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">assignment_ind</i>Registrar</h3>
<?php } ?>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php if($clase == 'perfil'){ ?>
                    <div class="card-header"><h3 class="title">Información Perfil</h3></div>
                    <?php }elseif($clase == 'usuario'){ ?>
                    <div class="card-header"><h3 class="title">Crear Usuario <?php echo $title;?></h3></div>
                    <?php }elseif($clase == 'editar'){ ?>
                    <div class="card-header"><h3 class="title">Editar Usuario</h3></div>
                    <?php }elseif($clase == 'registrar'){ ?>
                    <div class="card-header"><h3 class="title">Registrar Usuario</h3></div>
                    <?php } ?>
                    <input type="text" class="form-control" value="<?php echo $mensaje; ?>" style="text-align:center;" disabled>
                    <?php 
                    if($clase == 'perfil' or $clase == 'registrar') echo form_open_multipart('inicio_con/edit_user'); 
                    elseif($clase == 'usuario' or $clase == 'editar') echo form_open_multipart('usuario_con/mod_user/'.$info['tipo'].'/'.$clase);?>
                    <div class="col-md-3">
                        <?php if($info['imagen'] == ''){?>
                        <img id="imgProd" src="<?php echo base_url(); ?>application/images/usuarios/user.jpg" alt="Reloj control">
                        <?php }else{ ?>
                        <img id="imgProd" src="<?php echo base_url(); ?>application/images/usuarios/<?php echo $info['imagen'];?>" alt="Reloj control">
                        <?php } ?>
                        <input class="btn btn-default btn-xs" style="background: #af1416;width: 305px;" type="file" name="imagen" id="imagen" size="30" accept=".jpg" />
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                        <!-- Usuario -->
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Usuario </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <input name="usuario" type="text" onkeypress="return soloLetras(event)" class="form-control col-md-7 col-xs-12 parsley-success" required
                            <?php if($clase == 'perfil'){ ?> value="<?php echo $info['usuario']; ?>" readonly 
                            <?php }elseif($clase == 'editar'){ ?> value="<?php echo $info['usuario']; ?>"
                            <?php }elseif($clase == 'registrar'){ ?> value="<?php echo $usuario; ?>" readonly  
                            <?php }elseif($clase == 'usuario'){ ?> placeholder="Usuario" <?php } ?>>
                        </div>
                        <!-- Nombres -->
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Nombres </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <input name="nombres" type="text" onkeypress="return soloLetras(event)" class="form-control col-md-7 col-xs-12 parsley-success" required
                            <?php if($clase == 'perfil' or $clase == 'editar'){ ?> value="<?php echo $info['nombre_1']." ".$info['nombre_2']; ?>" 
                            <?php }elseif($clase == 'usuario' or $clase == 'registrar'){ ?> placeholder="Nombres" <?php } ?>>
                        </div>
                        <!-- Direccion -->
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Dirección </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <input name="direccion" type="text" class="form-control col-md-7 col-xs-12 parsley-success" required
                            <?php if($clase == 'perfil' or $clase == 'editar' or $clase == 'registrar'){ ?> value="<?php echo $info['direccion']; ?>"
                            <?php }elseif($clase == 'usuario'){ ?> placeholder="Direccion" <?php } ?>>
                        </div>
                        <!-- Rut -->
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Rut </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <input name="rut" type="text" onkeypress="return soloRut(event)" class="form-control col-md-7 col-xs-12 parsley-success" required
                            <?php if($clase == 'perfil' or $clase == 'editar'){ ?> value="<?php echo $info['rut']; ?>"
                            <?php }elseif($clase == 'usuario' or $clase == 'registrar'){ ?> placeholder="Rut" <?php } ?>>
                        </div>
                        <!-- Nacionalidad -->
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Nacionalidad </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12 parsley-success" name="id_nacion">
                                <?php foreach ($naciones as $nacion) {?>
                                <option value="<?php echo $nacion->id_nacion;?>" <?php if($nacion->id_nacion == $info['id_nacion']) echo "selected";?>><?php echo $nacion->nacion;?></option>
                                <?php }?>
                            </select>
                        </div>
                        <!--  -->
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                        <!-- Correo -->
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Correo </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <input name="correo" type="email" class="form-control col-md-7 col-xs-12 parsley-success" required
                            <?php if($clase == 'perfil' or $clase == 'editar'){ ?> value="<?php echo $info['correo']; ?>"
                            <?php }elseif($clase == 'registrar'){ ?> value="<?php echo $correo; ?>" readonly 
                            <?php }elseif($clase == 'usuario'){ ?> placeholder="Correo" <?php } ?>>
                        </div>
                        <!-- Apellidos -->
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Apellidos </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <input name="apellidos" type="text" onkeypress="return soloLetras(event)" class="form-control col-md-7 col-xs-12 parsley-success" required
                            <?php if($clase == 'perfil' or $clase == 'editar'){ ?> value="<?php echo $info['apellido_1']." ".$info['apellido_2']; ?>"
                            <?php }elseif($clase == 'usuario' or $clase == 'registrar'){ ?> placeholder="Apellidos" <?php } ?>>
                        </div>
                        <!-- Celular -->
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Celular </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <input name="celular" type="text" onkeypress="return soloNumeros(event)"class="form-control col-md-7 col-xs-12 parsley-success" required
                            <?php if($clase == 'perfil' or $clase == 'editar'){ ?> value="<?php echo $info['celular']; ?>"
                            <?php }elseif($clase == 'usuario' or $clase == 'registrar'){ ?> placeholder="Celular" <?php } ?>>
                        </div>
                        <!-- Sexo -->
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Genero </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12 parsley-success" name="genero">
                                <option value="Masculino" <?php if($info['genero'] == "Masculino") echo "selected";?>>Masculino</option>
                                <option value="Femenino" <?php if($info['genero'] == "Femenino") echo "selected";?>>Femenino</option>
                            </select>
                        </div>
                        <!-- Tipo de Usuario -->
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Tipo Usuario </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12 parsley-success" name="tipo" disabled="true">
                                <option value="1" <?php if($info['tipo'] == '1') echo "selected";?>>Administrador</option>
                                <option value="2" <?php if($info['tipo'] == '2' or $clase == 'registrar') echo "selected";?> >Cliente</option>
                            </select>
                        </div>
                        <!-- Id Usuario -->
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">ID Usuario </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <input name="id_usuario" type="text" class="form-control col-md-7 col-xs-12 parsley-success"
                            <?php if($clase == 'registrar'){ ?> 
                            value="<?php echo $id_usuario; ?>" 
                            <?php }else{ ?>
                            value="<?php echo $info['id_usuario']; ?>" 
                            <?php } ?> 
                            readonly>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <!-- Empresa -->
                        <table class="table table-hover">
                            <thead>
                                <tr><th style="text-align: center; width:100px;">Seleccion</th><th>Empresa</th></tr>
                            </thead>
                            <tbody id="myTable">
                                <tr>
                                    <td style="text-align: center; width:100px;">
                                        <input name="s_empresa" value="existe" type="radio" style="height:20px; width:20px; vertical-align: middle;" required checked="True">
                                    </td>
                                    <td>
                                        <select class="form-control col-md-7 col-xs-12 parsley-success" name="id_empresa">
                                        <?php foreach ($empresas as $empresa) {?>
                                            <option value="<?php echo $empresa->id_empresa;?>" <?php if($empresa->id_empresa == $info['id_empresa']) echo "selected";?>><?php echo $empresa->empresa;?></option>
                                        <?php }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; width:100px;">
                                        <input name="s_empresa" value="nueva" type="radio" style="height:20px; width:20px; vertical-align: middle;" required>
                                    </td>
                                    <td>
                        <label class="control-label col-md-1 col-sm-3 col-xs-12" for="first-name">Nombre </label>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <input name="e_name" type="text" class="form-control col-md-7 col-xs-12 parsley-success" placeholder="Nombre">
                        </div>
                        <label class="control-label col-md-1 col-sm-3 col-xs-12" for="first-name">Rut </label>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <input name="e_rut" type="text" onkeypress="return soloRut(event)" class="form-control col-md-7 col-xs-12 parsley-success" placeholder="Rut">
                        </div>
                        <label class="control-label col-md-1 col-sm-3 col-xs-12" for="first-name">Direccion </label>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <input name="e_dir" type="text" class="form-control col-md-7 col-xs-12 parsley-success" placeholder="Direccion">
                        </div>
                        <label class="control-label col-md-1 col-sm-3 col-xs-12" for="first-name">Giro </label>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <input name="e_giro" type="text" class="form-control col-md-7 col-xs-12 parsley-success" placeholder="Giro">
                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <?php if($clase == 'perfil'){ ?>
                        <button id="btnSubmit" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-edit" ></i> Guardar Cambios</button>
                        <a href="<?php echo site_url("inicio_con/cambiar_pass"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-key"></i> Cambiar Contraseña </a>
                        <a href="<?php echo site_url("inicio_con/index"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-reply"></i> Volver </a>
                        <?php }elseif($clase == 'usuario'){ ?>
                        <button id="btnSubmit" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-user-plus" ></i> Crear Usuario</button>
                        <a href="<?php echo site_url("usuario_con/index/".$info['tipo']); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-reply"></i> Volver </a>
                        <?php }elseif($clase == 'editar'){ ?>
                        <button id="btnSubmit" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-edit" ></i> Guardar Cambios</button>
                        <a href="<?php echo site_url("usuario_con/index/".$info['tipo']); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-reply"></i> Volver </a>
                        <?php }elseif($clase == 'registrar'){ ?>
                        <button id="btnSubmit" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-edit" ></i> Registrar Usuario</button>
                        <?php } ?>
                        <br><br>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>