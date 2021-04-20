<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends Fauna_Controller {

    protected $session_data;

	public function index() {
        /**  verificação pagina home utilizar ele caso esteja logado */
        
		// if($this->session->userdata("id")){
		// 	redirect("home");
        // } 

        /**                 | OBRIGATÓRIO |  |  NÃO OBRIGATÓRIO  |
         * $this->dadosShow('titulo_pagina', 'link_css', 'link_js') */

         /**            |DADOS| |VIEW| |TRUE/FALSE|
         * $this->show($dados, $view, $navbar); */


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
                
                echo json_encode(['mensagem'=>'Logado com sucesso']);
            }else{ // se os dados estiverem incorretos, retorna mensagem de erro
                $this->session->set_flashdata('error', 'Login ou senha inválidos.');
                echo json_encode(['mensagem'=>'Erro ao logar']);
            }
        }else{ //caso a validação do formulário der erro, volta para página de login
            echo json_encode(['mensagem'=>'Erro no formulário']);
        }
    }

}
