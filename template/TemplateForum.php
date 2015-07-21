<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}

//session_start();
include_once($path['dao'].'ForumQuestaoDao.php');
include_once($path['dao'].'ForumTopicoDAO.php');
include_once($path['dao'].'ForumRespostaDAO.php');
include_once($path['controller'].'ForumQuestaoController.php');
include_once($path['controller'].'ForumRespostaController.php');
include_once($path['controller'].'ForumTopicoController.php');

$path = $_SESSION['PATH_SYS'];

/**
 * Description of Template
 *
 * @author MuranoDesign
 */

class TemplateForum{

    public static $path;

	function __construct()
	{
		self::$path = $_SESSION['URL_SYS'];
	}
        
   public function Teste()
   {
		
   }
 
}
?>
