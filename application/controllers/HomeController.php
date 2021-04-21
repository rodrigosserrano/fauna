<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends Fauna_Controller {

    public function __construct()
    {
        parent::__construct();
            $this->verifySession();
    }

    public function index() {
        $dados = $this->dadosShow('Feed', 'assets/css/style');
		$view = '<h1>Feed</h1>';

        $this->show($dados, $view, true);
    }

}
