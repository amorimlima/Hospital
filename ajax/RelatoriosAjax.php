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
include_once($path["beans"]."RegistroGaleria.php");
include_once($path["beans"]."Grupo.php");
include_once($path["funcao"]."DatasFuncao.php");
include_once($path["funcao"]."Thumbs.php");
include_once($path["template"]."TemplateRelatorio.php");

switch ($_REQUEST["acao"]) {

	case 'adicionarGrupoProfessorSeriePeriodo':
		$grupoController = new GrupoController();
		$grupo = $grupoController->listarProfessorSeriePeriodo($_REQUEST['idProfessor'], $_REQUEST['serie'], $_REQUEST['periodo']);
		$usuarioController = new UsuarioController();
		$usuarioController->adicionarAlunosGrupo($grupo['id'], $_REQUEST['alunos']);
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
				"tipo_escola"	=> utf8_encode($escola->getEsc_tipo_escola()->getTps_tipo_escola()),
				"administracao"	=> utf8_encode($escola->getEsc_administracao()->getAdm_administracao()),
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
				)
			);
		}

		print json_encode($retorno);
	break;

	case "usuarioPorId":
		$usuarioController = new UsuarioController();
		$idUsuario = $_REQUEST["id"];
		$usuario = $usuarioController->select($idUsuario);
		$retorno = "";
		
		if ($usuario) {
			$escolaController = new EscolaController();
			$escola = $escolaController->select($usuario->getUsr_escola());
				
			$retorno = Array(
				"id" 					=> utf8_encode($usuario->getUsr_id()),
				"nome" 					=> utf8_encode($usuario->getUsr_nome()),
				"data_nascimento" 		=> utf8_encode($usuario->getUsr_data_nascimento()),
				"perfil"				=> utf8_encode($usuario->getUsr_perfil()),
				"escola" 				=> utf8_encode($usuario->getUsr_escola()),
				"data_entrada_escola"	=> utf8_encode($usuario->getUsr_data_entrada_escola()),
				"rg" 					=> utf8_encode($usuario->getUsr_rg()),
				"cpf" 					=> utf8_encode($usuario->getUsr_cpf()),
				"login" 				=> utf8_encode($usuario->getUsr_login()),
				"imagem" 				=> $path["arquivos"].utf8_encode($usuario->getUsr_imagem()),
				"nse" 					=> utf8_encode($usuario->getUsr_nse()),
				"escola_nome"           =>  utf8_encode($escola->getEsc_nome())
			);
		}

		print json_encode($retorno);
	break;

	case 'carregaGrafico':
		$templateRelatorio = new TemplateRelatorio();
		$templateRelatorio->carregaGrafico($_REQUEST);
	break;

	case 'carregaFiltro':
		set_time_limit(0);
		$templateRelatorio = new TemplateRelatorio();
		$templateRelatorio->carregaFiltro($_REQUEST);
	break;
	
	default:
		$result = Array("erro"=>true, "mensagem"=>"Parametro 'acao' invalido.", "acao" => $_REQUEST['acao']);
		print json_encode($result);
	break;
}

?>