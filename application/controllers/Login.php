<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

    public function validateLogin()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'required');
        $this->form_validation->set_rules('password', 'Senha', 'required');

        if($this->form_validation->run()){
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            
            $this->load->model('UsuariosModel');
            $result_validate = $this->UsuariosModel->validateLoginModel($email, $password);
            
            if($result_validate){
                print_r('caiu aqui');
                $session_data = [
                    'id' => $$result_validate['id'],
                    'email' => $$result_validate['email'],
                    'usuario' => $$result_validate['nome_usuario'],
                    'nivel_usuario' => $$result_validate['nivel_usuario']
                ];

                $this->session->set_userdata($session_data);
                redirect('http://google.com');
            }else{
                $this->session->set_flashdata('error', 'Login ou senha inválidos.');
            }
        }else{
            $this->index();
        }
    }
}
