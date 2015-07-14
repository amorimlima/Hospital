<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'TemaDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TemaController
 *
 * @author Kevyn
 */
class TemaController {
    //put your code here
    
    private $temaDAO;
    public function __construct()
	{
		$this->temaDAO = new TemaDAO(new DataAccess());
	}
	
	public function insert($tem)
	{
		return $this->temaDAO->insert($tem);
	}
	
	public function update($tem)
	{
		return $this->temaDAO->update($tem);
	}
	
	public function delete($tem)
	{
		return $this->temaDAO->delete($tem);
	}
	
	public function select($idtem)
	{
		$tem = $this->temaDAO->select($idtem);
		return $tem;
	}
        
        public function selectAll()
	{
		$tem = $this->temaDAO->selectFull();
		return $tem;
	}
}
?>