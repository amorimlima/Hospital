<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'ForumTopicoDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ForumTopicoController
 *
 * @author Kevyn
 */
class ForumTopicoController {
    //put your code here
    
    private $forumTopicoDAO;
    public function __construct()
	{
		$this->forumTopicoDAO =  new ForumTopicoDAO(new DataAccess());
	}
	
	public function insert($frt)
	{
		return $this->forumTopicoDAO->insert($frt);
	}
	
	public function update($frt)
	{
		return $this->forumTopicoDAO->update($frt);
	}
	
	public function delete($idfrt)
	{
		return $this->forumTopicoDAO->delete($idfrt);
	}
	
	public function select($idfrt)
	{
		$frt = $this->forumTopicoDAO->select($idfrt);
		return $frt;
	}
	
	public function selectAll()
	{
		$frt = $this->forumTopicoDAO->selectFull();
		return $frt;
	}

	public function insertAndReturnId($frt)
	{
		return $this->forumTopicoDAO->insertAndReturnId($frt);
	}

	public function selectAtivos()
	{
		$frt_ativos = $this->forumTopicoDAO->selectAtivos();
		return $frt_ativos;
	}

	public function aprovarTopico($idfrt)
	{
		return $this->forumTopicoDAO->aprovarTopico($idfrt);
	}
        
    public function countPendentesByEscola($idesc)
    {
        return $this->forumTopicoDAO->countPendentesByEscola($idesc);
    }
}
?>