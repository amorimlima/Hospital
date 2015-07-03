<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'FotoEventoController.php');
include_once($path['beans'].'FotoEvento.php');
include_once($path['sys'].'Nav/Navigator.php');
include_once($path['dao'].'Functions.php');
include_once($path['controller'].'Thumbs.php');
$fotoEventoController = new FotoEventoController();	
$cidade = $_SESSION['CIDADE'];	
$idEvento = $_GET["id"];

if(($_FILES['img']['size'] == 0) || ($_FILES['img']['size'] > 1024*1024)){
	Navigator::goPage('evento');
}else{	
	$img = Functions::addImagem($_FILES["img"],600,100,250);
	
	//MImagem em miniatura
	gerar_tumbs_real($img["x_p"],$img["y_p"], 100,$paths["temporaria"]."".$img["img_p"],$paths["miniaturas"]."".$img["img_p"]);
	
	//Imagem Grande 
	gerar_tumbs_real($img["x"],$img["y"], 100,$paths["temporaria"]."".$img["img"],$paths["imgg"]."".$img["img"]);
	
	//Imagem Media 
	gerar_tumbs_real($img["x_m"],$img["y_m"], 100,$paths["temporaria"]."".$img["img"],$paths["imgp"]."".$img["img"]);				
			
				$fotoEvento = new FotoEvento();
				
				$fotoEvento->setEventoFoto($idEvento);		
				$fotoEvento->setFotoEvento($img["img"]);				
						
				$fotoEventoController->insertFotoEvento($fotoEvento);
					
				Navigator::goPage('evento');
}
?>