<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'EnvioDocumentoDAO.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailController
 *
 * @author Carol
 */

class EnvioDocumentoController {
    //put your code here
    
    private $envioDocumentoDAO;
    public function __construct()
	{
		$this->envioDocumentoDAO = new EnvioDocumentoDAO(new DataAccess());
	}
	
	public function insert($env)
	{
		return $this->envioDocumentoDAO->insert($env);
	}
	
	public function update($env)
	{
		return $this->envioDocumentoDAO->update($env);
	}
	
	public function delete($idenv)
	{
		return $this->envioDocumentoDAO->delete($idenv);
	}
	
	public function select($idenv)
	{
		$env = $this->envioDocumentoDAO->select($idenv);
		return $env;
	}
        
        public function count($idenv){
            return $this->envioDocumentoDAO->count($idenv);
        }
        
        public function updateVisto($idenv){
            return $this->envioDocumentoDAO->updateVisto($idenv);
        }

                public function selectNaoVistos($idenv)
        {
                $env = $this->envioDocumentoDAO->selectNaoVistos($idenv);
		return $env;
        }

        public function selectAll()
	{
		$env = $this->envioDocumentoDAO->selectFull();
		return $env;
	}
}
?>

