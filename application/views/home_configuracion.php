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
            </div>
        </div>
    </div>
</div>