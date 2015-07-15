<?php
<<<<<<< HEAD
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
=======
//session_start();
include_once($path['dao'].'MensagemDAO.php');
include_once($path['controller'].'MensagemController.php');
>>>>>>> origin/master
$path = $_SESSION['PATH_SYS'];

/**
 * Description of Template
 *
 * @author MuranoDesign
 */

class TemplateMensagens {

    public static $path;

	function __construct()
	{
		self::$path = $_SESSION['URL_SYS'];
	}
   //Topo Site	
   public function Teste()
   {
		
   }
   
   public function recebidos(){
       $mensagem = new MensagemController();
       return $mensagem->count();
       
   }
   
}
?>
