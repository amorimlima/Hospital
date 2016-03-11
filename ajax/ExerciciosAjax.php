<?php

require_once '../_loadPaths.inc.php';

$path = $_SESSION['PATH_SYS'];

include_once($path['controller'].'ExercicioController.php');
include_once($path['controller'].'UsuarioVariavelController.php');
include_once($path['controller'].'RegistroAcessoController.php');
include_once($path['beans'].'RegistroAcesso.php');

$exercicioController = new ExercicioController();
$registroAcessoController = new RegistroAcessoController();
$usuarioVariavelController = new UsuarioVariavelController();

switch ($_POST["acao"]){
	case "verificaExercicio":{		

		$logado = unserialize($_SESSION['USR']);
		$capitulo = $_POST['capitulo'];
		$userVariavel = $usuarioVariavelController->selectByIdUsuario($logado['id']);
		$exercicios = $exercicioController->selectAllExercicioBySerieCapituloLiberado($userVariavel->getUsv_ano_letivo(),$logado['escola'],$capitulo);
		$lista = array();		
		foreach ($exercicios as $key => $value) {
			$exercicioVerPronto = $exercicioController->selectExercicioProntos($value['exe_tipo'], $value['exe_id'], $logado['id']);
			if($exercicioVerPronto){
				if($exercicioVerPronto->getRgc_id()){
					$result = Array(
						'rgc_id'=>utf8_encode($exercicioVerPronto->getRgc_id()),
						'rgc_usuario'=>utf8_encode($exercicioVerPronto->getRgc_usuario()),
						'rgc_exercicio'=>utf8_encode($exercicioVerPronto->getRgc_exercicio()),
						'rgc_inicio'=>utf8_encode($exercicioVerPronto->getRgc_inicio()),
						'rgc_fim'=>utf8_encode($exercicioVerPronto->getRgc_fim())
					);
					array_push($lista, $result);
				}				
			}
		}
		print_r(json_encode($lista));
		break;
	}
}