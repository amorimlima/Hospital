<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}

//session_start();
include_once($path['dao'].'GaleriaDao.php');
include_once($path['controller'].'GaleriaController.php');
$path = $_SESSION['PATH_SYS'];

/**
 * Description of Template
 *
 * @author MuranoDesign
 */

class TemplateGaleria{

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
