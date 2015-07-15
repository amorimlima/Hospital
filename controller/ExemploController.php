<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'exemploDAO.php');

class ExemploController {
	
	private $exemploDAO;
	
	public function __construct()
	{
		$this->exemploDAO = new ExemploDAO(new DataAccess());
	}
	
	public function insertExemplo($exemplo)
	{
		return $this->exemploDAO->insertExemplo($exemplo);
	}
	
	public function updateExemplo($exemplo)
	{
		return $this->exemploDAO->updateExemplo($exemplo);
	}
	
	public function deleteExemplo($idCategoria)
	{
		return $this->exemploDAO->deleteExemplo($idCategoria);
	}
	
	public function selectExemplo($idCategoria)
	{
		$exemplo = $this->exemploDAO->selectExemplo($idCategoria);
		return $exemplo;
	}
	
	public function selectAllExemploByCidade($idCidade,$exemplo)
	{
		$exemplo = $this->exemploDAO->selectAllExemploByCidade($idCidade,$exemplo);
		return $exemplo;
	}
	
	public function selectAllExemplo($exemplo)
	{
		$exemplo = $this->exemploDAO->selectAllExemplo($exemplo);
		return $exemplo;
	}
}
?>
