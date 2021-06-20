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
            'nome_usuario' => $nome_usuario,
            // 'foto_usuario' => $foto_usuario, 
            'telefone' => $telefone,
            'data_nascimento' => $data_nascimento
        ];
     
        if($senha) {
            $dados['senha'] = md5($senha);
        }

        if($foto_usuario) {
            $dados['foto_usuario'] = $foto_usuario;
        }
        
        $this->db->where('id_usuario', $id_usuario);
        return $this->db->update('usuario', $dados);
    }

    public function alterarSenhaModel($email,  $senha){
        $dados = [
            'email' => $email,
            'senha' => $senha
        ];

        // $this->db->where('email', $email);
        if( $this->db->where('email', $email)->get('usuario')->result() ) {
            return $this->db->where('email', $email)->update('usuario', $dados);
        }
        return null;
    }

    public function deleteModel($id_usuario){
        
        if($this->db->where('id_usuario', $id_usuario)->delete('postagem'))
            if($this->db->where('id_usuario', $id_usuario)->delete('comentario'))
                if($this->db->where('id_usuario', $id_usuario)->delete('curtida'))
                    if($this->db->where('id_seguido', $id_usuario)->or_where('id_seguidor')->delete('seguir'))
                        if($this->db->where('id_usuario', $id_usuario)->delete('animal'))
                            return $this->db->where('id_usuario', $id_usuario)->delete('usuario');
                    
    }

    public function getDadosUsuarioModel($id_usuario){
        $query = $this->db->where(['id_usuario' => $id_usuario])->get('usuario');
        return $query->result(); 
    }

    public function returnDadosTratadoUserModel($id_usuario){
        $query = $this->db->where(['id_usuario' => $id_usuario])->get('usuario');
        $result = $query->result(); 
        $r = $result[0];

        return [
            'nome_user' => $r->nome_usuario,
            'foto_user' => $r->foto_usuario ? $this->user_foto.'/'.$r->email.'/'.$r->foto_usuario : '',
            'email_user' => $r->email
        ];

    }

}