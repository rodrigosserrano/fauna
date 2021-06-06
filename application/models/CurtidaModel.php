<?php

class CurtidaModel extends CI_Model {

    public function cadastroCurtidaModel($id_usuario, $id_postagem  = null,  $id_comentario = null){

        $dados_curtida['id_usuario'] = $id_usuario;
        $dados_curtida['id_postagem'] = $id_postagem;
        $dados_curtida['id_comentario'] = $id_comentario;

        if($this->db->insert('curtida', $dados_curtida))
            return true;
    }

    public function deleteCurtidaModel($id_curtida){

        return $this->db->where('id_curtida', $id_curtida)->delete('curtida');
    }

    public function countCurtidaModel($id_postagem=null, $id_comentario=null){
        //$query = $this->db->where(['id_postagem' => $id_postagem])->get('comentario');
        if($id_postagem){

            $this->db->count_all_results('curtida')->where('id_postagem', $id_postagem);
            $query = $this->db->get(); 
            return $query->result();

        }else{
            if($id_comentario){

                $this->db->count_all_results('curtida')->where('id_comentario', $id_comentario);
                $query = $this->db->get(); 
                return $query->result();

            }else{
                return false; 
            }
        }
        
    }

}