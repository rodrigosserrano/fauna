<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function index() {
        // if(isset($_SESSION['id'])) {
        //     header('location: https://google.com');
        // } verificação pagina home utilizar ele caso esteja logado 
        $dados['title'] = 'Login';
        $dados['style'] = base_url().'assets/css/styleLogin.css';

        $this->load->view('template/header', $dados);
        $this->load->view('template/nav');
		$this->load->view('usuarios/login');
	}

    public function validateLogin() {
        header('Content-Type: application/json');
        // Validação do que vem do formulário   
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'required');
        $this->form_validation->set_rules('senha', 'Senha', 'required');

        if($this->form_validation->run()){
            $email = $this->input->post('email');
            $senha = $this->input->post('senha');
            
            $this->load->model('UsuariosModel');
            $result_validate = $this->UsuariosModel->validateLoginModel($email, $senha);
            
            //valida se o usuário existe na base, se existe, 
            //salva alguns dados na sessão e redireciona para home
            if($result_validate){
                $session_data = [
                    'id' => $result_validate[0]->id_usuario,
                    'email' => $result_validate[0]->email,
                    'usuario' => $result_validate[0]->nome_usuario,
                    'nivel_usuario' => $result_validate[0]->nivel_usuario
                ];

                $this->session->set_userdata($session_data);
                echo json_encode(['mensagem'=>'Logado com sucesso']);
            }else{ // se os dados estiverem incorretos, retorna mensagem de erro
                $this->session->set_flashdata('error', 'Login ou senha inválidos.');
                echo json_encode(['mensagem'=>'Erro ao logar']);
            }
        }else{ //caso a validação do formulário der erro, volta para página de login
            echo json_encode(['mensagem'=>'Erro no formulário']);
        }
    }

    public function registerPage() {
        $dados['title'] = 'Cadastrar-se';
        $dados['style'] = base_url().'assets/css/styleRegister.css';

        $this->load->view('template/header', $dados);
        $this->load->view('usuarios/registrar');
    }

    public function cadastroUsuarioPet() {
        header('Content-Type: application/json');
        // Validação do que vem do formulário usuario
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'required');
        $this->form_validation->set_rules('senha', 'Senha', 'required');
        $this->form_validation->set_rules('repetir-senha', 'repetir-Senha', 'required');
        $this->form_validation->set_rules('foto_usuario', 'foto_usuario', 'required');
        $this->form_validation->set_rules('nome_usuario', 'nome_usuario', 'required');
        $this->form_validation->set_rules('telefone', 'telefone', 'required');
        $this->form_validation->set_rules('data_nascimento', 'data_nascimento', 'required');
        $this->form_validation->set_rules('sexo_usuario', 'sexo_usuario', 'required');

        // Validação do que vem do formulário pet
        $this->form_validation->set_rules('foto_animal', 'foto_animal', 'required');
        $this->form_validation->set_rules('nome_animal', 'nome_animal', 'required');
        $this->form_validation->set_rules('tipo', 'tipo', 'required');
        $this->form_validation->set_rules('raca', 'raca', 'required');
        $this->form_validation->set_rules('sexo_animal', 'sexo_animal', 'required');

        if($this->form_validation->run()){
            $dados_cadastro = [
                //usuário
                "email" => $this->input->post('email'),
                "senha" => $this->input->post('senha'),
                "repetir_senha" => $this->input->post('repetir-senha'),
                "foto_usuario" => $this->input->post('foto_usuario'),
                "nome_usuario" => $this->input->post('nome_usuario'),
                "telefone" => $this->input->post('telefone'),
                "sexo_usuario" => $this->input->post('sexo_usuario'),
                "data_nascimento" => $this->input->post('data_nascimento'),
                //animal
                "foto_animal" => $this->input->post('foto_animal'),
                "nome_animal" => $this->input->post('nome_animal'),
                "tipo" => $this->input->post('tipo'),
                "raca" => $this->input->post('raca'),
                "sexo_animal" => $this->input->post('sexo_animal'),
            ];
            
            $this->load->model('CadastroModel');
            $verifica_cadastro = $this->CadastrodModel->verificaCadastroModel($dados_cadastro['email']);
            $verifica_cadastro = $verifica_cadastro ? $this->CadastrosModel->cadastroModel($dados_cadastro) : $verifica_cadastro['bn'] = false;
         
            if($verifica_cadastro['bn']){
                echo json_encode(['mensagem'=>$verifica_cadastro['mensagem']]);
            }
        }else{ //caso a validação do formulário der erro, volta para página de login
            echo json_encode(['mensagem'=>'Erro no formulário']);
        }
    }
}
