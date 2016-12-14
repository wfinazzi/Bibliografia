<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	function __construct() {
        
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('google');
        $this->load->helper('cookie');        
        $this->load->model('login_model', 'login');
        
    }

    public function logar()
    {
        $logar =$this->login->logar();
        if($logar == true){
            $this->sucesso();
        }else{

        }

    }

    public function cadastrar()
    {
        $cadastrar = $this->login->cadastrar();
        if($cadastrar == true){
            $this->sucesso();
        }else{

        }

    }


    public function logar()
    {
        $this->load->view("template/header");
        $this->load->view("conteudo/login");
        $this->load->view("template/footer");
    }


    
}