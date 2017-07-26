<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

class Producto_con extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->model('producto_mod');
    }
    function valida(){
        $data['usuario'] = $this->session->userdata('usuario');
        $data['tipo'] = $this->session->userdata('tipo');
        if(empty($data['usuario'])){
            redirect('/inicio_con/index/', 'refresh');
        }else{
            return $data;
        }
    }
    public function index(){
        $data = $this->valida();
        if(!empty($data)){
            $data['monedas'] = $this->producto_mod->variable('moneda');
            foreach ($data['monedas'] as $moneda)
                $data['arr_mnd'][$moneda->id_moneda] = $moneda->moneda;
            $data['productos'] = $this->producto_mod->productos();
            $data['clase'] = 'producto';
            $data['page'] = 'home_producto';
            $this->load->view('home',$data);
        }
    }
    public function mod_prod(){
        $clase = $this->uri->segment(3);
        $cabecera = array('cod_prod','producto','descripcion','cod_bar','prc_vta','mnd_vta','prc_cpr','mnd_cpr','modelo','marca','f_compra','cantidad');
        $contenido = array();
        if($clase == 'producto'){
            foreach ($cabecera as $post)
                array_push($contenido, "'".$this->input->post($post)."'");
            array_push($cabecera, 'usuario');
            array_push($contenido, "'".$this->session->userdata('usuario')."'");
            array_push($cabecera, 'f_creacion');
            array_push($contenido, "'".date("Y-m-d")."'");
            $this->producto_mod->crear_prod($cabecera,$contenido);
        }elseif($clase == 'editar'){
            $id_producto = $this->uri->segment(4);
            foreach ($cabecera as $post)
                array_push($contenido, $post." = '".$this->input->post($post)."'");
            array_push($contenido, "f_modificacion = '".date("Y-m-d")."'");
            $this->producto_mod->editar_prod($id_producto, $contenido);
        }
        $this->index();
    }
    public function down_productos(){
        $info['productos'] = $this->producto_mod->productos();
        $this->load->view("excel/maestro_producto",$info);
    }
    public function eliminar(){
        $id_producto = $this->uri->segment(3);
        $this->producto_mod->eliminar($id_producto);
        $this->index();
    }
    public function editar(){
        $data = $this->valida();
        $id_producto = $this->uri->segment(3);
        $data['monedas'] = $this->producto_mod->variable('moneda');
        $data['productos'] = $this->producto_mod->productos();
        $data['prod_edit'] = $this->producto_mod->producto($id_producto);
        $data['clase'] = 'editar';
        $data['page'] = 'home_producto';
        $this->load->view('home',$data);
    }
}
?>