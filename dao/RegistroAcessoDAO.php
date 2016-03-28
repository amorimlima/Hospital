<?php
if(!isset($_SESSION['PATH_SYS'])){
	session_start();
}
$paths = $_SESSION['PATH_SYS'];
require_once ($paths["DB"]."DAO.php");
require_once ($paths["DB"]."DataAccess.php");
require_once ($paths["beans"]."RegistroAcesso.php");

class RegistroAcessoDAO extends DAO{
	
	public function __construct($da){
		parent::__construct($da);
	}
	
	public function listaRegistroAcessoByIdExercicio($id){
		$sql = "select * from registro_acesso where ";
		$sql .= "rgc_id = ".$id." limit 1";
		$registroAcesso = null;
		$result = $this->retrieve($sql);
		if(mysqli_num_rows($result)>0){
			$qr = mysqli_fetch_array($result);
			$registroAcesso = new RegistroAcesso();
			$registroAcesso->setRgc_id($qr["rgc_id"]);
			$registroAcesso->setRgc_usuario($qr["rgc_usuario"]);
			$registroAcesso->setRgc_exercicio($qr["rgc_exercicio"]);
			$registroAcesso->setRgc_inicio($qr["rgc_inicio"]);
			$registroAcesso->setRgc_fim($qr["rgc_fim"]);
		}
		return $registroAcesso;
	}
	
	public function listaRegistroAcessoByUsuarioAndExercicio($usuario,$exercicio){
		$sql = "select * from registro_acesso where ";
		$sql .= "rgc_usuario = ".$usuario." and ";
		$sql .= "rgc_exercicio = ".$exercicio." limit 1";

		$registroAcesso = null;
		$result = $this->retrieve($sql);
		if(mysqli_num_rows($result)>0){
			$qr = mysqli_fetch_array($result);
			$registroAcesso = new RegistroAcesso();
			$registroAcesso->setRgc_id($qr["rgc_id"]);
			$registroAcesso->setRgc_usuario($qr["rgc_usuario"]);
			$registroAcesso->setRgc_exercicio($qr["rgc_exercicio"]);
			$registroAcesso->setRgc_inicio($qr["rgc_inicio"]);
			$registroAcesso->setRgc_fim($qr["rgc_fim"]);
		}
		return $registroAcesso;
	}
	public function editaRegistroAcesso(RegistroAcesso $rg){
		$sql = "update registro_acesso set ";
		$sql .= "rgc_fim = '".$rg->getRgc_fim()."' ";
		$sql .= "where rgc_id = ".$rg->getRgc_id()." limit 1";
		return $this->execute($sql);
	}
	public function gravaRegistroAcesso(RegistroAcesso $rg){
		$sql = "insert into registro_acesso (";
		$sql .= "rgc_usuario,";
		$sql .= "rgc_exercicio,";
		$sql .= "rgc_inicio,";
		$sql .= "rgc_fim";
		$sql .= ") values (";
		$sql .= "".$rg->getRgc_usuario().",";
		$sql .= "".$rg->getRgc_exercicio().",";
		$sql .= "'".$rg->getRgc_inicio()."',";
		$sql .= "'".$rg->getRgc_fim()."')";
		return $this->executeAndReturnLastID($sql);
	}

	public function selectExeByAlunoRegistro($idExercicio,$idUsuario)
    {
        $sql = "select * from registro_acesso where rgc_exercicio = ".$idExercicio." and rgc_usuario=".$idUsuario;
        $result = $this->retrieve($sql);
        $qr = mysqli_num_rows($result);
        return $qr;
    } 
}