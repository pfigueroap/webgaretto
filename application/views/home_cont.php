<div class="content">
	<div class="container-fluid">
		<div class="row">
			<?php foreach ($productos as $producto) { ?>
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="card card-stats">
						<div class="card-header" style="background-color: #af1416">
							<!--i class="material-icons" style="color: white">info_outline</i-->
							<img style="width: 100px;height: 120px;" src="<?php echo base_url(); ?>application/images/productos/<?php echo $producto->imagen;?>">
						</div>
						<div class="card-content">
							<p class="category" style="color: #af1416"><?php echo $producto->producto;?></p>
							<h3 class="title"><?php echo $stock[$producto->id_producto];?></h3>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="row" style="text-align: center;">
			<br><br><br><br>
			<img style="width: 600px;background-color: #af1416;" src="<?php echo base_url(); ?>application/images/logo2.png">
		</div>
	</div>
</div>