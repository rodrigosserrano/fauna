<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends Fauna_Controller {    

    public function __construct()
    {
        parent::__construct();
        $this->verifySession();

        $this->id_usuario = $_SESSION['id'];
        $this->id_animal = isset($_POST['id_animal']) ? $_POST['id_animal'] : '';
        $this->id_usuario_2 = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : '';

        $this->load->model('UsuariosModel');
        $this->load->model('PetsModel');
        $this->load->model('CadastrosModel');
        $this->load->model('SeguirModel');
        $this->load->helper('Tools');
    }

    public function index() {

        $dados_view = $this->dadosShow('Altera Conta', 'assets/css/styleConfig.css', 'assets/js/userConfig.js');
        $view = $this->load->view('/pages/Settings', null, true);

        $this->show($dados_view, $view, true);
    }

    public function getSettingsRequest() {
        header('Content-Type: application/json');
        
        $sexo = $this->CadastrosModel->getSexoModel();
        $tipo = $this->CadastrosModel->getTipoModel();
        
        $sexo = array_slice($sexo, 0, 2);

        $dados_usuario = $this->UsuariosModel->getDadosUsuarioModel($this->id_usuario);
        $dados_usuario = toArray($dados_usuario);

        $dados_pet = $this->PetsModel->getDadosPetModel($this->id_usuario);
        
        $usuario = [
            'email' => $dados_usuario->email,
            'nome_usuario' => $dados_usuario->nome_usuario,
            'data_nascimento' => $dados_usuario->data_nascimento,
            'telefone' => $dados_usuario->telefone,
            'foto_usuario' => $dados_usuario->foto_usuario
        ];

        if(!empty($dados_pet)){
            $mensagem = 'Você não possui pets';
        }
        
        $dados = [
            'usuario' => $usuario,
            'pet' => $dados_pet,
            'mensagem' =>  isset($mensagem),
            'sexo' => $sexo,
            'tipo' => $tipo
        ];
    
        echo json_encode($dados);
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
                "foto_usuario" => $this->uploadImage($_FILES['foto_usuario'], $this->input->post('email'), 'user'),
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
            
            $dados_view = [
                'usuario' => (object) $usuario,
                'pet' => $dados_pet,
                'n_seguindo' => $this->SeguirModel->countSeguirModel($this->id_usuario,true),
                'seguindo' => $this->SeguirModel->getDadosSeguirModel($this->id_usuario,true),
                'n_seguidores' => $this->SeguirModel->countSeguirModel($this->id_usuario,null, true),
                'seguidores' => $this->SeguirModel->getDadosSeguirModel($this->id_usuario,null,true)
            ];

            $dados = $this->dadosShow('Perfil', 'assets/css/styleProfile.css', 'assets/js/profile_scripts.js');
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
        $this->form_validation->set_rules('nome_animal', 'nome_animal', 'required');
        $this->form_validation->set_rules('tipo', 'tipo', 'required');
        $this->form_validation->set_rules('raca', 'raca');
        $this->form_validation->set_rules('sexo_animal', 'sexo_animal', 'required');

        if($this->form_validation->run()){
            $usuario = $this->UsuariosModel->returnDadosTratadoUserModel($this->id_usuario);

            $dados_cadastro = [
                //animal
                "foto_animal" => $this->uploadImage($_FILES['foto_animal'], $usuario['email_user'], 'pet'),
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
                "foto_animal" => $this->uploadImage($_FILES['foto_animal'], $usuario['email_user'], 'pet'),
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
     * DADOS SEGUIR 
     * create, edit & delete
     */

     public function createSeguidores(){
        if($this->SeguirModel->createSeguirModel($this->id_usuario, $this->id_usuario_2)){
            echo json_encode(['mensagem'=>'Usuario seguido com sucesso.']);
        }else{
            echo json_encode(['mensagem'=>'Erro ao seguir usuario.']);
        }
     }

     public function  deleteSeguidor(){
        if($this->SeguirModel->deleteSeguirModel($this->id_usuario, null , $this->id_usuario_2)){
            echo json_encode(['mensagem'=>'Seguidor Excluido com sucesso.']);
        }else{
            echo json_encode(['mensagem'=>'Erro ao excluir seguidor usuario.']);
        }
     }

     public function  deleteSeguindo(){
        if($this->SeguirModel->deleteSeguirModel($this->id_usuario, $this->id_usuario_2)){
            echo json_encode(['mensagem'=>'Você deixou de seguir o usuario selecionado.']);
        }else{
            echo json_encode(['mensagem'=>'Erro ao deixar de seguir usuario.']);
        }
     }
    
}
