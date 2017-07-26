<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

class Usuario_con extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('session');
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
        $data = $this->valida();
        $data['info']['tipo'] = $this->uri->segment(3);
        if($data['info']['tipo'] == '1') $data['title'] = "Administración";
        elseif ($data['info']['tipo'] == '2') $data['title'] = "Clientes";
        $data['empresas'] = $this->usuario_mod->variable('empresa');
        $data['naciones'] = $this->usuario_mod->variable('nacion');
        $data['info']['id_usuario'] = $this->usuario_mod->last_id('usuarios');
        $data['page'] = 'home_usuario';
        $data['clase'] = 'usuario';
        $this->load->view('home',$data);
    }
    public function mod_user(){
        $data = $this->valida();
        $info['tipo'] = $this->uri->segment(3);
        $clase = $this->uri->segment(4);
        if($clase == 'editar') $id_usuario = $this->input->post('id_usuario');
        $post = array('correo','celular','rut','id_empresa','id_nacion','genero');
        foreach ($post as $value)
            $info[$value] = $this->input->post($value);
        $info = $this->split($info,'nombre',$this->input->post('nombres'));
        $info = $this->split($info,'apellido',$this->input->post('apellidos'));
        if($clase == 'usuario') $this->usuario_mod->add_user($info);
        elseif ($clase == 'editar') $this->usuario_mod->edit_user($info,$id_usuario);
        $this->index_tipo($info['tipo']);
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
        $data = $this->valida();
        $tipo = $this->uri->segment(3);
        $id_usuario = $this->uri->segment(4);
        $data['empresas'] = $this->usuario_mod->variable('empresa');
        $data['naciones'] = $this->usuario_mod->variable('nacion');
        $data['info'] = $this->usuario_mod->informacion($id_usuario);
        $data['page'] = 'home_usuario';
        $data['clase'] = 'editar';
        $this->load->view('home',$data);
    }
}
?>