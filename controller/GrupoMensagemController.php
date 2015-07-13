<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'GrupoMensagemDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GrupoMensagemController
 *
 * @author Kevyn
 */
class GrupoMensagemController {
    //put your code here
    
    private $grupoMensagemDAO;
    public function __construct()
	{
		$this->grupoMensagemDAO = new GrupoMensagemDAO(new DataAccess());
	}
	
	public function insert($grm)
	{
		return $this->grupoMensagemDAO->insert($grm);
	}
	
	public function update($grm)
	{
		return $this->grupoMensagemDAO->update($grm);
	}
	
	public function delete($idgrm)
	{
		return $this->grupoMensagemDAO->delete($idgrm);
	}
	
	public function select($idgrm)
	{
		$grm = $this->grupoMensagemDAO->select($idgru);
		return $grm;
	}
	
	public function selectAll()
	{
		$grm = $this->grupoMensagemDAO->selectFull();
		return $grm;
	}
}
?>