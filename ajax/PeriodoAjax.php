<?php
require_once '../_loadPaths.inc.php';

$path = $_SESSION['PATH_SYS'];

include_once($path['beans'] . 'Periodo.php');
include_once($path['beans'] . 'Grupo.php');
include_once($path['controller'] . 'PeriodoController.php');
include_once($path['controller'] . 'GrupoController.php');

$periodoController = new periodoController();
$grupoController = new GrupoController();

switch ($_REQUEST["acao"]) {
	case "selectAll":
		$periodos	= $periodoController->selectAll();
		$retorno	= Array("erro" => false, "retorno" => Array());

		if (count($periodos) > 0) {
			foreach ($periodos as $periodo) {
				$prd = Array(
					"id"	  => utf8_encode($periodo->getPrd_id()),
					"periodo" => utf8_encode($periodo->getPrd_periodo())
				);

				array_push($retorno["retorno"], $prd);
			}
		} else {
			$prd = Array("mensagem" => "Nenhum periodo cadastrado ate o momento.");

			array_push($retorno["retorno"], $prd);
		}

		echo json_encode($retorno);
	break;

	case "selectById":
		$retorno = Array("erro" => false, "retorno" => Array());

		if (isset($_REQUEST["id"])) {
			$idperiodo	= $_REQUEST["id"];
			$periodo	= $periodoController->selectById($idperiodo);


			if ($periodo->getPrd_id()) {
				$prd = Array(
					"id" 		=> utf8_encode($periodo->getPrd_id()),
					"periodo" 	=> utf8_encode($periodo->getPrd_periodo())
				);

				array_push($retorno["retorno"], $prd);
			} else {
				$prd = Array("mensagem"=>"Periodo nao encontrado.");

				array_push($retorno["retorno"], $prd);
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