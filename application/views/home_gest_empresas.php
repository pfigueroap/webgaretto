<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">vpn_key</i>Gestionar Empresas</h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <?php if($clase == 'editar'){ ?>
                        <h3 class="title">Editar Empresa</h3>
                        <?php }else{ ?>
                        <h3 class="title">Agregar Empresa</h3>
                        <?php } ?>
                    </div>
                    <br/>
                    <?php if($clase == 'editar'){ ?>
                    <?php echo form_open('activa_con/add_empresa/editar/'.$info_empresa['id_empresa']);?>
                    <?php }else{ ?>
                    <?php echo form_open('activa_con/add_empresa');?>
                    <?php } ?>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nombre Corto</th>
                                                <th>Razón Social</th>
                                                <th>Dirección</th>
                                                <th>Rut Empresa</th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <td><div class="form-group"><div><input name="nombre_corto" type="text" class="form-control input-sm" required
                                                <?php if($clase == 'editar'){ ?>
                                                 value="<?php echo $info_empresa['nombre_corto']; ?>"
                                                <?php }else{ ?>
                                                 placeholder="Nombre Corto" 
                                                <?php } ?> ></div></div></td>
                                                <td><div class="form-group"><div><input name="empresa" type="text" class="form-control input-sm" required
                                                <?php if($clase == 'editar'){ ?>
                                                 value="<?php echo $info_empresa['empresa']; ?>"
                                                <?php }else{ ?>
                                                 placeholder="Razón Social" 
                                                <?php } ?> ></div></div></td>
                                                <td><div class="form-group"><div><input name="direccion" type="text" class="form-control input-sm" required
                                                <?php if($clase == 'editar'){ ?>
                                                 value="<?php echo $info_empresa['direccion']; ?>"
                                                <?php }else{ ?>
                                                 placeholder="Dirección" 
                                                <?php } ?> ></div></div></td>
                                                <td><div class="form-group"><div><input name="rut" type="text" class="form-control input-sm" required
                                                <?php if($clase == 'editar'){ ?>
                                                 value="<?php echo $info_empresa['rut']; ?>"
                                                <?php }else{ ?>
                                                 placeholder="Rut" 
                                                <?php } ?> ></div></div></td>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <th>Giro</th>
                                                <th>Nombre Representante</th>
                                                <th>Rut Representante</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <td><div class="form-group"><div><input name="giro" type="text" class="form-control input-sm" required
                                                <?php if($clase == 'editar'){ ?>
                                                 value="<?php echo $info_empresa['giro']; ?>"
                                                <?php }else{ ?>
                                                 placeholder="Giro" 
                                                <?php } ?> ></div></div></td>
                                                <td><div class="form-group"><div><input name="nom_representante" type="text" class="form-control input-sm" required
                                                <?php if($clase == 'editar'){ ?>
                                                 value="<?php echo $info_empresa['nom_representante']; ?>"
                                                <?php }else{ ?>
                                                 placeholder="Representante" 
                                                <?php } ?> ></div></div></td>
                                                <td><div class="form-group"><div><input name="rut_representante" type="text" class="form-control input-sm" required
                                                <?php if($clase == 'editar'){ ?>
                                                 value="<?php echo $info_empresa['rut_representante']; ?>"
                                                <?php }else{ ?>
                                                 placeholder="Rut Representante" 
                                                <?php } ?> ></div></div></td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-2"> 
                                <br/><br/>
                                <button class="btn btn-primary btn-xs" style="background: #af1416;box-shadow:none;width:200px;height:60px;" >
                                    <?php if($clase == 'editar'){ ?>
                                    <i class="fa fa-edit"></i> Editar Empresa
                                    <?php }else{ ?>
                                    <i class="fa fa-plus-square"></i> Agregar Empresa
                                    <?php } ?> </button>
                                <a href="<?php 
                                if($clase == 'editar') echo site_url("activa_con/menu_empresas");
                                else echo site_url("activa_con/index"); ?>" class="btn btn-default btn-xs" style="background: #af1416;width:200px;"><i class="fa fa-reply"></i> Volver </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Activar Empresa</h3>
                    </div>
                    <br/>
                    <?php echo form_open('activa_con/activa_empresa/');?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="text-align: center; width:100px;">Seleccion</th>
                                    <th>Empresa</th>
                                    <th>Nombre Corto</th>
                                    <th>Dirección</th>
                                    <th>Rut</th>
                                    <th>Giro</th>
                                    <th>Representante</th>
                                    <th>Rut Representante</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php foreach ($empresas as $empresa) {?>
                                <tr>
                                    <td style="text-align: center;">
                                        <input name="s_empresa" value="<?php echo $empresa->id_empresa;?>" type="radio" style="height:15px; width:15px; vertical-align: middle;" required>
                                    </td>
                                    <td><?php echo $empresa->empresa;?></td>
                                    <td><?php echo $empresa->nombre_corto;?></td>
                                    <td><?php echo $empresa->direccion;?></td>
                                    <td><?php echo $empresa->rut;?></td>
                                    <td><?php echo $empresa->giro;?></td>
                                    <td><?php echo $empresa->nom_representante;?></td>
                                    <td><?php echo $empresa->rut_representante;?></td>
                                    <td><a href="<?php echo site_url("activa_con/menu_empresas/editar/".$empresa->id_empresa); ?>" class="btn btn-info btn-xs" style="width: 120px"><i class="fa fa-edit"></i> Editar </a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td><input onkeyup="doSearch('searchTerm1','1')" id="searchTerm1" type="search" class="form-control input-sm" placeholder="Buscar Empresa" aria-controls="datatable-responsive" ></td>
                                    <td><input onkeyup="doSearch('searchTerm2','2')" id="searchTerm2" type="search" class="form-control input-sm" placeholder="Buscar Nombre Corto" aria-controls="datatable-responsive" ></td>
                                    <td><input onkeyup="doSearch('searchTerm3','3')" id="searchTerm3" type="search" class="form-control input-sm" placeholder="Buscar Dirección" aria-controls="datatable-responsive" ></td>
                                    <td><input onkeyup="doSearch('searchTerm4','4')" id="searchTerm4" type="search" class="form-control input-sm" placeholder="Buscar Rut" aria-controls="datatable-responsive" ></td>
                                    <td><input onkeyup="doSearch('searchTerm5','5')" id="searchTerm5" type="search" class="form-control input-sm" placeholder="Buscar Giro" aria-controls="datatable-responsive" ></td>
                                    <td><input onkeyup="doSearch('searchTerm6','6')" id="searchTerm6" type="search" class="form-control input-sm" placeholder="Buscar Representante" aria-controls="datatable-responsive" ></td>
                                    <td><input onkeyup="doSearch('searchTerm7','7')" id="searchTerm7" type="search" class="form-control input-sm" placeholder="Buscar Rut Representante" aria-controls="datatable-responsive" ></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <table>
                            <tr>
                                <td><button class="btn btn-primary btn-xs" style="background: #af1416;box-shadow:none;width:100%;"><i class="fa fa-cloud-upload"></i> Activar Empresa </button></td>
                                <td style="width: 1%;"></td>
                                <td><a href="<?php echo site_url("activa_con/index"); ?>" class="btn btn-default btn-xs" style="background: #af1416;width:150%;"><i class="fa fa-reply"></i> Volver </a></td>
                                <td style="text-align: right;width: 150%"><ul class="pagination pagination-lg pager" id="myPager"></ul></td>
                            </tr>
                        </table>
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