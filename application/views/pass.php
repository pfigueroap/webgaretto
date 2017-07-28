<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
	<br><br><br><br>
	<center style="width: 100%; background: #800A0A; text-align: left;">
		<table role="presentation" aria-hidden="true" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">
			<tr>
				<td style="padding: 20px 0; text-align: center">
					<img src="<?php echo base_url(); ?>application/images/logo2.png" width="300">
				</td>
			</tr>
		</table>
		<table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin:auto;" class="email-container">
			<tr>
				<td bgcolor="#ffffff">
					<table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" width="100%">
						<tr>
							<?php echo form_open('inicio_con/edit_pass'); ?>
							<input type="text" class="form-control" value="<?php echo $mensaje ?>" style="text-align:center;" disabled>
							<div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        		<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Contraseña Actual </label>
                    			<div class="col-md-8 col-sm-6 col-xs-12">
                        			<input name="pass" type="password" class="form-control col-md-7 col-xs-12 parsley-success" placeholder="Contraseña Actual" required>
                    			</div>
                    		</div>
                    		<div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        		<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Nueva Contraseña </label>
                    			<div class="col-md-8 col-sm-6 col-xs-12">
                        			<input name="new_pass" type="password" class="form-control col-md-7 col-xs-12 parsley-success" placeholder="Nueva Contraseña" required>
                    			</div>
                    		</div>
                    		<div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        		<label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Confirmar Nueva Contraseña </label>
                    			<div class="col-md-8 col-sm-6 col-xs-12">
                        			<input name="conf_new_pass" type="password" class="form-control col-md-7 col-xs-12 parsley-success" placeholder="Confirmar Nueva Contraseña" required>
                    			</div>
                    		</div>
                    		<div class="col-md-12 col-sm-12 col-xs-12 form-group"><input type="text" class="form-control" disabled></div>
                    		<div class="col-md-12 text-right">
                    			<button id="btnSubmit" class="btn btn-default btn-xs" style="background: #af1416;"><i class="fa fa-edit" ></i> Guardar Cambios</button>
                    		</div>
                    		</form>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">
			<tr>
				<td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; line-height:18px; text-align: center; color: #888888;" class="x-gmail-data-detectors">
					<br><br>
					Garetto <br>Nueva York 47, Santiago Centro - Chile<br>Teléfono: (56-2) 2820 59 00 - Fax: (56-2) 2696 24 40
					<br><br>
				</td>
			</tr>
		</table>
	</center>
</body>
</html>
