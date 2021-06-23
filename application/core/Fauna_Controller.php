<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fauna_Controller extends CI_Controller{

    private $path_user;
    private $path_pet;

    public function __construct(){
       parent:: __construct();
        
       //path save
       $this->path_user = getcwd().'/assets/img/user';
       $this->path_pet = getcwd().'/assets/img/pet';
       $this->path_post = getcwd().'/assets/img/post';
       //path use
       $this->user_foto = base_url().'/assets/img/user';
       $this->pet_foto = base_url().'/assets/img/pet';
       $this->pet_post = base_url().'/assets/img/post';
    }
    
    public function show(array $dados, $view, $nav = false){
        $id = isset($_SESSION['id']) ? $_SESSION['id'] : '';
        
        if($id != '') {
            $this->load->model('UsuariosModel');
            $usuario = $this->UsuariosModel->returnDadosTratadoUserModel($id);

            $dados_usuario = [
                'foto_user' => $usuario['foto_user'],
                'nome_user' => $usuario['nome_user']
            ];
        } else {
            $dados_usuario = [];
        }
        

        $estrutura = $this->load->view('template/header', $dados, true);
        $nav ? $estrutura .= $this->load->view('template/navbar', $dados_usuario, true) : null;
        
        $estrutura .= $view;

        $estrutura .= $this->load->view('template/footer', $dados, true);   
        echo $estrutura;
    }

    public function dadosShow($title, $style = null, $js = null){
        $dados = [
            'title' => $title,
            'style' => $style ? base_url().$style : null,
            'js' => $js ? base_url().$js : null
        ];

        return $dados;
    }   

    public function verifySession(){
        if(!$this->session->has_userdata('id')){
            redirect("/");
        }
    }

    public function createSession($session_data){
        $this->session->set_userdata($session_data);
    }

    
    public function destroySession(){
        $this->session->sess_destroy();
    }

    // TEM QUE MEXER PARA APAGAR O ARQUIVO TEMPORARIO
    // public function uploadImage($arquivo = false, $email = false, $is_user = false) {
    public function uploadImage($arquivo, $email, $type) {
        if($arquivo['name'] != ''){
            $extensao = trim(substr(strchr($arquivo['name'], '.'), 0));
            $acceptedTypes = ['.png', '.jpg', '.gif', '.jpeg'];
            $maxSize = 10000000;

            if(in_array($extensao, $acceptedTypes) && $arquivo['size'] <= $maxSize) {
                switch($type) {
                    case 'user':
                        $nomefoto = md5($email.time()).$extensao;
                        break;
                    default:
                        $nomefoto = md5(time()).$extensao;
                }
    
                $upload_path = $this->localUpload($type, $email);
                // $upload_path = $this->localUpload($is_user, $email);
    
                // if($is_user){
                //     $nomefoto = md5($email.time()).$extensao;
                //     $upload_path = $this->localUpload($is_user, $email);
                // }else{
                //     $nomefoto = md5(time()).$extensao;
                //     $upload_path = $this->localUpload($is_user, $email);
                    
                // }
                
                move_uploaded_file($arquivo['tmp_name'], $upload_path.$nomefoto);
                
                return $nomefoto;
            }
            
        }
    }

    // AJUSTAR O CHDIR OU ACHAR UMA FORMA MELHOR PARA CRIAR PASTA
    // public function localUpload($is_user = true, $email){
    //     if($is_user){
    //         return $this->path_user.'/'.$email.'/'; 
    //     }else{
    //         return $this->path_pet.'/'.$email.'/';
    //     }
    // }

    // public function createLocalUpload($email){
    //     if(!is_dir($this->path_user.'/'.$email)){
    //         mkdir($this->path_user.'/'.$email);
    //     }
    
    //     if(!is_dir($this->path_pet.'/'.$email)){
    //         mkdir($this->path_pet.'/'.$email);
    //     }
    // }

    // public function localUpload($is_user = true, $email){
    public function localUpload($type, $email){
        switch($type) {
            case 'user':
                return $this->path_user.'/'.$email.'/';
                break;
            case 'pet':
                return $this->path_pet.'/'.$email.'/';
                break;
            case 'post':
                return $this->path_post.'/'.$email.'/';
        }

        // if($is_user){
        //     return $this->path_user.'/'.$email.'/'; 
        // }else{
        //     return $this->path_pet.'/'.$email.'/';
        // }
    }

    public function createLocalUpload($email){
        if(!is_dir($this->path_user.'/'.$email)){
            mkdir($this->path_user.'/'.$email);
        }
    
        if(!is_dir($this->path_pet.'/'.$email)){
            mkdir($this->path_pet.'/'.$email);
        }

        if(!is_dir($this->path_post.'/'.$email)) {
            mkdir($this->path_post.'/'.$email);
        }
    }
    
}



