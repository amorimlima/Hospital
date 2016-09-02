<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];

include_once($path['dao'].'DocumentoEnvioDAO.php');

class DocumentoEnvioController {

	private $documentoEnvioDAO;
    public function __construct()
	{
		$this->documentoEnvioDAO = new DocumentoEnvioDAO(new DataAccess());
	}
	
	public function insert($doc)
	{
		return $this->documentoEnvioDAO->insert($doc);
	}

}

?>