<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">history</i>Historial</h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Historial</h3>
                    </div>
                    <!--CONTENIDO BODY-->
                    <br/>
                    <br/>
                    <!--TABLA-->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>colum 1</th>
                                    <th>colum 2</th>
                                    <th>colum 3</th>
                                    <th>colum 4</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td><input onkeyup="doSearch('searchTerm0','0')" id="searchTerm0" type="search" class="form-control input-sm" placeholder="Buscar Fecha detención" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm1','1')" id="searchTerm1" type="search" class="form-control input-sm" placeholder="Buscar Duración" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm2','2')" id="searchTerm2" type="search" class="form-control input-sm" placeholder="Buscar Tarea" aria-controls="datatable-responsive" style="width:100%"></td>
                                    <td><input onkeyup="doSearch('searchTerm3','3')" id="searchTerm3" type="search" class="form-control input-sm" placeholder="Buscar Workorder" aria-controls="datatable-responsive" style="width:100%"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <ul class="pagination pagination-lg pager" id="myPager"></ul> 
                    </div><!-- Revisar paginado - Fallan los números -->
                    <div class="col-md-12 text-right">
                        <a href="#" class="btn btn-primary btn-xs" style="background: #af1416;     box-shadow:none;" > <i class="fa fa-download"></i> Descargar </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

	        
