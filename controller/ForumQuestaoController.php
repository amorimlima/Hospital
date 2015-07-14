<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'ForumQuestaoDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ForumQuestaoController
 *
 * @author Kevyn
 */
class ForumQuestaoController {
    //put your code here
    
    private $forumQuestaoDAO;
    public function __construct()
	{
		$this->forumQuestaoDAO = new ForumQuestaoDAO(new DataAccess());
	}
	
	public function insert($foq)
	{
		return $this->forumQuestaoDAO->insert($foq);
	}
	
	public function update($foq)
	{
		return $this->forumQuestaoDAO->update($foq);
	}
	
	public function delete($idfoq)
	{
		return $this->forumQuestaoDAO->delete($idfoq);
	}
	
	public function select($idfoq)
	{
		$foq = $this->forumQuestaoDAO->select($idfoq);
		return $foq;
	}
	
	public function selectAll()
	{
		$foq = $this->forumQuestaoDAO->selectFull();
		return $foq;
	}
}
?>