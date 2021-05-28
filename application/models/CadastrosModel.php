<?php

class CadastrosModel extends CI_Model {

    private $id_usuario;

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
                'senha'=> md5($senha), 
                'foto_usuario' => $foto_usuario, 
                'nome_usuario' =>  $nome_usuario, 
                'telefone' => $telefone, 
                'sexo_usuario' =>  $sexo_usuario,
                'data_nascimento' => $data_nascimento
            ];

            if($this->cadastroUsuarioModel($dados_usuario)){
                $id_usuario = $this->getUltimoIdUsuario();
            }
            
            if($id_usuario !== null && !empty($id_usuario)){
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
        if($this->db->insert('usuario', $dados_usuario)){
            $this->id_usuario = $this->db->insert_id();

            return true;
        }else{
            return false;
        }
    }

    public function getUltimoIdUsuario(){
        return $this->id_usuario;
    }

    public function cadastroPetModel(array $dados_animal){
        if($this->db->insert('animal', $dados_animal))
            return true;
    }

    public function getSexoModel(){
        $query = $this->db->get('sexo');
        return $query->result();    
     }

     public function getTipoModel(){
        $query = $this->db->get('tipo');
        return $query->result();    
     }

     public function getCategoriaModel() {
         $query = $this->db->get('categoria');
         return $query->result();
     }
}