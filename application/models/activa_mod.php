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
    function add_registro($tabla,$cabecera,$contenido){
        $this->db->query("INSERT INTO ".$tabla." (".join(',',$cabecera).") VALUES (".join(',',$contenido).")");
    }
    function edit_empresa($id_empresa,$contenido){
        $this->db->query("UPDATE empresa SET ".join(', ',$contenido)." WHERE id_empresa = '{$id_empresa}'");
    }
    function activa_empresa($empresa){
        $url = 'http://www.relojgaretto.cl/pv/crearEmpresa';
        $postData = array(
                "rut_representante" => $empresa['rut_representante'],
                "nombre_representante" => $empresa['nom_representante'],
                "rut" => $empresa['rut'],
                "direccion" => $empresa['direccion'],
                "giro" => $empresa['giro'],
                "nombre" => $empresa['empresa'],
                "nombre_corto" => $empresa['nombre_corto']
            );
        $response = $this->curl_post($url,$postData);
        return $response;
    }
    function agregar_reloj($id_empresa,$id_compra,$tipo_orden,$usuario){
        $val = 0;
        #Comprobar que existe ID Compra
        if($tipo_orden == 'orden'){
            $query = $this->db->query("SELECT SUM(cantidad) AS cnt FROM tmp_det_compra WHERE id_compra = '{$id_compra}' AND valida = '1' AND id_producto < '7' AND estado > '0' AND estado < '3'");
        }elseif ($tipo_orden == 'web') {
            $query = $this->db->query("SELECT SUM(c.cantidad) AS cnt FROM compra_web AS c 
                LEFT JOIN transbank AS t ON c.id_tbk = t.id_tbk 
                WHERE c.id_web = '{$id_compra}' AND c.id_producto < '7' AND t.responseCode = '0'");
        }elseif ($tipo_orden == 'arriendo') {
            $query = $this->db->query("SELECT SUM(t.cantidad) AS cnt, a.cant_trab 
                FROM tmp_det_compra AS t 
                INNER JOIN arriendo AS a ON t.id_tmp_compra = a.id_tmp_compra 
                WHERE a.id_arriendo = '{$id_compra}' AND t.valida = '1' AND t.estado = '4' AND t.id_producto < '7'");
        }elseif ($tipo_orden == 'regalo') {
            $query = $this->db->query("SELECT SUM(cantidad) AS cnt FROM tmp_det_compra WHERE id_tmp_compra = '{$id_compra}' AND valida = '1' AND id_producto < '7' AND estado = '5'");
        }
        $result = $query->result();
        $cantidad = $result[0]->cnt;
        $fin = new DateTime(date("Y-m-d"));
        $fin->add(new DateInterval('P1Y'));
        $f_caducidad = $fin->format('Y-m-d');
        if($tipo_orden == 'arriendo') $cant_trab = $result[0]->cant_trab;
        else $cant_trab = $cantidad*100;
        if($cantidad > 0){
            $val = 1;
            #Comprobar que ya no se encuentra asociada
            $query = $this->db->query("SELECT * FROM registro_reloj WHERE id_compra = '{$id_compra}' AND tipo_orden = '{$tipo_orden}'");
            if($query->num_rows == 0){
                $val = 2;
                $this->db->query("INSERT INTO registro_reloj (id_empresa, id_compra, tipo_orden, f_registro, h_registro, f_caducidad, cant_trabajadores, usuario, cantidad) VALUES ('{$id_empresa}', '{$id_compra}', '{$tipo_orden}', CURDATE(), CURTIME(), '{$f_caducidad}', '{$cant_trab}', '{$usuario}', '{$cantidad}')");
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
    function usuarios_empresa($nombre_corto){
        $url = 'http://www.relojgaretto.cl/pv/listaUsuarios/'.$nombre_corto;
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
        $headers = array(
            'gtoken: EN128S7NvEmRoHiSOaypRQ.VKYw5ad3cEKV8_P6V54QmQ.14RebQ_3f06a67qKQMM4Qw.iQPYtlq6VE2uAhAtiBOTaQ.W2XhStOz4ku8XmCbxt27oQ');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);
        $usuarios = json_decode($response,true);
        return $usuarios;
    }
    function registra_user_ti($user_ti,$id_empresa,$nombre_corto,$id_ti){
        $url = 'http://www.relojgaretto.cl/pv/selTI/'.$nombre_corto.'/'.$id_ti;
        $postData = array();
        $response = $this->curl_post($url,$postData);
        if($response == 'OK') 
            $this->db->query("UPDATE empresa SET user_ti = '{$user_ti}' 
                WHERE id_empresa = '{$id_empresa}'");
        else 
            $this->db->query("UPDATE empresa SET user_ti = '{$respose}' 
                WHERE id_empresa = '{$id_empresa}'");
        return $response;
    }
    function crear_ti($nombre_corto,$user_ti,$rut_ti,$correo_ti){
        $url = 'http://www.relojgaretto.cl/pv/crearTI/'.$nombre_corto;
        $postData = array(
                "nombre_usuario" => $user_ti,
                "rut" => str_replace(array("."),"",$rut_ti),
                "correo" => $correo_ti);
        $response = $this->curl_post($url,$postData);
        return $response;
    }
    function curl_post($url,$postData){
        $ch = curl_init();
        $headers = array(
            'gtoken: EN128S7NvEmRoHiSOaypRQ.VKYw5ad3cEKV8_P6V54QmQ.14RebQ_3f06a67qKQMM4Qw.iQPYtlq6VE2uAhAtiBOTaQ.W2XhStOz4ku8XmCbxt27oQ');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $response = curl_exec ($ch);
        curl_close($ch);
        return $response;
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