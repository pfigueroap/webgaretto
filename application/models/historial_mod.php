<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

class Historial_mod extends CI_Controller {
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
    function registros($usuario){
    	$query = $this->db->query("SELECT c.id_tmp_compra, c.f_ingreso, c.h_ingreso, c.estado, c.valida, u.nombre_1, u.apellido_1, u.rut, SUM(d.total) AS total 
    		FROM tmp_compra AS c 
    		LEFT JOIN usuarios AS u ON c.id_cliente = u.id_usuario 
    		INNER JOIN tmp_det_compra AS d ON c.id_tmp_compra = d.id_tmp_compra 
    		WHERE u.usuario = '{$usuario}' GROUP BY c.id_tmp_compra ORDER BY c.f_ingreso DESC, c.h_ingreso DESC");
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
}
?>