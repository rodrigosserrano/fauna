<?php

class ComentarioModel extends CI_Model {

    public function cadastroComentarioModel(array $dados_comentario){
        if($this->db->insert('comentario', $dados_comentario))
            return true;
    }

    public function alterarDadosComentarioModel($dados_update){
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

    public function deleteComentarioModel($id_comentario){
        return $this->db->where('id_comentario', $id_comentario)->delete('comentario');
    }

    public function getDadosComentarioModel($id_postagem){
        //$query = $this->db->where(['id_postagem' => $id_postagem])->get('comentario');
        
        
        $this->db->select('u.nome_usuario as usuario, c.texto, c.dh_comentario');
        $this->db->from('comentario c'); 
        $this->db->join('postagem p', 'c.id_postagem = p.id_postagem', 'left');
        $this->db->join('usuario u', 'u.id_usuario = c.id_usuario', 'left');
        $this->db->where('p.id_postagem = '. $id_postagem);
        $this->db->order_by('c.dh_comentario','desc');
        $query = $this->db->get(); 
        return $query->result();
    }

}