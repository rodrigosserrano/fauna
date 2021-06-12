<?php

class ComentarioModel extends CI_Model {

    public function cadastroComentarioModel(array $dados_comentario){
        if($this->db->insert('comentario', $dados_comentario))
            return $this->db->insert_id();
    }

    public function alterarDadosComentarioModel($dados_update, $nivel_usuario){
        extract($dados_update);

        $dados = [
            'texto' => $texto
            //'dh_comentario' => $dh_comentario
            /*
                'tipo' => $tipo,
                'raca' =>  $raca_animal,
                'sexo_animal' => $sexo_animal
            */
        ];
        
        $this->db->where('id_comentario', $id_comentario);

        // Não for admin
        if($nivel_usuario != 1) {
            $this->db->where('id_usuario', $id_usuario);
        }
        
        return $this->db->update('comentario', $dados);
    }

    public function deleteComentarioModel($id_comentario, $id_usuario, $nivel_usuario){
        if($nivel_usuario == 1) {
            return $this->db->where('id_comentario', $id_comentario)->delete('comentario');
        }

        return $this->db->where('id_comentario', $id_comentario)->where('id_usuario', $id_usuario)->delete('comentario');
    }

    public function getDadosComentarioModel($id_postagem){
        //$query = $this->db->where(['id_postagem' => $id_postagem])->get('comentario');
        
        
        $this->db->select('u.id_usuario, c.id_comentario, u.nome_usuario as usuario, u.foto_usuario, u.email, c.texto, c.dh_comentario');
        $this->db->from('comentario c'); 
        $this->db->join('postagem p', 'c.id_postagem = p.id_postagem', 'left');
        $this->db->join('usuario u', 'u.id_usuario = c.id_usuario', 'left');
        $this->db->where('p.id_postagem = '. $id_postagem);
        $this->db->order_by('c.dh_comentario','desc');
        $query = $this->db->get(); 
        return $query->result();
    }

}