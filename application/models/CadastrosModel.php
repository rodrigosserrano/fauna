<?php

class UsuariosModel extends CI_Model {

    public function verificaCadastroModel($email){
       
        $query = $this->db->where('email',$email)
                          ->get('usuario');

        if($query->num_rows() > 0){

             return false;
          
        }else{
            return true;
        }   
    }

    public function cadastroModel(array $dados_cadastro){

        extract($dados_cadastro);

        if($senha == $repetir_senha){

        $dados_usuario = [  
            'email' => $email, 
            'senha'=> $senha, 
            'foto_usuario' => $foto_usuario, 
            'nome_usuario' =>  $nome_usuario, 
            'telefone' => $telefone, 
            'sexo_usuario' =>  $sexo_usuario,
            'data_nascimento' => $data_nascimento
        ];

        $id_usuario = $this->cadastroUsuarioModel($dados_usuario);

        if($id_usuario){

            $dados_animal = [   
                'id_usuario' => $id_usuario, 
                'foto_animal' => $foto_animal,
                'nome_animal' => $nome_animal, 
                'tipo' => $tipo, 
                'raca' => $raca,
                'sexo_animal' => $sexo_animal
            ];

            if($this->cadastroPetModel($dados_animal))  
                return ['bn' => true, "mensagem" =>  "Registrado com Sucesso"];
        }else{

            return ['bn' => false, "mensagem" =>  "Erro ao Registrar"];

        }
        
        }else{
            return ['bn' => false, "mensagem" =>  "Senhas diferentes, favor verificar"];

        }
    }

    public function cadastroUsuarioModel(array $dados_usuario){

        if($this->db->insert('usuario', $dados_usuario))
            return $this->db->select_max('id_usuario')->get('usuario');

    }

    public function cadastroPetModel(array $dados_animal){

        if($this->db->insert('animal', $dados_animal))
            return true;
    }
}