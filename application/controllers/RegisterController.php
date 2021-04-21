<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterController extends Fauna_Controller {

public function index() {
        /**                 | OBRIGATÓRIO |  |  NÃO OBRIGATÓRIO  |
         * $this->dadosShow('titulo_pagina', 'link_css', 'link_js') */
        
        /**            |DADOS| |VIEW| |TRUE/FALSE|
         * $this->show($dados, $view, $navbar); */


        $dados = $this->dadosShow('Cadastrar-se', 'assets/css/styleRegister.css');
		$view = $this->load->view('pages/Register', null, true);
        $this->show($dados, $view);
    }
    //Validação de registro Usuário e pet --- PRIMEIRO REGISTRO
    public function validateRegister() {
        header('Content-Type: application/json');
        // Validação do que vem do formulário usuario
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('senha', 'Senha', 'required');
        $this->form_validation->set_rules("repetir_senha', 'repetir-Senha', 'required|matches['senha']");
        // $this->form_validation->set_rules('foto_usuario', 'foto_usuario', 'required');
        $this->form_validation->set_rules('nome_usuario', 'nome_usuario', 'required');
        $this->form_validation->set_rules('telefone', 'telefone', 'required');
        $this->form_validation->set_rules('data_nascimento', 'data_nascimento', 'required');
        $this->form_validation->set_rules('sexo_usuario', 'sexo_usuario', 'required');

        // Validação do que vem do formulário pet
        // $this->form_validation->set_rules('foto_animal', 'foto_animal', 'required');
        $this->form_validation->set_rules('nome_animal', 'nome_animal', 'required');
        $this->form_validation->set_rules('tipo', 'tipo', 'required');
        $this->form_validation->set_rules('raca', 'raca', 'required');
        $this->form_validation->set_rules('sexo_animal', 'sexo_animal', 'required');

        if($this->form_validation->run()){
            $dados_cadastro = [
                //usuário
                "email" => $this->input->post('email'),
                "senha" => $this->input->post('senha'),
                "repetir_senha" => $this->input->post('repetir_senha'),
                // "foto_usuario" => $this->uploadFotoUsuario($this->input->post('email')),
                "nome_usuario" => $this->input->post('nome_usuario'),
                "telefone" => $this->input->post('telefone'),
                "sexo_usuario" => $this->input->post('sexo_usuario'),
                "data_nascimento" => $this->input->post('data_nascimento'),

                //animal
                // "foto_animal" => $this->input->post('foto_animal'),
                "nome_animal" => $this->input->post('nome_animal'),
                "tipo" => $this->input->post('tipo'),
                "raca" => $this->input->post('raca'),
                "sexo_animal" => $this->input->post('sexo_animal'),
            ];
            
            $this->load->model('CadastrosModel');
            $verifica_cadastro = $this->CadastrosModel->verificaCadastroModel($dados_cadastro['email']);
            $verifica_cadastro = $verifica_cadastro ? $this->CadastrosModel->cadastroModel($dados_cadastro) : $verifica_cadastro = false;
         
            if($verifica_cadastro){
                echo json_encode(['mensagem'=>'Cadastrado com sucesso !']);
            }else{
                echo json_encode(['mensagem'=>'Erro ao cadastrar.']);
            }
        }else{ //caso a validação do formulário der erro, volta para página de login
            echo json_encode(['mensagem'=>'Erro no formulário']);
        }
    }
    //falta mexer MUITA coisa ainda
    public function uploadFotoUsuario($email){

        $foto_usuario = $_FILES['foto_usuario'];
        $extensao = strtolower(substr($_FILES['foto_usuario']['name'], -4));
        $nomefoto = md5(time()).$extensao;

        $config = array(
            'upload_path'   => base_url().'assets/img/user/'.$email,
            'allowed_types' => 'png|jpg',
            'file_name'     => $nomefoto,
        );
        if(!$config['upload_path']){
            mkdir($config['upload_path']);
        }

        $this->load->library('upload');
        $this->upload->initialize($config);

        if ($this->upload->do_upload('foto_usuario')) {
            return $foto_usuario;
        }
        else {
            return false;
        }
    }
}