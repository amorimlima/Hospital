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

			if($value['exe_tipo']==1 || $value['exe_tipo']==3){
				$exercicioVerProntoAcesso = $exercicioController->selectExercicioProntosRegistroAcesso($value['exe_id'], $logado['id']);
				if($exercicioVerProntoAcesso){
					if($exercicioVerProntoAcesso->getRgc_id()){
						if(($exercicioVerProntoAcesso->getRgc_inicio() != null && $exercicioVerProntoAcesso->getRgc_inicio()!= "00:00:00") && ($exercicioVerProntoAcesso->getRgc_fim() != null && $exercicioVerProntoAcesso->getRgc_fim()!= "00:00:00")){
							$result = Array(
								'id_exercicio'=>utf8_encode($exercicioVerProntoAcesso->getRgc_exercicio()),
								'completo'=> "S"
							);	
						}else{
							$result = Array(
								'id_exercicio'=>utf8_encode($exercicioVerProntoAcesso->getRgc_exercicio()),
								'completo'=> "N"
							);
						}						
					}
					print_r(json_encode($result));
				}	

			}

			if($value['exe_tipo']==2){
				$exercicioVerProntoMultipla = $exercicioController->selectExercicioProntoMultipla($value['exe_id'], $logado['id']);
				$numQuestao = $exercicioController->selectCountExercicioNumQuestoes($value['exe_id']);

				if($numQuestao == $exercicioVerProntoMultipla){
					$result = Array(
						'id_exercicio'=>$value['exe_id'],
						'completo'=> "S"
					);
				}else{
					$result = Array(
						'id_exercicio'=>$value['exe_id'],
						'completo'=> "N"
					);
				}
				print_r(json_encode($result));
			}


			if($value['exe_tipo']==4){
				$exercicioVerProntoEscrita = $exercicioController->selectExercicioProntoEscrita($value['exe_id'], $logado['id']);
				$numQuestao = $exercicioController->selectCountExercicioNumQuestoes($value['exe_id']);

				if($numQuestao == $exercicioVerProntoEscrita){
					$result = Array(
						'id_exercicio'=>$value['exe_id'],
						'completo'=> "S"
					);
				}else{
					$result = Array(
						'id_exercicio'=>$value['exe_id'],
						'completo'=> "N"
					);
				}
				print_r(json_encode($result));
			}
		}
		
		break;
	}
}