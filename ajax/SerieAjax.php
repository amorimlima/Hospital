<?php
require_once '../_loadPaths.inc.php';

$path = $_SESSION['PATH_SYS'];

include_once($path['beans'] . 'Serie.php');
include_once($path['beans'] . 'Grupo.php');
include_once($path['controller'] . 'SerieController.php');
include_once($path['controller'] . 'GrupoController.php');

$serieController = new SerieController();
$grupoController = new GrupoController();

switch ($_REQUEST["acao"]) {
	case "selectAll":
		$series		= $serieController->selectAll();
		$retorno	= Array("erro" => false, "retorno" => Array());

		if (count($series) > 0) {
			foreach ($series as $serie) {
				$sri = Array(
					"id"	=> utf8_encode($serie->getSri_id()),
					"serie"	=> utf8_encode($serie->getSri_serie())
				);

				array_push($retorno["retorno"], $sri);
			}
		} else {
			$sri = Array("mensagem" => "Nenhuma serie cadastrada ate o momento.");

			array_push($retorno["retorno"], $sri);
		}

		echo json_encode($retorno);
	break;

	case "selectById":
		$retorno = Array("erro" => false, "retorno" => Array());

		if (isset($_REQUEST["id"])) {
			$idserie	= $_REQUEST["id"];
			$serie	= $serieController->select($idserie);


			if ($periodo->getPrd_id()) {
				$sri = Array(
					"id" 	=> utf8_encode($serie->getSri_id()),
					"serie" => utf8_encode($serie->getSri_serie())
				);

				array_push($retorno["retorno"], $sri);
			} else {
				$sri = Array("mensagem"=>"Serie nao encontrada.");

				array_push($retorno["retorno"], $sri);
			}
		} else {
			$retorno["erro"] = true;
			$retorno["retorno"] = Array("mensagem" => "Parametro id ausente.");
		}

		echo json_encode($retorno);
	break;

	default:
		$retorno = Array("erro"=>true, "mensagem"=>"Parametro acao invalido");

		echo json_encode($retorno);
	break;
}
?>