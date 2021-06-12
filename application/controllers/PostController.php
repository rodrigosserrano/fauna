<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PostController extends Fauna_Controller {    

    public function __construct()
    {
        parent::__construct();
        $this->verifySession();

        $this->id_postagem = isset($_POST['id_postagem']) ? $_POST['id_postagem'] : '';
        $this->id_comentario = isset($_POST['id_comentario']) ? $_POST['id_comentario'] : '';
        $this->id_curtida = isset($_POST['id_curtida']) ? $_POST['id_curtida'] : '';

        $this->id_usuario = $_SESSION['id'];
        $this->nivel_usuario = $_SESSION['nivel_usuario'];
        $this->email = $_SESSION['email'];

        $this->load->model('PostagemModel');
        $this->load->model('ComentarioModel');
        $this->load->model('CurtidaModel');
        $this->load->model('CadastrosModel');
        $this->load->model('PetsModel');
    }

    public function getPostagemComentarioRequest($filter = null) {
        header('Content-Type: application/json');
        $postagens = $this->PostagemModel->getDadosPostagemModel($filter);

        $pets = $this->PetsModel->getDadosPetModel($this->id_usuario);
        $categories = $this->CadastrosModel->getCategoriaModel();

        $dados_postagens = [];

        foreach($postagens as $postagem) {
           
            $postagem = [
                'id_postagem' => $postagem->id_postagem,
                'usuario' => $postagem->usuario,
                'id_usuario' => $postagem->id_usuario,
                'perfil' => base_url().'profile/'.$postagem->id_usuario,
                'id_animal' => $postagem->id_animal,
                'animal' => $postagem->animal,
                'id_categoria' => $postagem->id_categoria,
                'email' => $postagem->email,
                'foto_usuario' => $postagem->foto_usuario,
                'descricao' => $postagem->descricao,
                'midia' => $postagem->midia,
                'midia_url' => $postagem->email.'/'.$postagem->midia,
                'dh_post' => $postagem->dh_post,
                'comentarios' => $this->ComentarioModel->getDadosComentarioModel($postagem->id_postagem),
                'curtidas' =>  $this->CurtidaModel->countCurtidaModel($postagem->id_postagem),
                'curtiu' => $this->CurtidaModel->checkCurtidaUsuario($postagem->id_postagem, $this->id_usuario) ? true : false
            ];
            $dados_postagens[] = $postagem;
        }
        
        $usuario = [
            'id_usuario' => $this->id_usuario,
            'is_admin' => $this->nivel_usuario == 1 ? true : false
        ];

        $dados = [
            'postagens'=> $dados_postagens,
            'pets' => $pets,
            'categorias' => $categories,
            'usuario' => $usuario,
        ];

        echo json_encode($dados);
    }

    public function createPostagem() {
        header('Content-Type: application/json');
        $this->load->library('form_validation');
        
        // $this->form_validation->set_rules('id_postagem', 'id_postagem');
        // $this->form_validation->set_rules('id_usuario', 'id_usuario');
        $this->form_validation->set_rules('id_animal', 'id_animal', 'required');
        $this->form_validation->set_rules('id_categoria', 'id_categoria', 'required');
        // Não sei se vai precisar pq o banco dados preenche  o campo com a  hr do Crud
        //$this->form_validation->set_rules('dh_postagem', 'dh_postagem', 'required');
        $this->form_validation->set_rules('descricao', 'descricao', 'required');

        if($this->form_validation->run()){
            $dados_cadastro = [
                "id_usuario" => $this->id_usuario,
                "id_animal" => $this->input->post('id_animal'),
                "id_categoria" => $this->input->post('id_categoria'),
                // "dh_postagem" => new DateTime(), //  verificar se a função está correta  
                "descricao" => $this->input->post('descricao'),
                "midia" => $this->uploadImage($_FILES['midia'], $this->email, 'post'),
            ];

            print_r($dados_cadastro);
            
            $verifica_cadastro = $this->PostagemModel->cadastroPostagemModel($dados_cadastro);

            if($verifica_cadastro){
                echo json_encode(['mensagem'=>'Postagem feita com sucesso!']);
            }else{
                echo json_encode(['mensagem'=>'Erro ao realizar Postagem.']);
            }
        }else{ //caso a validação do formulário der erro, volta para página de login
            echo json_encode(['mensagem'=>'Erro no formulário']);
        }
    }

    public function editPostagem() {
        header('Content-Type: application/json');
        $this->load->library('form_validation');
        
        // $this->form_validation->set_rules('foto_animal', 'foto_animal', 'required');
        // $this->form_validation->set_rules('id_usuario', 'id_usuario', 'required');
        $this->form_validation->set_rules('id_postagem', 'id_postagem', 'required');
        $this->form_validation->set_rules('id_animal', 'id_animal', 'required');
        $this->form_validation->set_rules('id_categoria', 'id_categoria', 'required');
        $this->form_validation->set_rules('descricao', 'descricao', 'required');

        if($this->form_validation->run()){
            $dados_cadastro = [

                "midia" => $this->uploadImage($_FILES['midia'], $this->email, 'post'),
                "id_usuario" => $this->id_usuario,
                "id_animal" => $this->input->post('id_animal'),
                "descricao" => $this->input->post('descricao'),
                "id_categoria" => $this->input->post('id_categoria'),
                "id_postagem" => $this->input->post('id_postagem')
            ];
            
            $verifica_cadastro = $this->PostagemModel->alterarDadosPostagemModel($dados_cadastro, $this->nivel_usuario);
        
            if($verifica_cadastro){
                echo json_encode(['mensagem'=>'Postagem alterada com sucesso!']);
            }else{
                echo json_encode(['mensagem'=>'Erro ao alterar.']);
            }
        }else{ //caso a validação do formulário der erro, volta para página de login
            echo json_encode(['mensagem'=>'Erro no formulário']);
        }
    }

    public function deletePostagem() {
        header('Content-Type: application/json');
        
        if($this->PostagemModel->deletePostagemModel($this->id_postagem, $this->id_usuario, $this->nivel_usuario)){
            echo json_encode(['mensagem'=>'Postagem excluida com sucesso.']);
        }else{
            echo json_encode(['mensagem'=>'Erro ao deletar']);
        }
        
    }

    /**
     * DADOS Postagem 
     * create, edit & delete
     */

    public function createComentario() {
        header('Content-Type: application/json');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('id_postagem', 'id_postagem');
        //$this->form_validation->set_rules('id_usuario', 'id_usuario');
        $this->form_validation->set_rules('texto', 'texto', 'required');
        // Não sei se vai precisar pq o banco dados preenche  o campo com a  hr do Crud
        //$this->form_validation->set_rules('dh_comentario', 'dh_comentario', 'required');
        if($this->form_validation->run()){
            $dados_cadastro = [
                "id_usuario" => $this->id_usuario,
                "id_postagem" => $this->input->post('id_postagem'),
                //"dh_comentario" => new DateTime(), //  verificar se a função está correta  
                "texto" => $this->input->post('texto')
            ];
            
            $verifica_cadastro = $this->ComentarioModel->cadastroComentarioModel($dados_cadastro);

            if($verifica_cadastro){
                echo json_encode([
                    'mensagem'=>'Comentario feito com sucesso !',
                    'id'=>$verifica_cadastro
                ]);
            }else{
                echo json_encode(['mensagem'=>'Erro ao realizar Comentario.']);
            }
        }else{ //caso a validação do formulário der erro, volta para página de login
            echo json_encode(['mensagem'=>'Erro no formulário']);
        }
    }

    public function editComentario() {
        header('Content-Type: application/json');
        $this->load->library('form_validation');
        
        // $this->form_validation->set_rules('foto_animal', 'foto_animal', 'required');
        $this->form_validation->set_rules('id_comentario', 'id_comentario');
        $this->form_validation->set_rules('texto', 'texto', 'required');        

        if($this->form_validation->run()){
            $dados_cadastro = [    
                "id_usuario" => $this->id_usuario,
                "id_comentario" => $this->input->post('id_comentario'),
                "texto" => $this->input->post('texto')
                //"dh_comentario" => $now = new DateTime().getTimestamp
            ];
            
            $verifica_cadastro = $this->ComentarioModel->alterarDadosComentarioModel($dados_cadastro, $this->nivel_usuario);
        
            if($verifica_cadastro){
                echo json_encode(['mensagem'=>'Comentario alterado com sucesso !']);
            }else{
                echo json_encode(['mensagem'=>'Erro ao alterar.']);
            }
        }else{ //caso a validação do formulário der erro, volta para página de login
            echo json_encode(['mensagem'=>'Erro no formulário']);
        }
    }

    public function deleteComentario() {
        header('Content-Type: application/json');

        if($this->ComentarioModel->deleteComentarioModel($this->id_comentario, $this->id_usuario, $this->nivel_usuario)){
            echo json_encode(['mensagem'=>'Comentario excluido com sucesso.']);
        }else{
            echo json_encode(['mensagem'=>'Erro ao deletar']);
        }     
    }

    
    /**
     * DADOS Curtida 
     * create / delete / Count 
     */

    public function createCurtidaPostagem(){
        header('Content-Type: application/json');

        if($this->CurtidaModel->createCurtidaModel($this->id_usuario, $this->id_postagem)){
            return true;
        }else{
            return false;
        }
    }

    public function createCurtidaComentario(){
        header('Content-Type: application/json');

        if($this->CurtidaModel->createCurtidaModel($this->id_usuario, null,$this->id_comentario)){
            return true;
        }else{
            return false;
        }
    }

    public function deleteCurtida(){
        header('Content-Type: application/json');

        if($this->CurtidaModel->deleteCurtidaModel($this->id_curtida)){
            return true;
        }else{
            return false;
        }
    }

    public function deleteCurtidaPostagem(){
        header('Content-Type: application/json');

        if($this->CurtidaModel->deleteCurtidaModel($this->id_usuario, $this->id_postagem)){
            return true;
        }else{
            return false;
        }
    }

  
}