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
        <div id="preloader"></div>
        <!--==========================
          Hero Section
        ============================-->
        <section id="hero">
            <div class="hero-container">
                <div class="wow fadeIn">
                    <div class="hero-logo">
                        <img class="" src="<?php echo base_url(); ?>application/images/logo2.png" alt="Imperial">
                    </div>
                    <h1><?php echo $titulo; ?></h1>
                    <h2><?php echo $valor; ?> <span class="rotating"><?php echo $rotar; ?></span></h2>
                    <div class="actions">
                        <a href="#about" class="btn-get-started"><?php echo $sec1_tit; ?></a>
                        <a href="#services" class="btn-services"><?php echo $sec2_tit; ?></a>
                    </div>
                </div>
            </div>
        </section>
        <!--==========================
          Header Section
        ============================-->
        <header id="header">
            <div class="container">
                <div id="logo" class="pull-left">
                    <a href="#hero"><img src="<?php echo base_url(); ?>application/images/logo.png" alt="" title="" /></img></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="#hero">Inicio</a></li>
                        <li><a href="#about"><?php echo $sec1_tit; ?></a></li>
                        <li><a href="#services"><?php echo $sec2_tit; ?></a></li>
                        <li><a href="#portfolio"><?php echo $sec3_tit; ?></a></li>
                        <li><a href="#contact"><?php echo $sec4_tit; ?></a></li>
                        <li><a href="<?php echo site_url("inicio_con/ingreso"); ?>">
                            <?php 
                            if($usuario != '') echo "Hola ".$usuario;
                            else echo "Ingresar"; ?></a></li>
                    </ul>
                </nav><!-- #nav-menu-container -->
            </div>
        </header><!-- #header -->
        <!--==========================
          About Section
        ============================-->
        <section id="about">
            <div class="container wow fadeInUp">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="section-title"><?php echo $sec1_tit; ?></h3>
                        <div class="section-title-divider"></div>
                        <p class="section-description"><?php echo $sec1_desc; ?></p>
                    </div>
                </div>
            </div>
            <div class="container about-container wow fadeInUp">
                <div class="row">
                    <div class="col-md-6 col-md-push-6 about-content">
                        <h2 class="about-title"><?php echo $sec1_stit; ?></h2>
                        <p class="about-text">
                            <textarea class="about-text" rows="5" data-rule="required" style="background:inherit;border:inherit;width: 500px;height: 480px;" readonly><?php echo $sec1_det; ?></textarea>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!--==========================
          Services Section
        ============================-->
        <section id="services">
            <div class="container wow fadeInUp">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="section-title"><?php echo $sec2_tit; ?></h3>
                        <div class="section-title-divider"></div>
                        <p class="section-description">
                            <?php echo $sec2_desc; ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 service-item">
                        <div class="service-icon"><i class="fa fa-desktop"></i></div>
                        <h4 class="service-title"><a href=""><?php echo $sec2_1_tit; ?></a></h4>
                        <p class="service-description"><?php echo $sec2_1_desc; ?></p>
                    </div>
                    <div class="col-md-4 service-item">
                        <div class="service-icon"><i class="fa fa-bar-chart"></i></div>
                        <h4 class="service-title"><a href=""><?php echo $sec2_2_tit; ?></a></h4>
                        <p class="service-description"><?php echo $sec2_2_desc; ?></p>
                    </div>
                    <div class="col-md-4 service-item">
                        <div class="service-icon"><i class="fa fa-shopping-bag"></i></div>
                        <h4 class="service-title"><a href=""><?php echo $sec2_3_tit; ?></a></h4>
                        <p class="service-description"><?php echo $sec2_3_desc; ?></p>
                    </div>
                </div>
            </div>
        </section>
        <!--==========================
          Porfolio Section
        ============================-->
        <section id="portfolio">
            <div class="container wow fadeInUp">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="section-title"><?php echo $sec3_tit; ?></h3>
                        <div class="section-title-divider"></div>
                        <p class="section-description"><?php echo $sec3_desc; ?></p>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($productos as $producto) { ?>
                    <div class="col-md-3">
                        <a class="portfolio-item" style="background-image: url(<?php echo base_url(); ?>application/images/productos/<?php echo $producto->imagen;?>);" href="<?php echo site_url("inicio_con/descripcion/".$producto->id_producto); ?>">
                            <div class="details">
                                <h4><?php echo $producto->producto;?></h4>
                                <span>$<?php echo number_format($producto->prc_vta,0,",",".");?> CLP</span>
                            </div>
                        </a>
                    </div>
                    <?php }?>
                </div>
            </div>
        </section>
        <section id="contact">
            <div class="container wow fadeInUp">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="section-title"><?php echo $sec4_tit; ?></h3>
                        <div class="section-title-divider"></div>
                        <p class="section-description"><?php echo $sec4_desc; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-md-push-2">
                        <div class="info">
                            <div>
                                <i class="fa fa-map-marker"></i>
                                <p><?php echo $sec4_direc; ?><br><?php echo $sec4_comuna; ?></p>
                            </div>
                            <div>
                                <i class="fa fa-envelope"></i>
                                <p><?php echo $sec4_email; ?></p>
                            </div>
                            <div>
                                <i class="fa fa-phone"></i>
                                <p><?php echo $sec4_tel; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-push-2">
                        <div class="form">
                            <div id="sendmessage">Su mensaje ha sido enviado, muchas gracias!</div>
                            <div id="errormessage"></div>
                            <?php echo form_open('inicio_con/contacto'); ?>
                                <div class="form-group">
                                    <input type="text" name="nombre" class="form-control" id="name" placeholder="Su Nombre" data-rule="minlen:4" data-msg="Ingrese al menos 4 letras" required/>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Su Email" data-rule="email" data-msg="Por favor, ingrese un email valido" required/>
                                    <div class="validation"></div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="asunto" id="subject" placeholder="Asunto" data-rule="minlen:4" data-msg="Por favor, ingrese al menos 8 caracteres" required/>
                                    <div class="validation"></div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="mensaje" rows="5" data-rule="required" data-msg="Por favor, escribenos algo!" placeholder="Mensaje" required></textarea>
                                    <div class="validation"></div>
                                </div>
                                <div class="text-center"><button type="submit">Enviar Mensaje</button></div>
                            </form>
                        </div>
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