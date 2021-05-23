<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fauna_Controller extends CI_Controller{
    
    public function show(array $dados, $view, $nav = false){
        $dados_usuario = [];
        $estrutura = $this->load->view('template/header', $dados, true);
        $nav ? $estrutura .= $this->load->view('template/navbar', $dados_usuario, true) : null;
        
        $estrutura .= $view;

        $estrutura .= $this->load->view('template/footer', $dados, true);   
        echo $estrutura;
    }

    public function dadosShow($title, $style = null, $js = null){
        $dados = [
            'title' => $title,
            'style' => base_url().$style,
            'js' => base_url().$js
        ];

        return $dados;
    }   

    public function verifySession(){
        if(!$this->session->has_userdata('id')){
            redirect("/");
        }
    }

    public function createSession($session_data){
        $this->session->set_userdata($session_data);
    }

    
    public function destroySession(){
        $this->session->sess_destroy();
    }

    // TEM QUE MEXER PARA APAGAR O ARQUIVO TEMPORARIO
    public function uploadImage($arquivo = false, $email = false, $is_user = false) {
        $extensao = trim(substr(strchr($arquivo['name'], '.'), 0));
        $nomefoto = md5(time()).$extensao;
        $upload_path = $this->localUpload($is_user, $email);

        move_uploaded_file($arquivo['tmp_name'], $upload_path.$nomefoto);

        return $nomefoto;
    }

    // AJUSTAR O CHDIR OU ACHAR UMA FORMA MELHOR PARA CRIAR PASTA
    public function localUpload($is_user = true, $email){
        $path_user = getcwd().'/assets/img/user';
        $path_pet = getcwd().'/assets/img/pet';

        if($is_user){
            if(!is_dir($path_user.'/'.$email)){
                chdir($path_user);
                mkdir($email);
                return $path_user.'/'.$email.'/';
            }else{
                return $path_user.'/'.$email.'/';
            }
        }else{
            if(!is_dir($path_pet.'/'.$email)){
                chdir($path_pet);
                mkdir($email);
                return $path_pet.'/'.$email.'/';
            }else{
                return $path_pet.'/'.$email.'/';
            }
        }
    }
}



