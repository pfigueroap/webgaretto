<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

class Transbank extends CI_Controller {
    function __construct() {
        parent::__construct();
        #$this->load->library('webpay');
    }
    function pago($monto,$orden,$url_retorno,$url_final){
    	echo "Entro 2";
    	$comercio = '597020000040';
    	$request = array(
            "amount"    => $monto,
            "buyOrder"  => $orden,
            "sessionId" => $comercio,
            "urlReturn" => $url_retorno,
            "urlFinal"  => $url_final,
        );
        echo "<PRE>";
        var_dump($request);
        require_once('../libraries/libwebpay/webpay.php');
        #$config = $this->webpay->Configuration();
        $config = new Configuration();
        require_once(base_url('application/certificates/cert-normal.php'));
        var_dump($certificate);
        $config->setEnvironment($certificate['environment']);
		$config->setCommerceCode($certificate['commerce_code']);
		$config->setPrivateKey($certificate['private_key']);
		$config->setPublicCert($certificate['public_cert']);
		$config->setWebpayCert($certificate['webpay_cert']);
		var_dump($config);
        #$webpay = $this->webpay->Webpay($config);
        $webpay = new Webpay($config);
        $result = $webpay->getNormalTransaction()->initTransaction($monto,$orden,$comercio, $url_retorno, $url_final);
        var_dump($result);
    }
}
?>