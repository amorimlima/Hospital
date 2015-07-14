<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'QuestaoDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuestaoController
 *
 * @author Kevyn
 */
class QuestaoController {
    //put your code here
    
    private $questaoDAO;
    public function __construct()
	{
		$this->questaoDAO = new QuestaoDAO(new DataAccess());
	}
	
	public function insert($ques)
	{
		return $this->questaoDAO->insert($ques);
	}
	
	public function update($ques)
	{
		return $this->questaoDAO->update($ques);
	}
	
	public function delete($idques)
	{
		return $this->questaoDAO->delete($idques);
	}
	
	public function select($idques)
	{
		$ques = $this->questaoDAO->select($idques);
		return $ques;
	}
	
	public function selectAll()
	{
		$eml = $this->questaoDAO->selectFull();
		return $eml;
	}
}
?>