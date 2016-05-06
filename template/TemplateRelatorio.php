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
include_once($path['controller'].'LiberarCapituloController.php');
include_once($path['controller'].'RelatorioController.php');
include_once($path['controller'].'SerieController.php');
include_once($path['beans'].'RegistroGaleria.php');
include_once($path['beans'].'Grupo.php');
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

	public function carregaGrafico($par)
	{
		$relatorioController = new RelatorioController();
		$listados = $relatorioController->getListaVisualizacao($par);
		foreach ($listados as $listado) {
			$barrasGrafico = $relatorioController->getBarrasUsuario ($par, $listado);
			echo '<div onclick="'.$listado['perfil'].'GetById('.$listado['id'].')">';
			echo 	'<div class="row">';
			echo 		'<div class="col-md-4">';
			echo 			'<div class="grafico_desc" id="listado_id_'.utf8_encode($listado['id']).'">';
			echo 				'<div>';
			echo 					'<span>'.utf8_encode($listado['nome']).'</span>';
			echo 				'</div>';
			echo 			'</div>';
			echo 		'</div>';
			echo 		'<div class="col-md-8">';
			echo 			'<div class="grafico_chart">';
			echo 				'<svg class="chart">';
			echo 					'<rect y="0" width="'.($barrasGrafico['barra1'] * 100).'%" height="18" class="chart_acesso"></rect>';
			echo 					'<rect y="22" width="'.($barrasGrafico['barra2'] * 100).'%" height="18" class="chart_download"></rect>';
			echo 				'</svg>';
			echo 			'</div>';
			echo 		'</div>';
			echo 	'</div>';
			echo '</div>';
		}
	}

	public function carregaFiltro($par)
	{
		$relatorioController = new RelatorioController();
		$listados = $relatorioController->getFiltros($par);
		echo '<option value="0">Todos</option>';
		foreach ($listados as $listado)
			echo '<option value="'.$listado['id'].'">'.utf8_encode($listado['nome']).'</option>';
	}

	public function getLivros($par)
	{
		$relatorioController = new RelatorioController();
		$livros = $relatorioController->getLivros($par);
		echo '<option value="0" selected>Todos</option>';
		foreach ($livros as $livro)
			echo '<option value="'.$livro['id'].'">'.utf8_encode($livro['nome']).'</option>';
	}

	public function getCapitulos($par)
	{
		$relatorioController = new RelatorioController();
		$capitulos = $relatorioController->getCapitulos($par);
		echo '<option value="0" selected>Todos</option>';
		foreach ($capitulos as $capitulo)
				echo '<option value="'.$capitulo['id'].'">'.utf8_encode($capitulo['nome']).'</option>';
	}

	public function getSalas($par)
	{
		$relatorioController = new RelatorioController();
		$salas = $relatorioController->getSalas($par);
		echo '<option value="0" selected>Todos</option>';
		foreach ($salas as $sala) {
			echo '<option value="'.$sala['id'].'">'.utf8_encode($sala['nome']).'</option>';
		}
	}

}

?>


