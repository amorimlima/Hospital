<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'ForumRespostaDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ForumRespostaController
 *
 * @author Kevyn
 */
class ForumRespostaController {
    //put your code here
    
    private $forumRespostaDAO;
    public function __construct()
	{
		$this->forumRespostaDAO = new ForumRespostaDAO(new DataAccess());
	}
	
	public function insert($for)
	{
		return $this->forumRespostaDAO->insert($for);
	}
	
	public function update($for)
	{
		return $this->forumRespostaDAO->update($for);
	}
	
	public function delete($idfor)
	{
		return $this->forumRespostaDAO->delete($idfor);
	}
	
	public function select($idfor)
	{
		$for = $this->forumRespostaDAO->select($idfor);
		return $for;
	}
	
	public function selectAll()
	{
		$for = $this->forumRespostaDAO->selectFull();
		return $for;
	}
}
?>