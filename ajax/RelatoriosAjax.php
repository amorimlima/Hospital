<?php
require_once "../_loadPaths.inc.php";
$path = $_SESSION["PATH_SYS"];

include_once($path["controller"]."LiberarCapituloController.php");
include_once($path["controller"]."EscolaController.php");
include_once($path["controller"]."CapituloController.php");
include_once($path["controller"]."UsuarioController.php");
include_once($path['controller'].'RegistroGaleriaController.php');
include_once($path['controller'].'GrupoController.php');
include_once($path["beans"]."LiberarCapitulo.php");
include_once($path["beans"]."Escola.php");
include_once($path["beans"]."Capitulo.php");
include_once($path["beans"]."Usuario.php");
include_once($path['beans'].'RegistroGaleria.php');
include_once($path["funcao"]."DatasFuncao.php");
include_once($path["funcao"]."Thumbs.php");
include_once($path['template'].'TemplateRelatorio.php');

switch ($_REQUEST["acao"]) {
	case "listarEscolas":
		$escolaController = new EscolaController();
		$escolas = $escolaController->selectAtivas();
		$listaEscolas = Array();

		if (count($escolas) > 0) {
			foreach ($escolas as $key => $esc) {
				$escola = Array(
					"id" 	=> utf8_encode($esc->getEsc_id()),
					"nome" 	=> utf8_encode($esc->getEsc_nome())
				);
				array_push($listaEscolas, $escola);
			}
		}

		print json_encode($listaEscolas);
	break;
	
	case "escolaPorId":
		$escolaController = new EscolaController();
		$idEscola = $_REQUEST["id"];
		$escola = $escolaController->select($idEscola);
		$retorno = "";

		if ($escola) {
			$retorno = Array(
				"id" 			=> utf8_encode($escola->getEsc_id()),
				"status"		=> utf8_encode($escola->getEsc_status()),
				"nome" 			=> utf8_encode($escola->getEsc_nome()),
				"razao_social" 	=> utf8_encode($escola->getEsc_razao_social()),
				"endereco" 		=> Array(
					"id" 	 	=> utf8_encode($escola->getEsc_endereco()->getEnd_id()),
					"cidade" 	=> utf8_encode($escola->getEsc_endereco()->getEnd_cidade()),
					"uf" 	 	=> utf8_encode($escola->getEsc_endereco()->getend_uf()),
					"email" 	=> utf8_encode($escola->getEsc_endereco()->getEnd_email()),
					"telefone"  => utf8_encode($escola->getEsc_endereco()->getend_telefone_residencial())
				),
				"site" 			=> utf8_encode($escola->getEsc_site()),
				"diretor" 		=> Array(
					"nome" 		=> utf8_encode($escola->getEsc_nome_diretor()),
					"email" 	=> utf8_encode($escola->getEsc_email_diretor())
				),
				"coordenador" 	=> Array(
					"nome" 		=> utf8_encode($escola->getEsc_nome_coordenador()),
					"email" 	=> utf8_encode($escola->getEsc_email_coordenador())
				)

			);
		}

		print json_encode($retorno);
	break;

	case "professoresPorEscola":
		$usuarioController = new UsuarioController();
		$idEscola = $_REQUEST["id"];
		$professores = $usuarioController->selectProfessorByEscola($idEscola);
		$retorno = Array();

		if (count($professores) > 0) {
			foreach ($professores as $key => $prof) {
				$professor = Array(
					"id" 					=> utf8_encode($prof->getUsr_id()),
					"nome" 					=> utf8_encode($prof->getUsr_nome()),
					"data_nascimento" 		=> utf8_encode($prof->getUsr_data_nascimento()),
					"escola" 				=> utf8_encode($prof->getUsr_escola()),
					"data_entrada_escola"	=> utf8_encode($prof->getUsr_data_entrada_escola()),
					"rg" 					=> utf8_encode($prof->getUsr_rg()),
					"cpf" 					=> utf8_encode($prof->getUsr_cpf()),
					"login" 				=> utf8_encode($prof->getUsr_login()),
					"imagem" 				=> $path["arquivos"].utf8_encode($prof->getUsr_imagem()),
					"nse" 					=> utf8_encode($prof->getUsr_nse()),
					"endereco" 				=> Array(
						"logradouro" 			=> utf8_encode($prof->getUsr_endereco()->getend_logradouro()),
						"numero" 				=> utf8_encode($prof->getUsr_endereco()->getend_numero()),
						"complemento" 			=> utf8_encode($prof->getUsr_endereco()->getend_complemento()),
						"bairro" 				=> utf8_encode($prof->getUsr_endereco()->getend_bairro()),
						"cep" 					=> utf8_encode($prof->getUsr_endereco()->getend_cep()),
						"cidade" 				=> utf8_encode($prof->getUsr_endereco()->getend_cidade()),
						"uf" 					=> utf8_encode($prof->getUsr_endereco()->getend_uf()),
						"pais" 					=> utf8_encode($prof->getUsr_endereco()->getend_pais()),
						"tel_residencial" 		=> utf8_encode($prof->getUsr_endereco()->getend_telefone_residencial()),
						"tel_comercial" 		=> utf8_encode($prof->getUsr_endereco()->getend_telefone_comercial()),
						"tel_celular" 			=> utf8_encode($prof->getUsr_endereco()->getend_telefone_celular()),
						"email" 				=> utf8_encode($prof->getUsr_endereco()->getend_email())
					),
					"perfil" 				=> Array(
						"id" 					=>utf8_encode($prof->getUsr_perfil()->getPrf_id()),
						"perfil" 				=>utf8_encode($prof->getUsr_perfil()->getPrf_perfil()),
						"url" 					=>utf8_encode($prof->getUsr_perfil()->getPrf_url()),
						"pagina" 				=>utf8_encode($prof->getUsr_perfil()->getPrf_pagina())
					)
				);
				array_push($retorno, $professor);
			}
		}

		print_r(json_encode($retorno));
	break;

	case "professorPorId":
		$usuarioController = new UsuarioController();
		$idProfessor = $_REQUEST["id"];
		$professor = $usuarioController->select($idProfessor);
		$retorno = "";

		if ($professor) {
			$retorno = Array(
				"id" 					=> utf8_encode($professor->getUsr_id()),
				"nome" 					=> utf8_encode($professor->getUsr_nome()),
				"data_nascimento" 		=> utf8_encode($professor->getUsr_data_nascimento()),
				"escola" 				=> utf8_encode($professor->getUsr_escola()),
				"data_entrada_escola"	=> utf8_encode($professor->getUsr_data_entrada_escola()),
				"rg" 					=> utf8_encode($professor->getUsr_rg()),
				"cpf" 					=> utf8_encode($professor->getUsr_cpf()),
				"login" 				=> utf8_encode($professor->getUsr_login()),
				"imagem" 				=> $path["arquivos"].utf8_encode($professor->getUsr_imagem()),
				"nse" 					=> utf8_encode($professor->getUsr_nse())
			);
		}

		print json_encode($retorno);
	break;

	case 'graficoGaleria':
		$user = unserialize($_SESSION['USR']);
		$templateRelatorio = new TemplateRelatorio();
		switch ($user['perfil_id']) {
			case 2:
				$templateRelatorio->relatorioProfessor();
				break;
			
			case 4:
				$templateRelatorio->relatorioEscola();
				break;

			case 3:
				$templateRelatorio->relatorioNEC();
				break;
		}
		break;

	case 'graficoExercicios':
		$user = unserialize($_SESSION['USR']);
		$templateRelatorio = new TemplateRelatorio();
		switch ($user['perfil_id']) {
			case 2:
				$templateRelatorio->exerciciosProfessor();
				break;
			
			case 4:
				$templateRelatorio->exerciciosEscola();
				break;

			case 3:
				$templateRelatorio->relatorioNEC();
				break;
		}
		break;

	default:
		$result = Array("erro"=>true, "mensagem"=>"Parametro 'acao' invalido.");
		print json_encode($result);
	break;
}

?>