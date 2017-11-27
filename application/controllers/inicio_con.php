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
    function index(){
        $data = $this->valida();
        if(!empty($data)){
            $data['productos'] = $this->inicio_mod->productos();
            $data['stock'] = $this->inicio_mod->stock();
            $data['page'] = 'home_cont';
            $this->load->view('home',$data);
        }
    }
    function page(){
        $data = $this->inicio_mod->web();
        $data['productos'] = $this->inicio_mod->productos();
        $data['usuario'] = $this->session->userdata('usuario');
        $data['tipo'] = $this->session->userdata('tipo');
        $this->load->view('page',$data);
    }
    function descripcion(){
        $id_producto = $this->uri->segment(3);
        $data = $this->inicio_mod->web();
        $data['producto'] = $this->inicio_mod->producto($id_producto);
        $data['productos'] = $this->inicio_mod->productos();
        $data['stock'] = $this->inicio_mod->stock();
        $data['usuario'] = $this->session->userdata('usuario');
        $data['tipo'] = $this->session->userdata('tipo');
        $this->load->view('page_descripcion',$data);
    }
    function comprar(){
        $id_producto = $this->uri->segment(3);
        $data['cantidad'] = $this->input->post('cantidad');
        $data['stock'] = $this->inicio_mod->stock();
        if($data['cantidad'] > 0 and $data['cantidad'] < $data['stock'][$id_producto]){
            $data['producto'] = $this->inicio_mod->producto($id_producto);
            $data['usuario'] = $this->session->userdata('usuario');
            $data['tipo'] = $this->session->userdata('tipo');
            $this->load->view('page_comprar',$data);
        }else redirect('/inicio_con/descripcion/'.$id_producto, 'refresh');
    }
    function tbk(){
        $cabecera = array('nombre','cantidad','id_producto','rut','correo','telefono','tipo_fac','tipo_desp');
        $contenido = array();
        foreach ($cabecera as $post)
            array_push($contenido, "'".$this->input->post($post)."'");
        if($this->input->post('tipo_fac') == 'factura'){
            foreach(array('empresa','e_rut','e_giro','e_dir','e_correo') as $post){
                array_push($cabecera, $post);
                array_push($contenido, "'".$this->input->post($post)."'");
            }
        }
        if($this->input->post('tipo_desp') == 'despacho'){
            array_push($cabecera, 'direccion');
            array_push($contenido, "'".$this->input->post('direccion')."'");
        }
        array_push($cabecera, 'f_ingreso');
        array_push($contenido, "'".date("Y-m-d")."'");
        array_push($cabecera, 'h_ingreso');
        array_push($contenido, "'".date("H:i:s")."'");
        $id_compra = $this->inicio_mod->registrar_compra($cabecera,$contenido);
        $producto = $this->inicio_mod->producto($this->input->post('id_producto'));
        $this->inicio_mod->pago($producto['prc_vta']*$this->input->post('cantidad'),$id_compra,site_url("inicio_con/tbk_retorno"),site_url("inicio_con/tbk_final/".$producto['id_producto']));
    }
    function tbk_retorno(){
        $token = $this->input->post('token_ws');
        $this->inicio_mod->retorno($token);
    }
    function tbk_final(){
        $id_producto = $this->uri->segment(3);
        $token = $this->input->post('token_ws');
        $this->tbk_correo($id_producto,$token);
        $this->comprobante($id_producto,$token);
    }
    function tbk_correo($id_producto,$token){
        #Comprabar Tx Exitosa
        $info = $this->inicio_mod->comprobante($token);
        if($info['responseCode'] == '0'){
            #Correo Administradores
            $correos = $this->inicio_mod->correo_adm();
            $asunto = "Compra Productos Web de ".$info['nombre'];
            $mensaje = "Se ha adquirido un nuevo producto en el sistema, bajo el id: ".$info['id_web'];
            foreach ($correos as $email)
                $this->enviar_email('contacto@webgaretto.cl',"Equipo Garetto",$email->correo,$asunto,$mensaje);
            #Correo de Comprobante
            $asunto = "Compra Productos Web Garetto";
            $mensaje = "Se ha adquirido un nuevo producto en el sistema, bajo el id nº".$info['id_web'].", puede visualizar el comprobante en:<br><br>".site_url("inicio_con/comprobante_web/{$id_producto}/{$token}");
            $this->enviar_email('contacto@webgaretto.cl',"Equipo Garetto",$info['correo'],$asunto,$mensaje);
        }
    }
    function comprobante($id_producto,$token){
        $data['producto'] = $this->inicio_mod->producto($id_producto);
        $data['usuario'] = $this->session->userdata('usuario');
        $data['tipo'] = $this->session->userdata('tipo');
        if(empty($token)) $data['compra'] = 'fallida';
        else{ 
            $data['comprobante'] = $this->inicio_mod->comprobante($token);
            $data['info_comp'] = $this->inicio_mod->info_conf_comp();
            $data['compra'] = 'exito';
        }
        $this->load->view('page_comprobante_web',$data);
    }
    function web(){
        $data = $this->inicio_mod->web();
        $data['productos'] = $this->inicio_mod->productos();
        $this->load->view('page_edit',$data);
    }
    function contacto(){
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
    function edit_web(){
        $data = $this->valida();
        $tmp = $this->inicio_mod->web();
        $post_img = array('sec5_1_pimg','sec5_2_pimg','sec5_3_pimg');
        foreach ($post_img as $img) {
            $imagen = $this->cargar_imagen('web',$img);
            if($imagen != '')
                $info[$img] = $imagen;
            else
                $info[$img] = $tmp[$img];
        }
        $form = array('titulo','valor','rotar','sec1_tit','sec1_desc','sec1_stit','sec1_det','sec2_tit','sec2_desc','sec2_1_tit','sec2_1_desc','sec2_2_tit','sec2_2_desc','sec2_3_tit','sec2_3_desc','sec3_tit','sec3_desc','sec4_tit','sec4_desc','sec4_direc','sec4_comuna','sec4_email','sec4_tel','sec5_tit','sec5_desc','sec5_1_ptit','sec5_1_pdesc','sec5_1_pcheck','sec5_2_ptit','sec5_2_pdesc','sec5_2_pcheck','sec5_3_ptit','sec5_3_pdesc','sec5_3_pcheck');
        foreach ($form as $post)
            $info[$post] = $this->input->post($post);
        $info['user'] = $data['usuario'];
        $info['fecha'] = date("Y-m-d");
        $info['hora'] = date("H:i:s"); 
        $this->inicio_mod->insert_tab($info,'page');
        redirect('/inicio_con/web/', 'refresh');
    }
    function ingreso(){
        $data['usuario'] = $this->session->userdata('usuario');
        $data['tipo'] = $this->session->userdata('tipo');
        if(empty($data['usuario'])){
            $this->load->view('login');
        }else{
            $data['productos'] = $this->inicio_mod->productos();
            $data['stock'] = $this->inicio_mod->stock();
            $data['page'] = 'home_cont';
            $this->load->view('home',$data);
        }
    }
    function login(){
        $data['usuario'] = $this->input->post('username');
        $clave = $this->input->post('password');
        $data['tipo'] = $this->inicio_mod->valida_user($data['usuario'],$clave);
        if(in_array($data['tipo'], array('1','2'))){
            $data['productos'] = $this->inicio_mod->productos();
            $data['stock'] = $this->inicio_mod->stock();
            $data['page'] = 'home_cont';
            $this->load->view('home',$data);
        }else $this->load->view('login');
    }
    function registro(){
        $data['usuario'] = $this->input->post('username');
        $clave = $this->input->post('password');
        $data['correo'] = $this->input->post('email');
        #Tipo 2: Cliente
        $data['id_usuario'] = $this->inicio_mod->registra_user($data['usuario'],$clave,$data['correo'],'2');
        $tipo = $this->inicio_mod->valida_user($data['usuario'],$clave);
        if($tipo != ''){
            $asunto = "Registro de usuario";
            $mensaje = "Se ha registrado en la plataforma de garetto el usuario ".$data['usuario']." asociado a este correo.";
            $this->enviar_email('contacto@webgaretto.cl',"Equipo Garetto",$data['correo'],$asunto,$mensaje);
            $data['empresas'] = $this->inicio_mod->variable('empresa');
            $data['naciones'] = $this->inicio_mod->variable('nacion');
            $data['clase'] = 'registrar';
            $data['page'] = 'home_usuario';
            $this->load->view('home',$data);
        }
        else redirect('/inicio_con/index/', 'refresh');
    }
    function configuracion(){
        $data = $this->valida();
        $data['page'] = 'home_configuracion';
        $data['correo'] = $this->inicio_mod->correo_valida();
        $data['info_comp'] = $this->inicio_mod->info_conf_comp();
        if($data['tipo'] == '1') $this->load->view('home',$data);
        else $this->index();
    }
    function conf_correo(){
        $correo = $this->input->post('correo');
        $this->inicio_mod->conf_correo($correo,$this->session->userdata('usuario'));
        $this->configuracion();
    }
    function conf_comprobante(){
        $nombre = $this->input->post('nombre');
        $correo = $this->input->post('correo');
        $telefono = $this->input->post('telefono');
        $usuario = $this->session->userdata('usuario');
        $this->inicio_mod->conf_comprobante($nombre,$correo,$telefono,$usuario);
        $this->configuracion();
    }
    function salir(){
        $this->session->sess_destroy();
        redirect('/inicio_con/index/', 'refresh');
    }
    function usuario(){
        $data = $this->valida();
        $data['info'] = $this->inicio_mod->informacion($data['usuario']);
        $data['empresas'] = $this->inicio_mod->variable('empresa');
        $data['naciones'] = $this->inicio_mod->variable('nacion');
        $data['clase'] = 'perfil';
        $data['page'] = 'home_usuario';
        $this->load->view('home',$data);
    }
    function cargar_imagen($path,$img){
        $config['upload_path'] = 'application/images/'.$path.'/';
        $config['allowed_types'] = 'jpg';
        $config['max_size'] = 0;
        $this->upload->initialize($config);
        if ($this->upload->do_upload($img)) $datos = $this->upload->data();
        return $datos['file_name'];
    }
    function edit_user(){
        $data = $this->valida();
        $imagen = $this->cargar_imagen('usuarios','imagen');
        if($imagen != '')
            $info['imagen'] = $imagen;
        $id_usuario = $this->input->post('id_usuario');
        $post = array('correo','celular','rut','id_nacion','genero','direccion');
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
        $s_empresa = $this->input->post('s_empresa');
        if($s_empresa == 'existe') $info['id_empresa'] = $this->input->post('id_empresa');
        elseif($s_empresa == 'nueva'){
            $empresa = array('e_name','e_rut','e_dir','e_giro');
            foreach ($empresa as $value) 
                $in[$value] = $this->input->post($value);
            $info['id_empresa'] = $this->inicio_mod->empresa($in['e_name'],$in['e_rut'],$in['e_dir'],$in['e_giro']);
        }
        $valida = $this->inicio_mod->valida_edit($info['rut'],$info['correo'],$id_usuario);
        if($valida == 0){
            $this->inicio_mod->edit_user($info,$data['usuario']);
            $data['mensaje'] = "El perfil fue editado exitosamente.";
        }elseif($valida == 1) $data['mensaje'] = "El usuario, correo o rut modificados, ya existe en el sistema. Id_usuario: ".$id_usuario;
        $data['info'] = $this->inicio_mod->informacion($data['usuario']);
        $data['empresas'] = $this->inicio_mod->variable('empresa');
        $data['naciones'] = $this->inicio_mod->variable('nacion');
        $data['clase'] = 'perfil';
        $data['page'] = 'home_usuario';
        $this->load->view('home',$data);
    }
    function cambiar_pass(){
        $data = $this->valida();
        $data['page'] = 'pass';
        $this->load->view('home',$data);
    }
    function edit_pass(){
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
    function compras_web(){
        $data = $this->valida();
        $data['registros'] = $this->inicio_mod->registros();
        $data['page'] = 'home_pagos_web';
        $this->load->view('home',$data);
    }
    function comprobante_web(){
        $id_producto = $this->uri->segment(3);
        $token = $this->uri->segment(4);
        $this->comprobante($id_producto,$token);
    }
}
?>