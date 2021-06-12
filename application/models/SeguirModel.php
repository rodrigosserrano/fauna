<?php

class SeguirModel extends CI_Model {

    public function createSeguirModel($id_usuario,  $id_usuario_seguido){

        $dados_seguir['id_seguido'] = $id_usuario_seguido;
        $dados_seguir['id_seguidor'] = $id_usuario;

        if($this->db->insert('seguir', $dados_seguir))
            return true;
    }

    public function deleteSeguirModel($id_usuario, $id_seguido = null, $id_seguidor = null){

        if($id_seguido) {
            return $this->db->where('id_seguidor', $id_usuario)->where('id_seguido', $id_seguido)->delete('seguir');
        }else{
            if($id_seguidor){
                return $this->db->where('id_seguido', $id_usuario)->where('id_seguidor', $id_seguidor)->delete('seguir');
            }else{
                return false;
            }
        }
       
    }

    public function getDadosSeguirModel($id_usuario, $seguindo = null, $seguidores = null){
        //$query = $this->db->where(['id_postagem' => $id_postagem])->get('comentario');
        
        if($seguindo){

            $this->db->select('u.id_usuario, u.nome_usuario as usuario, u.foto_usuario, u.email');
            $this->db->from('seguir s'); 
            $this->db->join('usuario u', 'u.id_usuario = s.id_seguido', 'left');
            $this->db->where('s.id_seguidor = '. $id_usuario);
            $this->db->order_by('u.nome_usuario','asc');
            $query = $this->db->get(); 
            return $query->result();

        }else{
            if($seguidores){
                
            $this->db->select('u.id_usuario, u.nome_usuario as usuario, u.foto_usuario, u.email');
            $this->db->from('seguir s'); 
            $this->db->join('usuario u', 'u.id_usuario = s.id_seguidor', 'left');
            $this->db->where('s.id_seguido = '. $id_usuario);
            $this->db->order_by('u.nome_usuario','asc');
            $query = $this->db->get(); 
            return $query->result();

            }else{
                return false;
            }
        }
    }

    public function countSeguirModel($id_usuario, $seguindo = null, $seguidores = null){
        //$query = $this->db->where(['id_postagem' => $id_postagem])->get('comentario');
        if($seguindo){

            $query = $this->db->where('id_seguidor', $id_usuario)->count_all_results('seguir');
            return $query;

        }else{
            if($seguidores){

                $query = $this->db->where('id_seguido', $id_usuario)->count_all_results('seguir');
                return $query;

            }else{
                return false; 
            }
        }
        
    }

}