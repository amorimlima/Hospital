<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'GabaritoDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GabaritoController
 *
 * @author Kevyn
 */
class GabaritoController {
    //put your code here
    
    private $gabaritoDAO;
    public function __construct()
	{
		$this->gabaritoDAO = new GabaritoDAO(new DataAccess());
	}
	
	public function insert($gab)
	{
		return $this->gabaritoDAO->insert($gab);
	}
	
	public function update($gab)
	{
		return $this->gabaritoDAO->update($gab);
	}
	
	public function delete($idgab)
	{
		return $this->gabaritoDAO->delete($idgab);
	}
	
	public function select($idgab)
	{
		$gab = $this->gabaritoDAO->select($idgab);
		return $gab;
	}
	
	public function selectAll()
	{
		$gab = $this->gabaritoDAO->selectFull();
		return $gab;
	}
}
