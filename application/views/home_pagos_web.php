<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">payment</i>Pagos Web</h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Resumen de Pagos Web</h3>
                    </div>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Rut Cliente</th>
                                    <th>Email Cliente</th>
                                    <th>ID Operación</th>
                                    <th>Fecha Operación</th>
                                    <th>Hora Operación</th>
                                    <th>Facturación</th>
                                    <th>Producto</th>
                                    <th>Total</th>
                                    <th>Comprobante</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php foreach ($registros as $registro) { ?>
                                <tr>
                                    <?php  if($registro->tipo_fac == 'factura'){ ?>
                                    <td><?php echo $registro->nombre; ?></td>
                                    <td><?php echo $registro->rut; ?></td>
                                    <?php }else{ ?>
                                    <td><?php echo $registro->nombre; ?></td>
                                    <td><?php echo $registro->rut; ?></td>
                                    <?php } ?>
                                    <td><?php echo $registro->correo; ?></td>
                                    <td><?php echo $registro->id_web; ?></td>
                                    <td><?php echo $registro->f_ingreso; ?></td>
                                    <td><?php echo $registro->h_ingreso; ?></td>
                                    <td><?php echo $registro->tipo_fac; ?></td>
                                    <td><?php echo $registro->producto; ?></td>
                                    <td><?php echo number_format($registro->amount,0,",","."); ?></td>
                                    <td><a href="<?php echo site_url("inicio_con/comprobante_web/".$registro->id_producto."/".$registro->token); ?>" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Ver </a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td><input onkeyup="doSearch('searchTerm0','0')" id="searchTerm0" type="search" class="form-control input-sm" placeholder="Buscar Cliente" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm1','1')" id="searchTerm1" type="search" class="form-control input-sm" placeholder="Buscar Rut" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm2','2')" id="searchTerm2" type="search" class="form-control input-sm" placeholder="Buscar Email" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm3','3')" id="searchTerm3" type="search" class="form-control input-sm" placeholder="Buscar ID" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm4','4')" id="searchTerm4" type="search" class="form-control input-sm" placeholder="Buscar Fecha" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm5','5')" id="searchTerm5" type="search" class="form-control input-sm" placeholder="Buscar Hora" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm6','6')" id="searchTerm6" type="search" class="form-control input-sm" placeholder="Buscar Facturación" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm7','7')" id="searchTerm7" type="search" class="form-control input-sm" placeholder="Buscar Producto" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td></td><td></td>
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