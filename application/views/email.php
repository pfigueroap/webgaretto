<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
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
							<td style="padding: 40px; font-family: sans-serif; font-size: 15px;line-height: 20px; color: #555555;">
								<p style="text-indent: 50px; text-align: left;"><?php echo $asunto; ?>:</p>
								<br>
								<p style="text-indent: 50px; text-align: justify;"><?php echo $mensaje; ?></p>
								<br>
								<p style="text-indent: 50px; text-align: left;">Atte. <?php echo $nombre; ?></p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">
			<tr>
				<td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; line-height:18px; text-align: center; color: #888888;" class="x-gmail-data-detectors">
					<a href="http://www.webgaretto.cl/">
						<webversion style="color:#cccccc; text-decoration:underline; font-weight: bold;">Visitar Sitio Web</webversion>
					</a>
					<br><br>
					Garetto <br>Nueva York 47, Santiago Centro - Chile<br>Teléfono: (56-2) 2820 59 00 - Fax: (56-2) 2696 24 40
					<br><br>
				</td>
			</tr>
		</table>
	</center>
</body>
</html>
