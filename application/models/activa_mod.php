<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

class Activa_mod extends CI_Controller {
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
    function registros(){
    	$query = $this->db->query("SELECT e.*, IFNULL(SUM(r.cantidad),0) as cnt, IFNULL(SUM(r.activo),0) as act FROM empresa as e 
            LEFT JOIN registro_reloj as r ON e.id_empresa = r.id_empresa 
            WHERE activa = '1' GROUP BY e.id_empresa");
    	$result = $query->result();
        $registros = (array) $result;
        return $registros;
    }
    function activa_id($id_empresa,$estado){
        $this->db->query("UPDATE empresa SET activa = '{$estado}' WHERE id_empresa = '{$id_empresa}'");
    }
    function activa_empresa($empresa,$rut,$direccion,$giro){
        $query = $this->db->query("SELECT * FROM empresa WHERE rut = '{$rut}' OR empresa = '{$empresa}'");
        if($query->num_rows == 0){
            $this->db->query("INSERT INTO empresa (empresa, rut, direccion, giro, activa) VALUES ('{$empresa}', '{$rut}', '{$direccion}', '{$giro}', '1')");
        }
    }
    function agregar_reloj($id_empresa,$id_compra,$tipo_orden,$usuario){
        $val = 0;
        #Comprobar que existe ID Compra
        if($tipo_orden == 'orden'){
            $query = $this->db->query("SELECT SUM(cantidad) AS cnt FROM tmp_det_compra WHERE id_compra = '{$id_compra}' AND valida = '1' AND id_producto = '1'");
        }elseif ($tipo_orden == 'web') {
            $query = $this->db->query("SELECT SUM(c.cantidad) AS cnt FROM compra_web AS c 
                LEFT JOIN transbank AS t ON c.id_tbk = t.id_tbk 
                WHERE c.id_web = '{$id_compra}' AND c.id_producto = '1' AND t.responseCode = '0'");
        }
        $result = $query->result();
        $cantidad = $result[0]->cnt;
        if($cantidad > 0){
            $val = 1;
            #Comprobar que ya no se encuentra asociada
            $query = $this->db->query("SELECT * FROM registro_reloj WHERE id_compra = '{$id_compra}' AND tipo_orden = '{$tipo_orden}'");
            if($query->num_rows == 0){
                $val = 2;
                $this->db->query("INSERT INTO registro_reloj (id_empresa, id_compra, tipo_orden, f_registro, h_registro, usuario, cantidad) VALUES ('{$id_empresa}', '{$id_compra}', '{$tipo_orden}', CURDATE(), CURTIME(), '{$usuario}', '{$cantidad}')");
            }
        }
        return $val;
    }
    function empresa($id_empresa){
        $query = $this->db->query("SELECT * FROM empresa WHERE id_empresa = '{$id_empresa}'");
        $result = $query->result();
        $empresa = (array) $result[0];
        return $empresa;
    }
    function reg_reloj($id_empresa){
        $query = $this->db->query("SELECT * FROM registro_reloj WHERE id_empresa = '{$id_empresa}'");
        $result = $query->result();
        $registros = (array) $result;
        return $registros;
    }
    function usuarios_empresa($id_empresa){
        $query = $this->db->query("SELECT * FROM usuarios WHERE id_empresa = '{$id_empresa}'");
        $result = $query->result();
        $usuarios = (array) $result;
        return $usuarios;   
    }
    function registra_user_ti($user_ti,$id_empresa){
        $this->db->query("UPDATE empresa SET user_ti = '{$user_ti}' WHERE id_empresa = '{$id_empresa}'");
    }
    function borrar_registro($id_empresa,$id_registro){
        $this->db->query("DELETE FROM registro_reloj WHERE id_empresa = '{$id_empresa}' AND id_registro = '{$id_registro}' AND activo = '0'");
    }
    function sincro_empresa($id_empresa){
        $registros = $this->reg_reloj($id_empresa);
        $response = [];
        foreach ($registros as $registro) {
            $resp = $this->sincro_registro($id_empresa,$registro->id_registro);
            array_push($response, $resp);
        }
        return $response;
    }
    function sincro_registro($id_empresa,$id_registro){
        $response = '-1';
        $query = $this->db->query("SELECT r.*, u.*, e.empresa, e.direccion AS e_dir, e.giro, e.rut AS e_rut 
            FROM registro_reloj AS r 
            INNER JOIN empresa AS e ON r.id_empresa = e.id_empresa 
            INNER JOIN usuarios AS u ON e.user_ti = u.usuario 
            WHERE r.id_empresa = '{$id_empresa}' AND r.id_registro = '{$id_registro}' AND r.activo = '0'");
        if($query->num_rows == 1){
            $result = $query->result();
            $info = (array) $result[0];
            $url = "http://www.relojgaretto.cl/sensores/agregar";
            $postData = array(
                "usuario" => $info['usuario'],
                "nombres" => $info['nombre_1']." ".$info['nombre_2'],
                "apellido1" => $info['apellido_1'],
                "apellido2" => $info['apellido_2'],
                "rut_usuario" => str_replace(array(".","-"),"",$info['rut']),
                "email_usuario" => $info['correo'], 
                "modelo" => 'ZKT0001',
                "marca" => 'ZKT',
                "rut_empresa" => str_replace(array(".","-"),"",$info['e_rut']),
                "direccion_empresa" => $info['e_dir'],
                "giro_empresa" => $info['giro'],
                "empresa" => $info['empresa'],
                "cantidad" => $info['cantidad']);
            $handler = curl_init();
            curl_setopt($handler, CURLOPT_URL, $url);
            curl_setopt($handler, CURLOPT_POST,true);
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);
            $response = curl_exec ($handler);
            curl_close($handler);
            if($response == '1'){
                $this->db->query("UPDATE registro_reloj SET activo = '{$info['cantidad']}' WHERE id_registro = '{$info['id_registro']}'");
            }
            //echo "<PRE>";
            //var_dump($info);
            //var_dump($postData);
            //var_dump($response);
        }
        return $response;
    }
}
?>