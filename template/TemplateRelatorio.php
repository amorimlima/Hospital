<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
include_once($path['controller'].'EscolaController.php');
include_once($path['controller'].'RegistroGaleriaController.php');
include_once($path['controller'].'GrupoController.php');
include_once($path['controller'].'UsuarioController.php');
include_once($path['controller'].'ExercicioController.php');
include_once($path['controller'].'RespostaMultiplaController.php');
include_once($path['controller'].'GabaritoController.php');
include_once($path['beans'].'RegistroGaleria.php');
$path = $_SESSION['PATH_SYS'];
/**
 * Description of Template
 *
 * @author Diego
 */

class TemplateRelatorio{
	public static $path;

	function __construct()
	{
		self::$path = $_SESSION['URL_SYS'];
	}

	public function graficoGeral($tipoGrafico)
	{
		$user = unserialize($_SESSION['USR']);
		switch ($user['perfil_id']) {
			case 2:
				if ($tipoGrafico == "graficoGaleria")
					$this->relatorioProfessor($user['id']);
				else if ($tipoGrafico == "graficoExercicios")
					$this->exerciciosProfessor($user['id']);
				break;
			
			case 4:
				if ($tipoGrafico == "graficoGaleria")
					$this->relatorioEscola($user['escola']);
				else if ($tipoGrafico == "graficoExercicios")
					$this->exerciciosEscola($user['escola']);
				break;

			case 3:
				if ($tipoGrafico == "graficoGaleria")
					$this->relatorioNEC();
				else if ($tipoGrafico == "graficoExercicios")
					$this->exerciciosNEC();
				break;
		}
	}

	public function relatorioProfessor($idProfessor)
	{
		$grupoController = new GrupoController();
		$registroController = new RegistroGaleriaController();
		$usuarioController = new UsuarioController();
		$user = unserialize($_SESSION['USR']);
		$grupos = $grupoController->selectProfessor($idProfessor);
		$acessosGaleria = $registroController->registroGaleriaCountAcessosProfessor($idProfessor);
		$downloadGaleria = $registroController->registroGaleriaCountDownloadProfessor($idProfessor);
		foreach ($grupos as $grupo) {
			$alunosGrupo = $usuarioController->buscaUsuarioGrupo($grupo->getGrp_id());
			foreach($alunosGrupo as $aluno){
				$acessosAluno = $registroController->registroGaleriaCountAcessosUsuario($aluno['id']);
				$downloadAluno = $registroController->registroGaleriaCountDownloadUsuario($aluno['id']);
				$pctAcessosAluno = $acessosGaleria > 0? $acessosAluno/$acessosGaleria : 0;
				$pctDownloadsAluno = $downloadGaleria > 0? $downloadAluno/$downloadGaleria : 0;
				echo '<div>';
				echo 	'<div class="row">';
				echo 		'<div class="col-md-4">';
				echo 			'<div class="grafico_desc" id="aluno_id_'.utf8_encode($aluno['id']).'">';
				echo 				'<div>';
				echo 					'<span>'.utf8_encode($aluno['nome']).'</span>';
				echo 				'</div>';
				echo 			'</div>';
				echo 		'</div>';
				echo 		'<div class="col-md-8">';
				echo 			'<div class="grafico_chart">';
				echo 				'<svg class="chart">';
				echo 					'<rect y="0" width="'.($pctAcessosAluno * 100).'%" height="18" class="chart_acesso"></rect>';
				echo 					'<rect y="22" width="'.($pctDownloadsAluno*100).'%" height="18" class="chart_download"></rect>';
				echo 				'</svg>';
				echo 			'</div>';
				echo 		'</div>';
				echo 	'</div>';
				echo '</div>';
			}
		}
	}

