<?php
session_start();
$path = $_SESSION['PATH_SYS'];

/**
 * Description of Template
 *
 * @author MuranoDesign
 */

class Template {

    public static $path;

	function __construct()
	{
		self::$path = $_SESSION['URL_SYS'];
	}

   //Topo Site	
   public function topoSite()
   {
		echo '<div id="logo">
            	<img src="img/logo.png" width="359" height="61" alt=""/>
              </div>
              <div id="boxMenu"> 
                <div id="user_logout">
                    <p id="user_logado">Rosana Amaral</p>
                    <span id="separador">
                    	<img src="img/separador.png" width="2" height="22" alt=""/>
                    </span>
                    <p id="logout">SAIR</p>
                </div>		
                <div id="menu">
                    <a href="livro.php" id="mn_livro"></a>
                    <a href="mensagens.php" id="mn_mensagens"></a>
                    <a href="forum.php" id="mn_forum"></a>
                    <a href="galeria.php" id="mn_galeria"></a>
                </div>
			  </div>';
   }
}
?>
