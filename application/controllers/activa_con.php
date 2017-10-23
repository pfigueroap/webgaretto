<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

class Activa_con extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->model('activa_mod');
    }
    function valida(){
        $data['usuario'] = $this->session->userdata('usuario');
        $data['tipo'] = $this->session->userdata('tipo');
        if(empty($data['usuario'])){
            redirect('/inicio_con/index/', 'refresh');
        }else{
            $data['monedas'] = $this->activa_mod->variable('moneda');
            foreach ($data['monedas'] as $moneda)
                $data['arr_mnd'][$moneda->id_moneda] = $moneda->moneda;
            $data['empresas'] = $this->activa_mod->variable('empresa');
            return $data;
        }
    }
    function index(){
        $data = $this->valida();
        $data['registros'] = $this->activa_mod->registros();
        $data['page'] = 'home_activa';
        $this->load->view('home',$data);
    }
    function add_empresa(){
        $data = $this->valida();
        $seleccion = $this->input->post('s_empresa');
        if($seleccion == 'existe'){
            $id_empresa = $this->input->post('id_empresa');
            $this->activa_mod->activa_id($id_empresa,'1');
        }elseif ($seleccion == 'nueva') {
            $empresa = $this->input->post('e_name');
            $rut = $this->input->post('e_rut');
            $direccion = $this->input->post('e_dir');
            $giro = $this->input->post('e_giro');
            $this->activa_mod->activa_empresa($empresa,$rut,$direccion,$giro);
        }
        $this->index();
    }
    function add_reloj(){
        $data = $this->valida();
        $id_empresa = $this->input->post('add_reloj');
        $id_compra = $this->input->post('id_compra');
        $tipo_orden = $this->input->post('tipo_orden');
        $data['valida'] = $this->activa_mod->agregar_reloj($id_empresa,$id_compra,$tipo_orden,$data['usuario']);
        $this->index();
    }
    function registro_empresa($id_empresa){
        $data = $this->valida();
        $data['empresa'] = $this->activa_mod->empresa($id_empresa);
        $data['registros'] = $this->activa_mod->reg_reloj($id_empresa);
        $data['page'] = 'home_registro_actividad';
        $this->load->view('home',$data);
    }
    function registro(){
        $this->registro_empresa($this->uri->segment(3));
    }
    function view_reg_ti($id_empresa){
        $data = $this->valida();
        $data['id_empresa'] = $id_empresa;
        $data['usuarios'] = $this->activa_mod->usuarios_empresa($data['id_empresa']);
        $data['empresa'] = $this->activa_mod->empresa($id_empresa);
        $data['page'] = 'home_registro_userti';
        $this->load->view('home',$data);
    }
    function registro_ti(){
        $this->view_reg_ti($this->uri->segment(3));
    }
    function add_user_ti(){
        $data = $this->valida();
        $id_empresa = $this->uri->segment(3);
        $user_ti = $this->input->post('user_ti');
        $this->activa_mod->registra_user_ti($user_ti,$id_empresa);
        $this->view_reg_ti($id_empresa);
    }
    function desactiva_empresa(){
        $data = $this->valida();
        $id_empresa = $this->uri->segment(3);
        $this->activa_mod->activa_id($id_empresa,'0');
        $this->index();
    }
    function sincro_empresa(){
        $data = $this->valida();
        $id_empresa = $this->uri->segment(3);
        $response = $this->activa_mod->sincro_empresa($id_empresa);
        $this->index();
    }
    function borrar_registro(){
        $data = $this->valida();
        $id_empresa = $this->uri->segment(3);
        $id_registro = $this->uri->segment(4);
        $this->activa_mod->borrar_registro($id_empresa,$id_registro);
        $this->registro_empresa($id_empresa);
    }
    function sincro_registro(){
        $data = $this->valida();
        $id_empresa = $this->uri->segment(3);
        $id_registro = $this->uri->segment(4);
        $response = $this->activa_mod->sincro_registro($id_empresa,$id_registro);
        $this->registro_empresa($id_empresa);
    }
}
?>