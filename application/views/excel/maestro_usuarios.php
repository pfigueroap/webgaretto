<meta charset="utf-8" />
<?php
$fech = date("ymd");
header("Content-type: application/vnd.ms-excel"); 
header("Content-disposition: attachment; filename=maestro_usuarios_{$title}_{$fech}.xls"); 
?>
<table   border="1" cellspacing="0" cellpadding="1">
    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>1er Nombre</th>
        <th>2do Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Direccion</th>
        <th>Correo</th>
        <th>Rut</th>
        <th>Genero</th>
        <th>Celular</th>
        <th>Perfil</th>
        <th>Empresa</th>
        <th>Nación</th>
    </tr>
    <?php foreach ($usuarios as $value) {?>
    <tr>
        <td><?php echo $value->id_usuario;?></td>
        <td><?php echo $value->usuario;?></td>
        <td><?php echo $value->nombre_1;?></td>
        <td><?php echo $value->nombre_2;?></td>
        <td><?php echo $value->apellido_1;?></td>
        <td><?php echo $value->apellido_2;?></td>
        <td><?php echo $value->direccion;?></td>
        <td><?php echo $value->correo;?></td>
        <td><?php echo $value->rut;?></td>
        <td><?php echo $value->genero;?></td>
        <td><?php echo $value->celular;?></td>
        <td><?php echo $title;?></td>
        <td><?php echo $value->empresa;?></td>
        <td><?php echo $value->nacion;?></td>
    </tr>
    <?php }?>
</table>