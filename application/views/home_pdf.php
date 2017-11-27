
<!--link href="<?php #echo base_url(); ?>application/css/custom.min.css" rel="stylesheet"-->
<style>
table, td, th {    
    border: 1px solid #ddd;
    text-align: center;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 10px;
}
</style>

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
    			elseif($pago == 'webpay' and $valida == '1') echo "Información de Compra Exitosa";
    			elseif($pago == 'webpay' and $valida == '0') echo "Información de Compra Rechazada";
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
            <td><?php echo $user;?></td>
            <td><?php echo number_format($total,0,",",".");?></td>
            <td>CLP</td>
        </tr>
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
        <?php if($pago == 'webpay' and $valida == '0'){ ?>
        <tr><th colspan="4" style="background: LightGray;">La compra a sido declinada, por favor validar con su banco el origen del problema.</th></tr>
        <?php }elseif($pago == 'transferencia' and $valida == '0'){?>
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
    <br/>
    <h3>Registro de compras</h3>
    <table>
        <tr>
            <th>Código Producto</th>
            <th>Producto</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Código Barras</th>
            <th>Precio</th>
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
            <td><?php echo number_format($compra->prc_vta,0,",",".")." ".$arr_mnd[$compra->mnd_vta]; ?></td>
            <td><?php echo number_format($compra->cantidad,0,",","."); ?></td>
            <td><?php echo number_format($compra->total,0,",","."); ?></td>
        </tr>
        <?php } ?>
    </table>
    <?php if($valida == '1'){?>
    <br><hr>
    <h3>Voucher</h3>
    <table>        
        <tr>
            <th>ID Compra</th>
            <th>Monto Total</th>
            <th>Tipo Pago</th>
            <th>Fecha - Hora</th>
            <th>Facturación</th>
            <th>Validado</th>
        </tr>
        <tr>
            <td><?php echo $id_compra; ?></td>
            <td><?php echo number_format($total,0,",",".");?> CLP</td>
            <td><?php echo $pago;?></td>
            <td><?php echo $orden_compra['f_compra'].' - '.$orden_compra['h_compra'];?></td>
            <td><?php echo $orden_compra['factura'];?></td>
            <td>Si</td>
        </tr>
    </table>
    <textarea style="width: 100%;height: 60px;font-size: 8pt;text-align: justify;background-color: whitesmoke;" readonly>Estimado Cliente, gracias por preferirnos, en Garetto estamos para ayudarlo, una vez recibido su producto,<br>agradeceremos tomar contacto con Nuestra área de Servicios y Soporte, para asesorarlo en su Instalación y<br>respectiva validación. El nombre de la persona encargada es <?php echo $info_comp->nombre; ?>, su N° telefónico es <?php echo $info_comp->telefono; ?><br>y su mail es <?php echo $info_comp->correo; ?>.</textarea>
    <?php } ?>
</div>
	
