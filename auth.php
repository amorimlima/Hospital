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
					'pagina'		 =>utf8_encode($user['prf_pagina']),
					'idUserVariavel' =>$userVariavel->getUsv_id(),
					'serie'          =>$userVariavel->getUsv_serie()
				);

		if($adm['perfil_id'] == 1){
			$serie = $adm['serie']; 
		}

		$_SESSION['USR'] = serialize($adm);
		$result = Array('erro'=>false,'msg'=>'Logado!!','url'=>$adm['url'],'serie'=>$serie);
	}else{

		$result = Array('erro'=>true,'msg'=>'Usuário ou Senha Inválida!!');
	}

	echo json_encode($result);
}
