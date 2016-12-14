<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Biblio extends CI_Controller {

	
	function __construct() {
        
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('google');
        $this->load->library('PDF');
        $this->load->helper('cookie');        
        $this->load->model('login_model', 'login');
        $this->load->model('biblioteca_model','biblioteca');
        $id_usuario = $this->session->userdata("id");
        
    }

    public function index()
    {
        $logado = $this->session->userdata('logado');
        if($logado == false){

            $this->load->view("template/header");
            $this->load->view("conteudo/login");
            $this->load->view("template/footer");

        }else{

            $this->biblioteca();
        }    
    }


    public function biblioteca()
    {
        $id_usuario = $this->session->userdata("id");
        $dados["biblioteca"] = $this->biblioteca->get_books($id_usuario);
        $this->load->view("template/header");
        $this->load->view("conteudo/biblioteca",$dados);
        $this->load->view("template/footer");
    }

    public function home()
    {
    	$this->load->view("template/header");
    	$this->load->view("conteudo/index");
    	$this->load->view("template/footer");
    }

    public function buscar()
    {
    	$tipo = $this->input->post('tipo');
    	$resposta = $this->input->post('resposta');
    	//$data['busca']=$this->mercado_modelo->buscar($tipo,$resposta);
    	//if($this->mercado_modelo->buscar($tipo,$resposta)!=null)
    	//{
    	$nome = str_replace(" ", "+", $resposta);
    	//print_r($nome);
    	$this->livro(trim($nome),$tipo);
    
    	//}
    
    	/*else
    	 {
    	 $this->fracasso();
    	 }*/
    
    }
    
    public function livro($nome,$tipo)
    {   
        
    	$id = $this->session->userdata('id');

        $biblioteca = $this->biblioteca->get_books($id);
        
        $chave = "&key=AIzaSyD24rk4RbB7E6uDTP4Q24zG3NslnlLI8-g";
        $data['livros'] = $this->biblioteca->get_livros($biblioteca);
        $data['biblioteca'] = $biblioteca;
    	$data['nome'] = $nome;
        $data['tipo'] = $tipo;
       
    	
    	if($tipo == 'livro'){
    		$data['file'] = file_get_contents('https://www.googleapis.com/books/v1/volumes?q=+intitle:'.$nome."&orderBy=newest&projection=full".$chave);
    		
    	}
    	if($tipo == 'autor'){
    		$data['file'] = file_get_contents('https://www.googleapis.com/books/v1/volumes?q=+inauthor:'.$nome."&orderBy=newest&projection=full".$chave);
    		
    	}
    	if($tipo == 'editora'){
    		$data['file'] = file_get_contents('https://www.googleapis.com/books/v1/volumes?q=inpublisher:'.$nome."&orderBy=newest&projection=full".$chave);
    	}
    	if($tipo == 'subtitulo'){
    		$data['file'] = file_get_contents('https://www.googleapis.com/books/v1/volumes?q=+subject:'.$nome."&orderBy=newest&projection=full".$chave);
    	}
    	if($tipo == 'isbn'){
    		$data['file'] = file_get_contents('https://www.googleapis.com/books/v1/volumes?q=+isbn:'.$nome."&orderBy=newest&projection=full".$chave);
    	}
    	
    	//echo $data['file'];
    	
    	
    	//$data['biblio'] = $this->mercado_modelo->get_biblio($id);
    	//$data['biblioteca'] = $this->mercado_modelo->busca_biblioteca($id);
    
    	//$this->load->view("template/header");
    	//$this->load->view("template/menu");
    	$this->load->view("template/header");
    	$this->load->view("conteudo/livro",$data);
    	$this->load->view("template/footer");
    	
    
    }


    public function logar()
    {
        $usuario = $this->login->logar();
        if($usuario != null){
            $dadosSessao['id'] = $usuario->id;
            $dadosSessao['usuario'] = $usuario->nome;
            $dadosSessao['email'] = $usuario->email;
            $dadosSessao['senha'] = $usuario->senha;
            $dadosSessao['logado'] = TRUE;
            $this->session->set_userdata($dadosSessao);
            $this->biblioteca();
        }else{
            $this->index();
        }

    }

    public function logout()
    {
       
       $this->session->unset_userdata('logado');
       $this->session->sess_destroy();
       $this->index();
    }

    public function cadastrar()
    {
        $cadastrar = $this->login->cadastrar();
        if($cadastrar == true){
            $this->cadastro_sucesso();
        }else{
            $this->cadastro_fracasso();
        }

    }

    public function inserir_biblioteca()
    {
        
        $adiciona = $this->biblioteca->adicionar_biblioteca();

        if($adiciona == true){
            $this->home();
        }else{
            $this->index();
        }
    }

    public function cadastro_sucesso()
    {
        $this->load->view("template/header");
        $this->load->view("conteudo/cadastro_sucesso");
        $this->load->view("template/footer");

    }

    public function cadastro_fracasso()
    {
        $this->load->view("template/header");
        $this->load->view("conteudo/cadastro_fracasso");
        $this->load->view("template/footer");

    }

    public function inserir_livro($livro,$busca,$tipo,$biblioteca){

        
        $this->biblioteca->inserir_livros($livro,$biblioteca);
        $this->livro($busca,$tipo);

    }

    public function excluir_livro($livro,$busca,$tipo){
        
        $this->biblioteca->excluir_livro($livro);
        $this->livro($busca,$tipo);

    }

    public function bibliografia()
    {
        $id = $this->session->userdata('id');
        $biblioteca = $this->biblioteca->get_books($id);        
        $data['livros'] = $this->biblioteca->get_livros($biblioteca);

        $this->load->view("template/header");
        $this->load->view("conteudo/bibliografia",$data);
        $this->load->view("template/footer");

    }


    public function pdf(){

        $this->load->library('PDF');
        $id = $this->session->userdata('id');
        $biblioteca = $this->biblioteca->get_books($id);        
        $data['livros'] = $this->biblioteca->get_livros($biblioteca); 
        
 
        //this the the PDF filename that user will get to download
        $pdfFilePath = "Bibliografia.pdf";
 
        //load mPDF library
        $this->load->library('m_pdf');
        
        //load the view and saved it into $html variable
        $html = $this->load->view('conteudo/bibliografia', $data, true);
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "D");

    }

 
}