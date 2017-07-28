<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

class Inicio_con extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->library('email');
        $this->load->helper(array('form', 'url'));
        $this->load->model('inicio_mod');
    }
    function valida(){
        $data['usuario'] = $this->session->userdata('usuario');
        $data['tipo'] = $this->session->userdata('tipo');
        if(empty($data['usuario'])){
            $this->page();
        }else{
            return $data;
        }
    }
    public function index(){
        $data = $this->valida();
        if(!empty($data)){
            $data['page'] = 'home_cont';
            $this->load->view('home',$data);
        }
    }
    public function page(){
        $data = $this->inicio_mod->web();
        $data['usuario'] = $this->session->userdata('usuario');
        $data['tipo'] = $this->session->userdata('tipo');
        $this->load->view('page',$data);
    }
    public function web(){
        $data = $this->inicio_mod->web();
        $this->load->view('page_edit',$data);
    }
    public function contacto(){
        $form = array('nombre','email','asunto','mensaje');
        foreach ($form as $post)
            $info[$post] = $this->input->post($post);
        $info['user'] = $this->session->userdata('usuario');
        $info['fecha'] = date("Y-m-d");
        $info['hora'] = date("H:i:s");
        $data = $this->inicio_mod->web();
        $info['email_des'] = $data['sec4_email'];
        $info['estado'] = $this->enviar_email($info['email'],$info['nombre'],$info['email_des'],$info['asunto'],$info['mensaje']);
        $this->inicio_mod->insert_tab($info,'contacto');
        $this->page();
    }
    function enviar_email($email_org,$nombre,$email_des,$asunto,$mensaje){
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from($email_org,$nombre);
        $this->email->to($email_des);
        $this->email->subject($asunto);
        $data['mensaje'] = $mensaje;
        $this->email->message($this->load->view('email',$data,true));
        $this->email->send();
    }
    public function edit_web(){
        $data = $this->valida();
        $form = array('titulo','valor','rotar','sec1_tit','sec1_desc','sec1_stit','sec1_det','sec2_tit','sec2_desc','sec2_1_tit',
            'sec2_1_desc','sec2_2_tit','sec2_2_desc','sec2_3_tit','sec2_3_desc','sec3_tit','sec3_desc','sec4_tit','sec4_desc',
            'sec4_direc','sec4_comuna','sec4_email','sec4_tel');
        foreach ($form as $post)
            $info[$post] = $this->input->post($post);
        $info['user'] = $data['usuario'];
        $info['fecha'] = date("Y-m-d");
        $info['hora'] = date("H:i:s"); 
        $this->inicio_mod->insert_tab($info,'page');
        $this->web();
    }
    public function ingreso(){
        $data['usuario'] = $this->session->userdata('usuario');
        $data['tipo'] = $this->session->userdata('tipo');
        if(empty($data['usuario'])){
            $this->load->view('login');
        }else{
            $data['page'] = 'home_cont';
            $this->load->view('home',$data);
        }
    }
    public function login(){
        $data['usuario'] = $this->input->post('username');
        $clave = $this->input->post('password');
        $data['tipo'] = $this->inicio_mod->valida_user($data['usuario'],$clave);
        if(in_array($data['tipo'], array('1','2'))){
            $data['page'] = 'home_cont';
            $this->load->view('home',$data);
        }else $this->load->view('login');
    }
    public function registro(){
        $usuario = $this->input->post('username');
        $clave = $this->input->post('password');
        $correo = $this->input->post('email');
        $this->inicio_mod->registra_user($usuario,$clave,$correo,'2'); #Tipo 2: Cliente
        $this->inicio_mod->valida_user($usuario,$clave);
        if($this->session->userdata('usuario') != ''){
            $data['info'] = $data['datos'];
            $data['empresas'] = $this->inicio_mod->variable('empresa');
            $data['naciones'] = $this->inicio_mod->variable('nacion');
            $data['clase'] = 'registrar';
            $data['page'] = 'home_usuario';
            $this->load->view('home',$data);
        }
        else redirect('/inicio_con/index/', 'refresh');
    }
    public function configuracion(){
        $data = $this->valida();
        $data['page'] = 'home_configuracion';
        if($data['tipo'] == '1') $this->load->view('home',$data);
        else $this->index();
    }
    public function salir(){
        $this->session->sess_destroy();
        redirect('/inicio_con/index/', 'refresh');
    }
    public function usuario(){
        $data = $this->valida();
        $data['info'] = $this->inicio_mod->informacion($data['usuario']);
        $data['empresas'] = $this->inicio_mod->variable('empresa');
        $data['naciones'] = $this->inicio_mod->variable('nacion');
        $data['clase'] = 'perfil';
        $data['page'] = 'home_usuario';
        $this->load->view('home',$data);
    }
    public function edit_user(){
        $data = $this->valida();
        $post = array('correo','celular','rut','id_empresa','id_nacion','genero');
        foreach ($post as $value)
            $info[$value] = $this->input->post($value);
        $nombres = split(" ",$this->input->post('nombres'));
        if(sizeof($nombres) > 1){
            $info['nombre_1'] = $nombres[0];
            $info['nombre_2'] = $nombres[1];
        }else{
            $info['nombre_1'] = $nombres[0];
            $info['nombre_2'] = '';
        }
        $apellidos = split(" ",$this->input->post('apellidos'));
        if(sizeof($apellidos) > 1){
            $info['apellido_1'] = $apellidos[0];
            $info['apellido_2'] = $apellidos[1];
        }else{
            $info['apellido_1'] = $apellidos[0];
            $info['apellido_2'] = '';
        }
        $this->inicio_mod->edit_user($info,$data['usuario']);
        $data['page'] = 'home_cont';
        $this->load->view('home',$data);
    }
}
?>