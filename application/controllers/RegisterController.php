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