	public function relatorioEscola($idEscola){
		$grupoController = new GrupoController();
		$registroController = new RegistroGaleriaController();
		$usuarioController = new UsuarioController();
		$professores = $usuarioController->selectProfessorByEscola($idEscola);
		$acessosGaleria = $registroController->registroGaleriaCountAcessosEscola($idEscola);
		$downloadGaleria = $registroController->registroGaleriaCountDownloadEscola($idEscola);
		foreach ($professores as $professor) {
			$idProfessor = $professor->getUsr_id();
			$grupos = $grupoController->selectProfessor($idProfessor);
			$grupo = $grupos[0];
			$acessosProfessor = $registroController->registroGaleriaCountAcessosGrupo($grupo->getGrp_id()) +  $registroController->registroGaleriaCountAcessosUsuario($idProfessor);
			$downloadProfessor = $registroController->registroGaleriaCountDownloadGrupo($grupo->getGrp_id()) + $registroController->registroGaleriaCountDownloadUsuario($idProfessor);
			$pctAcessos = $acessosGaleria > 0? $acessosProfessor/$acessosGaleria : 0;
			$pctDownloads = $downloadGaleria > 0? $downloadProfessor/$downloadGaleria : 0;
			echo '<div onclick="getProfessorById('.utf8_encode($idProfessor).')">';
			echo 	'<div class="row">';
			echo 		'<div class="col-md-4">';
			echo 			'<div class="grafico_desc" id="professor_id_'.utf8_encode($idProfessor).'">';
			echo 				'<div>';
			echo 					'<span>'.utf8_encode($professor->getUsr_nome()).'</span>';
			echo 				'</div>';
			echo 			'</div>';
			echo 		'</div>';
			echo 		'<div class="col-md-8">';
			echo 			'<div class="grafico_chart">';
			echo 				'<svg class="chart">';
			echo 					'<rect y="0" width="'.($pctAcessos * 100).'%" height="18" class="chart_acesso"></rect>';
			echo 					'<rect y="22" width="'.($pctDownloads *100).'%" height="18" class="chart_download"></rect>';
			echo 				'</svg>';
			echo 			'</div>';
			echo 		'</div>';
			echo 	'</div>';
			echo '</div>';
		}
	}

	public function relatorioNEC()
	{
		$escolaController = new EscolaController();
		$registroController = new RegistroGaleriaController();
		$escolas = $escolaController->selectAtivas();
		$acessosGaleria = $registroController->registroGaleriaCountAcessos(0);
		$downloadGaleria = $registroController->registroGaleriaCountDownload(0);
		foreach ($escolas as $escola) {
			$acessosEscola = $registroController->registroGaleriaCountAcessos($escola->getEsc_id());
			$downloadEscola = $registroController->registroGaleriaCountDownload($escola->getEsc_id());
			echo '<div onclick="getEscolaById('.utf8_encode($escola->getEsc_id()).')">';
			echo 	'<div class="row">';
			echo 		'<div class="col-md-4">';
			echo 			'<div class="grafico_desc" id="esc_id_'.utf8_encode($escola->getEsc_id()).'">';
			echo 				'<div>';
			echo 					'<span>'.utf8_encode($escola->getEsc_nome()).'</span>';
			echo 				'</div>';
			echo 			'</div>';
			echo 		'</div>';
			echo 		'<div class="col-md-8">';
			echo 			'<div class="grafico_chart">';
			echo 				'<svg class="chart">';
			echo 					'<rect y="0" width="'.(($acessosEscola/$acessosGaleria)*100).'%" height="18" class="chart_acesso"></rect>';
			echo 					'<rect y="22" width="'.(($downloadEscola/$downloadGaleria)*100).'%" height="18" class="chart_download"></rect>';
			echo 				'</svg>';
			echo 			'</div>';
			echo 		'</div>';
			echo 	'</div>';
			echo '</div>';
		}
	}

	public function exerciciosProfessor($idProfessor){
		$grupoController = new GrupoController();
		$usuarioController = new UsuarioController();
		$exerciciosController = new ExercicioController();
		$respostaMultiplaController = new RespostaMultiplaController();
		$gabaritoController = new GabaritoController();
		$grupos = $grupoController->selectProfessor($idProfessor);
		$grupo = $grupos[0];
		$alunosGrupo = $usuarioController->buscaUsuarioGrupo($grupo->getGrp_id());
		foreach ($alunosGrupo as $aluno) {
			$exerciciosAluno = $exerciciosController->countExerciciosAluno($aluno['escola'], $aluno['serie']);
			$exerciciosAlunoCompletos = $exerciciosController->countExerciciosAlunoCompletos($aluno['id']);
			$pctExerciciosCompletosAluno = $exerciciosAluno > 0? $exerciciosAlunoCompletos/$exerciciosAluno : 0;
			$multiplaAluno = $gabaritoController->countMultiplaAluno($aluno['escola'], $aluno['serie']);
			$multiplaAlunoCorretos = $respostaMultiplaController->countCorretasAluno($aluno['id']);
			$pctCorretosAluno = $multiplaAluno > 0? $multiplaAlunoCorretos/$multiplaAluno : 0;
			echo '<div>';
			echo 	'<div class="row">';
			echo 		'<div class="col-md-4">';
			echo 			'<div class="grafico_desc" id="aluno_id_'.utf8_encode($aluno['id']).'">';
			echo 				'<div>';
			echo 					'<span>'.utf8_encode($aluno['nome']).'</span>';
			echo 				'</div>';
			echo 			'</div>';
			echo 		'</div>';
			echo 		'<div class="col-md-8">';
			echo 			'<div class="grafico_chart">';
			echo 				'<svg class="chart">';
			echo 					'<rect y="0" width="'.($pctExerciciosCompletosAluno * 100).'%" height="18" class="chart_acesso"></rect>';
			echo 					'<rect y="22" width="'.($pctCorretosAluno * 100).'%" height="18" class="chart_download"></rect>';
			echo 				'</svg>';
			echo 			'</div>';
			echo 		'</div>';
			echo 	'</div>';
			echo '</div>';
		}
	}

