<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">vpn_key</i>Activación</h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Activación de Productos</h3>
                    </div>
                    <!--CONTENIDO BODY-->
                    <br/>
                    <br/>
                    <!--TABLA-->
                    <?php echo form_open('activa_con/add_reloj'); ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Seleccion</th>
                                    <th>Empresa</th>
                                    <th>Rut Empresa</th>
                                    <th>Giro Empresa</th>
                                    <th>Usuario TI</th>
                                    <th style="text-align: center;">Cantidad de Reloj</th>
                                    <th style="text-align: center;">Cantidad de Activos</th>
                                    <th style="text-align: center;">Registro Actividad</th>
                                    <th style="text-align: center;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php foreach ($registros as $registro) { ?>
                                <tr>
                                    <td style="text-align: center;"><input name="add_reloj" value="<?php echo $registro->id_empresa; ?>" type="radio" style="height:15px; width:15px; vertical-align: middle;" required></td>
                                    <td><?php echo $registro->empresa; ?></td>
                                    <td><?php echo $registro->rut; ?></td>
                                    <td><?php echo $registro->giro; ?></td>
                                    <td><?php echo $registro->user_ti; ?></td>
                                    <td style="text-align: center;"><?php echo $registro->cnt; ?></td>
                                    <td style="text-align: center;"><?php echo $registro->act; ?></td>
                                    <td style="text-align: center;"><?php if($registro->cnt > 0){ ?>
                                        <a href="<?php echo site_url("activa_con/registro/".$registro->id_empresa); ?>" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Ver </a><?php } ?>
                                    </td>
                                    <td>
                                        <?php if($registro->cnt > 0){ ?>
                                        <?php if($registro->user_ti != '' and $registro->cnt > $registro->act){ ?>
                                        <a href="<?php echo site_url("activa_con/sincro_empresa/".$registro->id_empresa); ?>" class="btn btn-warning btn-xs" style="width: 120px"><i class="fa fa-cloud-upload"></i> Sincronizar </a>
                                        <?php }elseif ($registro->cnt == $registro->act) { ?>
                                        <a href="#" class="btn btn-success btn-xs" style="width: 120px"><i class="fa fa-cloud"></i> Sincronizado </a>
                                        <?php } ?>
                                        <a href="<?php echo site_url("activa_con/registro_ti/".$registro->id_empresa); ?>" class="btn btn-info btn-xs" style="width: 120px"><i class="fa fa-user-plus"></i> Editar TI </a>
                                        <?php }else{ ?>
                                        <a href="<?php echo site_url("activa_con/desactiva_empresa/".$registro->id_empresa); ?>" class="btn btn-danger btn-xs" style="width: 250px"><i class="fa fa-trash-o"></i> Borrar </a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td><input onkeyup="doSearch('searchTerm1','1')" id="searchTerm1" type="search" class="form-control input-sm" placeholder="Buscar Empresa" aria-controls="datatable-responsive" ></td>
                                    <td><input onkeyup="doSearch('searchTerm2','2')" id="searchTerm2" type="search" class="form-control input-sm" placeholder="Buscar Rut" aria-controls="datatable-responsive" ></td>
                                    <td><input onkeyup="doSearch('searchTerm3','3')" id="searchTerm3" type="search" class="form-control input-sm" placeholder="Buscar Giro" aria-controls="datatable-responsive" ></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <table>
                        <tr>
                            <td style="width: 200px">
                                <div class="col-md-2 col-sm-6 col-xs-12 form-group">
                                    <input name="id_compra" type="number" style="width: 200px" class="form-control col-md-7 col-xs-12 parsley-success" placeholder="ID Compra" required>
                                </div>
                            </td>
                            <td style="text-align: center;"><input name="tipo_orden" value="web" type="radio" style="height:15px; width:15px; vertical-align: middle;" required></td>
                            <td style="width: 80px">Web</td>
                            <td style="text-align: center;"><input name="tipo_orden" value="orden" type="radio" style="height:15px; width:15px; vertical-align: middle;" required></td>
                            <td style="width: 80px">Ordén</td>
                            <td style="width: 200px"><button class="btn btn-primary btn-xs" style="background: #af1416;box-shadow:none;"><i class="fa fa-clock-o"></i> Agregar Reloj </button></td>
                            <td style="width: 600px;text-align: right;"><ul class="pagination pagination-lg pager" id="myPager"></ul></td>
                        </tr>
                    </table>
                    </form>
                </div>
                <div class="card">
                    <?php echo form_open('activa_con/add_empresa'); ?>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-hover">
                            <thead>
                                <tr><th style="text-align: center; width:100px;">Seleccion</th><th>Empresa</th></tr>
                            </thead>
                            <tbody id="myTable">
                                <tr class="form-group">
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
                                <tr class="form-group">
                                    <td style="text-align: center; width:100px;">
                                        <input name="s_empresa" value="nueva" type="radio" style="height:20px; width:20px; vertical-align: middle;" required>
                                    </td>
                                    <td>
                                        <div class="col-md-2 col-sm-6 col-xs-12" style="width: 300px;">
                                            <input name="e_name" type="text" class="form-control col-md-7 col-xs-12 parsley-success" placeholder="Razón Social">
                                        </div>
                                        <div class="col-md-2 col-sm-6 col-xs-12" style="width: 200px;">
                                            <input name="e_rut" type="text" onkeypress="return soloRut(event)" class="form-control col-md-7 col-xs-12 parsley-success" placeholder="Rut">
                                        </div>
                                        <div class="col-md-2 col-sm-6 col-xs-12" style="width: 400px;">
                                            <input name="e_dir" type="text" class="form-control col-md-7 col-xs-12 parsley-success" placeholder="Direccion">
                                        </div>
                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                            <input name="e_giro" type="text" class="form-control col-md-7 col-xs-12 parsley-success" placeholder="Giro">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary btn-xs" style="background: #af1416;box-shadow:none;"><i class="fa fa-plus"></i> Agregar Empresa </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

	        
