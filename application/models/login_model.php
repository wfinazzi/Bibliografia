<?php 

class login_model extends CI_Model {

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



    function logar(){
    	$email = $this->input->post("email");
    	$senha = $this->input->post("senha");
    	$this->db->select("*");
    	$this->db->from("usuarios");
    	$this->db->where("email",$email);
    	$this->db->where("senha",$senha);

    	$query = $this->db->get();
    	$rst = $query->num_rows();
        $result = $query->row();

    	if($rst == 1){
    		return $result;
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



}?>

