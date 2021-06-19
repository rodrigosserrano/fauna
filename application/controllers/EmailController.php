<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailController extends Fauna_Controller {

    public function __construct() {
        parent:: __construct();

        $this->load->helper('url');
    }

    public function index() {
        $this->load->view('email/contact');
    }

    function send() {
        // Receber o email do front
        header('Content-Type: application/json');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');

        if($this->form_validation->run()){
            $email = $this->input->post('email');

            // Configurar o email
            $this->load->config('email');
            $this->load->library('email');

            $this->load->model('UsuariosModel');

            $senha = md5(time());

            if( $this->UsuariosModel->alterarSenhaModel($email, md5($senha)) ) {
                $from = $this->config->item('smtp_user');
                $to = $email;
                $subject = 'Solicitação de alteração de senha';
                $message = 'Sua senha foi alterada para ' . $senha;
        
                $this->email->set_newline("\r\n");
                $this->email->from($from);
                $this->email->to($to);
                $this->email->subject($subject);
                $this->email->message($message);
        
                if ($this->email->send()) {
                    // echo 'Seu email foi enviado com sucesso.';
                    echo json_encode(['mensagem'=>'Seu email foi enviado com sucesso.']);
                } else {
                    // show_error($this->email->print_debugger());
                    echo json_encode(['mensagem'=>'Erro.']);
                }
            } else {
                echo json_encode(['mensagem'=>'Email não cadastrado.']);
            }
        } else {
            echo json_encode(['mensagem'=>'Email inválido.']);
        }

    }
        

}
