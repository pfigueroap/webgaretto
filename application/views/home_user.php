<div>
	<h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">assignment_ind</i><?php echo $title; ?></h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            	<div class="col-md-12 text-right">
					<table align="right">
						<tr>
							<td>
								<a href="<?php echo site_url("usuario_con/down_usuarios/".$tipo_selec); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-download"></i> Descargar Maestro Personal </a>
							</td>
							<td>
								<a href="<?php echo site_url("usuario_con/crear_usuario/".$tipo_selec); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-user-plus"></i> Crear Usuario </a>
							</td>
						</tr>
					</table>
				</div>
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h3 class="title">Usuarios <?php echo $title; ?></h3>
                    </div>
                	<br>
                	<br>
					<div class="table-responsive">
						<table class="table table-hover" id="data">
					    	<thead>
					            <tr>    
					            	<th>Usuario</th>
					                <th>Nombres</th>
					                <th>Apellido</th>
					                <th>Correo</th>
					                <th>Rut</th>
					                <th>Celular</th>
					                <th>Acciones</th>
					            </tr>
					    	</thead>
					    	<tbody id="myTable">
					    		<?php foreach($usuarios as $user){?>
								<tr>
									<td><?php echo $user->usuario;?></td>
						            <td><?php echo $user->nombre_1." ".$user->nombre_2;?></td>
						            <td><?php echo $user->apellido_1." ".$user->apellido_2;?></td>
						            <td><?php echo $user->correo;?></td>
						            <td><?php echo $user->rut;?></td>
						            <td><?php echo $user->celular;?></td>
						            <td> 
						            	<a href="<?php echo site_url("usuario_con/editar_id/{$tipo_selec}/{$user->id_usuario}"); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Editar </a>
						            	<a href="<?php echo site_url("usuario_con/eliminar_user/{$tipo_selec}/{$user->id_usuario}"); ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Borrar </a>
						        	</td>
						        </tr>
						        <?php }?>
						    </tbody>
						    <tbody>
						    	<tr>
					                <td><input onkeyup="doSearch('searchTerm0','0')" id="searchTerm0" type="search" class="form-control input-sm" placeholder="Buscar usuario" aria-controls="datatable-responsive" style="width:100%"></td>
					                <td><input onkeyup="doSearch('searchTerm1','1')" id="searchTerm1" type="search" class="form-control input-sm" placeholder="Buscar Nombres" aria-controls="datatable-responsive" style="width:100%"></td>
					                <td><input onkeyup="doSearch('searchTerm2','2')" id="searchTerm2" type="search" class="form-control input-sm" placeholder="Buscar Apellidos" aria-controls="datatable-responsive" style="width:100%"></td>
					                <td><input onkeyup="doSearch('searchTerm3','3')" id="searchTerm3" type="search" class="form-control input-sm" placeholder="Buscar Correo" aria-controls="datatable-responsive" style="width:100%"></td>
					                <td><input onkeyup="doSearch('searchTerm4','4')" id="searchTerm4" type="search" class="form-control input-sm" placeholder="Buscar Rut" aria-controls="datatable-responsive" style="width:100%"></td>
					                <td><input onkeyup="doSearch('searchTerm5','5')" id="searchTerm5" type="search" class="form-control input-sm" placeholder="Buscar Celular" aria-controls="datatable-responsive" style="width:100%"></td>
					            </tr>
					        </tbody>
						</table>
					</div>
					<div class="col-md-12 text-right">
						<ul class="pagination pagination-lg pager" id="myPager"></ul>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>

