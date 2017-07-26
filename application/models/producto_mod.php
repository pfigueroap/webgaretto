<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

class Producto_mod extends CI_Controller {
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
    function crear_prod($cabecera,$contenido){
    	$this->db->query("INSERT INTO producto (".join(',',$cabecera).") VALUES (".join(',',$contenido).")");
    }
    function editar_prod($id_producto,$contenido){
    	$this->db->query("UPDATE producto SET ".join(',',$contenido)." WHERE id_producto = '{$id_producto}' AND estado = '0'");
    }
    function productos(){
    	$query = $this->db->query("SELECT * FROM producto WHERE estado = '0'");
        $result = $query->result();
        $productos = (array) $result;
        return $productos;
    }
    function producto($id_producto){
    	$query = $this->db->query("SELECT * FROM producto WHERE estado = '0' AND id_producto = '{$id_producto}'");
        $result = $query->result();
        $producto = (array) $result[0];
        return $producto;
    }
    function eliminar($id_producto){
    	$this->db->query("UPDATE producto SET estado = '1', f_modificacion = CURDATE() WHERE id_producto = '{$id_producto}'");
    }
}
?>