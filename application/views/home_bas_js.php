<!-- JS -->
<!--
	[1] Home: home_cont
	[2] Usuario: home_user
	[3] Usuario-Enrolar: home_user_enrolar
	[4] Gestión: <Entrega> home_gest_ent <Recepción> home_gest_rec <Devolución> home_gest_dev
	[5] Programación: home_program
	[6] Inspección: home_inspect
	[7] Materiales E-S: <Entrada> home_mat_ing <Salida> home_mat_sal
	[8] Materiales Maestro: home_mat_mas
	[9] Informes: home_informe
-->
<!-- [1][2][3][4][5][6][7][8][9] -->
<script src="<?php echo base_url(); ?>application/js/jquery.min.js"></script>
<!-- [2][3][4][5][6][7][8][9] -->
<script src="<?php echo base_url(); ?>application/js/tabla.js"></script>
<!-- [1][2][3][4][5][6][7][8][9] -->
<script src="<?php echo base_url(); ?>application/js/bootstrap.min.js" type="text/javascript"></script>
<!-- [1][2][3][4][5][6][7][8][9] -->
<script src="<?php echo base_url(); ?>application/js/material.min.js" type="text/javascript"></script>
<!-- [1][2][3][4][5][6][7][8][9] -->
<script src="<?php echo base_url(); ?>application/js/chartist.min.js"></script>
<!-- [1][2][3][4][5][6][7][8][9] -->
<script src="<?php echo base_url(); ?>application/js/bootstrap-notify.js"></script>
<!-- [1][2][3][4][5][6][7][8][9] -->
<script src="<?php echo base_url(); ?>application/js/material-dashboard.js"></script>
<!-- [1][2][3][4][5][6][7][8][9] -->
<script src="<?php echo base_url(); ?>application/js/demo.js"></script>
<!-- [1][2][3][4][5][6][7][8][9] -->
<script src="<?php echo base_url(); ?>application/js/custom.min.js"></script>
<!-- [3][4][6][7][8][9] -->
<script src="<?php echo base_url(); ?>application/js/switchery.min.js"></script>

<!-- [9] Informes -->
<?php if($page == 'home_informe'){?>
<script src="<?php echo base_url(); ?>application/js/dragula.min.js"></script>
<script src="<?php echo base_url(); ?>application/js/index.js"></script>
<?php }?>

<!-- [1] Home -->
<?php if($page == 'home_cont'){?>
<script type="text/javascript">
	$(document).ready(function(){
		// Javascript method's body can be found in assets/js/demos.js
    	demo.initDashboardPageCharts();
	});
</script>
<?php }?>

<!-- [2] Usuario -->
<?php if(in_array($page, array('home_user','home_historial','home_producto','home_compras'))){?>
<script src="<?php echo base_url(); ?>application/js/buscar.js"></script>
<?php }elseif ($page == 'home_usuario') {?>
<script>
function soloLetras(e){
   key = e.keyCode || e.which;
   tecla = String.fromCharCode(key).toLowerCase();
   letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
   especiales = "8-37-39-46";

   tecla_especial = false
   for(var i in especiales){
        if(key == especiales[i]){
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla)==-1 && !tecla_especial){
        return false;
    }
}
function soloNumeros(e){
   key = e.keyCode || e.which;
   tecla = String.fromCharCode(key).toLowerCase();
   numeros = "1234567890+";
   especiales = "8-37-39-46";

   tecla_especial = false
   for(var i in especiales){
        if(key == especiales[i]){
            tecla_especial = true;
            break;
        }
    }

    if(numeros.indexOf(tecla)==-1 && !tecla_especial){
        return false;
    }
}
function soloRut(e){
   key = e.keyCode || e.which;
   tecla = String.fromCharCode(key).toLowerCase();
   ruts = "1234567890.-k";
   especiales = "8-37-39-46";

   tecla_especial = false
   for(var i in especiales){
        if(key == especiales[i]){
            tecla_especial = true;
            break;
        }
    }

    if(ruts.indexOf(tecla)==-1 && !tecla_especial){
        return false;
    }
}
</script>
<?php }?>

<?php if(in_array($page, array('home_compras','home_ventas','home_arriendos','home_regalos'))){ ?>
<script>
function validarchk(id){
var chk = document.getElementById('chk'+id);
var cnt = document.getElementById('cnt'+id);
var tot = document.getElementById('tot'+id);
if(chk.checked){
    cnt.disabled='';
}else{
    cnt.value='0';
    tot.value='0';
    cnt.disabled='disabled';
}
}
function sumcnt(id){
var cnt = document.getElementById('cnt'+id);
var tot = document.getElementById('tot'+id);
var prc = document.getElementById('prc'+id);
//var num = prc.innerHTML*cnt.value;
var num = prc.innerHTML.replace(/[.,]/g, '');
//var num = prc.innerHTML*cnt.value;
tot.value = num*cnt.value;
}
</script>
<?php }?>