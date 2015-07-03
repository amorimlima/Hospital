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
                    <a href="livro.php">
                    	<img src="img/bt_livros_normal.png" id="mn_livro" width="103" height="40" alt=""/>
                    </a>
                    <a href="mensagens.php">
                    	<img src="img/bt_mensagens_normal.png" id="mn_mensagens" width="142" height="38" alt=""/>
                    </a>
                    <a href="forum.php">
                    	<img src="img/bt_forum_normal.png" id="mn_forum" width="114" height="38" alt=""/>
                    </a>
                    <a href="galeria.php">
                    	<img src="img/bt_galeria_normal.png" id="mn_galeria" width="111" height="38" alt=""/>
                    </a>
                </div>
			  </div>';
   }
}
?>
