<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}

//session_start();

$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'MensagemDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MensagemController
 *
 * @author Kevyn
 */
class MensagemController {
    //put your code here
    
    private $mensagemDAO;
    public function __construct()
	{
		$this->mensagemDAO = new MensagemDAO(new DataAccess());
	}
	
	public function insert($mens)
	{
		return $this->mensagemDAO->insert($mens);
	}
	
	public function update($mens)
	{
		return $this->mensagemDAO->update($mens);
	}
        
        public function msgLida($idmens){
            return $this->mensagemDAO->msgLida($idmens);
        }

        public function delete($idmens)
	{
            return $this->mensagemDAO->delete($idmens);
	}
	
	public function selectMensagem($idmens)
	{
            $mens = $this->mensagemDAO->select($idmens);
            return $mens;
	}
        
	public function count($idmens){
		$valor = $this->mensagemDAO->count($idmens);
		return $valor;
	}

	public function listaEnviadas($idmens){
		$valor = $this->mensagemDAO->listaEnviadas($idmens);
		return $valor;
	}
	
	public function deletadas(){
		 $valor = $this->mensagemDAO->deletadas();
		return $valor;
	} 

	public function deletadasByUsuario($idUsuario){
		 $valor = $this->mensagemDAO->deletadasByUsuario($idUsuario);
		return $valor;
	} 


	public function detalhe($idmens){
		$valor = $this->mensagemDAO->detalhe($idmens);
		return $valor;
	}

	public function listaRecebidos($destinatario){
		$valor = $this->mensagemDAO->listaRecebidos($destinatario);
		return $valor;
	}

	public function selectAll()
	{
		$mens = $this->mensagemDAO->selectFull();
		return $mens;
	}
		public function deleteDefinitivo($idmens)
	{
		$mens = $this->mensagemDAO->deleteDefinitivo($idmens);
		return $mens;
	}
}
?>
