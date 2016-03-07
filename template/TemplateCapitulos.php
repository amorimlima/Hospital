<?php

	if(!isset($_SESSION['PATH_SYS'])){
	   session_start();  
	}

	$path = $_SESSION['PATH_SYS'];

	include_once($path['dao'].'ExercicioDAO.php');
	include_once($path['controller'].'ExercicioController.php');
	include_once($path['controller'].'UsuarioController.php');
	include_once($path['controller'].'UsuarioVariavelController.php');

	/**
	 * Description of Template
	 *
	 * @author MuranoDesign
	 */

	class TemplateCapitulos{

		public static $path;
		
		function __construct()
		{
			self::$path = $_SESSION['URL_SYS'];
		}
	        
		public function listaExercicios()
		{	

			$usuarioVariavelController = new UsuarioVariavelController();	
			$exercicioController = new ExercicioController();


			$logado = unserialize($_SESSION['USR']);
			$capitulo = $_GET['capitulo'];
			$ano = $_GET['ano'];
			$userVariavel = $usuarioVariavelController->selectByIdUsuario($logado['id']);

			if($logado['perfil'] == "Aluno"){
				$exercicios = $exercicioController->selectAllExercicioBySerieCapituloLiberado($userVariavel->getUsv_ano_letivo(), $logado['escola'],  $capitulo);
			}else{
				$exercicios = $exercicioController->selectAllExercicioBySerieCapituloLiberado($ano, $logado['escola'],  $capitulo);
			}			

			foreach ($exercicios as $key => $value){
				print($value->getExe_nome());
			}
			
		}
	}
?>
