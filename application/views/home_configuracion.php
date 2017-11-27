<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">settings</i>Configuración</h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Editar Página</h3>
                    </div>
                    <br/>
                    <iframe name = "ventana" src="<?php echo site_url("inicio_con/web"); ?>" width="100%" height="600" align="center"></iframe>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Validación</h3>
                    </div>
                    <div class="table-responsive">
                        <?php echo form_open('inicio_con/conf_correo');?>
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Correo Validación</th>
                                    <td>:</td>
                                    <td><?php echo $correo; ?></td>
                                    <th><div class="form-group"><div><input name="correo" type="email" class="form-control input-sm" placeholder="Ingrese Correo" required></div></div></th>
                                    <th><button class="btn btn-success btn-xs"><i class="fa fa-refresh"></i> Cambiar </button></th>
                                </tr>
                            </tbody>
                        </table>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                            <h3 class="title">Comprobante</h3>
                        </div>
                    <div class="table-responsive">
                        <?php echo form_open('inicio_con/conf_comprobante');?>
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Nombre Encargado(a)</th>
                                    <td>:</td>
                                    <td><?php echo $info_comp->nombre; ?></td>
                                    <th><div class="form-group"><div><input name="nombre" type="text" class="form-control input-sm" placeholder="Ingrese Nombre Encargado" required></div></div></th>
                                </tr>
                                <tr>
                                    <th>Correo Encargado(a)</th>
                                    <td>:</td>
                                    <td><?php echo $info_comp->correo; ?></td>
                                    <th><div class="form-group"><div><input name="correo" type="email" class="form-control input-sm" placeholder="Ingrese Correo Encargado" required></div></div></th>
                                </tr>
                                <tr>
                                    <th>Telefono Encargado(a)</th>
                                    <td>:</td>
                                    <td><?php echo $info_comp->telefono; ?></td>
                                    <th><div class="form-group"><div><input name="telefono" type="text" class="form-control input-sm" placeholder="Ingrese Telefono Encargado" required></div></div></th>
                                </tr>
                                <tr>
                                    <th colspan="4" style="text-align: right;"><button class="btn btn-success btn-xs"><i class="fa fa-refresh"></i> Cambiar </button></th>
                                </tr>
                            </tbody>
                        </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>