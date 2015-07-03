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

$icone = Functions::addImagem($_FILES["icone"],300,100,0);

gerar_tumbs_real($icone["x_p"],$icone["y_p"], 100,$paths["temporaria"]."".$icone["img_p"],$paths["miniaturas"]."".$icone["img_p"]);
gerar_tumbs_real($icone["x"],$icone["y"], 100,$paths["temporaria"]."".$icone["img"],$paths["imgg"]."".$icone["img"]);

$img_mapa = Functions::addImagem($_FILES["img_mapa"],300,100);

gerar_tumbs_real($img_mapa["x_p"],$img_mapa["y_p"], 100,$paths["temporaria"]."".$img_mapa["img_p"],$paths["miniaturas"]."".$img_mapa["img_p"]);
gerar_tumbs_real($img_mapa["x"],$img_mapa["y"], 100,$paths["temporaria"]."".$img_mapa["img"],$paths["imgg"]."".$img_mapa["img"]);

		$mapa = new Mapa();
			
    		$mapa->setIconeMapa($icone["img"]);		
    		$mapa->setEnderecoMapa($_POST["endereco_mapa"]);
    		$mapa->setTextoMapa($_POST["texto_mapa"]);
    		$mapa->setImgMapa($img_mapa["img"]);
			$mapa->setIdCidade($cidade);
			
			//print_r($mapa);
			$mapaController->insertMapa($mapa);
				
			Navigator::goPage('mapa');	

?>