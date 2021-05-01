<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends Fauna_Controller {    

    public function __construct()
    {
        parent::__construct();
        $this->verifySession();

        $this->id_usuario = $_SESSION['id'];
        $this->id_animal = isset($_POST['id_animal']) ? $_POST['id_animal'] : '';
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
        
        $this->load->model('CadastrosModel');
        $sexo = $this->CadastrosModel->getSexoModel();
        $sexo = array_slice($sexo, 0, 2);

        $tipo = $this->CadastrosModel->getTipoModel();

        if(!empty($dados_pet)){
            $dados_pet = $dados_pet[0];
            
            $dados = [
                'id_animal' => $dados_pet->id_animal,
                'id_usuario' => $this->id_usuario,
                'nome_animal' => $dados_pet->nome_animal,
                'foto_animal' => $dados_pet->foto_animal,
                'sexo' => $sexo,
                'tipo' => $tipo,
                'mensagem' => ''
            ];
        }else{
            $dados = [
                'mensagem' => 'Você não possuí pets.',
                'id_animal' => '',
                'id_usuario' => '',
                'nome_animal' => '',
                'foto_animal' => '',
                'sexo' => $sexo,
                'tipo' => $tipo
            ];
        }


        $view = $this->load->view('/pages/config-pet', $dados, true);

        $this->show($dados_view, $view, true);
    }

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
        $this->form_validation->set_rules('id_usuario', 'id_usuario');
        $this->form_validation->set_rules('id_animal', 'id_animal');
        $this->form_validation->set_rules('nome_animal', 'nome_animal', 'required');
        

        if($this->form_validation->run()){
            $dados_cadastro = [
                //animal
                // "foto_animal" => $this->input->post('foto_animal'),
                "id_usuario" => $this->input->post('id_usuario'),
                "id_animal" => $this->input->post('id_animal'),
                "nome_animal" => $this->input->post('nome_animal')
            ];
            
            $this->load->model('PetsModel');
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

        $this->load->model('PetsModel');
        if($this->PetsModel->deletePetModel($this->id_animal)){
            echo json_encode(['mensagem'=>'Pet excluido com sucesso. ' . $this->id_animal]);
        }else{
            echo json_encode(['mensagem'=>'Erro ao deletar']);
        }
        
    }

<<<<<<< HEAD
      /**
     * DADOS Postagem 
     * create, edit & delete
     */

    public function PostagemView() {
        $dados_view = $this->dadosShow('Postagem', 'assets/css/styleConfig.css');
        

        $this->load->model('PostagemModel');
        $dados_postagem = $this->PostagemModel->getDadosPostagemModel();
        
        if(!empty($dados_postagem)){
            $dados_postagem = $dados_postagem[0];
            
            $dados = [
                'id_postagem' => $dados_postagem->id_postagem,
                'id_usuario' => $dados_postagem->id_usuario,
                'id_animal' => $dados_postagem->id_animal,
                'id_categoria' => $dados_postagem->id_categoria,
                'descricao' => $dados_postagem->descricao,
                'dh_postagem' => $dados_postagem->dh_postagem,
                'midia' => $dados_postagem->midia,
                'mensagem' => ''
            ];
        }else{
            $dados = [
                'mensagem' => 'Não Existem Postagens.',
                'id_postagem' => '',
                'id_usuario' => '',
                'id_animal' => '',
                'id_categoria' => '',
                'descricao' => '',
                'dh_postagem' => '',
                'midia' => ''
            ];
        }

        // Inserir Pagina do FEED
        // $view = $this->load->view('/pages/config-pet', $dados, true);

        $this->show($dados_view, $view, true);
    }

    public function createPostagem() {
        header('Content-Type: application/json');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('id_postagem', 'id_postagem');
        $this->form_validation->set_rules('id_usuario', 'id_usuario');
        $this->form_validation->set_rules('id_animal', 'id_animal');
        $this->form_validation->set_rules('id_categoria', 'id_categoria');
        // Não sei se vai precisar pq o banco dados preenche  o campo com a  hr do Crud
        //$this->form_validation->set_rules('dh_postagem', 'dh_postagem', 'required');
        $this->form_validation->set_rules('descricao', 'descricao', 'required');
        // $this->form_validation->set_rules('midia', 'midia', 'required');

        if($this->form_validation->run()){
            $dados_cadastro = [
                //animal
                // "foto_animal" => $this->input->post('foto_animal'),
                "id_usuario" => $this->id_usuario,
                "id_animal" => $this->input->post('id_animal'),
                "id_tipo" => $this->input->post('tipo'),
                "dh_postagem" => new DateTime(), //  verificar se a função está correta  
                "descricao" => $this->input->post('descricao'),
                // "midia" => $this->input->post('midia')
            ];
            
            $this->load->model('PostagemModel');
            $verifica_cadastro = $this->PostagemModel->cadastroPostagemModel($dados_cadastro);
    
            if($verifica_cadastro){
                echo json_encode(['mensagem'=>'Postagem feita com sucesso !']);
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
        $this->form_validation->set_rules('id_usuario', 'id_usuario');
        $this->form_validation->set_rules('id_animal', 'id_animal');
        $this->form_validation->set_rules('descricao', 'descricao', 'required');
        $this->form_validation->set_rules('midia', 'midia', 'required');
        

        if($this->form_validation->run()){
            $dados_cadastro = [
    
                // "midia" => $this->input->post('midia'),
                "id_usuario" => $this->input->post('id_usuario'),
                "id_animal" => $this->input->post('id_animal'),
                "descricao" => $this->input->post('descricao')
            ];
            
            $this->load->model('PostagemModel');
            $verifica_cadastro = $this->PostagemModel->alterarDadosPostagemModel($dados_cadastro);
         
            if($verifica_cadastro){
                echo json_encode(['mensagem'=>'Postagem alterado com sucesso !']);
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
        $this->form_validation->set_rules('id_usuario', 'id_usuario');
        $this->form_validation->set_rules('texto', 'texto', 'required');
        // Não sei se vai precisar pq o banco dados preenche  o campo com a  hr do Crud
        //$this->form_validation->set_rules('dh_comentario', 'dh_comentario', 'required');

        if($this->form_validation->run()){
            $dados_cadastro = [
                "id_usuario" => $this->id_usuario,
                "id_postagem" => $this->input->post('id_postagem'),
                "dh_comentario" => new DateTime(), //  verificar se a função está correta  
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


=======
    public function viewTeste() {
        $dados = $this->dadosShow('Configurações do Usuário', 'assets/css/styleConfig.css', 'assets/js/userConfig.js');
		$view = $this->load->view('pages/userConfigIdeia2', null, true);
        $this->show($dados, $view);
    }

>>>>>>> 69cb8beb5fffc78c5f6977164f3ced9c898b93c4
}
