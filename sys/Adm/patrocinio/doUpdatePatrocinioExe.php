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
$idPatrocinio =	$_GET["id"];
$imagemAntiga = $_GET["imagem"];
					
  		$patrocinio = new Patrocinio();
		
			$patrocinio->setIdPatrocinio($idPatrocinio);
	    	$patrocinio->setCidadePatrocinio($cidade);
	    	$patrocinio->setTituloPatrocinio($_POST["tituloPatrocinio"]);
	    	$patrocinio->setSitePatrocinio($_POST["sitePatrocinio"]);
			$patrocinio->setEnderecoPatrocinio($_POST["enderecoPatrocinio"]);
	    	$patrocinio->setBairroPatrocinio($_POST["bairroPatrocinio"]);
			$patrocinio->setTelefonePatrocinio($_POST["telefonePatrocinio"]);
			$patrocinio->setEmailPatrocinio($_POST["emailPatrocinio"]);
			
			if(empty($_FILES["imagem"]['name'])){
				$patrocinio->setImgPatrocinio($imagemAntiga);
			}else{
				$img = Functions::addImagem($_FILES["imagem"],250,100,0);
				gerar_tumbs_real($img["x_p"],$img["y_p"], 100,$paths["temporaria"]."".$img["img_p"],$paths["miniaturas"]."".$img["img_p"]);
				gerar_tumbs_real($img["x"],$img["y"], 100,$paths["temporaria"]."".$img["img"],$paths["imgg"]."".$img["img"]);
				
				$patrocinio->setImgPatrocinio($img["img"]);
			}
			
			//echo "<pre>";			
			//print_r($_FILES["imagem"]);			
			$patrocinioController->updatePatrocinio($patrocinio);
							
			Navigator::goPage('patrocinio');	

?>