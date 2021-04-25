<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends Fauna_Controller {    

    public function __construct()
    {
        parent::__construct();
        $this->verifySession();

        $this->id_usuario = $_SESSION['id'];
    }

    public function index() {
        
        $this->load->model('UsuariosModel');
        $dados_usuario = $this->UsuariosModel->getDadosUsuarioModel($this->id_usuario);
        $dados_usuario = $dados_usuario[0];

        $dados = [
            'email' => $dados_usuario->email,
            'nome_usuario' => $dados_usuario->nome_usuario,
            'data_nascimento' => $dados_usuario->data_nascimento,
            'telefone' => $dados_usuario->telefone
        ];

        $dados_view = $this->dadosShow('Altera Conta', 'assets/css/styleConfig.css');
        $view = $this->load->view('/pages/config-dados', $dados, true);

        $this->show($dados_view, $view, true);
    }

    public function edit() {
        header('Content-Type: application/json');
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        // $this->form_validation->set_rules('senha', 'Senha', 'required');
        // $this->form_validation->set_rules('foto_usuario', 'foto_usuario', 'required');
        $this->form_validation->set_rules('nome_usuario', 'nome_usuario', 'required');
        $this->form_validation->set_rules('telefone', 'telefone', 'required');
        $this->form_validation->set_rules('data_nascimento', 'data_nascimento', 'required');
        // $this->form_validation->set_rules('sexo_usuario', 'sexo_usuario', 'required');
        
        if($this->form_validation->run()){
            $dados_cadastro = [
                //usuário
                "email" => $this->input->post('email'),
                // "senha" => $this->input->post('senha'),
                // "foto_usuario" => $this->uploadFotoUsuario($this->input->post('email')),
                "nome_usuario" => $this->input->post('nome_usuario'),
                "telefone" => $this->input->post('telefone'),
                // "sexo_usuario" => $this->input->post('sexo_usuario'),
                "data_nascimento" => $this->input->post('data_nascimento')
            ];
        }

        $this->load->model('UsuariosModel');
        if($this->UsuariosModel->alterarDadosModel($this->id_usuario, $dados_cadastro)){
            echo json_encode(['mensagem'=>'Dados Alterados com sucesso.']);
        }else{
            echo json_encode(['mensagem'=>'Erro ao alterar dados']);
        }
    }

    public function deletaContaView() {
        $dados = $this->dadosShow('Deletar Conta', 'assets/css/styleConfig.css');
        $view = $this->load->view('/pages/config-excluir', null, true);

        $this->show($dados, $view, true);
    }

    public function delete() {
        header('Content-Type: application/json');
        
        $this->load->model('UsuariosModel');
        if($this->UsuariosModel->deleteModel($this->id_usuario)){
            echo json_encode(['mensagem'=>'Conta excluida com sucesso.']);
            $this->destroySession();
        }else{
            echo json_encode(['mensagem'=>'Erro ao deletar']);
        }
        
    }

    /**
     * DADOS PET 
     * create, edit & delete
     */

    public function petDadosView() {
        $dados_view = $this->dadosShow('Pet Dados', 'assets/css/styleConfig.css');
        

        $this->load->model('PetsModel');
        $dados_pet = $this->PetsModel->getDadosPetModel($this->id_usuario);
        $dados_pet = $dados_pet[0];
        
        $this->load->model('CadastrosModel');
        $sexo = $this->CadastrosModel->getSexoModel();
        $tipo = $this->CadastrosModel->getTipoModel();
        
        $dados = [
            'id_animal' => $dados_pet->id_animal,
            'id_usuario' => $this->id_usuario,
            'nome_animal' => $dados_pet->nome_animal,
            'foto_animal' => $dados_pet->foto_animal,
            'sexo' => $sexo,
            'tipo' => $tipo
        ];

        $view = $this->load->view('/pages/config-pet', $dados, true);

        $this->show($dados_view, $view, true);
    }

    public function createPet() {
        header('Content-Type: application/json');
        $this->load->library('form_validation');
        
        // $this->form_validation->set_rules('foto_animal', 'foto_animal', 'required');
        $this->form_validation->set_rules('nome_animal', 'nome_animal', 'required');
        $this->form_validation->set_rules('tipo', 'tipo', 'required');
        $this->form_validation->set_rules('raca', 'raca');
        $this->form_validation->set_rules('sexo_animal', 'sexo_animal', 'required');

        if($this->form_validation->run()){
            $dados_cadastro = [
                //animal
                // "foto_animal" => $this->input->post('foto_animal'),
                "nome_animal" => $this->input->post('nome_animal'),
                "tipo" => $this->input->post('tipo'),
                "raca" => $this->input->post('raca'),
                "sexo_animal" => $this->input->post('sexo_animal'),
            ];
            
            $this->load->model('CadastrosModel');
            $verifica_cadastro = $this->CadastrosModel->cadastroPetModel($dados_cadastro);
         
            if($verifica_cadastro){
                echo json_encode(['mensagem'=>'Pet cadastrado com sucesso !']);
            }else{
                echo json_encode(['mensagem'=>'Erro ao cadastrar.']);
            }
        }else{ //caso a validação do formulário der erro, volta para página de login
            echo json_encode(['mensagem'=>'Erro no formulário']);
        }
    }

    public function editPet() {
        header('Content-Type: application/json');
        $this->load->library('form_validation');
        
        // $this->form_validation->set_rules('foto_animal', 'foto_animal', 'required');
        $this->form_validation->set_rules('nome_animal', 'nome_animal', 'required');
        $this->form_validation->set_rules('tipo', 'tipo', 'required');
        $this->form_validation->set_rules('raca', 'raca');
        $this->form_validation->set_rules('sexo_animal', 'sexo_animal', 'required');

        if($this->form_validation->run()){
            $dados_cadastro = [
                //animal
                // "foto_animal" => $this->input->post('foto_animal'),
                "nome_animal" => $this->input->post('nome_animal'),
                "tipo" => $this->input->post('tipo'),
                "raca" => $this->input->post('raca'),
                "sexo_animal" => $this->input->post('sexo_animal'),
            ];
            
            $this->load->model('PetModel');
            $verifica_cadastro = $this->PetModel->alterarDadosPetModel($this->id_animal,$dados_cadastro);
         
            if($verifica_cadastro){
                echo json_encode(['mensagem'=>'Pet alterado com sucesso !']);
            }else{
                echo json_encode(['mensagem'=>'Erro ao alterar.']);
            }
        }else{ //caso a validação do formulário der erro, volta para página de login
            echo json_encode(['mensagem'=>'Erro no formulário']);
        }
    }

    public function deletePet() {
        header('Content-Type: application/json');
        
        $this->load->model('PetsModel');
        if($this->PetsModel->deleteModel($this->id_animal)){
            echo json_encode(['mensagem'=>'Pet excluido com sucesso.']);
            $this->destroySession();
        }else{
            echo json_encode(['mensagem'=>'Erro ao deletar']);
        }
        
    }

}
