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
    function insertar($cabecera,$contenido,$tabla){
        $this->db->query("INSERT INTO {$tabla} (".join(',',$cabecera).") VALUES (".join(',',$contenido).")");
    }
    function crear_prod($cabecera,$contenido){
    	$this->db->query("INSERT INTO producto (".join(',',$cabecera).") VALUES (".join(',',$contenido).")");
    }
    function editar_prod($id_producto,$contenido){
    	$this->db->query("UPDATE producto SET ".join(',',$contenido)." WHERE id_producto = '{$id_producto}' AND estado = '0'");
    }
    function productos(){
    	$query = $this->db->query("SELECT p.id_producto,p.cod_prod, p.producto, p.modelo, p.marca, p.cod_bar, p.prc_vta, p.mnd_vta, SUM(s.cantidad) AS cantidad 
            FROM producto AS p LEFT JOIN prod_stock AS s ON p.id_producto = s.id_producto WHERE p.estado = '0' GROUP BY p.id_producto");
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
    function stock($id_producto){
        $query = $this->db->query("SELECT * FROM prod_stock WHERE id_producto = '{$id_producto}'");
        $result = $query->result();
        $stock = (array) $result;
        return $stock;
    }
    function eliminar($id_producto){
    	$this->db->query("UPDATE producto SET estado = '1', f_modificacion = CURDATE() WHERE id_producto = '{$id_producto}'");
    }
    function eliminar_stock($id_prod_stock){
        $this->db->query("DELETE FROM prod_stock WHERE id_prod_stock = '{$id_prod_stock}'");
    }
    function stock_productos(){
        $query = $this->db->query("SELECT p.id_producto, IFNULL(SUM(s.cantidad),0) as cant_prod, 
            IFNULL((SELECT IFNULL(SUM(w.cantidad),0) FROM compra_web AS w LEFT JOIN transbank AS t ON w.id_tbk = t.id_tbk WHERE w.id_producto = p.id_producto AND t.responseCode = '0' GROUP BY w.id_producto),0) as cant_web, 
            IFNULL((SELECT IFNULL(SUM(d.cantidad),0) FROM tmp_det_compra AS d WHERE d.id_producto = p.id_producto AND d.valida = '1' GROUP BY d.id_producto),0) as cant_plat
            FROM producto AS p LEFT JOIN prod_stock AS s ON p.id_producto = s.id_producto 
            WHERE p.estado = '0' GROUP BY p.id_producto");
        $result = $query->result();$productos = (array) $result;
        $stock = array();
        foreach ($productos as $producto)
            $stock[$producto->id_producto] = $producto->cant_prod - $producto->cant_web - $producto->cant_plat;
        return $stock;
    }
}
?>