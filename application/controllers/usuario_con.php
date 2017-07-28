<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

class Usuario_con extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->library('email');
        $this->load->helper(array('form', 'url'));
        $this->load->model('usuario_mod');
    }
    function valida(){
        $data['usuario'] = $this->session->userdata('usuario');
        $data['tipo'] = $this->session->userdata('tipo');
        if(empty($data['usuario']) or $data['tipo'] == '2'){
            redirect('/inicio_con/index/', 'refresh');
        }else{
            return $data;
        }
    }
    public function index(){
        $tipo = $this->uri->segment(3);
        $this->index_tipo($tipo);
    }
    function index_tipo($tipo){
        $data = $this->valida();
        $data['tipo_selec'] = $tipo;
        $data['usuarios'] = $this->usuario_mod->usuarios($tipo);
        if($tipo == '1') $data['title'] = "Administración";
        elseif ($tipo == '2') $data['title'] = "Clientes";
        $data['page'] = 'home_user';
        $this->load->view('home',$data);
    }
    public function down_usuarios(){
        $tipo = $this->uri->segment(3);
        if($tipo == '1') $info['title'] = "Administración";
        elseif ($tipo == '2') $info['title'] = "Clientes";
        $info['usuarios'] = $this->usuario_mod->usuarios($tipo);
        $this->load->view("excel/maestro_usuarios",$info);
    }
    public function crear_usuario(){
        $this->crear_user($this->uri->segment(3),'');
    }
    function crear_user($tipo,$mensaje){
        $data = $this->valida();
        $data['info']['tipo'] = $tipo;
        if($data['info']['tipo'] == '1') $data['title'] = "Administración";
        elseif ($data['info']['tipo'] == '2') $data['title'] = "Clientes";
        $data['empresas'] = $this->usuario_mod->variable('empresa');
        $data['naciones'] = $this->usuario_mod->variable('nacion');
        $data['info']['id_usuario'] = $this->usuario_mod->last_id('usuarios');
        $data['page'] = 'home_usuario';
        $data['clase'] = 'usuario';
        $data['mensaje'] = $mensaje;
        $this->load->view('home',$data);
    }
    public function mod_user(){
        $data = $this->valida();
        $info['tipo'] = $this->uri->segment(3);
        $clase = $this->uri->segment(4);
        if($clase == 'editar') $id_usuario = $this->input->post('id_usuario');
        $post = array('correo','celular','rut','id_empresa','id_nacion','genero','usuario','direccion');
        foreach ($post as $value)
            $info[$value] = $this->input->post($value);
        if($clase == 'usuario'){
            $clave = $this->tmp_clave(8);
            $info['clave'] = sha1($clave);
            $this->enviar_email($info['correo'],$info['usuario'],$clave);
        }
        $info = $this->split($info,'nombre',$this->input->post('nombres'));
        $info = $this->split($info,'apellido',$this->input->post('apellidos'));
        if($clase == 'usuario') $valida = $this->usuario_mod->valida_user($info['usuario'],$info['rut']);
        elseif($clase == 'editar') $valida = $this->usuario_mod->valida_edit($info['usuario'],$info['rut'],$id_usuario);
        if($valida == 1){
            if($clase == 'usuario') $this->crear_user($info['tipo'],"El usuario o rut ya existe en el sistema.");
            elseif($clase == 'editar') $this->edit_user($info['tipo'],$id_usuario,"El usuario o rut modificados, ya existe en el sistema.");
        }elseif($valida == 0){
            if($clase == 'usuario') $this->usuario_mod->add_user($info);
            elseif ($clase == 'editar') $this->usuario_mod->edit_user($info,$id_usuario);
            $this->index_tipo($info['tipo']);
        }
    }
    function enviar_email($email,$usuario,$clave){
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('contacto@garetto.cl','Garetto');
        $this->email->to($email);
        $this->email->subject("Creación de usuario Garetto");
        $data['usuario'] = $usuario;
        $data['clave'] = $clave;
        $this->email->message($this->load->view('email_user',$data,true));
        return $this->email->send();
    }
    function tmp_clave($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
}
    function split($info,$tag,$post){
        $tmp = split(" ",$post);
        if(sizeof($tmp) > 1){
            $info[$tag.'_1'] = $tmp[0];
            $info[$tag.'_2'] = $tmp[1];
        }else{
            $info[$tag.'_1'] = $tmp[0];
            $info[$tag.'_2'] = '';
        }
        return $info;
    }
    public function eliminar_user(){
        $tipo = $this->uri->segment(3);
        $id_usuario = $this->uri->segment(4);
        $this->usuario_mod->eliminar_user($id_usuario);
        $this->index_tipo($tipo);
    }
    public function editar_id(){
        $this->edit_user($this->uri->segment(3),$this->uri->segment(4),'');
    }
    function edit_user($tipo,$id_usuario,$mensaje){
        $data = $this->valida();
        $data['empresas'] = $this->usuario_mod->variable('empresa');
        $data['naciones'] = $this->usuario_mod->variable('nacion');
        $data['info'] = $this->usuario_mod->informacion($id_usuario);
        $data['page'] = 'home_usuario';
        $data['clase'] = 'editar';
        $data['mensaje'] = $mensaje;
        $this->load->view('home',$data);
    }
}
?>