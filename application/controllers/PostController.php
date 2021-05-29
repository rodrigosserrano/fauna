<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PostController extends Fauna_Controller {    

    public function __construct()
    {
        parent::__construct();
        $this->verifySession();

        $this->id_usuario = $_SESSION['id'];
        $this->email = $_SESSION['email'];
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
            
            $this->load->model('PostagemModel');
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
        $this->form_validation->set_rules('id_usuario', 'id_usuario', 'required');
        $this->form_validation->set_rules('id_animal', 'id_animal', 'required');
        $this->form_validation->set_rules('id_categoria', 'id_categoria', 'required');
        $this->form_validation->set_rules('descricao', 'descricao', 'required');

        if($this->form_validation->run()){
            $dados_cadastro = [

                "midia" => $this->uploadImage($_FILES['midia'], $this->email, 'post'),
                "id_usuario" => $this->id_usuario,
                "id_animal" => $this->input->post('id_animal'),
                "descricao" => $this->input->post('descricao'),
                "id_categoria" => $this->input->post('id_categoria')
            ];
            
            $this->load->model('PostagemModel');
            $verifica_cadastro = $this->PostagemModel->alterarDadosPostagemModel($dados_cadastro);
        
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

        $this->load->model('PostagemModel');
        if($this->PostagemModel->deletePostagemModel($this->id_postagem)){
            echo json_encode(['mensagem'=>'Postagem excluida com sucesso. ' . $this->id_postagem]);
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
            
            $this->load->model('ComentarioModel');
            $verifica_cadastro = $this->ComentarioModel->cadastroComentarioModel($dados_cadastro);

            if($verifica_cadastro){
                echo json_encode(['mensagem'=>'Comentario feito com sucesso !']);
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
        $this->form_validation->set_rules('id_usuario', 'id_usuario');
        $this->form_validation->set_rules('id_comentario', 'id_comentario');
        $this->form_validation->set_rules('texto', 'texto', 'required');        

        if($this->form_validation->run()){
            $dados_cadastro = [    
                "id_usuario" => $this->input->post('id_usuario'),
                "id_comentario" => $this->input->post('id_comentario'),
                "texto" => $this->input->post('texto')
                //"dh_comentario" => $now = new DateTime().getTimestamp
            ];
            
            $this->load->model('ComentarioModel');
            $verifica_cadastro = $this->ComentarioModel->alterarDadosComentarioModel($dados_cadastro);
        
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

        $this->load->model('ComentarioModel');
        if($this->ComentarioModel->deleteComentarioModel($this->id_comentario)){
            echo json_encode(['mensagem'=>'Comentario excluido com sucesso. ' . $this->id_comentario]);
        }else{
            echo json_encode(['mensagem'=>'Erro ao deletar']);
        }     
    }
}