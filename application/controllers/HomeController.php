<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends Fauna_Controller {

    public function __construct()
    {
        parent::__construct();
            $this->verifySession();
    }

    public function index() {
        $dados = $this->dadosShow('Feed', 'assets/css/styleCommon-feed.css');
		$view = $this->load->view('pages/Home', null, true);

        $this->show($dados, $view, true);
    }

}
