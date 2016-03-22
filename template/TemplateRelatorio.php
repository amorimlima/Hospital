<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
include_once($path['controller'].'EscolaController.php');
include_once($path['controller'].'RegistroGaleriaController.php');
include_once($path['beans'].'RegistroGaleria.php');
$path = $_SESSION['PATH_SYS'];
/**
 * Description of Template
 *
 * @author MuranoDesign
 */

class TemplateRelatorio{
	public static $path;

	function __construct()
	{
		self::$path = $_SESSION['URL_SYS'];
	}

	public function graficoEscolas()
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


