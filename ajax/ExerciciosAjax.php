
<?php

require_once '../_loadPaths.inc.php';

$path = $_SESSION['PATH_SYS'];

include_once($path['controller'].'ExercicioController.php');
include_once($path['controller'].'UsuarioVariavelController.php');
include_once($path['controller'].'RegistroAcessoController.php');
include_once($path['beans'].'RegistroAcesso.php');
include_once($path['beans'].'Exercicio.php');

$exercicioController = new ExercicioController();
$registroAcessoController = new RegistroAcessoController();
$usuarioVariavelController = new UsuarioVariavelController();

switch ($_REQUEST["acao"]){
	case "verificaExercicio":{		

		$logado = unserialize($_SESSION['USR']);
		$capitulo = $_REQUEST['capitulo'];
		$userVariavel = $usuarioVariavelController->selectByIdUsuario($logado['id']);

		if($logado['perfil'] == "Aluno"){
			$exercicios = $exercicioController->selectAllExercicioBySerieCapituloLiberado($userVariavel->getUsv_ano_letivo(),$logado['escola'],$capitulo);
			$lista = array();		
			foreach ($exercicios as $key => $value) {
				$result = '';
				$numQuestao = 0;
				if($value['exe_tipo']==1 || $value['exe_tipo']==3){
					$exercicioVerProntoAcesso = $exercicioController->selectExercicioProntosRegistroAcesso($value['exe_id'], $logado['id']);
					if($exercicioVerProntoAcesso){
						if(	$exercicioVerProntoAcesso->getRgc_id() &&
							$exercicioVerProntoAcesso->getRgc_inicio() != null && 
							$exercicioVerProntoAcesso->getRgc_inicio()!= "00:00:00" && 
							$exercicioVerProntoAcesso->getRgc_fim() != null && 
							$exercicioVerProntoAcesso->getRgc_fim()!= "00:00:00"){
									$result = Array(
										'id_exercicio'=>utf8_encode($exercicioVerProntoAcesso->getRgc_exercicio()),
										'nome_exercicio'=>utf8_encode($value['exe_nome']),
										'completo'=> "S"
									);	
						}else{
							$result = Array(
								'id_exercicio'=>utf8_encode($exercicioVerProntoAcesso->getRgc_exercicio()),
								'nome_exercicio'=>utf8_encode($value['exe_nome']),
								'completo'=> "N"
							);
						}
					}
					else{
						$result = Array(
							'id_exercicio'=>utf8_encode($value['exe_id']),
							'nome_exercicio'=>utf8_encode($value['exe_nome']),
							'completo'=> "N"
						);
					}				
				}

				if($value['exe_tipo']==2){
					$verificaPrePos=0;
					$exercicioVerProntoMultipla = $exercicioController->selectExercicioProntoMultipla($value['exe_id'], $logado['id']);

					$numQuestao = $exercicioController->selectCountExercicioNumQuestoes($value['exe_id']);
					if($numQuestao == 0){
						$verificaPrePos = $exercicioController->selecionaExePrePos($value['exe_id']);
					}

					// echo $value['exe_id'];
					// print_r($verificaPrePos);
					// echo "-----";
					// print_r($exercicioVerProntoMultipla);
					// echo "--- nq=";
					// print_r($numQuestao);

					if(($numQuestao != 0) && ($numQuestao == $exercicioVerProntoMultipla)){
						$result = Array(
							'id_exercicio'=>$value['exe_id'],
							'nome_exercicio'=>utf8_encode($value['exe_nome']),
							'completo'=> "S"
						);
					}else if($verificaPrePos>0 && $exercicioVerProntoMultipla>0){
						$result = Array(
							'id_exercicio'=>$value['exe_id'],
							'nome_exercicio'=>utf8_encode($value['exe_nome']),
							'completo'=> "S"
						);
					}else{
						$result = Array(
							'id_exercicio'=>$value['exe_id'],
							'nome_exercicio'=>utf8_encode($value['exe_nome']),
							'completo'=> "N"
						);
					}
				}

				if($value['exe_tipo']==4){
					$exercicioVerProntoEscrita = $exercicioController->selectExercicioProntoEscrita($value['exe_id'], $logado['id']);
					$numQuestao = $exercicioController->selectCountExercicioNumQuestoes($value['exe_id']);
					
					if($numQuestao == 0){
						$verificaPrePos = $exercicioController->selecionaExePrePos($value['exe_id']);
					}

					if(($numQuestao != 0) && ($numQuestao == $exercicioVerProntoEscrita)){
						$result = Array(
							'id_exercicio'=>$value['exe_id'],
							'nome_exercicio'=>utf8_encode($value['exe_nome']),
							'completo'=> "S"
						);
					}else if($verificaPrePos>1 && $exercicioVerProntoMultipla>1){
						$result = Array(
							'id_exercicio'=>$value['exe_id'],
							'nome_exercicio'=>utf8_encode($value['exe_nome']),
							'completo'=> "S"
						);
					}else{
						$result = Array(
							'id_exercicio'=>$value['exe_id'],
							'nome_exercicio'=>utf8_encode($value['exe_nome']),
							'completo'=> "N"
						);
					}
				}
				array_push($lista, $result);
			}
			
			print_r(json_encode($lista));
		}
		break;
	}

	case "getNameById":
		$exercicios = $exercicioController->selectByIdExercicio($_REQUEST['id']);
		echo utf8_encode($exercicios->getExe_nome());
		break;

	case "exercicioSerieCapitulo":
		$exercicios = $exercicioController->selectAllExercicioBySerieCapitulo($_REQUEST['serie'], $_REQUEST['capitulo']);
		print_r(json_encode($exercicios));
		break;
}