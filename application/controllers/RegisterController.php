<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterController extends Fauna_Controller {

    public function __construct(){
        parent::__construct();
        
    }

    public function index() {
        /**                 | OBRIGATÓRIO |  |  NÃO OBRIGATÓRIO  |
         * $this->dadosShow('titulo_pagina', 'link_css', 'link_js') */
        
        /**            |DADOS| |VIEW| |TRUE/FALSE|
         * $this->show($dados, $view, $navbar); */
        $this->load->model('CadastrosModel');
        $sexo = $this->CadastrosModel->getSexoModel();
        
        $tipo = $this->CadastrosModel->getTipoModel();

        $dados = [
            'sexo'=>$sexo,
            'tipo'=>$tipo
        ];

        $dados_view = $this->dadosShow('Cadastrar-se', 'assets/css/styleRegister.css', "assets/js/register_scripts.js");
		$view = $this->load->view('pages/Register', $dados, true);
        $this->show($dados_view, $view);
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
        $this->form_validation->set_rules('raca', 'raca');
        $this->form_validation->set_rules('sexo_animal', 'sexo_animal', 'required');

        if($this->form_validation->run()){
            $this->createLocalUpload($this->input->post('email'));

            $dados_cadastro = [
                //usuário
                "email" => $this->input->post('email'),
                "senha" => $this->input->post('senha'),
                "repetir_senha" => $this->input->post('repetir_senha'),
                "foto_usuario" => $this->uploadImage($_FILES['foto_usuario'], $this->input->post('email'), 'user'),
                "nome_usuario" => $this->input->post('nome_usuario'),
                "telefone" => $this->input->post('telefone'),
                "sexo_usuario" => $this->input->post('sexo_usuario'),
                "data_nascimento" => $this->input->post('data_nascimento'),

                //animal
                "foto_animal" => $this->uploadImage($_FILES['foto_animal'], $this->input->post('email'), 'pet'),
                "nome_animal" => $this->input->post('nome_animal'),
                "tipo" => $this->input->post('tipo'),
                "raca" => $this->input->post('raca'),
                "sexo_animal" => $this->input->post('sexo_animal'),
            ];
            
// /** */      print_r($dados_cadastro);
// /** */      die();
            $this->load->model('CadastrosModel');
            $verifica_cadastro = $this->CadastrosModel->verificaCadastroModel($dados_cadastro['email']);
            $verifica_cadastro = $verifica_cadastro ? $this->CadastrosModel->cadastroModel($dados_cadastro) : $verifica_cadastro = false;
         
            if($verifica_cadastro){
                echo json_encode(['error'=> 0, 'mensagem'=>'Cadastrado com sucesso !']);
            }else{
                echo json_encode(['error'=> 1, 'mensagem'=>'Erro ao cadastrar.']);
            }
        }else{ //caso a validação do formulário der erro, volta para página de login
            echo json_encode(['mensagem'=>'Erro no formulário']);
        }
    } 



}