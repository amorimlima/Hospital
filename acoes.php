<?php
/**/ if(!isset($_SESSION['PATH_SYS'])){
	
}
session_start();
$paths = $_SESSION['PATH_SYS'];
require_once ($paths["Controller"]."UsuarioController.php");
require_once ($paths["Controller"]."RegistroAcessoController.php");
$usuarioController = new UsuarioController();
$registroAcessoController = new RegistroAcessoController(); 

switch ($_REQUEST["acao"]){
	
	case "registraOpcaoResposta":{
		print_r($_REQUEST);
		break;
		}
	
	case "acaoExercicio":{
		//echo $_SESSION["EXERCICIO_ATUAL"];
		$usuario = 1;
		if($_REQUEST["tipoacao"] == "iniciou"){
			$registroAcesso = $registroAcessoController->listaRegistroAcessoByIdExercicio($_SESSION["EXERCICIO_ATUAL"]);
			if($registroAcesso == null){
			$registroAcesso = new RegistroAcesso();
			$registroAcesso->setRgc_usuario($usuario);
			$registroAcesso->setRgc_exercicio($_POST["exercicio"]);
			$registroAcesso->setRgc_inicio(date("Y-m-d H:i:s"));
			$registroAcesso->setRgc_fim('0000-00-00 00:00:00');
			$id = $registroAcessoController->gravaRegistroAcesso($registroAcesso);
			if($id){
				$_SESSION["EXERCICIO_ATUAL"] = $id;
				$result = Array(
						'erro'=>false
				);
				}else{
					$result = Array(
						'erro'=>true
				);
					}
			}
				}
			
			
			if($_REQUEST["tipoacao"] == "finalizou"){
				$registroAcesso = $registroAcessoController->listaRegistroAcessoByIdExercicio($_SESSION["EXERCICIO_ATUAL"]);
				$registroAcesso->setRgc_fim(date("Y-m-d H:i:s"));
				if($registroAcessoController->editaRegistroAcesso($registroAcesso)){
					$result = Array(
						'erro'=>false
				);
				unset($_SESSION["EXERCICIO_ATUAL"]);
				}else{
					$result = Array(
						'erro'=>true
				);
					}
				}
		break;
		}
	
	case "verificaExercicio":{
		$usuario = $_SESSION["USUARIO_LOGADO"];
		$exercicio = $registroAcessoController->listaRegistroAcessoByUsuarioAndExercicio($usuario, $_POST["exercicio"]);
		if($exercicio!=null){
			$result = Array(
					'erro'=>false,
					'existe'=>'sim',
					'tempoInicial'=>$exercicio->getRgc_inicio(),
					'tempoFinal'=>$exercicio->getRgc_fim());
		}else{
			
			$temp = explode(":", $_POST["tempo"]);
			$data = date("Y-m-d H:i:s");
			$registroAcesso = new RegistroAcesso();
			$registroAcesso->setRgc_usuario($usuario);
			$registroAcesso->setRgc_exercicio($_POST["exercicio"]);
			$registroAcesso->setRgc_inicio($data);
			$registroAcesso->setRgc_fim('00:00');
			if($registroAcessoController->gravaRegistroAcesso($registroAcesso)){
				$result = Array(
						'erro'=>false
				);
			}
		}
		echo json_encode($result);
		break;
	}
	
	case "getUsuario":{
		
		$result = Array(
				'erro'=>false,
				'usuario'=>'1'
				);
		echo json_encode($result);
		break;
	}
	
}

