<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'FotoPontoTuristicoController.php');
include_once($path['beans'].'fotoPontoTuristico.php');
include_once($path['sys'].'Nav/Navigator.php');
include_once($path['dao'].'Functions.php');
include_once($path['controller'].'Thumbs.php');
$fotoPontoTuristicoController = new FotoPontoTuristicoController();	
$cidade = $_SESSION['CIDADE'];	
$idPontoTuristico = $_GET["id"];

//Miniatura da imagem 
$img = Functions::addImagem($_FILES["img"],300,100,0);
//print_r($img);

gerar_tumbs_real($img["x_p"],$img["y_p"], 100,$paths["temporaria"]."".$img["img_p"],$paths["miniaturas"]."".$img["img_p"]);

//Imagem Grande Galeria

gerar_tumbs_real($img["x"],$img["y"], 100,$paths["temporaria"]."".$img["img"],$paths["imgg"]."".$img["img"]);
				
		
			$fotoPontoTuristico = new FotoPontoTuristico();
			
    		$fotoPontoTuristico->setPontoTuristicoFoto($idPontoTuristico);		
    		$fotoPontoTuristico->setFotoPontoTuristico($img["img"]);
			
    		//print_r($fotoPontoTuristico);		
			$fotoPontoTuristicoController->insertFotoPontoTuristicos($fotoPontoTuristico);
				
			Navigator::goPage('pontoTuristico');	
?>