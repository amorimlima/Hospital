<?php

	if(!isset($_SESSION['PATH_SYS'])){
	   session_start();  
	}

	$path = $_SESSION['PATH_SYS'];

	include_once($path['dao'].'ExercicioDAO.php');
	include_once($path['controller'].'LiberarCapituloController.php');

	/**
	 * Description of Template
	 *
	 * @author MuranoDesign
	 */

	class TemplateLivros{

		public static $path;
		
		function __construct()
		{
			self::$path = $_SESSION['URL_SYS'];
		}
	        
		public function listaCapitulosLiberados()
		{	
			$logado = unserialize($_SESSION['USR']);
			$liberarCapituloController = new liberarCapituloController();
			$capitulos = $liberarCapituloController->selectByIdEscola($logado['escola']);

			foreach ($capitulos as $key => $value){
				print($value->getLbr_capitulo());
				echo '<br>';
			}
			
		}
	}
?>
