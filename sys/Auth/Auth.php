<?php

session_start();

$paths = $_SESSION['PATH_SYS'];

include_once($paths['DB'].'DataAccess.php');
include_once($paths['beans'].'Usuario.php');
include_once($paths['dao'].'UsuarioDAO.php');

class Auth  
{
	private $usuario;
	private $senha;
	
	private $usuarioDAO;
	
	public function __construct($usuario, $senha)
	{
		$this->usuario = $usuario;
		$this->senha = $senha;	
				
		$this->initDAO(); 
		
	}
	
	private function initDAO () 
	{
		$this->usuarioDAO = new UsuarioDAO(new DataAccess());
	}
			
			
	public function doAuth()
	{	
		$usuarioAuth = $this->usuarioDAO->autentica($this->usuario, $this->senha);

		if ($usuarioAuth)
		{
   		    $_SESSION['AUTHENTICATED_USER'] = serialize($usuarioAuth);
							
			return $usuarioAuth;
		}
		else
			return false;			
			
	}        
			
	
	public static function logout()
	{
		session_unset();
		session_destroy();
		setcookie("USER_AUTH","");
	}
	
	
	public static function viewSession()
	{		                
       	if(isset($_SESSION['AUTHENTICATED_USER']))
			return true;
		else
			return false;
	}        
	
}


?>