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
        $data['asunto'] = $asunto;
        $data['nombre'] = $nombre;
        $this->email->message($this->load->view('email',$data,true));
        return $this->email->send();
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
        $data['usuario'] = $this->input->post('username');
        $clave = $this->input->post('password');
        $data['correo'] = $this->input->post('email');
        $this->inicio_mod->registra_user($data['usuario'],$clave,$data['correo'],'2'); #Tipo 2: Cliente
        $tipo = $this->inicio_mod->valida_user($data['usuario'],$clave);
        if($tipo != ''){
            $asunto = "Registro de usuario";
            $mensaje = "Se ha registrado en la plataforma de garetto el usuario ".$data['usuario']." asociado a este correo.";
            $this->enviar_email('contacto@wegaretto.cl',"Equipo Garetto",$data['correo'],$asunto,$mensaje);
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
        $id_usuario = $this->input->post('id_usuario');
        $post = array('correo','celular','rut','id_empresa','id_nacion','genero','direccion');
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
        $valida = $this->inicio_mod->valida_edit($info['rut'],$info['correo'],$id_usuario);
        if($valida == 0){
            $this->inicio_mod->edit_user($info,$data['usuario']);
            $data['mensaje'] = "El perfil fue editado exitosamente.";
        }elseif($valida == 1) $data['mensaje'] = "El usuario, correo o rut modificados, ya existe en el sistema.";
        $data['info'] = $this->inicio_mod->informacion($data['usuario']);
        $data['empresas'] = $this->inicio_mod->variable('empresa');
        $data['naciones'] = $this->inicio_mod->variable('nacion');
        $data['clase'] = 'perfil';
        $data['page'] = 'home_usuario';
        $this->load->view('home',$data);
    }
    public function cambiar_pass(){
        $data = $this->valida();
        $data['page'] = 'pass';
        $this->load->view('home',$data);
    }
    public function edit_pass(){
        $data = $this->valida();
        $posts = array('pass','new_pass','conf_new_pass');
        foreach ($posts as $post)
            $info[$post] = $this->input->post($post);
        $valida = $this->inicio_mod->valida_pass($data['usuario'],$info['pass']);
        if($info['new_pass'] != $info['conf_new_pass']) $data['mensaje'] = "La Confirmación de la contraseña no corresponde.";
        elseif($valida == 0) $data['mensaje'] = "La Contraseña no corresponde.";
        elseif($valida == 1){
            $conf = $this->inicio_mod->edit_pass($data['usuario'],$info['new_pass']);
            if($conf == 1) $data['mensaje'] = "La Contraseña ha sido cambiada exitosamente.";
            else $data['mensaje'] = "Ups!, ha ocurrido un problema.";
        }
        $data['page'] = 'pass';
        $this->load->view('home',$data);
    }
    public function activar_reloj(){
        $url = "http://www.relojgaretto.cl/sensores/agregar";  
        $postData = array(
            "usuario" => "pablo",
            "rut_usuario" => "16016083",
            "email_usuario" => "pfigueroap.plaza@gmail.com", 
            "clave" => sha1("pablo"),
            "modelo" => "FGT45",
            "marca" => "ZKT",
            "cantidad" => "1");  
        /*Convierte el array en el formato adecuado para cURL*/  
        #$elements = array();
        #foreach ($postData as $name=>$value) {  
        #   $elements[] = "{$name}=".urlencode($value);  
        #}  
        $handler = curl_init();  
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);  
        #curl_setopt($handler, CURLOPT_POSTFIELDS, $elements);
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);
        $response = curl_exec ($handler);  
        curl_close($handler);
        echo $response;
    }
}
?>