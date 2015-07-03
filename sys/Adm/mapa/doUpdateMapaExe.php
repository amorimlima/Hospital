<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'MapaController.php');
include_once($path['beans'].'Mapa.php');
include_once($path['sys'].'Nav/Navigator.php');
include_once($path['dao'].'Functions.php');
include_once($path['controller'].'Thumbs.php');
$mapaController = new MapaController();
$cidade = $_SESSION['CIDADE'];	
$idMapa = $_GET["id"];	
$iconeAntigo = $_GET["icone"];
$img_mapaAntiga = $_GET["img_mapa"];

	
	$mapa = new Mapa();
		
		$mapa->setIdMapa($idMapa);
		$mapa->setEnderecoMapa($_POST["endereco_mapa"]);
		$mapa->setTextoMapa($_POST["texto_mapa"]);
		$mapa->setIdCidade($cidade);
		
		if(empty($_FILES["icone"]['name'])){
			$mapa->setIconeMapa($iconeAntigo);
		}else{
			$icone = Functions::addImagem($_FILES["icone"],300,100,0);
			gerar_tumbs_real($icone["x_p"],$icone["y_p"], 100,$paths["temporaria"]."".$icone["img_p"],$paths["miniaturas"]."".$icone["img_p"]);
			gerar_tumbs_real($icone["x"],$icone["y"], 100,$paths["temporaria"]."".$icone["img"],$paths["imgg"]."".$icone["img"]);
				
			$mapa->setIconeMapa($icone["img"]);
		}
		
		if(empty($_FILES["img_mapa"]['name'])){
			$mapa->setImgMapa($img_mapaAntiga);
		}else{			
			$img_mapa = Functions::addImagem($_FILES["img_mapa"],300,100);
			gerar_tumbs_real($img_mapa["x_p"],$img_mapa["y_p"], 100,$paths["temporaria"]."".$img_mapa["img_p"],$paths["miniaturas"]."".$img_mapa["img_p"]);
			gerar_tumbs_real($img_mapa["x"],$img_mapa["y"], 100,$paths["temporaria"]."".$img_mapa["img"],$paths["imgg"]."".$img_mapa["img"]);
			
			$mapa->setImgMapa($img_mapa["img"]);
		}
		
		
		//print_r($mapa);
		$mapaController->updateMapa($mapa);
			
		Navigator::goPage('mapa');	
?>