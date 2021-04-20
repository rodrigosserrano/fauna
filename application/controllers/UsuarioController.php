<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuarioController extends Fauna_Controller {

public function index() {
        /**                 | OBRIGATÓRIO |  |  NÃO OBRIGATÓRIO  |
         * $this->dadosShow('titulo_pagina', 'link_css', 'link_js') */
        
        /**            |DADOS| |VIEW| |TRUE/FALSE|
         * $this->show($dados, $view, $navbar); */


        $dados = $this->dadosShow('Feed', 'assets/css/style');
		$view = $this->load->view('/template/nav', null, true);
        $this->show($dados, $view);
    }

public function deletaContaView() {
        /**                 | OBRIGATÓRIO |  |  NÃO OBRIGATÓRIO  |
         * $this->dadosShow('titulo_pagina', 'link_css', 'link_js') */
        
        /**            |DADOS| |VIEW| |TRUE/FALSE|
         * $this->show($dados, $view, $navbar); */


        $dados = $this->dadosShow('Deletar Conta', 'assets/css/styleConfig.css');
		$navbar = $this->load->view('/template/navbar', null, true);
        $view = $this->load->view('/pages/config-excluir', null, true);
        $this->show($dados, $view, $navbar);
    }

    public function alteraContaView() {
        /**                 | OBRIGATÓRIO |  |  NÃO OBRIGATÓRIO  |
         * $this->dadosShow('titulo_pagina', 'link_css', 'link_js') */
        
        /**            |DADOS| |VIEW| |TRUE/FALSE|
         * $this->show($dados, $view, $navbar); */


        $dados = $this->dadosShow('Altera Conta', 'assets/css/styleConfig.css');
		$navbar = $this->load->view('/template/navbar', null, true);
        $view = $this->load->view('/pages/config-alterar', null, true);
        $this->show($dados, $view, $navbar);
    }

}
