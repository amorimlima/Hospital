<?php
require_once "../_loadPaths.inc.php";
$path = $_SESSION["PATH_SYS"];

include_once($path["controller"]."LiberarCapituloController.php");
include_once($path["controller"]."EscolaController.php");
include_once($path["controller"]."CapituloController.php");
include_once($path["beans"]."LiberarCapitulo.php");
include_once($path["beans"]."Escola.php");
include_once($path["beans"]."Capitulo.php");
include_once($path["funcao"]."DatasFuncao.php");
include_once($path["funcao"]."Thumbs.php");

switch ($_REQUEST["acao"]) {
	case "deletar":
		$idLibCap = $_REQUEST["id"];
		$liberarCapituloController = new LiberarCapituloController();
		$result = "";

		if ($deletado = $liberarCapituloController->deleteByIdLiberarCapitulo($idLibCap))
			$result = Array("erro"=>false, "mensagem"=>"Deletado com sucesso.");
		else
			$result = Array("erro"=>true, "mensagem"=>"Erro ao deletar.");

		print json_encode($result);

	break;

	case "liberar":
		$idCap = $_REQUEST["capitulo"];
		$idEsc = $_REQUEST["escola"];

		$liberarCapituloController = new LiberarCapituloController();
		$liberarCapitulo = new LiberarCapitulo();
		$liberarCapitulo->setLbr_escola($idEsc);
		$liberarCapitulo->setLbr_capitulo($idCap);
		$liberarCapitulo->setLbr_status(1);

		$result = "";

		if ($inserido = $liberarCapituloController->insertLiberarCapitulo($liberarCapitulo))
			$result = Array("erro"=>false, "mensagem"=>"Capitulo liberado com sucesso.");
		else
			$result = Array("erro"=>true, "mensagem"=>"Erro ao liberar capitulo.");

		print json_encode($result);
	break;

	case "listar":
		$idEscola = $_REQUEST["id"];
		$liberarCapituloController = new LiberarCapituloController();
		$capitulos = $liberarCapituloController->selectByIdEscola($idEscola);
		$result = Array();

		foreach ($capitulos as $key => $cap) {
			$capitulo = Array(
				"id" 		=> utf8_encode($cap->getLbr_id()),
				"escola" 	=> utf8_encode($cap->getLbr_escola()),
				"capitulo" 	=> Array(
					"id" 		=> utf8_encode($cap->getLbr_capitulo()->getCpt_id()),
					"capitulo" 	=> utf8_encode($cap->getLbr_capitulo()->getCpt_capitulo()),
				),
				"status" 	=> utf8_encode($cap->getLbr_status())
			);

			array_push($result, $capitulo);
		}

		print json_encode($result);
	break;
	
	default:
		$result = Array("erro"=>true, "mensagem"=>"Parametro 'acao' invalido.");

		print json_encode($result);
	break;
}
?>