<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends Fauna_Controller {

    public function __construct()
    {
        parent::__construct();
            $this->verifySession();
    }

    public function index() {
        $dados = $this->dadosShow('Dados Conta', 'assets/css/styleConfig.css');
        $view = $this->load->view('/pages/config-dados', null, true);

        $this->show($dados, $view, true);
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

    public function alteraContaView() {
        $dados = $this->dadosShow('Altera Conta', 'assets/css/styleConfig.css');
        $view = $this->load->view('/pages/config-alterar', null, true);

        $this->show($dados, $view, true);
    }

}
