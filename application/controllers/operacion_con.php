<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

class Operacion_con extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->library('mydompdf');
        $this->load->library('email');
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
    function index(){
        $operacion = $this->uri->segment(3);
        $this->index_run($operacion);
    }
    function index_run($operacion){
        $data = $this->valida();
        if(!empty($data)){
            $data['productos'] = $this->operacion_mod->productos();
            $data['stock'] = $this->operacion_mod->stock();
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
    function crear_compra(){
        $data = $this->valida();
        $compras = $this->formulario();
        if(count($compras) > 0){
            $id_usuario = $this->operacion_mod->id_usuario($data['usuario']);
            $this->operacion_mod->crear_registro($compras,'0',$id_usuario);
            $this->carro_compras();
        }else $this->index_run('1');
    }
    #Carro de Compras
    function carro_compras(){
        $data = $this->valida();
        $data['compras'] = $this->operacion_mod->tmp_compras($data['usuario'],'carro');
        foreach ($data['compras'] as $compra)
            $data['total'] += $compra->total;
        $data['info'] = $this->operacion_mod->info($data['usuario']);
        $data['page'] = 'home_compras_resumen';
        $this->load->view('home',$data);
    }
    function eliminar_detalle(){
        $id_tmp_detalle = $this->uri->segment(3);
        $usuario = $this->session->userdata('usuario');
        $this->operacion_mod->eliminar_detalle($id_tmp_detalle,$usuario);
        $this->carro_compras();
    }
    function vaciar_carrito(){
        $id_tmp_compra = $this->uri->segment(3);
        $usuario = $this->session->userdata('usuario');
        $this->operacion_mod->vaciar_carrito($usuario,$id_tmp_compra);
        $this->carro_compras();
    }
    function comprar(){
        $tipo = $this->uri->segment(3);
        $data = $this->valida();
        $info = $this->operacion_mod->info($data['usuario']);
        #Despacho
        $data['despacho'] = $this->input->post('t_desp');
        if($data['despacho'] == 'otro') $data['direccion'] = $this->input->post('dir');
        elseif($data['despacho'] == 'laboral') $data['direccion'] = $info['dir_laboral'];
        elseif($data['despacho'] == 'personal') $data['direccion'] = $info['dir_personal'];
        elseif($data['despacho'] == 'retiro') $data['direccion'] = 'Nueva York 47, Santiago';
        #Factura
        $data['factura'] = $this->input->post('t_fact');
        if($data['factura'] == 'otro'){
            $data['name_fact'] = $this->input->post('name_fact');
            $data['rut_fact'] = $this->input->post('rut_fact');
            $data['giro_fact'] = $this->input->post('giro_fact');
            $data['dir_fact'] = $this->input->post('dir_fact');
        }elseif($data['factura'] == 'empresa'){
            $data['name_fact'] = $info['empresa'];
            $data['rut_fact'] = $info['rut'];
            $data['giro_fact'] = $info['giro'];
            $data['dir_fact'] = $info['dir_laboral'];
        }elseif($data['factura'] == 'boleta'){
            $data['name_fact'] = '';$data['rut_fact'] = '';
            $data['giro_fact'] = '';$data['dir_fact'] = '';
        }
        #Pago
        $data['pago'] = $this->input->post('t_pago');
        $data['total'] = str_replace(".","",$this->input->post('total'));
        if($data['total'] != '0'){
            $data['compras'] = $this->operacion_mod->tmp_compras($data['usuario'],$tipo);
            $id_tmp_compra = $data['compras'][0]->id_tmp_compra;
            if($data['compras'][0]->id_compra != '0'){
                $data['id_compra'] = $data['compras'][0]->id_compra;
                $this->operacion_mod->actualizar_compra($data['id_compra'],$data['pago'],$data['total'],$data['compras'],$data['despacho'],$data['direccion'],$data['factura'],$data['name_fact'],$data['rut_fact'],$data['giro_fact'],$data['dir_fact'],$tipo);
            }else{
                $data['id_compra'] = $this->operacion_mod->registrar_compra($data['usuario'],$data['pago'],$data['total'],$data['compras'],$data['despacho'],$data['direccion'],$data['factura'],$data['name_fact'],$data['rut_fact'],$data['giro_fact'],$data['dir_fact'],$tipo);
            }
            if($data['pago'] == 'webpay'){
                $this->operacion_mod->pago($data['total'],$data['id_compra'],site_url("operacion_con/tbk_retorno/compra"),site_url("operacion_con/comprobante/".$id_tmp_compra));
            }elseif ($data['pago'] == 'transferencia') {
                $correos = $this->operacion_mod->correo_adm();
                $asunto = "Compra Productos de ".$data['usuario'];
                $mensaje = "Se ha adquirido un nuevo producto en el sistema, bajo el id: ".$data['id_compra'];
                foreach ($correos as $info)
                    $this->enviar_email('contacto@webgaretto.cl',$data['usuario'],$info->correo,$asunto,$mensaje);
                redirect('/operacion_con/tbk_final/'.$id_tmp_compra, 'refresh');
            }
        }else{
            $this->carro_compras();
        }
    }
    #Respuestas Transbank
    function tbk_retorno(){
        $clase = $this->uri->segment(3);
        $token = $this->input->post('token_ws');
        $this->operacion_mod->retorno($token,$clase);

    }
    function tbk_final(){
        $id_tmp_compra = $this->uri->segment(3);
        $data = $this->data_comprobante($id_tmp_compra);        
        if(!empty($this->input->post('token_ws'))){
            echo "entro";
            $correos = $this->operacion_mod->correo_adm();
            $asunto = "Compra Productos de ".$data['usuario'];
            $mensaje = "Se ha adquirido un nuevo producto en el sistema, bajo el id: ".$data['id_compra'];
            foreach ($correos as $info)
                $this->enviar_email('contacto@webgaretto.cl',$data['usuario'],$info->correo,$asunto,$mensaje);
        }
        $this->load->view('home',$data);
    }
    #Comprobante
    function data_comprobante($id_tmp_compra){
        $data['id_tmp_compra'] = $id_tmp_compra; 
        $orden = $this->operacion_mod->orden($id_tmp_compra);
        foreach ($orden as $key => $value)
            $data[$key] = $value;
        if($data['id_compra'] != '0')
            $data['orden_compra'] = $this->operacion_mod->orden_compra($data['id_compra']);
        $data['pago'] = $data['f_pago'];
        $data['despacho'] = $data['t_despacho'];
        $data['info_comp'] = $this->operacion_mod->info_conf_comp();
        $data['compras'] = $this->operacion_mod->detalle_registro($id_tmp_compra);
        $data['page'] = 'home_comprobante';
        return $data;
    }
    function comprobante(){
        $id_tmp_compra = $this->uri->segment(3);
        $data = $this->data_comprobante($id_tmp_compra);
        $data['usuario'] = $this->session->userdata('usuario');
        $data['tipo'] = $this->session->userdata('tipo');
        $data['monedas'] = $this->operacion_mod->variable('moneda');
        foreach ($data['monedas'] as $moneda)
            $data['arr_mnd'][$moneda->id_moneda] = $moneda->moneda;
        $data['clase'] = $this->uri->segment(4);
        $this->load->view('home',$data);
    }
    function down(){
        $id_tmp_compra = $this->uri->segment(3);
        $data = $this->data_comprobante($id_tmp_compra);
        $this->load->view('home_pdf',$data);
    }
    function down_comprobante(){
        $id_tmp_compra = $this->uri->segment(3);
        $data = $this->data_comprobante($id_tmp_compra);
        $html = $this->load->view('home_pdf',$data,true);
        $this->mydompdf->load_html($html);
        $this->mydompdf->render();
        $this->mydompdf->stream("comprobante.pdf", array("Attachment" => false));
    }
    #Ordenes
    function ordenes(){
        $data = $this->valida();
        $data['registros'] = $this->operacion_mod->registros();
        $data['page'] = 'home_resumen';
        $this->load->view('home',$data);
    }
    #Paga Historial
    function pagar_historial(){
        $id_tmp_compra = $this->uri->segment(3);
        $estado = $this->uri->segment(4);
        $this->det_orden($id_tmp_compra,'historial',$estado);
    }
    #Operaciones de ordenes e historial
    function det_orden($id_tmp_compra,$clase,$estado){
        $data = $this->valida();
        $data['estado'] = $estado;
        $data['orden'] = $this->operacion_mod->orden($id_tmp_compra);
        $data['info'] = $this->operacion_mod->info($data['orden']['user']);
        $data['registros'] = $this->operacion_mod->detalle_registro($id_tmp_compra);
        $data['page'] = 'home_orden';
        $data['clase'] = $clase;
        $this->load->view('home',$data);
    }
    function detalle_registro(){
        $this->det_orden($this->uri->segment(3),$this->uri->segment(4),'0');
    }
    function eliminar_orden(){
        $id_tmp_compra = $this->uri->segment(3);
        $clase = $this->uri->segment(4);
        $this->operacion_mod->eliminar_orden($id_tmp_compra);
        if($clase == 'ordenes') $this->ordenes();
        elseif($clase == 'historial') redirect('/historial_con/index/', 'refresh');
    }
    function eliminar_det_orden(){
        $clase = $this->uri->segment(3);
        $id_tmp_compra = $this->uri->segment(4);
        $id_tmp_detalle = $this->uri->segment(5);
        $this->operacion_mod->eliminar_det_orden($id_tmp_detalle);
        $this->det_orden($id_tmp_compra,$clase,'0');
    }
    function actualizar_orden(){
        $id_tmp_compra = $this->uri->segment(3);
        $clase = $this->uri->segment(4);
        $direccion = '';$name = '';$rut = '';
        $despacho = $this->input->post('t_desp');
        if($despacho == 'otro')
            $direccion = $this->input->post('dir');
        $factura = $this->input->post('t_fact');
        if($factura == 'otro'){
            $name = $this->input->post('name_fact');
            $rut = $this->input->post('rut_fact');
            $giro = $this->input->post('giro_fact');
            $dir_fact = $this->input->post('dir_fact');
        }
        $pago = $this->input->post('t_pago');
        $this->operacion_mod->actualizar_orden($id_tmp_compra,$despacho,$direccion,$pago,$factura,$name,$rut,$giro,$dir_fact);
        $this->det_orden($id_tmp_compra,$clase,'0');
    }
    #Crear orden
    function crear_orden(){
        $tipo = $this->uri->segment(3);
        $asunto = array(
            'venta' => 'Solicitud de compra',
            'regalo' => 'Regalo de Garetto');
        $mensaje = array(
            'venta' => 'Se ha generado en nuestro sistema Garetto una nueva solicitud de adquisición de productos, por favor valide la compra en el sistema, para enviar los productos solicitados.',
            'regalo' => 'Se ha generado en nuestro sistema Garetto un regalo para usted, para mayor información y pasos a seguir, por favor ingrese a nuestro sistema web.');
        if($tipo == 'venta') $estado = '3';
        elseif($tipo == 'regalo') $estado = '5';
        $ventas = $this->formulario();
        if(count($ventas) > 0){
            $id_cliente = $this->input->post('id_cliente');
            $id_tmp_compra = $this->operacion_mod->crear_registro($ventas,$estado,$id_cliente);
            $correo = $this->operacion_mod->correo($id_cliente);
            if($tipo == 'arriendo') $this->operacion_mod->registra_arriendo($id_cliente,$id_tmp_compra,$arriendo);
            $this->enviar_email('contacto@webgaretto.cl',"Equipo Garetto",$correo,$asunto[$tipo],$mensaje[$tipo]);
            $this->det_orden($id_tmp_compra,'ordenes','0');
        }elseif($tipo == 'venta') $this->index_run('2');
        elseif($tipo == 'regalo') $this->index_run('4');
    }
    #Crear orden arriendo
    function crear_arriendo(){
        $posts = array('f_inicio','per_gracia','cant_trab');
        foreach ($posts as $post)
            $arriendo[$post] = $this->input->post($post);
        if($arriendo['cant_trab'] <= 100) $factor = 0.03;
        elseif($arriendo['cant_trab'] > 100 and $arriendo['cant_trab'] <= 200) $factor = 0.026;
        elseif($arriendo['cant_trab'] > 200 and $arriendo['cant_trab'] <= 500) $factor = 0.023;
        elseif($arriendo['cant_trab'] > 500) $factor = 0.02;
        $arriendo['costo_mensual'] = $arriendo['cant_trab'] * $factor;
        $arriendo['id_moneda'] = '3';
        $productos = $this->formulario();
        if(count($productos) > 0){
            $id_cliente = $this->input->post('id_cliente');
            $id_tmp_compra = $this->operacion_mod->crear_registro($productos,'4',$id_cliente);
            $this->operacion_mod->registra_arriendo($id_cliente,$id_tmp_compra,$arriendo);
            $correo = $this->operacion_mod->correo($id_cliente);
            $asunto = 'Solicitud de arriendo';
            $mensaje = 'Se ha generado en nuestro sistema Garetto una nueva solicitud de arriendo de productos, por favor valide la compra en el sistema, para enviar los productos solicitados.';
            $this->enviar_email('contacto@webgaretto.cl',"Equipo Garetto",$correo,$asunto,$mensaje);
            $this->arriendos();
            #$this->det_orden($id_tmp_compra,'ordenes','0');
        }else $this->index_run('3');
    }
    function enviar_email($email_org,$nombre,$email_des,$asunto,$mensaje){
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from($email_org,$nombre);
        $this->email->to($email_des);
        $this->email->subject($asunto);
        $data['mensaje'] = $mensaje;
        $data['asunto'] = $asunto;
        $data['nombre'] = $nombre;
        #$this->load->view('email',$data);
        $this->email->message($this->load->view('email',$data,true));
        return $this->email->send();
    }
    #Validar Orden
    function genera_validacion(){
        $id_tmp_compra = $this->uri->segment(3);
        $valida = '2'; #Validación Financiera
        $clave = $this->operacion_mod->genera_validacion($id_tmp_compra,$valida);
        $correo = $this->operacion_mod->correo_valida();
        $asunto = 'Validación Transferencia orden nº'.$id_tmp_compra;
        $mensaje = 'Se ha solicitado validar una transferencia de la orden nº'.$id_tmp_compra.'. La información de la compra, como a su vez la validación la puede realizar en la siguiente dirección:<br><br>'.site_url("operacion_con/validar_orden/orden/{$id_tmp_compra}/{$clave}");
        $this->enviar_email('contacto@webgaretto.cl',"Equipo Garetto",$correo,$asunto,$mensaje);
        #echo "<PRE>";
        #echo $mensaje;
        $this->ordenes();
    }
    function validar_orden(){
        $tipo = $this->uri->segment(3);
        $id_tmp_compra = $this->uri->segment(4);
        $clave = $this->uri->segment(5);
        $validacion = $this->operacion_mod->valida_clave($id_tmp_compra,$clave);
        if($validacion == '1'){
            if($tipo == 'valida'){
                $this->operacion_mod->validar_orden($id_tmp_compra,$validacion);
                $respuesta = $this->operacion_mod->activar_reloj($id_tmp_compra);
            }
            $data = $this->data_comprobante($id_tmp_compra);
            $data['clave'] = $clave;
            $this->load->view('validacion',$data);
        }else redirect('/inicio_con/index/', 'refresh');
    }
    function activar_orden(){
        $id_tmp_compra = $this->uri->segment(3);
        $clave = $this->uri->segment(4);
        $validacion = $this->operacion_mod->valida_clave($id_tmp_compra,$clave);
        if($validacion == '1'){
            $data = $this->data_comprobante($id_tmp_compra);
            $data['clave'] = $clave;
            $this->load->view('validacion',$data);
        }else redirect('/inicio_con/index/', 'refresh');
    }
    #Arriendo
    function arriendos(){
        $data = $this->valida();
        $data['registros'] = $this->operacion_mod->arriendos($data['tipo'],$data['usuario']);
        $data['page'] = 'home_rent_client';
        $this->load->view('home',$data);
    }
    function detalle_arriendo(){
        $id_arriendo = $this->uri->segment(3);
        $data = $this->valida();
        $data['arriendo'] = $this->operacion_mod->detalle_arriendo($id_arriendo);
        $data['periodos'] = $this->operacion_mod->periodo_arriendo($data['arriendo']['f_inicio']);
        $data['page'] = 'home_detalle_arriendo';
        $this->load->view('home',$data);
    }
    function pago_arriendo(){
        $id_arriendo = $this->uri->segment(3);
        $id_cuota = $this->uri->segment(4);
        $pos = intval($id_cuota)-1;
        $arriendo = $this->operacion_mod->detalle_arriendo($id_arriendo);
        $periodos = $this->operacion_mod->periodo_arriendo($arriendo['f_inicio']);
        $total = $arriendo['costo_mensual']*$periodos[$pos]['prc_pago']*26500;
        $buy_order = 1000*$id_arriendo+$id_cuota;
        echo "<PRE>";
        var_dump($arriendo);
        $this->operacion_mod->reg_pago_arriendo($total,$buy_order,$arriendo['id_tmp_compra'],$id_arriendo,$periodos[$pos]);
        $this->operacion_mod->pago($total,$buy_order,site_url("operacion_con/tbk_retorno/arriendo"),site_url("operacion_con/comprobante_pago_cuota/".$buy_order));
    }
    function comprobante_pago_cuota(){
        $buy_order = $this->uri->segment(3);
        $data = $this->valida();
        $data['periodo'] = $this->operacion_mod->periodo_arr($buy_order);
        $data['arriendo'] = $this->operacion_mod->detalle_arriendo($data['periodo']['id_arriendo']);
        $data['page'] = 'home_det_arr_com';
        $this->load->view('home',$data);
    }
}
?>