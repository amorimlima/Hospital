<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
include_once($path['controller'].'EscolaController.php');
include_once($path['controller'].'RegistroGaleriaController.php');
include_once($path['controller'].'GrupoController.php');
include_once($path['controller'].'UsuarioController.php');
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

	public function graficoEscolas()
	{
		$user = unserialize($_SESSION['USR']);
		switch ($user['perfil_id']) {
			case 2:
				$this->relatorioProfessor();
				break;
			
			case 4:
				$this->relatorioEscola();
				break;

			case 3:
				$this->relatorioNEC();
				break;
		}
	}

	public function relatorioProfessor()
	{
		$grupoController = new GrupoController();
		$registroController = new RegistroGaleriaController();
		$usuarioController = new UsuarioController();
		$user = unserialize($_SESSION['USR']);
		$idProfessor = $user['id'];
		$grupos = $grupoController->selectProfessor($idProfessor);
		$grupo = $grupos[0];
		$acessosGaleria = $registroController->registroGaleriaCountAcessosGrupo($grupo->getGrp_id());
		$downloadGaleria = $registroController->registroGaleriaCountDownloadGrupo($grupo->getGrp_id());
		$alunosGrupo = $usuarioController->buscaUsuarioGrupo($grupo->getGrp_id());
		foreach($alunosGrupo as $aluno){
			$acessosAluno = $registroController->registroGaleriaCountAcessosAluno($aluno['id']);
			$downloadAluno = $registroController->registroGaleriaCountDownloadAluno($aluno['id']);
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

	public function relatorioEscola()
	{
		# code...
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
}

?>


