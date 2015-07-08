<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'EnderecoDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EnderecoController
 *
 * @author Kevyn
 */
class EnderecoController {
    //put your code here
     private $enderecoDAO;
    public function __construct()
	{
		$this->enderecoDAO =   new EnderecoDAO(new DataAccess());
	}
	
	public function insert($end)
	{
		return $this->enderecoDAO->insert($end);
	}
	
	public function update($end)
	{
		return $this->enderecoDAO->update($end);
	}
	
	public function delete($idend)
	{
		return $this->enderecoDAO->delete($idend);
	}
	
	public function select($idend)
	{
		$end = $this->enderecoDAO->select($idend);
		return $end;
	}
	
	public function selectAll()
	{
		$end = $this->enderecoDAO->selectFull();
		return $end;
	}
}
?>