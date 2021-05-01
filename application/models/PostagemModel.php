<?php

class PetsModel extends CI_Model {

    public function cadastroPostagemModel(array $dados_animal){
        if($this->db->insert('postagem', $dados_animal))
            return true;
    }

    public function alterarDadosPostagemModel($dados_update){
        extract($dados_update);

        $dados = [
            'nome_animal' => $nome_animal,
            /*
                'tipo' => $tipo,
                'raca' =>  $raca_animal,
                'sexo_animal' => $sexo_animal
            */
        ];
        
        $this->db->where('id_postagem', $id_postagem);
        return $this->db->update('postagem', $dados);
    }

    public function deletePetModel($id_postagem){
        return $this->db->where('id_postagem', $id_postagem)->delete('postagem');
    }

    public function getDadosPostagemModel(){
        $query = $this->db->get('postagem');
        return $query->result(); 
    }

    public function getDadosPostagemUsuarioModel($id_usuario){
        $query = $this->db->where(['id_usuario' => $id_usuario])->get('postagem');
        return $query->result(); 
    }

}