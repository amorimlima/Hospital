 <?php
session_start();
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php';
}

$paths = $_SESSION['PATH_SYS'];
require_once ($paths["controller"]."UsuarioController.php");
include_once($path['controller'].'UsuarioVariavelController.php');

if(isset($_POST)){

	$usuario = str_replace("'", "",$_POST["usuario"]);
	$senha = str_replace("'","", $_POST["senha"]);
    //$senha = md5($senha);

	$usuarioController = new UsuarioController();
	$usuarioVariavelController = new UsuarioVariavelController();	

	$user = $usuarioController->autenticaUsuario($usuario, $senha);
	$userVariavel = $usuarioVariavelController->selectByIdUsuario($user['usr_id']);

	if($user!=null){
		$adm = Array(
					'nome'			 =>$user['usr_nome'],
					'id'			 =>$user['usr_id'],
					'perfil'		 =>$user['prf_perfil'],
					'perfil_id'		 =>$user['prf_id'],
					'url'			 =>$user['prf_url'],
					'escola'		 =>$user['usr_escola'],
					'pagina'		 =>utf8_encode($user['prf_pagina'])					
				);



		if($adm['perfil_id'] == 1){
			array_push($adm,array('idUserVariavel'=>$userVariavel->getUsv_id(),'serie'=>$userVariavel->getUsv_serie()));
		}

		$_SESSION['USR'] = serialize($adm);
		$result = Array('erro'=>false,'msg'=>'Logado!!','url'=>$adm['url']);

		if($adm['perfil_id'] == 1){
			array_push($result,array('serie'=>$adm[0]['serie']));
		}
	}else{

		$result = Array('erro'=>true,'msg'=>'Usuário ou Senha Inválida!!');
	}

	print_r(json_encode($result));
}
