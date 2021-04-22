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

    public function alterarDadosModel($id_usuario,$dados_update){
        extract($dados_update);

        $dados = [
            'email' => $email,
            'senha' => md5($senha),
            'nome_usuario' => $nome_usuario,
            'telefone' => $telefone,
            'data_nascimento' => $data_nascimento,
        ];
        
        $this->db->where('id_usuario', $id_usuario);
        return $this->db->update('usuario', $dados);
    }

    public function deleteModel($id_usuario){
        return $this->db->where('id_usuario', $id_usuario)->delete('usuario');
    }

    public function getDadosUsuarioModel($id_usuario){
        $query = $this->db->where(['id_usuario' => $id_usuario])->get('usuario');
        return $query->result(); 
    }

}