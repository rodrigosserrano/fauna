<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends Fauna_Controller {

public function index() {
        $this->verifySession(); //verifica sessão existente
        
        $dados = $this->dadosShow('Feed', 'assets/css/style');
		$view = '<h1>Feed</h1>';

        $this->show($dados, $view, true);
    }

}
