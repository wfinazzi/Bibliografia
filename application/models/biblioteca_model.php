<?php 

class Biblioteca_model extends CI_Model {

    public function __construct()
    {
            parent::__construct();
    }


    /*
    	$this->db->select();
    	$this->db->from();
    	$this->db->where();

    	$query = $this->db->get();
    	$rst = $query->result();

		$data = array(
   'title' => 'My title' ,
   'name' => 'My Name' ,
   'date' => 'My date'
);

$this->db->insert('mytable', $data); 


    */



    function adicionar_biblioteca(){

        $titulo = $this->input->post("titulo");
        $usuario =  $this->input->post("id_usuario");

    	$this->db->set('titulo', $titulo);
        $this->db->set('id_usuario', $usuario);

        if($this->db->insert('biblioteca')){
        
            return true; 

        }else{

            return false;
        }

    }

    function cadastrar(){

    	$nome = $this->input->post("nome");
    	$email = $this->input->post("email");
    	$senha = $this->input->post("senha");

    	$this->db->select("*");
    	$this->db->from("usuarios");
    	$this->db->where("email",$email);
    	$query = $this->db->get();
    	$rst = $query->row();

    	if($rst){
    		return false;
    	}else{
    		$this->db->set('nome', $nome);
			$this->db->set('email', $email);
			$this->db->set('senha', $senha);

			if($this->db->insert('usuarios')){
			
				return true; 

    		}else{

    			return false;
    		}
    	}

        

    	

    }

    function get_books($id){
        $this->db->select("id");
        $this->db->from("biblioteca");
        $this->db->where("id_usuario", $id);
        $query = $this->db->get();
        $result = $query->row();
        $this->db->last_query();
        return $result->id;

    }

    function get_livros($id){
        $this->db->select("*");
        $this->db->from("livros");
        $this->db->where("id_biblioteca", $id);
        $query = $this->db->get();
        $result = $query->result();
        //$this->db->last_query();
        foreach ($result as $item) {
           $chave = "?key=AIzaSyD24rk4RbB7E6uDTP4Q24zG3NslnlLI8-g";

           $file = file_get_contents('https://www.googleapis.com/books/v1/volumes/'.$item->livro.$chave);
           $item->json = json_decode($file, true);              
        }

        return $result;

    }

    
    function inserir_livros($livro,$biblioteca)
    {

        $data = array(
            'livro' => $livro,
            'id_biblioteca' => $biblioteca  
                
        );


        $this->db->insert('livros',$data);


    } 

    function excluir_livro($livro)
    {

        $this->db->where("id", $livro);
        $this->db->delete('livros');


    } 

    function binToStr($str){ 
    
    $string = ''; 
    for($i=0;$i<count($str);$i++){ 
        $string .= chr(bindec($str[$i])); 
    } 
    return $string; 
} 


}?>

