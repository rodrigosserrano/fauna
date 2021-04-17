<?php

class UsuariosModel extends CI_Model {

    public function validateLoginModel($email, $password){
        $this->db->where('email', $email);   
        $this->db->where('senha', $password);   

        $query = $this->db->get('usuario');

        if($query->num_rows() > 0){
            // return $query->result;
            return true;
        }else{
            return false;
        }   
    }
}