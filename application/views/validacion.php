<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Garetto</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
        <meta property="og:title" content="">
        <meta property="og:image" content="">
        <meta property="og:url" content="">
        <meta property="og:site_name" content="">
        <meta property="og:description" content="">
        <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="">
        <meta name="twitter:title" content="">
        <meta name="twitter:description" content="">
        <meta name="twitter:image" content="">
        <!-- Place your favicon.ico and apple-touch-icon.png in the template root directory -->
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>application/images/apple-icon.png" />
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>application/images/favicon.png" />
        <!--link href="favicon.ico" rel="shortcut icon"-->
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet"> 
        <!-- Bootstrap CSS File -->
        <link href="<?php echo base_url(); ?>application/css/bootstrap.min.css" rel="stylesheet">
        <!-- Libraries CSS Files -->
        <link href="<?php echo base_url(); ?>application/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>application/css/animate.min.css" rel="stylesheet">
        <!-- Main Stylesheet File -->
        <link href="<?php echo base_url(); ?>application/css/style.css" rel="stylesheet">
    </head>
    <body>
<!--==========================
  Header Section
============================-->
        <header id="header">
            <div class="container">
                <div id="logo" class="pull-left">
                    <a href="index.html"><img src="img/logo.png" alt="" title="" /></img></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li><a href="<?php echo site_url("inicio_con/page"); ?>">Inicio</a></li>
                        <li class="menu-active"><a href="#about">Validación</a></li>
                        <li><a href="<?php echo site_url("inicio_con/ingreso"); ?>">
                        <?php if($usuario != '') echo "Hola ".$usuario;
                        else echo "Ingresar"; ?></a></li>
                    </ul>
                </nav>
            </div>
        </header>
<!--==========================
  About Section
============================-->
        <section id="about">
            <div class="container wow fadeInUp">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="section-title">Validación de Transferencia</h3>
                        <div class="section-title-divider"></div>
                        <p class="section-description">Se requiere validar la transferencia exitosa de la orden de compra <?php echo $id_tmp_compra; ?></p>
                    </div>
                </div>
            </div>
            <div class="container about-container wow fadeInUp" style="background-image: url(<?php echo base_url(); ?>application/images/validacion.png);">
                <div class="row">
                    <div class="col-md-6 col-md-push-6 about-content">
                        <h2 class="about-title">Información de orden</h2>
                        <p class="about-text">
                        <table class="table table-hover">
                            <tr><th style="width:200px">Monto</th><td style="width:20px">:</td>
                                <td style="width:250px">
                                    <?php echo number_format($total,0,",",".");?> CLP</td></tr>
                            <tr><th>Orden de compra</th><td>:</td><td><?php echo $id_tmp_compra;?></td></tr>
                            <tr><th>Usuario</th><td>:</td><td><?php echo $user;?></td></tr>
                            <tr><th>Tipo de Pago</th><td>:</td><td><?php echo $pago;?></td></tr>
                            <tr><th>Tipo despacho</th><td>:</td><td><?php echo $despacho;?></td></tr>
                            <tr><th>Dirección Despacho</th><td>:</td><td><?php echo $direccion;?></td></tr>
                            <tr><th>Fecha de Compra</th><td>:</td>
                                <td><?php echo $orden_compra['f_compra'];?></td></tr>
                            <tr><th>Hora de Compra</th><td>:</td>
                                <td><?php echo $orden_compra['h_compra'];?></td></tr>
                            <tr><th>Tipo de facturación</th><td>:</td>
                                <td><?php echo $orden_compra['factura'];?></td></tr>
                            <tr><th>Empresa</th><td>:</td>
                                <td><?php echo $orden_compra['empresa'];?></td></tr>
                            <tr><th>Rut</th><td>:</td>
                                <td><?php echo $orden_compra['rut'];?></td></tr>
                        </table>
                        </p>
                        <div class="well carousel-search hidden-sm">
                            <?php if($valida == '2'){ ?>
                            <div class="btn-group">
                                <a href="<?php echo site_url("operacion_con/validar_orden/valida/{$id_tmp_compra}/{$clave}"); ?>" class="btn btn-lg btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;Validar</a>
                            </div>
                            <?php }elseif($valida == '1'){?>
                            <div class="btn-group">
                                <h3 class="about-text" style="color:green;">Orden Validada ! </h3>
                            </div>
                            <?php } ?>
                            <div class="btn-group">
                                <h3 class="about-text">&nbsp;&nbsp;&nbsp;$<?php echo number_format($total,0,",","."); ?> CLP</h3>
                            </div>
                        </div>
                        <!--p class="about-text">
                            <textarea class="about-text" rows="5" data-rule="required" style="background:inherit;border:inherit;width: 500px;height: 200px;" readonly></textarea>
                        </p-->
                        </p>
                    </div>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Código Producto</th>
                            <th>Producto</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Código Barras</th>
                            <th>Precio</th>
                            <th>Moneda</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php foreach ($compras as $compra) { ?>
                        <tr>
                            <td><?php echo $compra->cod_prod; ?></td>
                            <td><?php echo $compra->producto; ?></td>
                            <td><?php echo $compra->marca; ?></td>
                            <td><?php echo $compra->modelo; ?></td>
                            <td><?php echo $compra->cod_bar; ?></td>
                            <td><?php echo number_format($compra->prc_vta,0,",","."); ?></td>
                            <td><?php echo $arr_mnd[$compra->mnd_vta]; ?></td>
                            <td><?php echo number_format($compra->cantidad,0,",","."); ?></td>
                            <td><?php echo number_format($compra->total,0,",","."); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
<!--==========================
  Footer
============================--> 
        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">
                            &copy; Copyright <strong>Garetto</strong>. Todos los derechos reservados.
                        </div>
                    </div>
                </div>
            </div>
        </footer><!-- #footer -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        <!-- Required JavaScript Libraries -->
        <script src="<?php echo base_url(); ?>application/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>application/js/jquery-migrate.min.js"></script>
        <script src="<?php echo base_url(); ?>application/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>application/js/superfish/hoverIntent.js"></script>
        <script src="<?php echo base_url(); ?>application/js/superfish/superfish.min.js"></script>
        <script src="<?php echo base_url(); ?>application/js/morphext/morphext.min.js"></script>
        <script src="<?php echo base_url(); ?>application/js/wow/wow.min.js"></script>
        <script src="<?php echo base_url(); ?>application/js/stickyjs/sticky.js"></script>
        <script src="<?php echo base_url(); ?>application/js/easing/easing.js"></script>
        <!-- Template Specisifc Custom Javascript File -->
        <script src="<?php echo base_url(); ?>application/js/custom.js"></script>
    </body>
</html>