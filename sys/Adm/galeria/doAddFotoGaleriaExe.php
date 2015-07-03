<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['beans'].'GaleriaFoto.php');
include_once($path['controller'].'GaleriaFotoController.php');
include_once($path['sys'].'Nav/Navigator.php');
include_once($path['dao'].'Functions.php');
include_once($path['controller'].'Thumbs.php');
$cidade = $_SESSION['CIDADE'];	
//echo "<pre>";
$galeriaFotoController = new GaleriaFotoController();

//Miniatura da imagem 
$img = Functions::addImagem($_FILES["img"],500,100,0);
//print_r($img);

gerar_tumbs_real($img["x_p"],$img["y_p"], 100,$path["temporaria"]."".$img["img_p"],$path["miniaturas"]."".$img["img_p"]);

//Imagem Grande Galeria

gerar_tumbs_real($img["x"],$img["y"], 100,$path["temporaria"]."".$img["img"],$path["imgg"]."".$img["img"]);

			
			$galeriaFoto = new GaleriaFoto();
			
    		$galeriaFoto->setCidadeGaleria($cidade);		
    		$galeriaFoto->setFotoGaleria($img["img"]);
			
			$galeriaFotoController->insertGaleriaFoto($galeriaFoto);
						
			Navigator::goPage('galeria');
?>
