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
            $data['monedas'] = $this->producto_mod->variable('moneda');
            foreach ($data['monedas'] as $moneda)
                $data['arr_mnd'][$moneda->id_moneda] = $moneda->moneda;
            return $data;
        }
    }
    function index(){
        $data = $this->valida();
        if(!empty($data)){
            $data['productos'] = $this->producto_mod->productos();
            $data['clase'] = 'producto';
            $data['page'] = 'home_producto';
            $data['stock'] = $this->producto_mod->stock_productos();
            #var_dump($data);
            $this->load->view('home',$data);
        }
    }
    function mod_prod(){
        $clase = $this->uri->segment(3);
        $imagen = $this->cargar_imagen();
        $cabecera = array('cod_prod','producto','descripcion','cod_bar','prc_vta','modelo','marca');
        $contenido = array();
        if($clase == 'crear'){
            foreach ($cabecera as $post)
                array_push($contenido, "'".$this->input->post($post)."'");
            array_push($cabecera, 'usuario');
            array_push($contenido, "'".$this->session->userdata('usuario')."'");
            array_push($cabecera, 'f_creacion');
            array_push($contenido, "'".date("Y-m-d")."'");
            if($imagen != '') array_push($cabecera, "imagen");
            if($imagen != '') array_push($contenido, "'{$imagen}'");
            $this->producto_mod->crear_prod($cabecera,$contenido);
        }elseif($clase == 'editar'){
            $id_producto = $this->uri->segment(4);
            foreach ($cabecera as $post)
                array_push($contenido, $post." = '".$this->input->post($post)."'");
            array_push($contenido, "f_modificacion = '".date("Y-m-d")."'");
            if($imagen != '') array_push($contenido, "imagen = '{$imagen}'");
            $this->producto_mod->editar_prod($id_producto, $contenido);
        }
        $this->index();
    }
    function cargar_imagen(){
        $config['upload_path'] = 'application/images/productos/';
        $config['allowed_types'] = 'jpg';
        $config['max_size'] = 0;
        $this->upload->initialize($config);
        if ($this->upload->do_upload('imagen')) $datos = $this->upload->data();
        return $datos['file_name'];
    }
    function down_productos(){
        $info['productos'] = $this->producto_mod->productos();
        $this->load->view("excel/maestro_producto",$info);
    }
    function eliminar(){
        $tipo = $this->uri->segment(3);
        $id = $this->uri->segment(4);
        if($tipo == 'producto'){
            $this->producto_mod->eliminar($id);
            $this->index();
        }elseif($tipo == 'stock'){
            $this->producto_mod->eliminar_stock($id);
            $this->get_stock($id);
        }
    }
    function gest_prod(){
        $data = $this->valida();
        $data['clase'] = $this->uri->segment(3);
        if($data['clase'] == 'editar'){
            $id_producto = $this->uri->segment(4);
            $data['prod_edit'] = $this->producto_mod->producto($id_producto);
        }
        $data['page'] = 'home_gest_prod';
        $this->load->view('home',$data);
    }
    function gest_stock(){
        $this->get_stock($this->uri->segment(3));
    }
    function get_stock($id_producto){
        $data = $this->valida();
        $data['producto'] = $this->producto_mod->producto($id_producto);
        $data['stock'] = $this->producto_mod->stock($id_producto);
        $data['page'] = 'home_gest_stock';
        $this->load->view('home',$data);
    }
    function add_stock(){
        $data = $this->valida();
        $id_producto = $this->uri->segment(3);
        $cabecera = array('documento','proveedor','f_compra','cantidad','prc_compra','id_moneda');
        $contenido = array();
        foreach ($cabecera as $post) array_push($contenido, "'".$this->input->post($post)."'");
        array_push($cabecera,"id_producto");
        array_push($contenido,"'{$id_producto}'");
        array_push($cabecera,"usuario");
        array_push($contenido,"'".$data['usuario']."'");
        array_push($cabecera,"f_creacion");
        array_push($contenido,"'".date("Y-m-d")."'");
        $this->producto_mod->insertar($cabecera,$contenido,'prod_stock');
        $this->get_stock($id_producto);
    }
}
?>