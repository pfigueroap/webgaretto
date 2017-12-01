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
    function index($mensaje = ''){
        $data = $this->valida();
        $data['mensaje'] = $mensaje;
        $data['registros'] = $this->activa_mod->registros();
        $data['page'] = 'home_activa';
        $this->load->view('home',$data);
    }
    function menu_empresas($mensaje = ''){
        $data = $this->valida();
        $data['mensaje'] = $mensaje;
        $data['clase'] = $this->uri->segment(3);
        if($data['clase'] == 'editar')
            $data['info_empresa'] = $this->activa_mod->empresa($this->uri->segment(4));
        $data['page'] = 'home_gest_empresas';
        $this->load->view('home',$data);        
    }
    function add_empresa(){
        $clase = $this->uri->segment(3);
        if($clase == 'editar')
            $id_empresa = $this->uri->segment(4);
        $cabecera = array('empresa','nombre_corto','direccion','rut','giro','nom_representante','rut_representante');
        $contenido = array();
        foreach ($cabecera as $post){
            if($clase == 'editar')
                array_push($contenido, $post."='".$this->input->post($post)."'");
            else
                array_push($contenido, "'".$this->input->post($post)."'");
        }
        if($clase == 'editar')
            $this->activa_mod->edit_empresa($id_empresa,$contenido);
        else
            $this->activa_mod->add_registro('empresa',$cabecera,$contenido);
        redirect('/activa_con/menu_empresas/', 'refresh');
    }
    function activa_empresa(){
        $id_empresa = $this->input->post('s_empresa');
        $empresa = $this->activa_mod->empresa($id_empresa);
        $mensaje = $this->activa_mod->activa_empresa($empresa);
        if($mensaje == 'OK'){
            $mensaje = "Empresa activada exitosamente";
            $this->activa_mod->activa_id($id_empresa,'1');
            $this->index($mensaje);
        }else{
            $this->menu_empresas($mensaje);
        }
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
    function view_reg_ti($id_empresa,$mensaje){
        $data = $this->valida();
        $data['mensaje'] = $mensaje;
        $data['id_empresa'] = $id_empresa;
        $data['empresa'] = $this->activa_mod->empresa($id_empresa);
        $data['usuarios'] = $this->activa_mod->usuarios_empresa($data['empresa']['nombre_corto']);
        $data['page'] = 'home_registro_userti';
        $this->load->view('home',$data);
    }
    function registro_ti(){
        $this->view_reg_ti($this->uri->segment(3),'');
    }
    function crear_ti(){
        $id_empresa = $this->uri->segment(3);
        $user_ti = $this->input->post('user_ti');
        $rut_ti = $this->input->post('rut_ti');
        $correo_ti = $this->input->post('correo_ti');
        $empresa = $this->activa_mod->empresa($id_empresa);
        $resp = $this->activa_mod->crear_ti($empresa['nombre_corto'],$user_ti,$rut_ti,$correo_ti);
        $this->index($resp);
    }
    function add_user_ti(){
        $id_empresa = $this->uri->segment(3);
        $user_ti = $this->input->post('user_ti');
        $post = split('@',$user_ti)[0];
        $id_ti = $this->input->post($post);
        $empresa = $this->activa_mod->empresa($id_empresa);
        $resp = $this->activa_mod->registra_user_ti($user_ti,$id_empresa,$empresa['nombre_corto'],$id_ti);
        $this->index($resp);
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