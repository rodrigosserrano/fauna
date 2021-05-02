<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends PostController {

    public function __construct()
    {
        parent::__construct();
            $this->verifySession();
    }

    public function index() {
        $dados = $this->dadosShow('Feed', 'assets/css/style');
		$view = $this->load->view('pages/common-feed', null, true);

        $this->show($dados, $view, true);
    }

}
