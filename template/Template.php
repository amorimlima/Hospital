<?php

session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'MenuController.php');

/**
 * Description of Template
 *
 * @author MuranoDesign
 */
class Template {

    public static $path;

    function __construct() {
        self::$path = $_SESSION['URL_SYS'];
    }

    //Topo Site	
    public function topoSite(){
        $menuControler = new MenuController();
        $menuLista = $menuControler->selectTipoPerfil('Botao','2');
        echo'<div id="logo">
            	<a href="index.php"><img src="img/logo.png" width="359" height="61" alt=""/></a>
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
                <ul>';
                    foreach($menuLista as $menu){
                        $menuId = explode(".", $menu->getBtn_menu()); 
                        echo '<li><a href="'.$menu->getBtn_menu().'" id="mn_'.$menuId[0].'"></a>';
                        if($menuId[0]=='livros'){
                            echo'<ul id="sbm_exercicios">
                                <li><a href="#">1º Ano</a></li>
                                <li><a href="#">2º Ano</a></li>
                                <li><a href="#">3º Ano</a></li>
                                <li><a href="#">4º Ano</a></li>
                                <li><a href="#">5º Ano</a></li>
                            </ul>';
                        }
                        echo'</li>';
                    }                
            echo'</ul></div></div>';
    }
}

?>
