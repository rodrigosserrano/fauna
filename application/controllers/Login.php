<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		$this->load->view('welcome_message');
	}

    public function validateLogin() {
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
                redirect(base_url().'home');
            }else{ // se os dados estiverem incorretos, retorna mensagem de erro
                $this->session->set_flashdata('error', 'Login ou senha inválidos.');
            }
        }else{ //caso a validação do formulário der erro, volta para página de login
            $this->index();
        }
    }
}
