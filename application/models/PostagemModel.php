<?php

class PostagemModel extends CI_Model {

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

    public function getDadosPostagemModel($filtro_categoria = null){
        //$query = $this->db->get('postagem');
        $this->db->select('p.id_postagem, u.nome_usuario as usuario, u.foto_usuario, u.email, a.nome_animal as animal, p.descricao, p.midia, p.dh_post');
        $this->db->from('postagem p'); 
        $this->db->join('usuario u', 'u.id_usuario = p.id_usuario', 'left');
        $this->db->join('animal a', ' a.id_animal = p.id_animal', 'left');
        if($filtro_categoria) {
            $this->db->where('p.categoria', $filtro_categoria);
        }
        $this->db->order_by('p.dh_post','desc');
        $query = $this->db->get(); 
        return $query->result(); 
    }

    public function getDadosPostagemUsuarioModel($id_usuario){
        $query = $this->db->where(['id_usuario' => $id_usuario])->get('postagem');
        return $query->result(); 
    }

}