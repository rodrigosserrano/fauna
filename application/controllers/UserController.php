<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends Fauna_Controller {    

    public function __construct()
    {
        parent::__construct();
        $this->verifySession();

        $this->id_usuario = $_SESSION['id'];
        $this->id_animal = isset($_POST['id_animal']) ? $_POST['id_animal'] : '';

        $this->load->model('UsuariosModel');
        $this->load->model('PetsModel');
        $this->load->model('CadastrosModel');
    }

    public function index() {
        $sexo = $this->CadastrosModel->getSexoModel();
        $sexo = array_slice($sexo, 0, 2);
        $tipo = $this->CadastrosModel->getTipoModel();

        $dados_usuario = $this->UsuariosModel->getDadosUsuarioModel($this->id_usuario);
        $dados_usuario = $dados_usuario[0];

        $dados_pet = $this->PetsModel->getDadosPetModel($this->id_usuario);
        
        $usuario = [
            'email' => $dados_usuario->email,
            'nome_usuario' => $dados_usuario->nome_usuario,
            'data_nascimento' => $dados_usuario->data_nascimento,
            'telefone' => $dados_usuario->telefone,
            'foto_usuario' => $dados_usuario->foto_usuario
        ];

        if(!empty($dados_pet)){
            $mensagem = '';
            //$dados_pet = $dados_pet[0];
            
            // $pet = [
            //     'id_animal' => $dados_pet->id_animal,
            //     'id_usuario' => $this->id_usuario,
            //     'nome_animal' => $dados_pet->nome_animal,
            //     'foto_animal' => $dados_pet->foto_animal,
            //     'sexo' => $sexo,
            //     'tipo' => $tipo,
            //     'mensagem' => ''
            // ];
        }else{

            $mensagem = 'Você não possui pets';
            $pet = [
                'mensagem' => 'Você não possuí pets.',
                'id_animal' => '',
                'id_usuario' => '',
                'nome_animal' => '',
                'foto_animal' => '',
                'sexo' => $sexo,
                'tipo' => $tipo
            ];
        }
        
        $dados = [
            'usuario' => $usuario,
            'pet' => $dados_pet,
            'mensagem' =>  $mensagem,
            'tipo' => $tipo,
            'sexo' => $sexo
        ];
    
        $dados_view = $this->dadosShow('Altera Conta', 'assets/css/styleConfig.css', 'assets/js/userConfig.js');
        $view = $this->load->view('/pages/Settings', $dados, true);

        $this->show($dados_view, $view, true);
    }

    public function edit() {
        header('Content-Type: application/json');
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        // $this->form_validation->set_rules('senha', 'Senha', 'required');
        $this->form_validation->set_rules('nome_usuario', 'nome_usuario', 'required');
        $this->form_validation->set_rules('telefone', 'telefone', 'required');
        $this->form_validation->set_rules('data_nascimento', 'data_nascimento', 'required');
        // $this->form_validation->set_rules('sexo_usuario', 'sexo_usuario', 'required');
        
        if($this->form_validation->run()){
            $dados_cadastro = [
                //usuário
                "email" => $this->input->post('email'),
                // "senha" => $this->input->post('senha'),
                "foto_usuario" => $this->uploadImage($_FILES['foto_usuario'], $this->input->post('email'), true),
                "nome_usuario" => $this->input->post('nome_usuario'),
                "telefone" => $this->input->post('telefone'),
                // "sexo_usuario" => $this->input->post('sexo_usuario'),
                "data_nascimento" => $this->input->post('data_nascimento')
            ];
        }

        if($this->UsuariosModel->alterarDadosModel($this->id_usuario, $dados_cadastro)){
            echo json_encode(['mensagem'=>'Dados Alterados com sucesso.']);
        }else{
            echo json_encode(['mensagem'=>'Erro ao alterar dados']);
        }
    }

    // public function deletaContaView() {
    //     $dados = $this->dadosShow('Deletar Conta', 'assets/css/styleConfig.css');
    //     $view = $this->load->view('/pages/config-excluir', null, true);

    //     $this->show($dados, $view, true);
    // }

    public function delete() {
        header('Content-Type: application/json');
        
        if($this->UsuariosModel->deleteModel($this->id_usuario)){
            echo json_encode(['mensagem'=>'Conta excluida com sucesso.']);
            $this->destroySession();
        }else{
            echo json_encode(['mensagem'=>'Erro ao deletar']);
        }
        
    }

    // precisa mudar o id default dps
    public function profile($id = false) {
        if(!$id) {
            $id = $this->id_usuario;
        }

        $dados_usuario = $this->UsuariosModel->getDadosUsuarioModel($id);

        if($dados_usuario) {
            $dados_usuario = $dados_usuario[0];

            $dados_pet = $this->PetsModel->getDadosPetModel($id);

            $usuario = [
                'email' => $dados_usuario->email,
                'nome_usuario' => $dados_usuario->nome_usuario,
                'data_nascimento' => $dados_usuario->data_nascimento,
                'telefone' => $dados_usuario->telefone,
                'sexo_usuario' => $dados_usuario->sexo_usuario, 
                'foto_usuario' => $dados_usuario->foto_usuario ? base_url().'assets/img/user/'.$dados_usuario->email.'/'.$dados_usuario->foto_usuario : '',
            ];

            if(!empty($dados_pet)){
                $mensagem = '';
            }else{
                $mensagem = 'Você não possui pets';
            }
            
            $dados_view = [
                'usuario' => (object) $usuario,
                'pet' => $dados_pet,
                'mensagem' =>  $mensagem
            ];

            $dados = $this->dadosShow('Perfil', 'assets/css/styleProfile.css', 'assets/js/profile_scripts');
            $view = $this->load->view('pages/Profile', $dados_view, true);

            $this->show($dados, $view, true);
        } else {
            redirect('home');
        }
        
    }

    /**
     * DADOS PET 
     * create, edit & delete
     */

    public function createPet() {
        header('Content-Type: application/json');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('id_usuario', 'id_usuario');
        // $this->form_validation->set_rules('foto_animal', 'foto_animal', 'required');
        $this->form_validation->set_rules('nome_animal', 'nome_animal', 'required');
        $this->form_validation->set_rules('tipo', 'tipo', 'required');
        $this->form_validation->set_rules('raca', 'raca');
        $this->form_validation->set_rules('sexo_animal', 'sexo_animal', 'required');

        if($this->form_validation->run()){
            $dados_cadastro = [
                //animal
                // "foto_animal" => $this->input->post('foto_animal'),
                "id_usuario" => $this->id_usuario,
                "nome_animal" => $this->input->post('nome_animal'),
                "tipo" => $this->input->post('tipo'),
                "raca" => $this->input->post('raca'),
                "sexo_animal" => $this->input->post('sexo_animal'),
            ];
            
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
        
        $this->form_validation->set_rules('id_usuario', 'id_usuario');
        $this->form_validation->set_rules('id_animal', 'id_animal');
        $this->form_validation->set_rules('nome_animal', 'nome_animal', 'required');
        

        if($this->form_validation->run()){
            $usuario = $this->UsuariosModel->returnDadosTratadoUserModel($this->id_usuario);
            $dados_cadastro = [
                //animal
                "foto_animal" => $this->uploadImage($_FILES['foto_animal'], $usuario['email_user'], false),
                "id_usuario" => $this->input->post('id_usuario'),
                "id_animal" => $this->input->post('id_animal'),
                "nome_animal" => $this->input->post('nome_animal')
            ];
            
            $verifica_cadastro = $this->PetsModel->alterarDadosPetModel($dados_cadastro);
         
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

        if($this->PetsModel->deletePetModel($this->id_animal)){
            echo json_encode(['mensagem'=>'Pet excluido com sucesso.']);
        }else{
            echo json_encode(['mensagem'=>'Erro ao deletar']);
        }
        
    }

      /**
     * DADOS Postagem 
     * create, edit & delete
     */

    
}
