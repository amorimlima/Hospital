<?php

if(!isset($_SESSION['PATH_SYS'])){
   require_once '../_loadPaths.inc.php';
}

$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'EscolaJSONController.php');
include_once($path['beans'].'EscolaJSON.php');


switch ($_REQUEST["acao"])
{
	case "novoPreCadastro":
	{
		$escolaJSONController = new EscolaJSONController();

		$query = json_encode($_POST);

		$escolaJSON = new EscolaJSON();

		$escolaJSON->setEjs_escola($_SESSION['idEscolaPre']);
		$escolaJSON->setEjs_string($query);

		if ($escolaJSONController->insert($escolaJSON))
			echo json_encode(["status"=>1, "retorno"=>"Registro salvo com sucesso."]);
		else
			throw new Exception("Erro ao salvar registro.", 1);

		break;
	}

	case "getAquivoPdf":
	{
		$escolaJSONController = new EscolaJSONController();
		$idesc = $_GET["idesc"];
		$result = $escolaJSONController->selectByIdEscola($idesc);

		if ($escolaJSONController->selectByIdEscola($idesc)) {
			$data = json_decode($result["esj_string"]);

			print_r($data);
		}
		else throw new Exception("Erro ao retornar registro", 1);

		break;
	}
}

?>