<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuarioController extends Fauna_Controller {

public function index() {
        $this->verifySession(); //verifica sessão existente
        
        $dados = $this->dadosShow('Feed', 'assets/css/style');
		$view = $this->load->view('/template/navbar', null, true);

        $this->show($dados, $view);
    }

    public function dadosContaView() {
        $dados = $this->dadosShow('Dados Conta', 'assets/css/styleConfig.css');
		$navbar = $this->load->view('/template/navbar', null, true);
        $view = $this->load->view('/pages/config-dados', null, true);

        $this->show($dados, $view, $navbar);
    }

    public function deletaContaView() {
        $dados = $this->dadosShow('Deletar Conta', 'assets/css/styleConfig.css');
		$navbar = $this->load->view('/template/navbar', null, true);
        $view = $this->load->view('/pages/config-excluir', null, true);

        $this->show($dados, $view, $navbar);
    }

    public function alteraContaView() {
        $dados = $this->dadosShow('Altera Conta', 'assets/css/styleConfig.css');
		$navbar = $this->load->view('/template/navbar', null, true);
        $view = $this->load->view('/pages/config-alterar', null, true);

        $this->show($dados, $view, $navbar);
    }

}
