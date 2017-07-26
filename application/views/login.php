<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Garetto</title>
        <!-- CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>application/css/reset.min.css">
        <link rel='stylesheet prefetch' href='<?php echo base_url(); ?>application/css/google_fonts.css'>
        <link rel='stylesheet prefetch' href='<?php echo base_url(); ?>application/lib/font-awesome/css/font-awesome.min.css'>
        <link rel="stylesheet" href="<?php echo base_url(); ?>application/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>application/css/style_login.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>application/css/login.css">
        <!-- Iconos -->
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>application/images/apple-icon.png" />
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>application/images/favicon.png" />
    </head>
    <body>
        <video autoplay="autoplay" loop muted > 
            <source src="<?php echo base_url(); ?>application/video/login.mp4" type="video/mp4"></source>
        </video>
        <div class="container">
            <br/>
            <div class="pen-title">
                <h1>Bienvenido a</h1>
                <img src="<?php echo base_url(); ?>application/images/logo2.png" width="30%">
            </div>
            <div class="module form-module">
                <div hidden="true" class="toggle"><i class="fa fa-times fa-pencil"></i>
                    <div class="tooltip" id="ClickMe">Click Me</div>
                </div>
                <div class="form">
                    <h2>Ingresa tus datos</h2>
                    <?php echo form_open('inicio_con/login'); ?>
                        <input type="text" placeholder="Usuario" name="username"/>
                        <input type="password" placeholder="Contraseña" name="password"/>
                        <button>Ingresa</button>
                    </form>
                    <button onclick="document.getElementById('ClickMe').click();">Registrate</button>
                </div>
                <div class="form">
                    <h2>Registrarse</h2>
                    <?php echo form_open('inicio_con/registro'); ?>
                        <input type="text" placeholder="Usuario" name="username" required/>
                        <input type="password" placeholder="Contraseña" name="password" required/>
                        <input type="email" placeholder="Email" name="email" required/>
                        <button>Registrarse</button>
                    </form>
                    <button onclick="document.getElementById('ClickMe').click();">Ingresar</button>
                </div>
                <!--div class="cta"><a href="#">Olvidaste tu contraseña?</a></div-->
            </div>
        </div>
        <a id="refresh" value="Refresh" onClick="history.go()">
            <svg class="refreshicon"   version="1.1" id="Capa_1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 width="25px" height="25px" viewBox="0 0 322.447 322.447" style="enable-background:new 0 0 322.447 322.447;" xml:space="preserve">
                 <path  d="M321.832,230.327c-2.133-6.565-9.184-10.154-15.75-8.025l-16.254,5.281C299.785,206.991,305,184.347,305,161.224
                        c0-84.089-68.41-152.5-152.5-152.5C68.411,8.724,0,77.135,0,161.224s68.411,152.5,152.5,152.5c6.903,0,12.5-5.597,12.5-12.5
                        c0-6.902-5.597-12.5-12.5-12.5c-70.304,0-127.5-57.195-127.5-127.5c0-70.304,57.196-127.5,127.5-127.5
                        c70.305,0,127.5,57.196,127.5,127.5c0,19.372-4.371,38.337-12.723,55.568l-5.553-17.096c-2.133-6.564-9.186-10.156-15.75-8.025
                        c-6.566,2.134-10.16,9.186-8.027,15.751l14.74,45.368c1.715,5.283,6.615,8.642,11.885,8.642c1.279,0,2.582-0.198,3.865-0.614
                        l45.369-14.738C320.371,243.946,323.965,236.895,321.832,230.327z"/>
            </svg>
        </a>
        <!-- JS -->
        <script src='<?php echo base_url(); ?>application/js/jquery.min.js'></script>
        <script src="<?php echo base_url(); ?>application/js/index.js"></script>
    </body>
</html>
