<?php

class UsuariosModel extends CI_Model {

    public function validateLoginModel($email, $senha){
        $dados_login = [
            'email' => $email,
            'senha' => $senha
        ]; 

        $query = $this->db->where($dados_login)
                          ->get('usuario');

        if($query->num_rows() == 1){
            // return $query->result;
            // return true;
            return $query->result();
        }else{
            return false;
        }   
    }
}