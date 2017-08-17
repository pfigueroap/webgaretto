<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

class Historial_con extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->library('mydompdf');
        $this->load->helper(array('form', 'url'));
        $this->load->model('historial_mod');
    }
    function valida(){
        $data['usuario'] = $this->session->userdata('usuario');
        $data['tipo'] = $this->session->userdata('tipo');
        if(empty($data['usuario'])){
            redirect('/inicio_con/index/', 'refresh');
        }else{
            $data['monedas'] = $this->historial_mod->variable('moneda');
            foreach ($data['monedas'] as $moneda)
                $data['arr_mnd'][$moneda->id_moneda] = $moneda->moneda;
            return $data;
        }
    }
    function index(){
        $data = $this->valida();
        if(!empty($data)){
            $data['registros'] = $this->historial_mod->registros($data['usuario']);
            $data['info'] = $this->historial_mod->usuario($data['usuario']);
            $data['page'] = 'home_historial';
            $this->load->view('home',$data);
        }
    }
    function detalle_registro(){
        $this->det_orden($this->uri->segment(3));
    }
    function det_orden($id_tmp_compra){
        $data = $this->valida();
        $data['orden'] = $this->historial_mod->orden($id_tmp_compra);
        $data['direcciones'] = $this->historial_mod->direcciones($data['orden']['usuario']);
        $data['info'] = $this->historial_mod->usuario($data['usuario']);
        $data['registros'] = $this->historial_mod->detalle_registro($id_tmp_compra);
        $data['clase'] = 'historial';
        $data['page'] = 'home_orden';
        $this->load->view('home',$data);
    }
    function eliminar_orden(){
        $id_tmp_compra = $this->uri->segment(3);
        $this->historial_mod->eliminar_orden($id_tmp_compra);
        $this->index();
    }
    function actualizar_orden(){
        $this->index();
    }
    function eliminar_det_orden(){
        $id_tmp_compra = $this->uri->segment(3);
        $id_tmp_detalle = $this->uri->segment(4);
        $this->historial_mod->eliminar_det_orden($id_tmp_detalle);
        $this->det_orden($id_tmp_compra);
    }
    function data_comprobante($id_tmp_compra){
        $data = $this->valida();
        $data['id_tmp_compra'] = $id_tmp_compra; 
        $data['validador'] = '0';
        $orden = $this->historial_mod->orden($id_tmp_compra);
        foreach ($orden as $key => $value)
            $data[$key] = $value;
        $data['clase'] = 'historial';
        $data['pago'] = $data['f_pago'];
        $data['despacho'] = $data['t_despacho'];
        $data['compras'] = $this->historial_mod->detalle_registro($id_tmp_compra);
        $data['page'] = 'home_comprobante';
        return $data;
    }
    function comprobante(){
        $id_tmp_compra = $this->uri->segment(3);
        $data = $this->data_comprobante($id_tmp_compra);
        $this->load->view('home',$data);
    }
    function down_comprobante(){
        $id_tmp_compra = $this->uri->segment(3);
        $data = $this->data_comprobante($id_tmp_compra);
        $html = $this->load->view('home_pdf',$data,true);
        $this->mydompdf->load_html($html);
        $this->mydompdf->render();
        $this->mydompdf->stream("comprobante.pdf", array("Attachment" => false));
    }
}
?>