<nav class="navbar navbar-transparent navbar-absolute">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="<?php echo site_url("inicio_con/page"); ?>">
					   <i class="material-icons">public</i>
					   <p class="hidden-lg hidden-md">Page</p>
				    </a>
				</li>
				<?php if($tipo == '1'){ ?>
				<li>
					<a href="<?php echo site_url("operacion_con/ordenes"); ?>">
					   <i class="material-icons">content_paste</i>
					   <p class="hidden-lg hidden-md">Ordenes</p>
				    </a>
				</li>
				<?php } ?>
				<li>
					<a href="<?php echo site_url("operacion_con/carro_compras"); ?>">
					   <i class="material-icons">add_shopping_cart</i>
					   <p class="hidden-lg hidden-md">Shopping</p>
				    </a>
				</li>
				<li>
					<a href="<?php echo site_url("inicio_con/usuario"); ?>">
					   <i class="material-icons">person</i>
					   <p class="hidden-lg hidden-md">Profile</p>
				    </a>
				</li>
				<?php if($tipo == '1'){ ?>
				<li>
					<a href="<?php echo site_url("inicio_con/configuracion"); ?>">
					   <i class="material-icons">settings</i>
					   <p class="hidden-lg hidden-md">Config</p>
				    </a>
				</li>
				<?php } ?>
				<li>
					<a href="<?php echo site_url("inicio_con/salir"); ?>">
						<i class="material-icons">exit_to_app</i>
						<p class="hidden-lg hidden-md">exit_to_app</p>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>