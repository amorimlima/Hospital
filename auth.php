<?php
session_start();
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}

$paths = $_SESSION['PATH_SYS'];
require_once ($paths["controller"]."UsuarioController.php");

if(isset($_POST)){
	
	$usuario = str_replace("'", "",$_POST["usuario"]);
	$senha = str_replace("'","", $_POST["senha"]);
	//$senha = md5($senha);

	$usuarioController = new UsuarioController();
	$user = $usuarioController->autenticaUsuario($usuario, $senha);

	//print_r($user);
	if($user!=null){
		$adm = Array('nome'=>$user->getUsr_nome(),'id'=>$user->getUsr_id());
		$_SESSION['USR'] = serialize($adm);
		$result = Array('erro'=>false,'msg'=>'Logado!!','url'=>'inicio.php');
	}else{
		
//		if($_SESSION['ADM']){
//			unset($_SESSION['ADM']);
//		}
		$result = Array('erro'=>true,'msg'=>utf8_encode('Usuário ou Senha Inválida!!'));
	}
	//print_r($result);
	echo json_encode($result);	
}
