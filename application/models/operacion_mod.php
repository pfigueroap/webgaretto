<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

class Operacion_mod extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }
    function variable($tabla){
        $query = $this->db->query("SELECT * FROM ".$tabla);
        $result = $query->result();
        $variable = (array) $result;
        return $variable;
    }
    function productos(){
    	$query = $this->db->query("SELECT * FROM producto WHERE estado = '0'");
        $result = $query->result();
        $productos = (array) $result;
        return $productos;
    }
    function crear_registro($registros,$estado,$id_cliente){
    	# $estado [compra temporal: 0], [transferencia por validar: 1], [webpay pagado: 2], [venta temporal: 3], [arriendo: 4], [regalo: 5], [validado: 6]
    	$this->db->query("INSERT INTO tmp_compra (usuario,f_ingreso,h_ingreso,estado,id_cliente) VALUES ('{$registros[0]['usuario']}','{$registros[0]['f_ingreso']}','{$registros[0]['h_ingreso']}','{$estado}','{$id_cliente}')");
    	$id_tmp_compra = $this->db->insert_id();
    	foreach ($registros as $r) {
    		$this->db->query("INSERT INTO tmp_det_compra (id_tmp_compra,id_producto,prc_vta,mnd_vta,cantidad,total,usuario,f_ingreso,h_ingreso,estado) 
    			VALUES ('{$id_tmp_compra}','{$r['id_producto']}','{$r['prc_vta']}','{$r['mnd_vta']}','{$r['cantidad']}','{$r['total']}','{$r['usuario']}','{$r['f_ingreso']}','{$r['h_ingreso']}','{$estado}')");
    	}
    	return $id_tmp_compra;
    }
    function tmp_compras($usuario){
    	$query = $this->db->query("SELECT p.cod_prod, p.producto, p.cod_bar, p.modelo, p.marca, t.id_tmp_compra, t.id_tmp_detalle, t.prc_vta, t.mnd_vta, t.cantidad, t.total FROM tmp_det_compra AS t
    		INNER JOIN producto AS p ON t.id_producto = p.id_producto
    		WHERE t.estado = '0' AND t.usuario = '{$usuario}' AND t.estado = '0'");
        $result = $query->result();
        $compras = (array) $result;
        return $compras;
    }
    function eliminar_detalle($id_tmp_detalle,$usuario){
    	$this->db->query("DELETE FROM tmp_det_compra WHERE id_tmp_detalle = '{$id_tmp_detalle}' AND usuario = '{$usuario}' AND estado = '0'");
    }
    function direcciones($usuario){
    	$query = $this->db->query("SELECT u.direccion AS dir_personal, e.direccion AS dir_laboral FROM usuarios AS u
    		INNER JOIN empresa AS e ON u.id_empresa = e.id_empresa WHERE u.usuario = '{$usuario}'");
        $result = $query->result();
        $direcciones = (array) $result[0];
        return $direcciones;
    }
    function vaciar_carrito($usuario){
    	$this->db->query("DELETE FROM tmp_det_compra WHERE usuario = '{$usuario}'");
    }
    function direccion($usuario,$despacho){
    	if($despacho == 'laboral') $query = $this->db->query("SELECT e.direccion FROM usuarios AS u INNER JOIN empresa AS e ON u.id_empresa = e.id_empresa WHERE u.usuario = '{$usuario}'");
    	elseif($despacho == 'personal') $query = $this->db->query("SELECT direccion FROM usuarios WHERE usuario = '{$usuario}'");
    	$direccion = $query->result()[0]->direccion;
    	return $direccion;
    }
    function registrar_compra($usuario,$pago,$total,$compras,$despacho,$direccion,$validador){
    	$this->db->query("INSERT INTO compra (tipo_pago,usuario,f_compra,h_compra,validador,despacho,direccion,total) VALUES 
    		('{$pago}','{$usuario}',CURDATE(),CURTIME(),'{$validador}','{$despacho}','{$direccion}','{$total}')");
    	$id_compra = $this->db->insert_id();
    	if($pago == 'transferencia') $estado = '1'; #Transferencia por validar
    	elseif($pago == 'webpay' and $validador == '0') $estado = '0'; #De vuelta al carro de compras
    	elseif($pago == 'webpay' and $validador == '1') $estado = '2'; #Compra Pagada con webpay
    	foreach ($compras as $compra){
            $id_tmp_compra = $compra->id_tmp_compra;
    		$this->db->query("UPDATE tmp_det_compra SET id_compra = '{$id_compra}', estado = '{$estado}' 
                WHERE id_tmp_detalle = '{$compra->id_tmp_detalle}'");
        }
        $this->db->query("UPDATE tmp_compra SET direccion = '{$direccion}', estado = '{$estado}', f_pago = '{$pago}', t_despacho = '{$despacho}', id_compra = '{$id_compra}' 
            WHERE id_tmp_compra = '{$id_tmp_compra}'");
    	return $id_compra;
    }
    function clientes(){
    	$query = $this->db->query("SELECT * FROM usuarios WHERE tipo = '2'");
        $result = $query->result();
        $clientes = (array) $result;
        return $clientes;
    }
    function registros(){
    	$query = $this->db->query("SELECT c.id_tmp_compra, c.f_ingreso, c.h_ingreso, c.estado, c.valida, u.nombre_1, u.apellido_1, u.rut, SUM(d.total) AS total 
    		FROM tmp_compra AS c 
    		LEFT JOIN usuarios AS u ON c.id_cliente = u.id_usuario 
    		INNER JOIN tmp_det_compra AS d ON c.id_tmp_compra = d.id_tmp_compra 
    		GROUP BY c.id_tmp_compra ORDER BY c.f_ingreso DESC, c.h_ingreso DESC");
    	$result = $query->result();
        $registros = (array) $result;
        return $registros;
    }
    function orden($id_tmp_compra){
    	$query = $this->db->query("SELECT c.id_tmp_compra, c.f_ingreso, c.h_ingreso, c.estado, c.direccion, c.f_pago, c.t_despacho, c.id_compra, u.nombre_1, u.apellido_1, u.rut, u.usuario, SUM(d.total) AS total 
    		FROM tmp_compra AS c 
    		INNER JOIN usuarios AS u ON c.id_cliente = u.id_usuario 
    		INNER JOIN tmp_det_compra AS d ON c.id_tmp_compra = d.id_tmp_compra 
    		WHERE c.id_tmp_compra = '{$id_tmp_compra}'");
    	$result = $query->result();
        $orden = (array) $result[0];
        return $orden;
    }
    function detalle_registro($id_tmp_compra){
    	$query = $this->db->query("SELECT p.cod_prod, p.producto, p.modelo, p.marca, p.cod_bar, d.prc_vta, d.mnd_vta, d.cantidad, d.total, d.id_tmp_detalle  
    		FROM tmp_det_compra AS d 
    		INNER JOIN tmp_compra AS c ON d.id_tmp_compra = c.id_tmp_compra 
    		INNER JOIN usuarios AS u ON c.id_cliente = u.id_usuario 
    		INNER JOIN producto AS p ON d.id_producto = p.id_producto 
    		WHERE d.id_tmp_compra = '{$id_tmp_compra}'");
    	$result = $query->result();
        $detalle_registro = (array) $result;
        return $detalle_registro;
    }
    function eliminar_orden($id_tmp_compra){
    	$this->db->query("DELETE FROM tmp_det_compra WHERE id_tmp_compra = '{$id_tmp_compra}'");
    	$this->db->query("DELETE FROM tmp_compra WHERE id_tmp_compra = '{$id_tmp_compra}'");	
    }
    function eliminar_det_orden($id_tmp_detalle){
    	$this->db->query("DELETE FROM tmp_det_compra WHERE id_tmp_detalle = '{$id_tmp_detalle}'");
    }
    function actualizar_orden($id_tmp_compra,$despacho, $direccion,$pago){
    	$this->db->query("UPDATE tmp_compra SET t_despacho = '{$despacho}', direccion = '{$direccion}', f_pago = '{$pago}' WHERE id_tmp_compra = '{$id_tmp_compra}'");
    }
    function id_usuario($usuario){
        $query = $this->db->query("SELECT id_usuario FROM usuarios WHERE usuario = '{$usuario}'"); 
        $result = $query->result();
        $usuario = (array) $result[0];
        return $usuario["id_usuario"];
    }
    function validar_orden($id_tmp_compra,$estado){
        $this->db->query("UPDATE tmp_det_compra SET valida = '{$estado}' WHERE id_tmp_compra = '{$id_tmp_compra}' AND id_producto = '2'");
        $this->db->query("UPDATE tmp_compra SET valida = '{$estado}' WHERE id_tmp_compra = '{$id_tmp_compra}'");
    }
    function info_reloj($id_tmp_compra){
        $query = $this->db->query("SELECT u.usuario, u.rut, u.correo, u.nombre_1, u.nombre_2, u.apellido_1, u.apellido_2, 
            p.marca, p.modelo, e.rut AS rut_empresa, e.direccion, e.giro, e.empresa, d.cantidad 
            FROM tmp_compra AS c 
            INNER JOIN usuarios AS u ON c.id_cliente = u.id_usuario 
            INNER JOIN empresa AS e ON u.id_empresa = e.id_empresa 
            INNER JOIN tmp_det_compra AS d ON c.id_tmp_compra = d.id_tmp_compra 
            INNER JOIN producto AS p ON d.id_producto = p.id_producto 
            WHERE c.id_tmp_compra = '{$id_tmp_compra}' AND d.id_producto = '2'");
        $result = $query->result();
        $info = (array) $result[0];
        return $info;
    }
    function correo($id_usuario){
        $query = $this->db->query("SELECT * FROM usuarios WHERE id_usuario = '{$id_usuario}'");
        $result = $query->result();
        return $result[0]->correo;
    }
    function correo_adm(){
        $query = $this->db->query("SELECT correo FROM usuarios WHERE tipo = '1' AND estado = '0'");
        $result = $query->result();
        return $result;
    }
}
?>