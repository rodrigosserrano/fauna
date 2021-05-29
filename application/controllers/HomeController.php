<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends Fauna_Controller {

    public function __construct()
    {
        parent::__construct();
            $this->verifySession();
            $this->id_usuario = $_SESSION['id'];
            $this->email = $_SESSION['email'];
    }

    public function index() {
        $this->load->model('PostagemModel');
        $this->load->model('ComentarioModel');
        $this->load->model('CadastrosModel');
        $this->load->model('PetsModel');

        $postagens = $this->PostagemModel->getDadosPostagemModel();

        $pets = $this->PetsModel->getDadosPetModel($this->id_usuario);
        $categories = $this->CadastrosModel->getCategoriaModel();

        $dados_postagens = array();

        foreach($postagens as $postagem) {
            $postagem = [
                'id_postagem' => $postagem->id_postagem,
                'usuario' => $postagem->usuario,
                'animal' => $postagem->animal,
                'email' => $postagem->email,
                'foto_usuario' => $postagem->foto_usuario,
                'descricao' => $postagem->descricao,
                'midia' => $postagem->midia,
                'midia_url' => $postagem->email.'/'.$postagem->midia,
                'dh_post' => $postagem->dh_post,
                'comentarios' => $this->ComentarioModel->getDadosComentarioModel($postagem->id_postagem)
            ];

            array_push($dados_postagens, (object) $postagem);
        }
        
        $usuario = [
            'id_usuario' => $this->id_usuario,
            'email' => $this->email
        ];

        $dados = [
            'usuario' => $usuario,
            'postagens'=> $dados_postagens,
            'pets' => $pets,
            'categorias' => $categories
        ];

        $dados_view = $this->dadosShow('Feed', 'assets/css/styleHome.css');
		$view = $this->load->view('pages/Home', $dados, true);

        $this->show($dados_view, $view, true);
    }

}
