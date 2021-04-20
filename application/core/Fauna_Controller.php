<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fauna_Controller extends CI_Controller{

    public function show(array $dados, $view, $nav = false){
        $estrutura = $this->load->view('template/header', $dados, true);
        $nav ? $estrutura .= $this->load->view('template/navbar', $dados, true) : null;
        
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
            redirect("login");
        }
    }

    public function createSession($session_data){
        $this->session->set_userdata($session_data);
    }

    
    public function unsetSession(){
        $this->session->sess_destroy();
    }
}



