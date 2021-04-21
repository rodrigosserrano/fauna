<?php

class UsuariosModel extends CI_Model {

    public function validateLoginModel($email, $senha){
        $dados_login = [
            'email' => $email,
            'senha' => md5($senha)
        ]; 

        $query = $this->db->where($dados_login)->get('usuario');

        if($query->num_rows() == 1){
            return $query->result();
        }else{
            return false;
        }   
    }

    public function alterarDados($id_usuario,$dados_alterados){
        $this->db->update('usuario', $dados_alterados, $id_usuario);    
    }

    public function deleteModel($id_usuario){
        return $this->db->where('id_usuario', $id_usuario)->delete('usuario');
    }

}