<div>
    <h3 class="title" style="margin-left: 1.5%; color: #af1416; font-size: 30px;"><i class="material-icons">business</i>Productos</h3>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <?php if($clase == 'crear'){ ?>
                        <h3 class="title">Crear Producto</h3>
                        <?php }elseif($clase == 'editar'){ ?>
                        <h3 class="title">Editar Producto <?php echo $prod_edit['producto']; ?></h3>
                        <?php } ?>
                    </div>
                    <br/>
                    <?php echo form_open_multipart('producto_con/mod_prod/'.$clase.'/'.$prod_edit['id_producto']);?>
                    <div class="row">
                        <div class="col-md-3">
                            <?php if($clase == 'editar'){ ?>
                                <img id="imgProd" src="<?php echo base_url(); ?>application/images/productos/<?php echo $prod_edit['imagen'];?>" alt="Reloj control">
                            <?php }else{ ?>
                                <img id="imgProd" src="<?php echo base_url(); ?>application/images/productos/sin_imagen.jpg" alt="Reloj control">
                            <?php } ?>
                            <input class="btn btn-default btn-xs" style="background: #af1416;width: 305px;" type="file" name="imagen" id="imagen" size="30" accept=".jpg" />
                        </div>
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Código Producto</th>
                                            <th>Producto</th>
                                            <th>Código Barras</th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            <td><div class="form-group"><div><input name="cod_prod" type="text" class="form-control input-sm" 
                                                <?php if($clase == 'crear'){?> placeholder="Código Producto"
                                                <?php }elseif($clase == 'editar'){?> value="<?php echo $prod_edit['cod_prod'];}?>" required></div></div></td>
                                            <td><div class="form-group"><div><input name="producto" type="text" class="form-control input-sm"
                                                <?php if($clase == 'crear'){?> placeholder="Producto"
                                                <?php }elseif($clase == 'editar'){?> value="<?php echo $prod_edit['producto'];}?>" required></div></div></td>
                                            <td><div class="form-group"><div><input name="cod_bar" type="number" class="form-control input-sm"
                                                <?php if($clase == 'crear'){?> placeholder="Código Barras"
                                                <?php }elseif($clase == 'editar'){?> value="<?php echo $prod_edit['cod_bar'];}?>" required></div></div></td>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            <th>Modelo</th>
                                            <th>Marca</th>
                                            <th>Precio Venta (CLP)</th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            <td><div class="form-group"><div><input name="modelo" type="text" class="form-control input-sm"
                                                <?php if($clase == 'crear'){?> placeholder="Modelo"
                                                <?php }elseif($clase == 'editar'){?> value="<?php echo $prod_edit['modelo'];}?>" required></div></div></td>
                                            <td><div class="form-group"><div><input name="marca" type="text" class="form-control input-sm"
                                                <?php if($clase == 'crear'){?> placeholder="Marca"
                                                <?php }elseif($clase == 'editar'){?> value="<?php echo $prod_edit['marca'];}?>" required></div></div></td>
                                            <td><div class="form-group"><div><input name="prc_vta" type="number" class="form-control input-sm"
                                                <?php if($clase == 'crear'){?> placeholder="Precio Venta"
                                                <?php }elseif($clase == 'editar'){?> value="<?php echo $prod_edit['prc_vta'];}?>" required></div></div></td>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            <th colspan="3">Descripción</th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            <td colspan="3">
                                                <div class="form-group">
                                                    <textarea name="descripcion" type="text" class="form-control input-sm" style="height: 100px;"  required >
<?php if($clase == 'crear'){ ?>Ingrese Descripción del producto.
<?php }elseif($clase == 'editar'){ ?><?php echo $prod_edit['descripcion']; }?></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-11 text-right">
                            <?php if($clase == 'crear'){?>
                            <button class="btn btn-primary btn-xs" style="background: #af1416;     box-shadow:none;" > <i class="fa fa-plus-square"></i> Crear Producto </button>
                            <?php }elseif($clase == 'editar'){?>
                            <button id="btnSubmit" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-edit" ></i> Editar Producto</button>
                            <?php }?>
                            <a href="<?php echo site_url("producto_con/index"); ?>" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-reply"></i> Volver </a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>