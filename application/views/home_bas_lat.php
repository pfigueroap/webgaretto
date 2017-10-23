<div class="sidebar" data-color="purple" data-image="<?php echo base_url(); ?>application/images/sidebar-1.jpg">
    <div class="logo">
        <a href="<?php echo site_url("inicio_con/index"); ?>" class="simple-text">
            <img src="<?php echo base_url(); ?>application/images/garetto.png" style="background-color:#af1416" height="40" width="200" >
        </a>
    </div>
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="sidebar-wrapper">
            <ul class="nav">
                <?php if($tipo == '1'){ ?>
                <li><a>Usuarios<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?php echo site_url("usuario_con/index/1"); ?>">Administración</a></li>
                        <li><a href="<?php echo site_url("usuario_con/index/2"); ?>">Clientes</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo site_url("producto_con/index"); ?>"> 
                        <p>Productos</p>
                    </a>
                </li>
                <?php } ?>
                <?php #if($tipo == '2'){ ?>
                <li>
                    <a href="<?php echo site_url("historial_con/index"); ?>">
                        <p>Historial</p>
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url("operacion_con/index/1"); ?>">
                        <p>Comprar</p>
                    </a>
                </li>
                <?php #}?>
                <?php if($tipo == '1'){ ?>
                <li><a>Operaciones<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?php echo site_url("operacion_con/index/2"); ?>">Venta</a></li>
                        <li><a href="<?php echo site_url("operacion_con/index/3"); ?>">Arriendo</a></li>
                        <li><a href="<?php echo site_url("operacion_con/index/4"); ?>">Regalo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo site_url("activa_con/index"); ?>">
                        <p>Activación</p>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>