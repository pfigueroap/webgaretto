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
        <?php echo form_open_multipart('inicio_con/edit_web'); ?>
        <!--==========================
            Portada
        ============================-->
        <section id="hero">
            <div class="hero-container">
                <div class="wow fadeIn">
                    <div class="hero-logo">
                        <img class="" src="<?php echo base_url(); ?>application/images/logo2.png" alt="Imperial">
                    </div>
                    <h1><input name="titulo" type="text" value="<?php echo $titulo; ?>" style="background : inherit; width: 1000px;text-align:center;" ></h1>
                    <h2><input name="valor" type="text" value="<?php echo $valor; ?>" style="background : inherit; width: 190px;" > 
                        <input name="rotar" type="text" value="<?php echo $rotar; ?>" style="background : inherit; width: 800px;" >
                        </h2>
                    <div class="actions">
                        <a href="#about" class="btn-get-started">Conocenos</a>
                        <a href="#services" class="btn-services">Nuestros Servicios</a>
                    </div>
                </div>
            </div>
        </section>
        <!--==========================
            Barra Navegación
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
                        <li><a href="#">Ingresar</a></li>
                    </ul>
                </nav><!-- #nav-menu-container -->
            </div>
        </header><!-- #header -->
        <!--==========================
            Nosotros
        ============================-->
        <section id="about">
            <div class="container wow fadeInUp">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="section-title">
                            <input name="sec1_tit" type="text" value="<?php echo $sec1_tit; ?>" style="background:inherit;width: 500px;text-align:center;" >
                        </h3>
                        <div class="section-title-divider"></div>
                        <p class="section-description">
                            <input name="sec1_desc" type="text" value="<?php echo $sec1_desc; ?>" style="background:inherit;width: 500px;text-align:center;" ></p>
                    </div>
                </div>
                <div class="row"></div>
            </div>
            <br/>
            <div class="container about-container wow fadeInUp">
                <div class="row">
                    <div class="col-md-6 col-md-push-6 about-content">
                        <h2 class="about-title">
                            <input name="sec1_stit" type="text" value="<?php echo $sec1_stit; ?>" style="background:inherit;width: 500px;text-align:center;" >
                        </h2>
                        <p class="about-text">
                            <textarea name="sec1_det" class="about-text" rows="5" data-rule="required" style="width: 500px;height: 480px;"><?php echo $sec1_det; ?></textarea>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!--==========================
            Servicios
        ============================-->
        <section id="services">
            <div class="container wow fadeInUp">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="section-title">
                            <input name="sec2_tit" type="text" value="<?php echo $sec2_tit; ?>" style="background:inherit;width: 500px;text-align:center;" ></h3>
                        <div class="section-title-divider"></div>
                        <p class="section-description">
                            <textarea name="sec2_desc" class="about-text" rows="5" data-rule="required" style="background:inherit;text-align:center;width: 1000px;height: 100px;"><?php echo $sec2_desc; ?></textarea>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 service-item">
                        <div class="service-icon"><i class="fa fa-desktop"></i></div>
                        <h4 class="service-title"><a href="">
                            <input name="sec2_1_tit" type="text" value="<?php echo $sec2_1_tit; ?>" style="background:inherit;width: 250px;text-align:left;" >
                        </a></h4>
                        <p class="service-description">
                            <textarea name="sec2_1_desc" class="about-text" rows="5" data-rule="required" style="background:inherit;text-align:left;width: 250px;height: 80px;"><?php echo $sec2_1_desc; ?></textarea>
                        </p>
                    </div>
                    <div class="col-md-4 service-item">
                        <div class="service-icon"><i class="fa fa-bar-chart"></i></div>
                        <h4 class="service-title"><a href="">
                            <input name="sec2_2_tit" type="text" value="<?php echo $sec2_2_tit; ?>" style="background:inherit;width: 250px;text-align:left;" >
                        </a></h4>
                        <p class="service-description">
                            <textarea name="sec2_2_desc" class="about-text" rows="5" data-rule="required" style="background:inherit;text-align:left;width: 250px;height: 80px;"><?php echo $sec2_2_desc; ?></textarea>
                        </p>
                    </div>
                    <div class="col-md-4 service-item">
                        <div class="service-icon"><i class="fa fa-shopping-bag"></i></div>
                        <h4 class="service-title"><a href="">
                            <input name="sec2_3_tit" type="text" value="<?php echo $sec2_3_tit; ?>" style="background:inherit;width: 250px;text-align:left;" >
                        </a></h4>
                        <p class="service-description">
                            <textarea name="sec2_3_desc" class="about-text" rows="5" data-rule="required" style="background:inherit;text-align:left;width: 250px;height: 80px;"><?php echo $sec2_3_desc; ?></textarea>
                        </p>r
                    </div>
                </div>
            </div>
        </section>
        <!--==========================
            Productos
        ============================-->
        <section id="portfolio">
            <div class="container wow fadeInUp">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="section-title">
                            <input name="sec3_tit" type="text" value="<?php echo $sec3_tit; ?>" style="background:inherit;width: 500px;text-align:center;" >
                        </h3>
                        <div class="section-title-divider"></div>
                        <p class="section-description">
                            <input name="sec3_desc" type="text" value="<?php echo $sec3_desc; ?>" style="background:inherit;width: 500px;text-align:center;" >
                        </p>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($productos as $producto) { ?>
                    <div class="col-md-4">
                        <a class="portfolio-item" style="background-image: url(<?php echo base_url(); ?>application/images/productos/<?php echo $producto->imagen;?>);" href="#">
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
        <!--==========================
            PROMO Section
        ============================-->
        <section id="promociones">
            <div class="container wow fadeInUp">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="section-title">
                            <input name="sec5_tit" type="text" value="<?php echo $sec5_tit; ?>" style="background:inherit;width: 500px;text-align:center;" >
                        </h3>
                        <div class="section-title-divider"></div>
                        <p class="section-description">
                            <input name="sec5_desc" type="text" value="<?php echo $sec5_desc; ?>" style="background:inherit;width: 500px;text-align:center;" >
                        </p>
                        <div class="col-md-12">
                            <hr>
                            <div class="col-md-6">
                                <h2 style="font-style: bold; color: black; border: grey;">
                                    <input name="sec5_1_ptit" type="text" value="<?php echo $sec5_1_ptit; ?>" style="background:inherit;width: 500px;text-align:center;" >
                                </h2>
                                <p><input name="sec5_1_pdesc" type="text" value="<?php echo $sec5_1_pdesc; ?>" style="background:inherit;width: 500px;text-align:center;" ></p>
                                <input class="btn btn-default btn-xs" style="background: #af1416;width: 500px;" type="file" name="sec5_1_pimg" id="sec5_1_pimg" size="30" accept=".jpg" /><br>
                                <input type="checkbox" style="width: 20px;height: 20px;font-size: 15pt;" name="sec5_1_pcheck" value="1" <?php if($sec5_1_pcheck == '1') echo "checked" ?>>&nbsp;&nbsp;Activar Promoción<br>
                            </div>
                            <div class="col-md-6">
                                <img id="img5_1" src="<?php echo base_url(); ?>application/images/web/<?php echo $sec5_1_pimg;?>" style="width:50%;">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <div class="col-md-6">
                                <h2 style="font-style: bold; color: black; border: grey;">
                                    <input name="sec5_2_ptit" type="text" value="<?php echo $sec5_2_ptit; ?>" style="background:inherit;width: 500px;text-align:center;" >
                                </h2>
                                <p><input name="sec5_2_pdesc" type="text" value="<?php echo $sec5_2_pdesc; ?>" style="background:inherit;width: 500px;text-align:center;" ></p>
                                <input class="btn btn-default btn-xs" style="background: #af1416;width: 500px;" type="file" name="sec5_2_pimg" id="sec5_2_pimg" size="30" accept=".jpg" /><br>
                                <input type="checkbox" style="width: 20px;height: 20px;font-size: 15pt;" name="sec5_2_pcheck" value="1" <?php if($sec5_2_pcheck == '1') echo "checked" ?>>&nbsp;&nbsp;Activar Promoción<br>
                            </div>
                            <div class="col-md-6">
                                <img id="img5_2" src="<?php echo base_url(); ?>application/images/web/<?php echo $sec5_2_pimg;?>" style="width:50%;">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <div class="col-md-6">
                                <h2 style="font-style: bold; color: black; border: grey;">
                                    <input name="sec5_3_ptit" type="text" value="<?php echo $sec5_3_ptit; ?>" style="background:inherit;width: 500px;text-align:center;" >
                                </h2>
                                <p><input name="sec5_3_pdesc" type="text" value="<?php echo $sec5_3_pdesc; ?>" style="background:inherit;width: 500px;text-align:center;" ></p>
                                <input class="btn btn-default btn-xs" style="background: #af1416;width: 500px;" type="file" name="sec5_3_pimg" id="sec5_3_pimg" size="30" accept=".jpg" /><br>
                                <input type="checkbox" style="width: 20px;height: 20px;font-size: 15pt;" name="sec5_3_pcheck" value="1" <?php if($sec5_3_pcheck == '1') echo "checked" ?>>&nbsp;&nbsp;Activar Promoción<br>
                            </div>
                            <div class="col-md-6">
                                <img id="img5_3" src="<?php echo base_url(); ?>application/images/web/<?php echo $sec5_3_pimg;?>" style="width:50%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--==========================
            Contacto
        ============================-->
        <section id="contact">
            <div class="container wow fadeInUp">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="section-title">
                            <input name="sec4_tit" type="text" value="<?php echo $sec4_tit; ?>" style="background:inherit;width: 500px;text-align:center;" >
                        </h3>
                        <div class="section-title-divider"></div>
                        <p class="section-description">
                            <input name="sec4_desc" type="text" value="<?php echo $sec4_desc; ?>" style="background:inherit;width: 500px;text-align:center;" >
                        </p>
                    </div>
                </div>
                <div class="info">
                    <table style="text-align:center">
                        <tr>
                            <td style="text-align: center; width:100px;height: 50px;">
                                <i class="fa fa-map-marker"></i>
                            </td>
                            <td style="text-align: left; width:600px;height: 50px;">
                                <input name="sec4_direc" type="text" value="<?php echo $sec4_direc; ?>" style="background:inherit;width: 500px;text-align:left;" >
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; width:100px;height: 50px;"></td>
                            <td style="text-align: left; width:600px;height: 50px;">
                                <input name="sec4_comuna" type="text" value="<?php echo $sec4_comuna; ?>" style="background:inherit;width: 500px;text-align:left;" >
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; width:100px;height: 50px;">
                                <i class="fa fa-envelope"></i>
                            </td>
                            <td style="text-align: left; width:600px;height: 50px;">
                                <input name="sec4_email" type="text" value="<?php echo $sec4_email; ?>" style="background:inherit;width: 500px;text-align:left;" >
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; width:100px;height: 50px;">
                                <i class="fa fa-phone"></i>
                            </td>
                            <td style="text-align: left; width:600px;height: 50px;">
                                <input name="sec4_tel" type="text" value="<?php echo $sec4_tel; ?>" style="background:inherit;width: 500px;text-align:left;" >
                            </td>
                        </tr>
                    </table>
                    <br/><br/>
                    <div style="text-align: center;">
                        <button class="btn btn-primary btn-xs" style="font-size: 15pt;width: 30%;height:50px;margin-right: 30px;margin-bottom: 20px;background: #af1416; box-shadow:none;" > <i class="fa fa-save" style="font-size: 20pt;"></i> &nbsp&nbsp&nbsp Guardar Cambios </button>
                    </div>
                </div>
            </div>
        </section>
        </form>  
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
        <!--script src="<?php #echo base_url(); ?>application/js/jquery.min.js"></script-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
        <script type="text/javascript">$(document).ready(function(){
            $("#sec5_1_pimg").change(function(){
                var input=this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#img5_1').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            })
            $("#sec5_2_pimg").change(function(){
                var input=this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#img5_2').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            })
            $("#sec5_3_pimg").change(function(){
                var input=this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#img5_3').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            })
        });</script>
    </body>
</html>