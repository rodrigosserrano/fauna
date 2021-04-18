<?php

class UsuariosModel extends CI_Model {

    public function verificaCadastroModel($email){
        $query = $this->db->where('email',$email)->get('usuario');

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

            $retorno_cadastro_usuario = $this->cadastroUsuarioModel($dados_usuario);

            if($retorno_cadastro_usuario != null){
                $dados_animal = [   
                    'id_usuario' => $id_usuario, 
                    'foto_animal' => $foto_animal,
                    'nome_animal' => $nome_animal, 
                    'tipo' => $tipo, 
                    'raca' => $raca,
                    'sexo_animal' => $sexo_animal
                ];

                if($this->cadastroPetModel($dados_animal)){
                    return true;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function cadastroUsuarioModel(array $dados_usuario){
        $id_ultimo_usuario = null;

        if($this->db->insert('usuario', $dados_usuario)){
            $id_ultimo_usuario = $this->db->select_max('id_usuario')->get('usuario');
            return $id_ultimo_usuario;
        }else{
            return $id_ultimo_usuario;
        }
    }

    public function cadastroPetModel(array $dados_animal){
        if($this->db->insert('animal', $dados_animal))
            return true;
    }
}