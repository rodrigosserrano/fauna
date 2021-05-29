<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends Fauna_Controller {

    public function __construct()
    {
        parent::__construct();
            $this->verifySession();
            $this->id_usuario = $_SESSION['id'];
            $this->email = $_SESSION['email'];

            $this->load->model('PostagemModel');
            $this->load->model('ComentarioModel');
            $this->load->model('CadastrosModel');
            $this->load->model('PetsModel');    
    }

    public function index() {

        $dados_view = $this->dadosShow('Feed', 'assets/css/styleHome.css');
		$view = $this->load->view('pages/Home', null, true);

        $this->show($dados_view, $view, true);
    }

}
