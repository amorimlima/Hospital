<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];

include_once($path['dao'].'DocumentoRetornoDAO.php');

class DocumentoRetornoController {

	private $documentoRetornoDAO;
    public function __construct()
	{
		$this->documentoRetornoDAO = new DocumentoRetornoDAO(new DataAccess());
	}
	
	public function insert($doc)
	{
		return $this->documentoRetornoDAO->insert($doc);
	}

}

?>