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
                        <?php if($compra == 'fallida'){?>
                        <h2 class="about-title">Compra Fallida</h2>
                        <p class="about-text">
                        Ha ocurrido un problema con el proceso de compras, por favor intente nuevamente.
                        </p>
                        <img src="<?php echo base_url(); ?>application/images/webpay.png" style="max-width: 600px; max-height: 400px" />
                        <p class="about-text">
                            <textarea class="about-text" rows="5" data-rule="required" style="background:inherit;border:inherit;width: 500px;height: 200px;" readonly></textarea>
                        </p>
                        <?php }elseif($compra == 'exito'){ ?>
                        <h2 class="about-title">Comprobante</h2>
                        <p class="about-text">
                        La compra se ha realizado exitosamente, en breve recibirá un correo con los datos de la compra.
                        <table class="table table-hover">
                            <tr><td style="width:200px">Producto</td><td style="width:20px">:</td>
                            <td style="width:150px"><?php echo $producto['producto'];?></td></tr>
                            <tr><td>Cantidad</td><td>:</td><td><?php echo $comprobante['cantidad'];?></td></tr>
                            <tr><td>Monto</td><td>:</td>
                            <td><?php echo number_format($comprobante['amount'],0,",",".");?> CLP</td></tr>
                            <tr><td>Orden de compra</td><td>:</td><td><?php echo $comprobante['id_web'];?></td></tr>
                            <tr><td>Fecha y hora transacción</td><td>:</td>
                                <td><?php echo $comprobante['transactionDate'];?></td></tr>
                            <tr><td>Nombre Comprador</td><td>:</td><td><?php echo $comprobante['nombre'];?></td></tr>
                            <tr><td>Rut Comprador</td><td>:</td><td><?php echo $comprobante['rut'];?></td></tr>
                            <tr><td>Email comprador</td><td>:</td><td><?php echo $comprobante['correo'];?></td></tr>
                            <tr><td>Dirección despacho</td><td>:</td>
                                <td><?php echo $comprobante['direccion'];?></td></tr>
                            <tr><td>Teléfono</td><td>:</td>
                                <td><?php echo $comprobante['telefono'];?></td></tr>
                            <tr><td>Tipo de facturación</td><td>:</td>
                                <td><?php echo $comprobante['tipo_fac'];?></td></tr>
                            <?php if($comprobante['tipo_fac'] == 'factura'){ ?>
                            <tr><td>Razón Social</td><td>:</td>
                                <td><?php echo $comprobante['empresa'];?></td></tr>
                            <tr><td>Rut Empresa</td><td>:</td>
                                <td><?php echo $comprobante['e_rut'];?></td></tr>
                            <tr><td>Giro Empresa</td><td>:</td>
                                <td><?php echo $comprobante['e_giro'];?></td></tr>
                            <tr><td>Dirección Empresa</td><td>:</td>
                                <td><?php echo $comprobante['e_dir'];?></td></tr>
                            <?php } ?>
                        </table>
                        </p>
                        <img src="<?php echo base_url(); ?>application/images/webpay_exito.jpg" style="max-width: 600px; max-height: 400px" />
                        <?php }?>
                        <!--h1 class="about-title">Datos de Facturación</h1-->
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