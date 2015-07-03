<?php

session_start();

$paths = $_SESSION['PATH_SYS'];

include_once($paths['DB'].'DataAccess.php');
include_once($paths['Aut'].'Auth.php');
include_once($paths['Nav'].'Navigator.php');
include_once($paths['dao'].'UsuarioDAO.php');
if(empty ($_POST["login"])){
    Navigator::goPage('error_auth');
}
        $user = str_replace("'", "",$_POST["email"]);
        $pass = str_replace("'", "",$_POST["senha"]);

$auth = new Auth(trim($user), trim($pass));

// Recebe os dados de Usuário e Senha
$usuario = $auth->doAuth();
  //verifica se esiste usuario
if ($usuario->getEmailUsuario())
{
	//echo $usuario->getEmailUsuario();
        //vai p/ pagina do cliente  
		$_SESSION['CIDADE'] = $usuario->getCidadeUsuario();    
        
	Navigator::goPage('logou');
	//echo "passou";
    
}
else
{
	echo "Não passou";
	// Retorna para a página de inicial/
        session_unset();
       session_destroy();
        setcookie("USER_AUTH", "",time()-24*3600,"/");
	Navigator::goPage('naoLogou');
        
}


?>