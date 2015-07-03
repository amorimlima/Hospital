<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'PatrocinioController.php');
include_once($path['beans'].'Patrocinio.php');
include_once($path['sys'].'Nav/Navigator.php');
include_once($path['dao'].'Functions.php');
include_once($path['controller'].'Thumbs.php');
$patrocinioController = new PatrocinioController();
$cidade = $_SESSION['CIDADE'];	

//Miniatura da imagem 
$img = Functions::addImagem($_FILES["img"],250,100,0);

gerar_tumbs_real($img["x_p"],$img["y_p"], 100,$paths["temporaria"]."".$img["img_p"],$paths["miniaturas"]."".$img["img_p"]);

//Imagem Grande Galeria
gerar_tumbs_real($img["x"],$img["y"], 100,$paths["temporaria"]."".$img["img"],$paths["imgg"]."".$img["img"]);
					
  		$patrocinio = new Patrocinio();
		
	    	$patrocinio->setCidadePatrocinio($cidade);
	    	$patrocinio->setTituloPatrocinio($_POST["tituloPatrocinio"]);
	    	$patrocinio->setSitePatrocinio($_POST["sitePatrocinio"]);
			$patrocinio->setEnderecoPatrocinio($_POST["enderecoPatrocinio"]);
	    	$patrocinio->setBairroPatrocinio($_POST["bairroPatrocinio"]);
			$patrocinio->setTelefonePatrocinio($_POST["telefonePatrocinio"]);
			$patrocinio->setEmailPatrocinio($_POST["emailPatrocinio"]);
	    	$patrocinio->setImgPatrocinio($img["img"]);
			
			//print_r($patrocinio);
			$patrocinioController->insertPatrocinio($patrocinio);
							
			Navigator::goPage('patrocinio');	

?>