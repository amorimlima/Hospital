<?php

	if(!isset($_SESSION['PATH_SYS'])){
	   session_start();  
	}

	$path = $_SESSION['PATH_SYS'];

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
			$userVariavel = $usuarioVariavelController->selectByIdUsuario($logado['id']);

			if($logado['perfil'] == "Aluno"){
				$exercicios = $exercicioController->selectAllExercicioBySerieCapituloLiberado($userVariavel->getUsv_ano_letivo(), $logado['escola'],  $capitulo);
				if(!empty($exercicios)){
					$bool = true;
				}else{
					$bool = false;
				}
			}else if(($logado['perfil'] == "Unidade Escolar") || ($logado['perfil'] == "Professor")){
				$ano = $_GET['ano'];
				$exercicios = $exercicioController->selectAllExercicioBySerieCapituloLiberado($ano, $logado['escola'],  $capitulo);
				if(!empty($exercicios)){
					$bool = true;
				}else{
					$bool = false;
				}
			}else{
				$ano = $_GET['ano'];
				$exercicios = $exercicioController->selectAllExercicioBySerieCapitulo($ano, $capitulo);
				$bool = true;
			}

			if($bool == true){
				foreach ($exercicios as $i => $value) {
					if($introducao== 'ok' && $value['exe_ordem']==1){
						echo '<iframe id="objeto" src="Objetos/'.$value['drt_nome'].$value['exe_nome'].'/index.html" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" msallowfullscreen="true"></iframe>';
					}

					if($introducao=='n_ok'){
						echo '<span id="obj_'.$value['exe_id'].'" class="obj_icone"></span>';
					}
				}
			}else{
				return $erro = "erro";
			}
		}

		public function listaFundo(){
			switch ($_GET['capitulo']) {
				case '1':
					$cssMapa = Array(
						'idFundo'  => 'id="btn_exercicio_1"',
						'parabens' => 'id="btn_exercicio_1_parabens"',
						'parabens_brilho' => 'id="btn_exercicio_1_parabens_brilho"'
					 );

					return $cssMapa;
				break;
				
				case '2':
					$cssMapa = Array(
						'idFundo'  => 'id="btn_exercicio_2"',
						'parabens' => 'id="btn_exercicio_2_parabens"',
						'parabens_brilho' => 'id="btn_exercicio_2_parabens_brilho"'
					 );

					return $cssMapa;
				break;

				case '3':
					$cssMapa = Array(
						'idFundo'  => 'id="btn_exercicio_3"',
						'parabens' => 'id="btn_exercicio_3_parabens"',
						'parabens_brilho' => 'id="btn_exercicio_3_parabens_brilho"'
					 );

					return $cssMapa;
				break;

				case '4':
					$cssMapa = Array(
						'idFundo'  => 'id="btn_exercicio_4"',
						'parabens' => 'id="btn_exercicio_4_parabens"',
						'parabens_brilho' => 'id="btn_exercicio_4_parabens_brilho"'
					 );

					return $cssMapa;
				break;

				case '5':
					$cssMapa = Array(
						'idFundo'  => 'id="btn_exercicio_5"',
						'parabens' => 'id="btn_exercicio_5_parabens"',
						'parabens_brilho' => 'id="btn_exercicio_5_parabens_brilho"'
					 );

					return $cssMapa;
				break;
			}
		}
	}
?>
