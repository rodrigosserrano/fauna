<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends Fauna_Controller {

    public function __construct()
    {
        parent::__construct();
            $this->verifySession();
    }

    public function index() {
        
        $id = $_SESSION['id'];
        $this->load->model('UsuariosModel');
        $dados['dados_usuario'] = $this->UsuariosModel->getDadosUsuarioModel($id);

        $dados_view = $this->dadosShow('Altera Conta', 'assets/css/styleConfig.css');
        $view = $this->load->view('/pages/config-dados', $dados, true);

        $this->show($dados_view, $view, true);
    }

    public function edit() {
        header('Content-Type: application/json');
        
        $id = $_SESSION['id'];
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('senha', 'Senha', 'required');
        // $this->form_validation->set_rules('foto_usuario', 'foto_usuario', 'required');
        $this->form_validation->set_rules('nome_usuario', 'nome_usuario', 'required');
        $this->form_validation->set_rules('telefone', 'telefone', 'required');
        $this->form_validation->set_rules('data_nascimento', 'data_nascimento', 'required');
        // $this->form_validation->set_rules('sexo_usuario', 'sexo_usuario', 'required');
        
        if($this->form_validation->run()){
            $dados_cadastro = [
                //usuário
                "email" => $this->input->post('email'),
                "senha" => $this->input->post('senha'),
                // "foto_usuario" => $this->uploadFotoUsuario($this->input->post('email')),
                "nome_usuario" => $this->input->post('nome_usuario'),
                "telefone" => $this->input->post('telefone'),
                // "sexo_usuario" => $this->input->post('sexo_usuario'),
                "data_nascimento" => $this->input->post('data_nascimento')
            ];
        }

        $this->load->model('UsuariosModel');
        if($this->UsuariosModel->alterarDadosModel($id, $dados_cadastro)){
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
        
        $id = $_SESSION['id'];
        
        $this->load->model('UsuariosModel');
        if($this->UsuariosModel->deleteModel($id)){
            echo json_encode(['mensagem'=>'Conta excluida com sucesso.']);
            $this->destroySession();
        }else{
            echo json_encode(['mensagem'=>'Erro ao deletar']);
        }
        
    }

}
