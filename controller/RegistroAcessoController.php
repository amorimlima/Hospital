<?php
if(!isset($_SESSION['PATH_SYS'])){
	session_start();
}
$paths = $_SESSION['PATH_SYS'];
require_once ($paths["dao"]."RegistroAcessoDAO.php");

class RegistroAcessoController {
	
	private $registroAcessoDao;
	
	public function __construct(){
		$this->registroAcessoDao = new RegistroAcessoDAO(new DataAccess());
	}
	public function listaRegistroAcessoByIdExercicio($id){
	return $this->registroAcessoDao->listaRegistroAcessoByIdExercicio($id);
	}
	public function listaRegistroAcessoByUsuarioAndExercicio($usuario,$exercicio){
	return $this->registroAcessoDao->listaRegistroAcessoByUsuarioAndExercicio($usuario, $exercicio);
	}
	public function editaRegistroAcesso($rg){
	return $this->registroAcessoDao->editaRegistroAcesso($rg);
	}
	public function gravaRegistroAcesso($rg){
	return $this->registroAcessoDao->gravaRegistroAcesso($rg);
	}

}