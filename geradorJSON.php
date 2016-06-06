<?php
	
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php';
}

$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'EscolaJSONController.php');
include_once($path['beans'].'EscolaJSON.php');
$escolaJSONController = new EscolaJSONController();


$query = json_encode($_POST);

$escolaJSON = new EscolaJSON();

$escolaJSON->setEjs_escola($_SESSION['idEscolaPre']);
$escolaJSON->setEjs_string($query);

echo $escolaJSONController->insert($escolaJSON);


?>