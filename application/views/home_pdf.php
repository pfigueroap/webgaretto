<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	    <meta name="viewport" content="width=device-width" />
		<title>Garetto</title>		
		<link href="<?php echo base_url(); ?>application/css/custom.min.css" rel="stylesheet">
		<style>
		table, td, th {    
		    border: 1px solid #ddd;
		    text-align: center;
		}

		table {
		    border-collapse: collapse;
		    width: 50%;
		}

		th, td {
		    padding: 10px;
		}
		</style>
	</head>
	<body>
		<div>
			<div>
				<h3 style="margin-left: 1.5%; color: #af1416; font-size: 30px;">Comprobante</h3>
			</div>
			<h3 class="title">
            <?php  	if($clase == 'historial' or  $clase == 'ordenes'){ ?>
            	<?php   if($estado == '0') echo "Información de compra - Por pagar"; 
	                    elseif($estado == '1') echo "Información de compra - Transferencia Bancaria"; 
	                    elseif($estado == '2') echo "Información de compra - WebPay Rechazada"; 
	                    elseif($estado == '3') echo "Información de Venta - por Validar"; 
	                    elseif($estado == '4') echo "Información de Arriendo - por Validar";
	                    elseif($estado == '5') echo "Información de Regalo - por Validar";
	                    elseif($estado == '6') echo "Información de Transacción Validada";
	                }else{ ?>
            	<?php 	if($pago == 'transferencia') echo "Información de compra - Transferencia Bancaria";
            			elseif($pago == 'webpay' and $validador == '1') echo "Información de Compra Exitosa";
            			elseif($pago == 'webpay' and $validador == '0') echo "Información de Compra Rechazada";
            		} ?>
            </h3>
            <table>
                <tr>
                    <th>ID Compra</th>
                    <th>Usuario</th>
                    <th>Total</th>
                    <th>Moneda</th>
                </tr>
                <tr>
                    <td><?php echo $id_compra;?></td>
                    <td><?php echo $usuario;?></td>
                    <td><?php echo $total;?></td>
                    <td>CLP</td>
                </tr>
            </table>
            <table>
                <tr>
                    <th>Tipo de Pago</th>
                    <th>Cantidad Productos</th>
                    <th>Tipo de Despacho</th>
                    <th>Dirección</th>
                </tr>
                <tr>
                    <td><?php echo $pago;?></td>
                    <td><?php echo number_format(count($compras),0,",",".");?></td>
                    <td><?php echo $despacho;?></td>
                    <td><?php echo $direccion;?></td>
                </tr>
                <?php if($pago == 'webpay' and $validador == '0'){ ?>
                <tr><th colspan="4" style="background: LightGray;">La compra a sido declinada, por favor validar con su banco el origen del problema.</th></tr>
                <?php }elseif($pago == 'transferencia'){?>
                <tr><th colspan="4" style="background: LightGray;">Está compra aún no se encuentra validada, una vez realizada la tansferencia a la cuenta señala a continuación, informando el ID de compra en el asunto, se procederá al despacho del producto.</th></tr>
                <tr>
                    <th>Banco/Tipo de Cuenta</th>
                    <th>Nº Cuenta</th>
                    <th>Nombre/Rut</th>
                    <th>Correo</th>
                </tr>
                <tr>
                    <td>Banco de Chile - Cta Corriente</td>
                    <td>XXXX-XXXX-XXXX</td>
                    <td>11.111.111-1</td>
                    <td>contacto@garetto.cl</td>
                </tr>
                <?php }?>
            </table>
            <h3>Registro de compras</h3>
            <br/>
            <table>
                <tr>
                    <th>Código Producto</th>
                    <th>Producto</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Código Barras</th>
                    <th>Precio</th>
                    <th>Moneda</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
                <?php foreach ($compras as $compra) { ?>
                <tr>
                    <td><?php echo $compra->cod_prod; ?></td>
                    <td><?php echo $compra->producto; ?></td>
                    <td><?php echo $compra->marca; ?></td>
                    <td><?php echo $compra->modelo; ?></td>
                    <td><?php echo $compra->cod_bar; ?></td>
                    <td><?php echo number_format($compra->prc_vta,0,",","."); ?></td>
                    <td><?php echo $arr_mnd[$compra->mnd_vta]; ?></td>
                    <td><?php echo number_format($compra->cantidad,0,",","."); ?></td>
                    <td><?php echo number_format($compra->total,0,",","."); ?></td>
                </tr>
                <?php } ?>
            </table>
		</div>
	</body>
</html>
