<?php

require_once "../_loadPaths.inc.php";
$path = $_SESSION["PATH_SYS"];

include_once($path["controller"]."UsuarioController.php");
include_once($path["controller"]."UsuarioVariavelController.php");
include_once($path["beans"]."Usuario.php");
include_once($path["beans"]."UsuarioVariavel.php");

switch ($_REQUEST["acao"]) {
	case 'usuarioGeral':
		$usuarioController = new UsuarioController();
		$idUsuario = $_REQUEST["id"];
		$usuario = $usuarioController->selectGeral($idUsuario);
		$retorno = Array(
			"id" 			=> utf8_encode($usuario['id']),
			"nome" 			=> utf8_encode($usuario['nome']),
			"perfil"		=> utf8_encode($usuario['perfil']),
			"escola" 		=> utf8_encode($usuario['escola']),
			"imagem" 		=> $path["arquivos"].utf8_encode($usuario['imagem']),
			"id_variavel"	=> utf8_encode($usuario['id_variavel']),
			"serie"			=> utf8_encode($usuario['serie']),
			"grupo"			=> utf8_encode($usuario['grupo'])
		);
		print_r(json_encode($retorno));
		break;

	case 'buscaAlunoSemGrupoBySerieEscola':
		$usuarioController = new UsuarioController();
		$alunos = $usuarioController->buscaAlunoSemGrupoBySerieEscola($_REQUEST['serie'], $_REQUEST['idEscola']);
		$retorno = array();
		foreach ($alunos as $aluno) {
			$a = Array(
				"idUsuario" => utf8_encode($aluno['idUsuario']),
				"nome" 		=> utf8_encode($aluno['nome']),
				"imagem"	=> utf8_encode($aluno['imagem']),
				"idVariavel"=> utf8_encode($aluno['idVariavel'])
			);
			array_push($retorno, $a);
		}
		echo json_encode($retorno);
		break;
		
	case 'alterarSenha':{
		$usuarioController = new UsuarioController();
		$senha = $_REQUEST["senha"];
		$senhaconf = $_REQUEST["confPass"];
		$email = $_REQUEST["email"];

		$mensagem = Array(
			"1" => 'campo_vazio',
			"2" => 'senhas_diferentes',
			"3" => 'alterou'
		);

		if($senha == "" || $senhaconf == ""){
			print_r(json_encode($mensagem['1'])); 
		}else if($senha != $senhaconf){
			print_r(json_encode($mensagem['2']));
		}else{
			$emailValidacao = $usuarioController->verificaEmail($email);
			$user =  new Usuario();
			$user->setUsr_senha($senha);
			$user->setUsr_id($emailValidacao['id']);
			$usuario = $usuarioController->updateSenhaByUser($user);
			if($usuario){
				print_r(json_encode($mensagem['3'])); 
			}
		}		
		break;
	}

	case 'verificaSenha':
		$usuarioController = new UsuarioController();
		$user = $usuarioController->select($_REQUEST['usuario']);
		if (md5($_REQUEST['senha']) == $user->getUsr_senha())
			echo "true";
		else
			echo '';
		break;
}

?>