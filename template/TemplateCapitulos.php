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
	        
		public function listaExercicios($introducao)
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

			foreach ($exercicios as $i => $value) {
				if($introducao== 'ok' && $value['exe_ordem']==1){
					echo '<iframe id="objeto" src="Objetos/'.$value['drt_nome'].$value['exe_nome'].'/index.html" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" msallowfullscreen="true"></iframe>';
				}

				if($introducao=='n_ok'){
					echo '<span id="obj_'.$i.'" url="'.$value['drt_nome'].$value['exe_ordem'].'_'.$value['exe_nome'].'" qtd="'.count($exercicios).'" class="tema obj_icone obj_icone'.count($exercicios).'_'.(++$i).'"></span>';
				}
			}
		}

	}
?>
