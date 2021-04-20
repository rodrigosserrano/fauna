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

    public function verifySession($id){
        if(!isset($_SESSION[$id])){
            redirect("login");
       }else{
            redirect("");
       }
    }
}



