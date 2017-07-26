<meta charset="utf-8" />
<?php
$fech = date("ymd");
header("Content-type: application/vnd.ms-excel"); 
header("Content-disposition: attachment; filename=maestro_productos_{$fech}.xls"); 
?>
<table   border="1" cellspacing="0" cellpadding="1">
    <tr>
        <th>ID</th>
        <th>Código Producto</th>
        <th>Producto</th>
        <th>Descripción</th>
        <th>Código Barras</th>
        <th>Precio Venta</th>
        <th>Moneda Venta</th>
        <th>Precio Compra</th>
        <th>Moneda Compra</th>
        <th>Modelo</th>
        <th>Marca</th>
        <th>Fecha Compra</th>
        <th>Stock</th>
        <th>Fecha Creación</th>
        <th>Fecha Modificación</th>
        <th>Creado por</th>
    </tr>
    <?php foreach ($productos as $value) {?>
    <tr>
        <td><?php echo $value->id_producto;?></td>
        <td><?php echo $value->cod_prod;?></td>
        <td><?php echo $value->producto;?></td>
        <td><?php echo $value->descripcion;?></td>
        <td><?php echo $value->cod_bar;?></td>
        <td><?php echo $value->prc_vta;?></td>
        <td><?php echo $value->mnd_vta;?></td>
        <td><?php echo $value->prc_cpr;?></td>
        <td><?php echo $value->mnd_cpr;?></td>
        <td><?php echo $value->modelo;?></td>
        <td><?php echo $value->marca;?></td>
        <td><?php echo $value->f_compra;?></td>
        <td><?php echo $value->cantidad;?></td>
        <td><?php echo $value->f_creacion;?></td>
        <td><?php echo $value->f_modificacion;?></td>
        <td><?php echo $value->usuario;?></td>
    </tr>
    <?php }?>
</table>