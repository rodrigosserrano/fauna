<?php

class CurtidaModel extends CI_Model {

    public function createCurtidaModel($id_usuario, $id_postagem  = null,  $id_comentario = null){

        $dados_curtida['id_usuario'] = $id_usuario;
        $dados_curtida['id_postagem'] = $id_postagem;
        $dados_curtida['id_comentario'] = $id_comentario;

        if($this->db->insert('curtida', $dados_curtida))
            return true;
    }

    public function deleteCurtidaModel($id_usuario, $id_postagem){
        return $this->db->where('id_usuario', $id_usuario)->where('id_postagem', $id_postagem)->delete('curtida');
    }

    // public function deleteCurtidaModel($id_curtida){

    //     return $this->db->where('id_curtida', $id_curtida)->delete('curtida');
    // }

    public function countCurtidaModel($id_postagem=null, $id_comentario=null){
        //$query = $this->db->where(['id_postagem' => $id_postagem])->get('comentario');
        if($id_postagem){
            $query = $this->db->where('id_postagem', $id_postagem)->count_all_results('curtida');
            return $query;

        }else{
            if($id_comentario){

                $query = $this->db->where('id_comentario', $id_comentario)->count_all_results('curtida');
                return $query;
            }else{
                return false; 
            }
        }
        
    }

    public function checkCurtidaUsuario($id_postagem, $id_usuario) {
        $this->db->select('*');
        $this->db->from('curtida');
        $this->db->where('id_postagem', $id_postagem);
        $this->db->where('id_usuario', $id_usuario);
        $query = $this->db->get();
        return $query->result();
    }

}