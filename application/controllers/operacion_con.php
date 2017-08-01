<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

class Operacion_con extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->model('operacion_mod');
    }
    function valida(){
        $data['usuario'] = $this->session->userdata('usuario');
        $data['tipo'] = $this->session->userdata('tipo');
        if(empty($data['usuario'])){
            redirect('/inicio_con/index/', 'refresh');
        }else{
            $data['monedas'] = $this->operacion_mod->variable('moneda');
            foreach ($data['monedas'] as $moneda)
                $data['arr_mnd'][$moneda->id_moneda] = $moneda->moneda;
            return $data;
        }
    }
    public function index(){
        $operacion = $this->uri->segment(3);
        $this->index_run($operacion);
    }
    function index_run($operacion){
        $data = $this->valida();
        if(!empty($data)){
            $data['productos'] = $this->operacion_mod->productos();
            $data['clientes'] = $this->operacion_mod->clientes();
            if($operacion == '1') $data['page'] = 'home_compras';
            elseif($operacion == '2') $data['page'] = 'home_ventas';
            elseif($operacion == '3') $data['page'] = 'home_arriendos';
            elseif($operacion == '4') $data['page'] = 'home_regalos';
            $this->load->view('home',$data);
        }
    }
    function formulario(){
        $usuario = $this->session->userdata('usuario');
        $productos = $this->operacion_mod->productos();
        $i = 0;$datos = array();
        foreach ($productos as $producto) {
            if($this->input->post("chk".$producto->id_producto) == 'on'){
                $cantidad = $this->input->post("cnt".$producto->id_producto);
                if($cantidad > 0){
                    $datos[$i]['id_producto'] = $producto->id_producto;
                    $datos[$i]['prc_vta'] = $producto->prc_vta;
                    $datos[$i]['mnd_vta'] = $producto->mnd_vta;
                    $datos[$i]['cantidad'] = $this->input->post("cnt".$producto->id_producto);
                    $datos[$i]['total'] = $this->input->post("tot".$producto->id_producto);
                    $datos[$i]['usuario'] = $usuario;
                    $datos[$i]['f_ingreso'] = date("Y-m-d");
                    $datos[$i]['h_ingreso'] = date("H:i:s"); 
                    $i++;
                }
            }
        }
        return $datos;
    }
    public function crear_compra(){
        $data = $this->valida();
        $compras = $this->formulario();
        if(count($compras) > 0){
            $id_usuario = $this->operacion_mod->id_usuario($data['usuario']);
            $this->operacion_mod->crear_registro($compras,'0',$id_usuario);
            $this->carro_compras();
        }else $this->index_run('1');
    }
    public function carro_compras(){
        $data = $this->valida();
        $data['compras'] = $this->operacion_mod->tmp_compras($data['usuario']);
        foreach ($data['compras'] as $compra)
            $data['total'] += $compra->total;
        $data['direcciones'] = $this->operacion_mod->direcciones($data['usuario']);
        $data['page'] = 'home_compras_resumen';
        $this->load->view('home',$data);
    }
    public function eliminar_detalle(){
        $id_tmp_detalle = $this->uri->segment(3);
        $usuario = $this->session->userdata('usuario');
        $this->operacion_mod->eliminar_detalle($id_tmp_detalle,$usuario);
        $this->carro_compras();
    }
    public function vaciar_carrito(){
        $usuario = $this->session->userdata('usuario');
        $this->operacion_mod->vaciar_carrito($usuario);
        $this->carro_compras();
    }
    public function comprar(){
        $data = $this->valida();
        $data['despacho'] = $this->input->post('t_desp');
        if($data['despacho'] == 'otro') $data['direccion'] = $this->input->post('dir');
        elseif($data['despacho'] == 'laboral' or $data['despacho'] == 'personal') $data['direccion'] = $this->operacion_mod->direccion($data['usuario'],$data['despacho']);
        elseif($data['despacho'] == 'retiro') $data['direccion'] = 'Nueva York 47, Santiago';
        $data['pago'] = $this->input->post('t_pago');
        $data['total'] = $this->input->post('total');
        if($data['total'] != '0'){
            $data['compras'] = $this->operacion_mod->tmp_compras($data['usuario']);
            $data['validador'] = '0';
            #Validar WebPay en caso de $pago = 'webpay'
            #$data['id_compra'] = '1';
            $data['id_compra'] = $this->operacion_mod->registrar_compra($data['usuario'],$data['pago'],$data['total'],$data['compras'],$data['despacho'],$data['direccion'],$data['validador']);
            $data['page'] = 'home_comprobante';
            $this->load->view('home',$data);
        }else{
            $this->carro_compras();
        }
    }
    public function ordenes(){
        $data = $this->valida();
        $data['registros'] = $this->operacion_mod->registros();
        $data['page'] = 'home_resumen';
        $this->load->view('home',$data);
    }
    public function detalle_registro(){
        $this->det_orden($this->uri->segment(3));
    }
    function det_orden($id_tmp_compra){
        $data = $this->valida();
        $data['orden'] = $this->operacion_mod->orden($id_tmp_compra);
        $data['direcciones'] = $this->operacion_mod->direcciones($data['orden']['usuario']);
        $data['registros'] = $this->operacion_mod->detalle_registro($id_tmp_compra);
        $data['page'] = 'home_orden';
        $this->load->view('home',$data);
    }
    public function eliminar_orden(){
        $id_tmp_compra = $this->uri->segment(3);
        $this->operacion_mod->eliminar_orden($id_tmp_compra);
        $this->ordenes();
    }
    public function eliminar_det_orden(){
        $id_tmp_compra = $this->uri->segment(3);
        $id_tmp_detalle = $this->uri->segment(4);
        $this->operacion_mod->eliminar_det_orden($id_tmp_detalle);
        $this->det_orden($id_tmp_compra);
    }
    public function actualizar_orden(){
        $id_tmp_compra = $this->uri->segment(3);
        $despacho = $this->input->post('t_desp');
        $pago = $this->input->post('t_pago');
        if($despacho == 'otro') $direccion = $this->input->post('dir');
        else $direccion = '';
        $this->operacion_mod->actualizar_orden($id_tmp_compra,$despacho,$direccion,$pago);
        $this->det_orden($id_tmp_compra);
    }
    public function crear_orden(){
        $tipo = $this->uri->segment(3);
        if($tipo == 'venta') $estado = '3';
        elseif($tipo == 'arriendo') $estado = '4';
        elseif($tipo == 'regalo') $estado = '5';
        $ventas = $this->formulario();
        if(count($ventas) > 0){
            $id_cliente = $this->input->post('id_cliente');
            $id_tmp_compra = $this->operacion_mod->crear_registro($ventas,$estado,$id_cliente);
            $this->det_orden($id_tmp_compra);
        }elseif($tipo == 'venta') $this->index_run('2');
        elseif($tipo == 'arriendo') $this->index_run('3');
        elseif($tipo == 'regalo') $this->index_run('4');
    }
    public function validar_orden(){
        $id_tmp_compra = $this->uri->segment(3);
        $this->operacion_mod->validar_orden($id_tmp_compra,'6');
        $this->activar_reloj($id_tmp_compra);
        $this->ordenes();
    }
    public function invalidar_orden(){
        $id_tmp_compra = $this->uri->segment(3);
        $this->operacion_mod->validar_orden($id_tmp_compra,'0');
        $this->ordenes();
    }
    function activar_reloj($id_tmp_compra){
        $url = "http://www.relojgaretto.cl/sensores/agregar";
        $info = $this->operacion_mod->info_compra($id_tmp_compra);
        $postData = array(
            "usuario" => $info['usuario'],
            "rut_usuario" => str_replace(array(".","-"),"",$info['rut']),
            "email_usuario" => $info['correo'], 
            "clave" => $info['clave'],
            "modelo" => "FGT45",
            "marca" => "ZKT",
            "cantidad" => "1");
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);
        $response = curl_exec ($handler);
        curl_close($handler);
        #return $response;
    }
}
?>