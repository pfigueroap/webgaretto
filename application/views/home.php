<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	    <meta name="viewport" content="width=device-width" />

		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>application/images/apple-icon.png" />
		<link rel="icon" type="image/png" href="<?php echo base_url(); ?>application/images/favicon.png" />
		
		<title>Garetto</title>
		
	    <?php $this->load->view('home_bas_css');?>
	</head>
	<body>
		<div class="wrapper">
			<?php if($clase != 'registrar')
					$this->load->view('home_bas_lat');?>
		    <div class="main-panel" id="main">
		    	<?php
		    	if($clase != 'registrar')
		    		$this->load->view('home_bas_nav');
		    	$this->load->view($page);
		    	?>
		        <footer class="footer"><div class="container-fluid"></div></footer>
		    </div>
		</div>
	</body>
	<?php $this->load->view('home_bas_js');?>
	</script>
</html>
