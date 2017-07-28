<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

class Inicio_mod extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }
    function valida_user($usuario,$clave){
        $query = $this->db->query("SELECT * FROM usuarios WHERE usuario = '{$usuario}' AND clave = SHA1('{$clave}') AND estado = '0'");
        if($query->num_rows == 1){
            $result = $query->result();
            $datos = (array) $result[0];
            $this->session->set_userdata('usuario', $usuario);
            $this->session->set_userdata('tipo', $datos['tipo']);
        }
        return $datos['tipo'];
    }
    function registra_user($usuario,$clave,$correo,$tipo){
        $this->db->query("INSERT INTO usuarios (usuario,clave,correo,tipo) VALUES ('{$usuario}',SHA1('{$clave}'),'{$correo}','{$tipo}')");
    }
    function informacion($usuario){
        #$query = $this->db->query("SELECT * FROM usuarios AS u INNER JOIN empresa AS e ON u.id_empresa = e.id_empresa INNER JOIN nacion AS n ON u.id_nacion = n.id_nacion WHERE usuario = '{$usuario}' AND estado = '0'");
        $query = $this->db->query("SELECT * FROM usuarios WHERE usuario = '{$usuario}' AND estado = '0'");
        $result = $query->result();
        $info = (array) $result[0];
        return $info;
    }
    function variable($tabla){
        $query = $this->db->query("SELECT * FROM ".$tabla);
        $result = $query->result();
        $variable = (array) $result;
        return $variable;
    }
    function edit_user($info,$user){
        $text = array();
        foreach ($info as $key => $value) 
            array_push($text, $key." = '".$value."'");
        $this->db->query("UPDATE usuarios SET ".join(',',$text)." WHERE usuario = '{$user}' AND estado = '0'");
    }
    function insert_tab($info,$tabla){
        $cabecera = array();
        $datos = array();
        foreach ($info as $cab => $dat) {
            array_push($cabecera, $cab);
            array_push($datos, "'".$dat."'");
        }
        $this->db->query("INSERT INTO ".$tabla." (".join(',',$cabecera).") VALUES (".join(',',$datos).")");
    }
    function web(){
        $query = $this->db->query("SELECT * FROM page ORDER BY id_page DESC LIMIT 1");
        $result = $query->result();
        $datos = (array) $result[0];
        return $datos;
    }
    function valida_pass($usuario,$clave){
        $query = $this->db->query("SELECT * FROM usuarios WHERE usuario = '{$usuario}' AND clave = SHA1('{$clave}') AND estado = '0'");
        $valida = 0;
        if($query->num_rows == 1){
            $result = $query->result();
            $datos = (array) $result[0];
            $valida = 1;
        }
        return $valida;
    }
    function edit_pass($usuario,$clave){
        $this->db->query("UPDATE usuarios SET clave = SHA1('{$clave}') WHERE usuario = '{$usuario}' AND estado = '0'");
        return 1;
    }
}
?>