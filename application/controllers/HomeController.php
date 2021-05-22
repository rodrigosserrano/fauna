<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends Fauna_Controller {

    public function __construct()
    {
        parent::__construct();
            $this->verifySession();
            $this->id_usuario = $_SESSION['id'];
    }

    public function index() {
        $this->load->model('PostagemModel');
        $postagens = $this->PostagemModel->getDadosPostagemModel();
        $this->load->model('ComentarioModel');

        $dados_postagens = array();

        foreach($postagens as $postagem) {
            $postagem = [
                'usuario' => $postagem->usuario,
                'animal' => $postagem->animal,
                'descricao' => $postagem->descricao,
                'midia' => $postagem->midia,
                'dh_post' => $postagem->dh_post,
                'comentarios' => $this->ComentarioModel->getDadosComentarioModel($postagem->id_postagem)
            ];

            array_push($dados_postagens, (object) $postagem);
        }

        $dados = [
            'id_usuario' => $this->id_usuario,
            'postagens'=> $dados_postagens,
        ];

        $dados_view = $this->dadosShow('Feed', 'assets/css/styleCommon-feed.css');
		$view = $this->load->view('pages/Home', $dados, true);

        $this->show($dados_view, $view, true);
    }

}
