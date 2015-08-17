<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}

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
        echo'<div class="col-lg-12" id="topo">
                <div class="row" id="row_logout">                    
                    <div class="col-xs-12 col-md-6 col-lg-7 pull-right" id="boxMenu">
                    	<div id="user_logout">
                        	<div id="user_logout_pequena">
                                <p id="user_logado">Rosana Amaral</p>
                                <span id="separador">
                                    <img class="img-responsive" src="img/separador.png" width="2" height="22" alt=""/>
                                </span>
                                <p id="logout">SAIR</p>
                            </div>
                        </div>
                        <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <nav id="bs-navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
                            <ul class="nav navbar-nav" id="menu">';
								foreach($menuLista as $menu){
									$menuId = explode(".", $menu->getBtn_menu()); 
									echo '<li class="mn_li" id="mn_livros_sub">
									<a href="'.$menu->getBtn_menu().'" id="mn_'.$menuId[0].'" class="mn_a_menu"></a>';
									if($menuId[0]=='livros'){
										echo'<ul id="sbm_exercicios">
												<li class="sub_a">
													<a href="livros.php?ano_1">1º Ano</a>
												</li>
												<li class="sub_a">
													<a href="livros.php?ano_2">2º Ano</a>
												</li>
												<li class="sub_a">
													<a href="livros.php?ano_3">3º Ano</a>
												</li>
												<li class="sub_a">
													<a href="livros.php?ano_4">4º Ano</a>
												</li>
												<li class="sub_a">
													<a href="livros.php?ano_5">5º Ano</a>
												</li>
											</ul>';
									}
									echo'</li>';
								}                
            				echo'</ul>
							</nav>
						</div>
					</div>
					<div class="row">                	
						<div class="col-xs-12 col-md-6 col-lg-5" id="logo">
							<a href="index.php"><img src="img/logo.png"/></a>
						</div>                    
					</div>
			   </div>';
    }
}

?>
