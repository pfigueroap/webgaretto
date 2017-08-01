<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

class Historial_mod extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }
    function registros($usuario){
    	$query = $this->db->query("SELECT c.id_tmp_compra, c.f_ingreso, c.h_ingreso, c.estado, u.nombre_1, u.apellido_1, u.rut, SUM(d.total) AS total 
    		FROM tmp_compra AS c 
    		LEFT JOIN usuarios AS u ON c.id_cliente = u.id_usuario 
    		INNER JOIN tmp_det_compra AS d ON c.id_tmp_compra = d.id_tmp_compra 
    		WHERE c.usuario = '{$usuario}' GROUP BY c.id_tmp_compra ORDER BY c.f_ingreso DESC, c.h_ingreso DESC");
    	$result = $query->result();
        $registros = (array) $result;
        return $registros;
    }
    function usuario($usuario){
    	$query = $this->db->query("SELECT * FROM usuarios WHERE usuario = '{$usuario}'");
    	$result = $query->result();
        $registros = (array) $result[0];
        return $registros;
    }
    function orden($id_tmp_compra){
    	$query = $this->db->query("SELECT c.id_tmp_compra, c.f_ingreso, c.h_ingreso, c.estado, c.direccion, c.f_pago, c.t_despacho, u.nombre_1, u.apellido_1, u.rut, u.usuario, SUM(d.total) AS total 
    		FROM tmp_compra AS c 
    		LEFT JOIN usuarios AS u ON c.id_cliente = u.id_usuario 
    		INNER JOIN tmp_det_compra AS d ON c.id_tmp_compra = d.id_tmp_compra 
    		WHERE c.id_tmp_compra = '{$id_tmp_compra}'");
    	$result = $query->result();
        $orden = (array) $result[0];
        return $orden;
    }
    function direcciones($usuario){
    	$query = $this->db->query("SELECT u.direccion AS dir_personal, e.direccion AS dir_laboral FROM usuarios AS u
    		INNER JOIN empresa AS e ON u.id_empresa = e.id_empresa WHERE u.usuario = '{$usuario}'");
        $result = $query->result();
        $direcciones = (array) $result[0];
        return $direcciones;
    }
    function detalle_registro($id_tmp_compra){
    	$query = $this->db->query("SELECT p.cod_prod, p.producto, p.modelo, p.marca, d.prc_vta, d.mnd_vta, d.cantidad, d.total, d.id_tmp_detalle  
    		FROM tmp_det_compra AS d 
    		INNER JOIN tmp_compra AS c ON d.id_tmp_compra = c.id_tmp_compra 
    		LEFT JOIN usuarios AS u ON c.id_cliente = u.id_usuario 
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
}
?>