<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends Fauna_Controller {

	public function index() {
        /**  verificação pagina home utilizar ele caso esteja logado */
        
		if($this->session->userdata('id')){
			redirect("home");
        } 

        $dados = $this->dadosShow('Login', 'assets/css/styleLogin.css');
		$view = $this->load->view('pages/Login', null, true);

        $this->show($dados, $view);
	}

    public function validateLogin() {
        header('Content-Type: application/json');
        // Validação do que vem do formulário   
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
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

                $this->createSession($session_data);

                echo json_encode(['mensagem'=>'Logado com sucesso', 'is_logado'=>true]);
            }else{ // se os dados estiverem incorretos, retorna mensagem de erro
                echo json_encode(['mensagem'=>'E-mail ou senha inválidos.', 'is_logado'=>false]);
            }
        }else{ //caso a validação do formulário der erro, volta para página de login
            echo json_encode(['mensagem'=>'Preencha corretamente o formulário', 'is_logado'=>false]);
        }
    }

    public function logout(){
        header('Content-Type: application/json');

        if($this->session->has_userdata('id')){
            $this->destroySession();
            echo json_encode(['mensagem'=>'Até mais !']);
        }else{
            echo json_encode(['mensagem'=>'Você não está logado.']);
        }
    }

    public function forgotPasswordPage(){
        $dados_view = $this->dadosShow('Recuperar senha', 'assets/css/stylePassword.css');
		$view = $this->load->view('pages/forgotPassword', null, true);

        $this->show($dados_view, $view);
    }
}
