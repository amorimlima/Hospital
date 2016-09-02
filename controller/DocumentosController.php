<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];

include_once($path['dao'].'DocumentosDAO.php');

class DocumentosController {

	private $documentosDAO;
    public function __construct()
	{
		$this->documentosDAO = new DocumentosDAO(new DataAccess());
	}
	
	public function insert($doc)
	{
		return $this->documentosDAO->insert($doc);
	}

}

?>