<?php
session_start();
$paths = $_SESSION['PATH_SYS'];
require_once ($paths["controller"]."UsuarioController.php");

if(isset($_POST)){
	
	$usuario = str_replace("'", "",$_POST["usuario"]);
	$senha = str_replace("'","", $_POST["senha"]);
	//$senha = md5($senha);

	$usuarioController = new UsuarioController();
	$user = $usuarioController->autenticaUsuario($usuario, $senha);
	
	if($user!=null){
		//$adm = Array('nome'=>$user->getNome(),'id'=>$user->getId(),'grupo'=>$user->getGrupo_id());
		//$_SESSION['ADM'] = serialize($adm);
		$result = Array('erro'=>false,'msg'=>'Logado!!','url'=>'painel.php');
	}else{
		
//		if($_SESSION['ADM']){
//			unset($_SESSION['ADM']);
//		}
		$result = Array('erro'=>true,'msg'=>utf8_encode('Usuário ou Senha Inválida!!'));
	}
	//print_r($result);
	echo json_encode($result);	
}
