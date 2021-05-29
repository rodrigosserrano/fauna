<?php

class PostagemModel extends CI_Model {

    public function cadastroPostagemModel(array $dados_postagem){
        if($this->db->insert('postagem', $dados_postagem))
            return true;
    }

    public function alterarDadosPostagemModel($dados_update){
        extract($dados_update);

        $dados = [
            'descricao' => $descricao,
            'midia' => $midia,
            'id_categoria' => $id_categoria
            /*
                'tipo' => $tipo,
                'raca' =>  $raca_animal,
                'sexo_animal' => $sexo_animal
            */
        ];

        if($midia) {
            $dados['midia'] = $midia;
        }
        
        $this->db->where('id_postagem', $id_postagem);
        $this->db->where('id_usuario', $id_usuario);
        return $this->db->update('postagem', $dados);
    }

    public function deletePostagemModel($id_postagem){
        if($this->db->where('id_postagem', $id_postagem)->delete('comentario'))
        return $this->db->where('id_postagem', $id_postagem)->delete('postagem');
    }

    public function getDadosPostagemModel($filtro_categoria = null){
        //$query = $this->db->get('postagem');
        $this->db->select('u.id_usuario as id_usuario, p.id_postagem, u.nome_usuario as usuario, u.foto_usuario, u.email, a.nome_animal as animal, p.descricao, p.midia, p.dh_post');
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