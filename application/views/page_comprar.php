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
                        <li class="menu-active"><a href="#about"><?php echo $producto['producto']; ?></a></li>
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
                        <h3 class="section-title"><?php echo $producto['producto']; ?></h3>
                        <div class="section-title-divider"></div>
                        <p class="section-description"><?php echo $producto['modelo']." - ".$producto['marca'];?></p>
                    </div>
                </div>
            </div>
            <div class="container about-container wow fadeInUp" style="background-image: url(<?php echo base_url(); ?>application/images/productos/<?php echo $producto['imagen'];?>);">
                <div class="row">
                    <div class="col-md-6 col-md-push-6 about-content">
                        <?php echo form_open('inicio_con/tbk'); ?>
                        <input type="hidden" name="cantidad" value="<?php echo $cantidad; ?>" />
                        <h2 class="about-title">Compra</h2>
                        <p class="about-text">
                        <table class="table table-hover">
                            <tr><th style="width:100px">Cantidad</th><td style="width:20px">:</td>
                            <td style="width:150px"><?php echo number_format($cantidad,0,",",".");?></td></tr>
                            <tr><th>Precio</th><td>:</td><td>
                            <?php echo number_format($producto['prc_vta'],0,",","."); ?> CLP</td></tr>
                        </table>
                        </p>
                        <h2 class="about-title">Datos del Comprador</h2>
                        <p class="about-text">
                            <table class="table table-hover">
                                <tr><td style="width:150px">Nombre</td><td style="width:20px">:</td>
                                <td><input type="text" name="nombre" style="width:200px" required></td></tr>
                                <tr><td>Rut</td><td>:</td>
                                <td><input type="text" name="rut" style="width:200px" required></td></tr>
                                <tr><td>Email</td><td>:</td>
                                <td><input type="email" name="correo" style="width:200px" required></td></tr>
                                <tr><td>Dirección despacho</td><td>:</td>
                                <td><input type="text" name="direccion" style="width:200px" required></td></tr>
                                <tr><td>Teléfono</td><td>:</td>
                                <td><input type="number" name="telefono" style="width:200px" required></td></tr>
                            </table>
                        </p>
                        <h1 class="about-title">Despacho de Productos</h1>
                        <p class="about-text">
                            <table class="table table-hover">
                                <tr>
                                    <td style="text-align: center; width:50px;">
                                        <input type = "radio" name = "tipo_desp" value = "retiro" required>
                                    </td>
                                    <td style="width:100px">Retiro en Local</td>
                                    <td style="text-align: center; width:50px;">
                                        <input type = "radio" name = "tipo_desp" value = "despacho" required>
                                    </td>
                                    <td style="width:100px">Despacho</td>
                                </tr>
                            </table>
                        </p>
                        <p class="about-text">Retiro en local: Nueva York 47, Santiago</p>
                        <p class="about-text">En caso de Despacho:</p>
                        <p class="about-text">
                            <table class="table table-hover">
                                <tr><td style="width:150px">Dirección destino</td><td style="width:20px">:</td>
                                <td><input type="text" name="dir_dest" style="width:200px"></td></tr>
                            </table>
                        </p>
                        <h1 class="about-title">Datos de Facturación</h1>
                        <p class="about-text">
                            <table class="table table-hover">
                                <tr>
                                    <td style="text-align: center; width:50px;">
                                        <input type = "radio" name = "tipo_fac" value = "boleta" required>
                                    </td>
                                    <td style="width:100px">Boleta</td>
                                    <td style="text-align: center; width:50px;">
                                        <input type = "radio" name = "tipo_fac" value = "factura" required>
                                    </td>
                                    <td style="width:100px">Factura</td>
                                </tr>
                            </table>
                        </p>
                        <p class="about-text">En caso de Factura, datos de la empresa:</p>
                        <p class="about-text">
                            <table class="table table-hover">
                                <tr><td style="width:150px">Nombre</td><td style="width:20px">:</td>
                                <td><input type="text" name="empresa" style="width:200px"></td></tr>
                                <tr><td>Rut</td><td>:</td>
                                <td><input type="text" name="e_rut" style="width:200px"></td></tr>
                                <tr><td>Giro</td><td>:</td>
                                <td><input type="text" name="e_giro" style="width:200px"></td></tr>
                                <tr><td>Dirección</td><td>:</td>
                                <td><input type="text" name="e_dir" style="width:200px"></td></tr>
                                <tr><td>Email Empresa</td><td>:</td>
                                <td><input type="email" name="e_correo" style="width:200px"></td></tr>
                            </table>
                        </p>
                        <div class="well carousel-search hidden-sm">
                            <?php if($stock[$producto['id_producto']] > 0){?>
                            <div class="btn-group">
                                <button class="btn btn-lg btn-success"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;&nbsp;Comprar</button>
                            </div>
                            <?php } ?>
                            <div class="btn-group">
                                <h3 class="about-text">&nbsp;&nbsp;&nbsp;$<?php echo number_format($producto['prc_vta']*$cantidad,0,",","."); ?> CLP</h3>
                            </div>
                            <div class="btn-group">
                                <img src="<?php echo base_url(); ?>application/images/webpay.png" style="max-width: 150px; max-height: 300px" />
                            </div>
                        </div>
                        <input name="id_producto" type="hidden" value="<?php echo $producto['id_producto'];?>">
                        </form>
                    </div>
                </div>
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