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
    function crear_registro($registros,$estado,$id_cliente){
    	# $estado [compra temporal: 0], [transferencia por validar: 1], [webpay pagado: 2], [venta temporal: 3], [arriendo: 4], [regalo: 5]
        if($estado == '5') $valida = '1'; #Validación Regalo
        else $valida = '0';
    	$this->db->query("INSERT INTO tmp_compra (usuario,f_ingreso,h_ingreso,estado,id_cliente,valida) 
            VALUES ('{$registros[0]['usuario']}','{$registros[0]['f_ingreso']}','{$registros[0]['h_ingreso']}','{$estado}','{$id_cliente}','{$valida}')");
    	$id_tmp_compra = $this->db->insert_id();
    	foreach ($registros as $r) {
    		$this->db->query("INSERT INTO tmp_det_compra (id_tmp_compra,id_producto,prc_vta,mnd_vta,cantidad,total,usuario,f_ingreso,h_ingreso,estado,valida) 
    			VALUES ('{$id_tmp_compra}','{$r['id_producto']}','{$r['prc_vta']}','{$r['mnd_vta']}','{$r['cantidad']}','{$r['total']}','{$r['usuario']}','{$r['f_ingreso']}','{$r['h_ingreso']}','{$estado}','{$valida}')");
    	}
    	return $id_tmp_compra;
    }
    function tmp_compras($usuario,$tipo){
        if($tipo == 'carro'){
            $query = $this->db->query("SELECT p.cod_prod, p.producto, p.cod_bar, p.modelo, p.marca, t.id_tmp_compra, t.id_tmp_detalle, t.prc_vta, t.mnd_vta, t.cantidad, t.total, t.id_compra FROM tmp_det_compra AS t 
                INNER JOIN producto AS p ON t.id_producto = p.id_producto 
                WHERE t.estado = '0' AND t.usuario = '{$usuario}' AND t.estado = '0'");
        }else{
            $query = $this->db->query("SELECT p.cod_prod, p.producto, p.cod_bar, p.modelo, p.marca, t.id_tmp_compra, t.id_tmp_detalle, t.prc_vta, t.mnd_vta, t.cantidad, t.total, t.id_compra FROM tmp_det_compra AS t 
                INNER JOIN producto AS p ON t.id_producto = p.id_producto 
                WHERE t.id_tmp_compra = '{$tipo}'");
        } 
        $result = $query->result();
        $compras = (array) $result;
        return $compras;
    }
    function eliminar_detalle($id_tmp_detalle,$usuario){
    	$this->db->query("DELETE FROM tmp_det_compra WHERE id_tmp_detalle = '{$id_tmp_detalle}' AND usuario = '{$usuario}' AND estado = '0'");
    }
    function info($usuario){
    	$query = $this->db->query("SELECT u.direccion AS dir_personal, e.direccion AS dir_laboral, e.empresa, e.rut, e.giro FROM usuarios AS u
    		INNER JOIN empresa AS e ON u.id_empresa = e.id_empresa WHERE u.usuario = '{$usuario}'");
        $result = $query->result();
        $info = (array) $result[0];
        return $info;
    }
    function vaciar_carrito($usuario,$id_tmp_compra){
    	$this->db->query("DELETE FROM tmp_det_compra 
            WHERE usuario = '{$usuario}' AND id_tmp_compra = '{$id_tmp_compra}'");
        $this->db->query("DELETE FROM tmp_compra 
            WHERE usuario = '{$usuario}' AND id_tmp_compra = '{$id_tmp_compra}'");
    }
    function direccion($usuario,$despacho){
    	if($despacho == 'laboral') $query = $this->db->query("SELECT e.direccion FROM usuarios AS u INNER JOIN empresa AS e ON u.id_empresa = e.id_empresa WHERE u.usuario = '{$usuario}'");
    	elseif($despacho == 'personal') $query = $this->db->query("SELECT direccion FROM usuarios WHERE usuario = '{$usuario}'");
    	$direccion = $query->result()[0]->direccion;
    	return $direccion;
    }
    function clientes(){
    	$query = $this->db->query("SELECT * FROM usuarios WHERE tipo = '2'");
        $result = $query->result();
        $clientes = (array) $result;
        return $clientes;
    }
    function registros(){
    	$query = $this->db->query("SELECT c.id_tmp_compra, c.f_ingreso, c.h_ingreso, c.estado, c.valida, u.nombre_1, u.apellido_1, u.rut, SUM(d.total) AS total, s.factura, s.empresa, s.rut AS e_rut 
    		FROM tmp_compra AS c 
    		LEFT JOIN usuarios AS u ON c.id_cliente = u.id_usuario 
            LEFT JOIN compra AS s ON c.id_compra = s.id_compra 
    		INNER JOIN tmp_det_compra AS d ON c.id_tmp_compra = d.id_tmp_compra 
    		GROUP BY c.id_tmp_compra ORDER BY c.f_ingreso DESC, c.h_ingreso DESC");
    	$result = $query->result();
        $registros = (array) $result;
        return $registros;
    }
    function orden($id_tmp_compra){
    	$query = $this->db->query("SELECT c.id_tmp_compra, c.valida, c.f_ingreso, c.h_ingreso, c.estado, c.direccion, c.f_pago, c.t_despacho, c.id_compra, c.f_pago, c.t_factura, c.empresa, c.rut as e_rut, c.giro, c.dir_fact, u.nombre_1, u.apellido_1, u.rut, u.usuario AS user, SUM(d.total) AS total 
    		FROM tmp_compra AS c 
    		INNER JOIN usuarios AS u ON c.id_cliente = u.id_usuario 
    		INNER JOIN tmp_det_compra AS d ON c.id_tmp_compra = d.id_tmp_compra 
    		WHERE c.id_tmp_compra = '{$id_tmp_compra}'");
    	$result = $query->result();
        $orden = (array) $result[0];
        return $orden;
    }
    function orden_compra($id_compra){
        $query = $this->db->query("SELECT * FROM compra WHERE id_compra = '{$id_compra}'");
        $result = $query->result();
        $orden_compra = (array) $result[0];
        return $orden_compra;
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
    function actualizar_orden($id_tmp_compra,$despacho, $direccion,$pago,$factura,$name,$rut,$giro,$dir_fact){
    	$this->db->query("UPDATE tmp_compra SET t_despacho = '{$despacho}', direccion = '{$direccion}', f_pago = '{$pago}', t_factura = '{$factura}', empresa = '{$name}', rut = '{$rut}', giro = '{$giro}', dir_fact = '{$dir_fact}' WHERE id_tmp_compra = '{$id_tmp_compra}'");
    }
    function id_usuario($usuario){
        $query = $this->db->query("SELECT id_usuario FROM usuarios WHERE usuario = '{$usuario}'"); 
        $result = $query->result();
        $usuario = (array) $result[0];
        return $usuario["id_usuario"];
    }
    function genera_validacion($id_tmp_compra,$estado){
        $clave = $this->tmp_clave(30);
        $this->db->query("UPDATE tmp_compra SET clave = SHA1('{$clave}') WHERE id_tmp_compra = '{$id_tmp_compra}'");
        $this->validar_orden($id_tmp_compra,$estado);
        return $clave;
    }
    function valida_clave($id_tmp_compra,$clave){
        $query = $this->db->query("SELECT * FROM tmp_compra WHERE clave = SHA1('{$clave}') AND id_tmp_compra = '{$id_tmp_compra}'");
        if($query->num_rows == 1) return '1';
        else return '0';
    }
    function validar_orden($id_tmp_compra,$estado){
        $this->db->query("UPDATE tmp_det_compra SET valida = '{$estado}' WHERE id_tmp_compra = '{$id_tmp_compra}'");
        $this->db->query("UPDATE tmp_compra SET valida = '{$estado}' WHERE id_tmp_compra = '{$id_tmp_compra}'");
    }
    function correo_valida(){
        $query = $this->db->query("SELECT correo_validacion FROM correo_valida ORDER BY id_config DESC LIMIT 1");
        $result = $query->result();
        $correo = $result[0]->correo_validacion;
        return $correo;
    }
    function tmp_clave($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    function info_reloj($id_tmp_compra){
        $query = $this->db->query("SELECT u.usuario, u.rut, u.correo, u.nombre_1, u.nombre_2, u.apellido_1, u.apellido_2, p.marca, p.modelo, e.rut AS rut_empresa, e.direccion, e.giro, e.empresa, d.cantidad 
            FROM tmp_compra AS c 
            INNER JOIN usuarios AS u ON c.id_cliente = u.id_usuario 
            INNER JOIN empresa AS e ON u.id_empresa = e.id_empresa 
            INNER JOIN tmp_det_compra AS d ON c.id_tmp_compra = d.id_tmp_compra 
            INNER JOIN producto AS p ON d.id_producto = p.id_producto 
            WHERE c.id_tmp_compra = '{$id_tmp_compra}' AND d.id_producto = '1'");
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
        $validador = $responseCode+1; #Validación de Compra
        $this->db->query("UPDATE compra SET id_tbk = '{$id_tbk}', validador = '{$validador}' 
            WHERE id_compra = '{$buyOrder}'");
        if($validador == '1'){
            $this->db->query("UPDATE tmp_det_compra SET estado = '2', valida = '1' 
                WHERE id_compra = '{$buyOrder}'");
            $this->db->query("UPDATE tmp_compra SET estado = '2', valida = '1' 
                WHERE id_compra = '{$buyOrder}'");
            $id_tmp_compra = $this->id_tmp_compra($result->buyOrder);
            $this->activar_reloj($id_tmp_compra);
        }
    }
    function id_tmp_compra($id_compra){
        $query = $this->db->query("SELECT * FROM tmp_compra WHERE id_compra = '{$id_compra}'");
        $result = $query->result();
        return $result[0]->id_tmp_compra;
    }
    function comprobante($token){
        $query = $this->db->query("SELECT * FROM transbank AS tbk
            INNER JOIN compra AS web ON tbk.id_tbk = web.id_tbk 
            WHERE tbk.token = '{$token}'");
        $result = $query->result();
        $comprobante = (array) $result[0];
        return $comprobante;
    }
    function actualiza_tmp_compra($id_compra,$pago,$compras,$despacho,$direccion,$tipo){
        foreach ($compras as $compra){
            $id_tmp_compra = $compra->id_tmp_compra;
            $this->db->query("UPDATE tmp_det_compra SET id_compra = '{$id_compra}' 
                WHERE id_tmp_detalle = '{$compra->id_tmp_detalle}'");
        }
        $this->db->query("UPDATE tmp_compra SET direccion = '{$direccion}', f_pago = '{$pago}', t_despacho = '{$despacho}', id_compra = '{$id_compra}' 
            WHERE id_tmp_compra = '{$id_tmp_compra}'");
        if($pago == 'transferencia'){ #Transferencia por validar
            $this->db->query("UPDATE tmp_det_compra SET estado = '1' WHERE id_compra = '{$id_compra}'");
            $this->db->query("UPDATE tmp_compra SET estado = '1' WHERE id_compra = '{$id_compra}'");
        }
    }
    function registrar_compra($usuario,$pago,$total,$compras,$despacho,$direccion,$factura,$empresa,$rut,$giro,$dir_fact,$tipo){
        $this->db->query("INSERT INTO compra 
            (tipo_pago,usuario,f_compra,h_compra,despacho,direccion,factura,empresa,rut,giro,dir_fact,total) VALUES 
            ('{$pago}','{$usuario}',CURDATE(),CURTIME(),'{$despacho}','{$direccion}','{$factura}','{$empresa}','{$rut}','{$giro}','{$dir_fact}','{$total}')");
        $id_compra = $this->db->insert_id();
        $this->actualiza_tmp_compra($id_compra,$pago,$compras,$despacho,$direccion,$tipo);
        return $id_compra;
    }
    function actualizar_compra($id_compra,$pago,$total,$compras,$despacho,$direccion,$factura,$empresa,$rut,$giro,$dir_fact,$tipo){
        $this->db->query("UPDATE compra SET tipo_pago = '{$pago}', despacho = '{$despacho}', direccion = '{$direccion}', factura = '{$factura}', empresa = '{$empresa}', rut = '{$rut}', giro = '{$giro}', dir_fact = '{$dir_fact}', total = '{$total}' 
            WHERE id_compra = '{$id_compra}'");        
        $this->actualiza_tmp_compra($id_compra,$pago,$compras,$despacho,$direccion,$tipo);
    }
    function registra_arriendo($id_cliente,$id_tmp_compra,$arriendo){
        $usuario = $this->session->userdata('usuario');
        $this->db->query("INSERT INTO arriendo (f_inicio, per_gracia, costo_mensual, id_moneda, id_cliente, id_tmp_compra, usuario, f_creacion, h_creacion) 
            VALUES ('{$arriendo['f_inicio']}', '{$arriendo['per_gracia']}', '{$arriendo['costo_mensual']}', '{$arriendo['id_moneda']}', '{$id_cliente}', '{$id_tmp_compra}', '{$usuario}', CURDATE(), CURTIME())");
    }
    function arriendos(){
        $query = $this->db->query("SELECT a.*, u.nombre_1, u.apellido_1, u.rut FROM arriendo AS a 
            INNER JOIN usuarios AS u ON a.id_cliente = u.id_usuario 
            ORDER BY a.f_creacion DESC, a.h_creacion DESC");
        $result = $query->result();
        $arriendos = (array) $result;
        return $arriendos;
    }
    function activar_reloj($id_tmp_compra){
        $url = "http://www.relojgaretto.cl/sensores/agregar";
        $info = $this->info_reloj($id_tmp_compra);
        if(count($info) != 0){
            #echo "<PRE>";
            $postData = array(
                "usuario" => $info['usuario'],
                "nombres" => $info['nombre_1']." ".$info['nombre_2'],
                "apellido1" => $info['apellido_1'],
                "apellido2" => $info['apellido_2'],
                "rut_usuario" => str_replace(array(".","-"),"",$info['rut']),
                "email_usuario" => $info['correo'], 
                "modelo" => $info['modelo'],
                "marca" => $info['marca'],
                "rut_empresa" => str_replace(array(".","-"),"",$info['rut_empresa']),
                "direccion_empresa" => $info['direccion'],
                "giro_empresa" => $info['giro'],
                "empresa" => $info['empresa'],
                "cantidad" => $info['cantidad']);
            #var_dump($postData);
            $handler = curl_init();
            curl_setopt($handler, CURLOPT_URL, $url);
            curl_setopt($handler, CURLOPT_POST,true);
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);
            $response = curl_exec ($handler);
            #echo "Respuesta:";
            #var_dump($response);
            curl_close($handler);
            return $response;
        }else return '0';
    }
}
?>