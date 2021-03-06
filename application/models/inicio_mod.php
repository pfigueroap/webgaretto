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
        $id_usuario = $this->db->insert_id();
        return $id_usuario;
    }
    function informacion($usuario){
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
    function empresa($e_name,$e_rut,$e_dir,$e_giro){
        $query = $this->db->query("SELECT * FROM empresa WHERE rut = '{$e_rut}'");
        if($query->num_rows > 0){
            $result = $query->result();
            $id_empresa = $result[0]->id_empresa;
        }else{
            $this->db->query("INSERT INTO empresa (empresa,direccion,rut,giro) 
                VALUES ('{$e_name}','{$e_dir}','{$e_rut}','{$e_giro}')");
            $id_empresa = $this->db->insert_id();
        }
        return $id_empresa;
    }
    function web(){
        $query = $this->db->query("SELECT * FROM page ORDER BY id_page DESC LIMIT 1");
        $result = $query->result();
        $datos = (array) $result[0];
        return $datos;
    }
    function productos(){
        $query = $this->db->query("SELECT id_producto, producto, prc_vta, imagen FROM producto WHERE estado = '0'");
        $productos = $query->result();
        return $productos;
    }
    function producto($id_producto){
        $query = $this->db->query("SELECT * FROM producto WHERE estado = '0' AND id_producto = '{$id_producto}'");
        $producto = $query->result();
        $producto = (array) $producto[0];
        return $producto;
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
    function valida_edit($rut,$correo,$id_usuario){
        $valida = 0;
        $query = $this->db->query("SELECT * FROM usuarios WHERE rut = '{$rut}' AND estado = '0' AND id_usuario != '{$id_usuario}'");
        if($query->num_rows > 0) $valida = 1;
        $query = $this->db->query("SELECT * FROM usuarios WHERE correo = '{$correo}' AND estado = '0' AND id_usuario != '{$id_usuario}'");
        if($query->num_rows > 0) $valida = 1;
        return $valida;
    }
    function webpay(){
        require_once(APPPATH.'libraries/libwebpay/webpay.php');
        require_once(APPPATH.'certificates/cert-normal.php');
        $config = new Configuration();
        $config->setEnvironment($certificate['environment']);
        $config->setCommerceCode($certificate['commerce_code']);
        $config->setPrivateKey($certificate['private_key']);
        $config->setPublicCert($certificate['public_cert']);
        $config->setWebpayCert($certificate['webpay_cert']);
        $webpay = new Webpay($config);
        return $webpay;
    }
    function registrar_compra($cabecera,$contenido){
        $this->db->query("INSERT INTO compra_web (".join(',',$cabecera).") VALUES (".join(',',$contenido).")");
        $id_compra = $this->db->insert_id();
        return $id_compra;
    }
    function pago($monto,$orden,$url_retorno,$url_final){
        $comercio = '597020000040';
        $request = array(
            "amount"    => $monto,
            "buyOrder"  => $orden,
            "sessionId" => $comercio,
            "urlReturn" => $url_retorno,
            "urlFinal"  => $url_final,
        );
        $webpay = $this->webpay();
        $result = $webpay->getNormalTransaction()->initTransaction($monto,$orden,$comercio, $url_retorno, $url_final);
        redirect($result->url.'?token_ws='.$result->token);
    }
    function retorno($token){
        $webpay = $this->webpay();
        $result = $webpay->getNormalTransaction()->getTransactionResult($token);
        $this->save_retorno($token,$result);
        redirect($result->urlRedirection.'?token_ws='.$token);
    }
    function save_retorno($token,$result){
        $accountingDate = $result->accountingDate;
        $buyOrder = $result->buyOrder;
        $cardNumber = $result->cardDetail->cardNumber;
        $cardExpirationDate = $result->cardDetail->cardExpirationDate;
        $authorizationCode = $result->detailOutput->authorizationCode;
        $paymentTypeCode = $result->detailOutput->paymentTypeCode;
        $responseCode = $result->detailOutput->responseCode;
        $sharesNumber = $result->detailOutput->sharesNumber;
        $amount = $result->detailOutput->amount;
        $commerceCode = $result->detailOutput->commerceCode;
        $responseDescription = $result->detailOutput->responseDescription;
        $sessionId = $result->sessionId;
        $transactionDate = $result->transactionDate;
        $urlRedirection = $result->urlRedirection;
        $VCI = $result->VCI;
        $this->db->query("INSERT INTO transbank (token,accountingDate,buyOrder,cardNumber,cardExpirationDate,authorizationCode,paymentTypeCode,responseCode,sharesNumber,amount,commerceCode,responseDescription,sessionId,transactionDate,urlRedirection,VCI) VALUES ('{$token}','{$accountingDate}','{$buyOrder}','{$cardNumber}','{$cardExpirationDate}','{$authorizationCode}','{$paymentTypeCode}','{$responseCode}','{$sharesNumber}','{$amount}','{$commerceCode}','{$responseDescription}','{$sessionId}','{$transactionDate}','{$urlRedirection}','{$VCI}')");
        $id_tbk = $this->db->insert_id();
        $this->db->query("UPDATE compra_web SET id_tbk = '{$id_tbk}' WHERE id_web = '{$buyOrder}'");
    }
    function comprobante($token){
        $query = $this->db->query("SELECT * FROM transbank AS tbk
            INNER JOIN compra_web AS web ON tbk.id_tbk = web.id_tbk 
            WHERE tbk.token = '{$token}'");
        $result = $query->result();
        $comprobante = (array) $result[0];
        return $comprobante;
    }
    function registros(){
        $query = $this->db->query("SELECT * FROM compra_web AS web 
            INNER JOIN producto AS prod ON web.id_producto = prod.id_producto 
            LEFT JOIN transbank AS tbk ON web.id_tbk = tbk.id_tbk 
            WHERE web.id_tbk > '0' AND tbk.responseCode = '0' 
            ORDER BY web.f_ingreso DESC, web.h_ingreso DESC ");
        $result = $query->result();
        $registros = (array) $result;
        return $registros;
    }
    function stock(){
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
    function conf_correo($correo,$usuario){
        $this->db->query("INSERT INTO configuracion (tipo,correo,fecha,hora,usuario) 
            VALUES ('valida','{$correo}',CURDATE(),CURTIME(),'{$usuario}')");
    }
    function conf_comprobante($nombre,$correo,$telefono,$usuario){
        $this->db->query("INSERT INTO configuracion (tipo,nombre,telefono,correo,fecha,hora,usuario) 
            VALUES ('comprobante','{$nombre}','{$telefono}','{$correo}',CURDATE(),CURTIME(),'{$usuario}')");
    }
    function correo_valida(){
        $query = $this->db->query("SELECT correo FROM configuracion WHERE tipo = 'valida' ORDER BY id_config DESC LIMIT 1");
        $result = $query->result();
        $correo = $result[0]->correo;
        return $correo;
    }
    function info_conf_comp(){
        $query = $this->db->query("SELECT nombre, telefono, correo FROM configuracion WHERE tipo = 'comprobante' ORDER BY id_config DESC LIMIT 1");
        $result = $query->result();
        $info = $result[0];
        return $info;
    }
    function correo_adm(){
        $query = $this->db->query("SELECT correo FROM usuarios WHERE tipo = '1' AND estado = '0'");
        $result = $query->result();
        return $result;
    }
}
?>