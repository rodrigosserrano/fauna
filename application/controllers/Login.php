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
        }else{
            $this->index();
        }
    }
}
