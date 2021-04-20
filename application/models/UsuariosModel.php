<?php

class UsuariosModel extends CI_Model {

    public function validateLoginModel($email, $senha){
        $dados_login = [
            'email' => $email,
            'senha' => $senha
        ]; 

        $query = $this->db->where($dados_login)->get('usuario');

        if($query->num_rows() == 1){
            return $query->result();
        }else{
            return false;
        }   
    }

    public function alteraDados($id_usuario,$dados_alterados){

        $this->db->update('Table', $dados_alterados, $id_usuario);
        
    }


    public function deletaDados($id_usuario){

        $this->db->delete('Usuario', $id_usuario);

    }

}