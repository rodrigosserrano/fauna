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

    function send($email, $senha) {
        $this->load->config('email');
        $this->load->library('email');

        $this->load->model('UsuariosModel.php');

        $senha  = md5(time());

        if($this->UsuariosModel->alterarSenhaModel($email, $senha)){

            $from = $this->config->item('smtp_user');
            $to = $email;
            $subject = 'Solicitação de alteração de senha';
            $message = 'Sua senha agora é' + $senha;
    
            $this->email->set_newline("\r\n");
            $this->email->from($from);
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($message);
    
            if ($this->email->send()) {
                echo 'Seu Email foi enviado com sucesso.';
            } else {
                show_error($this->email->print_debugger());
            }
        }
        }
        

}
