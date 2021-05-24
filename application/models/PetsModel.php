<?php

class PetsModel extends CI_Model {

    public function alterarDadosPetModel($dados_update){
        extract($dados_update);

        $dados = [
            'nome_animal' => $nome_animal,
            // 'foto_animal' => $foto_animal,
            /*
                'tipo' => $tipo,
                'raca' =>  $raca_animal,
                'sexo_animal' => $sexo_animal
            */
        ];

        if($foto_animal) {
            $dados['foto_animal'] = $foto_animal;
        }
        
        $this->db->where('id_animal', $id_animal);
        return $this->db->update('animal', $dados);
    }

    public function deletePetModel($id_animal){
        return $this->db->where('id_animal', $id_animal)->delete('animal');
    }

    public function getDadosPetModel($id_usuario){
        $query = $this->db->where(['id_usuario' => $id_usuario])->get('animal');
        return $query->result(); 
    }

}