	public function exerciciosEscola($idEscola){
		$grupoController = new GrupoController();
		$usuarioController = new UsuarioController();
		$exerciciosController = new ExercicioController();
		$respostaMultiplaController = new RespostaMultiplaController();
		$gabaritoController = new GabaritoController();
		$professores = $usuarioController->selectProfessorByEscola($idEscola);
		foreach ($professores as $professor) {
			$idProfessor = $professor->getUsr_id();
			$exerciciosProfessor = $exerciciosController->countExerciciosProfessor($idProfessor);
			$exerciciosProfessorCompletos = $exerciciosController->countExerciciosProfessorCompletos($idProfessor);
			$pctExerciciosCompletosProfessor = $exerciciosProfessor > 0? $exerciciosProfessorCompletos/$exerciciosProfessor : 0;
			$multiplaProfessor = $gabaritoController->countMultiplaProfessor($idProfessor);
			$multiplaProfessorCorretos = $respostaMultiplaController->countCorretasProfessor($idProfessor);
			$pctCorretosProfessor = $multiplaProfessor > 0? $multiplaProfessorCorretos/$multiplaProfessor : 0;
			echo '<div onclick="getProfessorById('.utf8_encode($idProfessor).')">';
			echo 	'<div class="row">';
			echo 		'<div class="col-md-4">';
			echo 			'<div class="grafico_desc" id="professor_id_'.utf8_encode($idProfessor).'">';
			echo 				'<div>';
			echo 					'<span>'.utf8_encode($professor->getUsr_nome()).'</span>';
			echo 				'</div>';
			echo 			'</div>';
			echo 		'</div>';
			echo 		'<div class="col-md-8">';
			echo 			'<div class="grafico_chart">';
			echo 				'<svg class="chart">';
			echo 					'<rect y="0" width="'.($pctExerciciosCompletosProfessor * 100).'%" height="18" class="chart_acesso"></rect>';
			echo 					'<rect y="22" width="'.($pctCorretosProfessor * 100).'%" height="18" class="chart_download"></rect>';
			echo 				'</svg>';
			echo 			'</div>';
			echo 		'</div>';
			echo 	'</div>';
			echo '</div>';
		}
	}

	public function exerciciosNEC(){
		$grupoController = new GrupoController();
		$escolaController = new EscolaController();
		$exerciciosController = new ExercicioController();
		$respostaMultiplaController = new RespostaMultiplaController();
		$gabaritoController = new GabaritoController();
		$escolas = $escolaController->selectAtivas();
		foreach ($escolas as $escola) {
			$idEscola = $escola->getEsc_id();
			$exerciciosEscola = $exerciciosController->countExerciciosEscola($idEscola);
			$exerciciosEscolaCompletos = $exerciciosController->countExerciciosEscolaCompletos($idEscola);
			$pctExerciciosCompletosEscola = $exerciciosEscola > 0? $exerciciosEscolaCompletos/$exerciciosEscola : 0;
			$multiplaEscola = $gabaritoController->countMultiplaEscola($idEscola);
			$multiplaEscolaCorretos = $respostaMultiplaController->countCorretasEscola($idEscola);
			$pctCorretosEscola = $multiplaEscola > 0? $multiplaEscolaCorretos/$multiplaEscola : 0;
			echo '<div onclick="getEscolaById('.utf8_encode($escola->getEsc_id()).')">';
			echo 	'<div class="row">';
			echo 		'<div class="col-md-4">';
			echo 			'<div class="grafico_desc" id="escola_id_'.utf8_encode($idEscola).'">';
			echo 				'<div>';
			echo 					'<span>'.utf8_encode($escola->getEsc_nome()).'</span>';
			echo 				'</div>';
			echo 			'</div>';
			echo 		'</div>';
			echo 		'<div class="col-md-8">';
			echo 			'<div class="grafico_chart">';
			echo 				'<svg class="chart">';
			echo 					'<rect y="0" width="'.($pctExerciciosCompletosEscola * 100).'%" height="18" class="chart_acesso"></rect>';
			echo 					'<rect y="22" width="'.($pctCorretosEscola * 100).'%" height="18" class="chart_download"></rect>';
			echo 				'</svg>';
			echo 			'</div>';
			echo 		'</div>';
			echo 	'</div>';
			echo '</div>';
		}
	}

}

?>


