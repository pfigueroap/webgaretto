<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

class Usuario_mod extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }
    function usuarios($tipo){
        $query = $this->db->query("SELECT * FROM usuarios AS u INNER JOIN empresa AS e ON u.id_empresa = e.id_empresa 
        INNER JOIN nacion AS n ON u.id_nacion = n.id_nacion WHERE tipo = '{$tipo}' AND estado = '0'");
        $result = $query->result();
        $usuarios = (array) $result;
        return $usuarios;
    }
    function last_id($tabla){
        $ids = array('usuarios' => 'id_usuario');
        $id = $ids[$tabla];
        $query = $this->db->query("SELECT MAX({$id}) FROM usuarios");
        $result = $query->result();
        $last_id = (array) $result[0];
        return $last_id["MAX({$id})"]+1;
    }
    function variable($tabla){
        $query = $this->db->query("SELECT * FROM ".$tabla);
        $result = $query->result();
        $variable = (array) $result;
        return $variable;
    }
    function add_user($info){
        $cabecera = array();$contenido = array();
        foreach ($info as $cab => $con) {
            array_push($cabecera, $cab);
            array_push($contenido, "'".$con."'");
        }
        $this->db->query("INSERT INTO usuarios (".join(',',$cabecera).") VALUES (".join(',',$contenido).")");
    }
    function edit_user($info,$id_usuario){
        $text = array();
        foreach ($info as $key => $value) 
            array_push($text, $key." = '".$value."'");
        $this->db->query("UPDATE usuarios SET ".join(',',$text)." WHERE id_usuario = '{$id_usuario}' AND estado = '0'");
    }
    function eliminar_user($id_usuario){
        $this->db->query("UPDATE usuarios SET estado = '1' WHERE id_usuario = '{$id_usuario}'");
    }
    function informacion($id_usuario){
        $query = $this->db->query("SELECT * FROM usuarios AS u INNER JOIN empresa AS e ON u.id_empresa = e.id_empresa 
        INNER JOIN nacion AS n ON u.id_nacion = n.id_nacion WHERE id_usuario = '{$id_usuario}' AND estado = '0'");
        $result = $query->result();
        $info = (array) $result[0];
        return $info;
    }
}
?>