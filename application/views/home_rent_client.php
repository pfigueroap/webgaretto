<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">timeline</i>Arriendos</h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Contratos de Arriendos</h3>
                    </div>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Rut Cliente</th>
                                    <th>ID Arriendo</th>
                                    <th>Fecha Inicio</th>
                                    <th>Periodo de Gracia</th>
                                    <th>Costo Mensual</th>
                                    <th>Fecha Creación</th>
                                    <th>Hora Creación</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php foreach ($registros as $registro) { ?>
                                <tr>
                                    <td><?php echo $registro->nombre_1." ".$registro->apellido_1; ?></td>
                                    <td><?php echo $registro->rut; ?></td>
                                    <td><?php echo $registro->id_arriendo; ?></td>
                                    <td><?php echo $registro->f_inicio; ?></td>
                                    <td><?php echo $registro->per_gracia; ?></td>
                                    <td><?php echo number_format($registro->costo_mensual,0,",","."); ?></td>
                                    <td><?php echo $registro->f_creacion; ?></td>
                                    <td><?php echo $registro->h_creacion; ?></td>
                                    <td><?php 
                                    if($registro->estado == '0') echo "Activo"; 
                                    else echo "Inactivo";
                                    ?></td>
                                    <td><a href="<?php echo site_url("operacion_con/comprobante/".$registro->id_tmp_compra."/arriendo"); ?>" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Ver </a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td><input onkeyup="doSearch('searchTerm0','0')" id="searchTerm0" type="search" class="form-control input-sm" placeholder="Buscar Cliente" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm1','1')" id="searchTerm1" type="search" class="form-control input-sm" placeholder="Buscar Rut" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm2','2')" id="searchTerm2" type="search" class="form-control input-sm" placeholder="Buscar ID" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm3','3')" id="searchTerm3" type="search" class="form-control input-sm" placeholder="Buscar Fecha" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm4','4')" id="searchTerm4" type="search" class="form-control input-sm" placeholder="Periodo Gracia" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm5','5')" id="searchTerm5" type="search" class="form-control input-sm" placeholder="Costo Mensual" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm6','6')" id="searchTerm6" type="search" class="form-control input-sm" placeholder="Buscar Fecha" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm7','7')" id="searchTerm7" type="search" class="form-control input-sm" placeholder="Buscar Hora" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm8','8')" id="searchTerm8" type="search" class="form-control input-sm" placeholder="Estado" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <ul class="pagination pagination-lg pager" id="myPager"></ul> 
                    </div><!-- Revisar paginado - Fallan los números -->
                </div>
            </div>
        </div>
    </div>
</div>