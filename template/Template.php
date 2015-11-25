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
		//$usuarioController = new UsuarioController();
		if (!isset($_SESSION['USR'])) {
			header("location:index.php");
			die();
		} else $usrLogado = unserialize($_SESSION['USR']);
		$NomeUser = $usrLogado['nome'];
		$menuLista = $menuControler->selectTipoPerfil('Botao',$usrLogado['perfil_id']);
		//$usuario = $usuarioController->select();
        echo'<div class="col-lg-12" id="topo">
                <div class="row" id="row_logout">                    
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-'.($usrLogado['perfil_id']==1?'8':'7').' pull-right" id="boxMenu">
                    	<div id="user_logout">
                        	<div id="user_logout_pequena">
                                <p id="user_logado">'.$usrLogado['nome'].'</p>
                                <span id="separador">
                                    <img class="img-responsive" src="img/separador.png" width="2" height="22" alt=""/>
                                </span>
                                <a id="logout" href="sair.php">SAIR</a>
                            </div>
                        </div>
                        <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <nav id="bs-navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
                        	<div id="menu_container" class="'.($usrLogado['perfil_id']==1?'menu_container_aluno':'menu_container_normal').'">
	                            <ul class="nav navbar-nav" id="menu">';
									foreach($menuLista as $menu){
										$menuId = explode(".", $menu->getBtn_menu());
										echo '<li class="mn_li" id="mn_livros_sub">';
										if ($usrLogado['perfil_id'] == 1 && $menuId[0]=='exercicios'){
												echo'
													<a href="#" id="mn_'.$menuId[0].'" class="mn_a_menu"></a>
													<ul id="sbm_exercicios">
														<li class="sub_a menu_li_capitulo">
															<a href="capitulos.php?ano_5_capitulo_1">1º Capítulo</a>
														</li>
														<li class="sub_a menu_li_capitulo">
															<a href="#" class="Li_not-a-link">2º Capítulo</a>
														</li>
														<li class="sub_a menu_li_capitulo">
															<a href="#" class="Li_not-a-link">3º Capítulo</a>
														</li>
														<li class="sub_a menu_li_capitulo">
															<a href="#" class="Li_not-a-link">4º Capítulo</a>
														</li>
														<li class="sub_a menu_li_capitulo">
															<a href="capitulos.php?ano_5_capitulo_5">5º Capítulo</a>
														</li>
													</ul>';
										}elseif($usrLogado['perfil_id'] != 1 && $menuId[0]=='livros'){
											  echo'<a href="#" id="mn_'.$menuId[0].'" class="mn_a_menu"></a>
													<ul id="sbm_exercicios">
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
										}else{
											 echo'<a href="'.$menu->getBtn_menu().'" id="mn_'.$menuId[0].'" class="mn_a_menu"></a>';
										}
										echo'</li>';
									}                
	            				echo'</ul>
	            				</div>
							</nav>
						</div>
					</div>
					<div class="row">                	
						<div class="col-xs-12 col-sm-12 col-md-5 col-lg-'.($usrLogado['perfil_id']==1?'4':'5').'" id="logo">
							<a href="'.$usrLogado['url'].'"><div id="logotipo"></div></a>
						</div>                    
					</div>
			   </div>';
    }
	/*
		$paginaMensagem => AQUI VAI O NOME DA PÁGINA ONDE VAI APARECER A MENSAGEM
		$textoMensagem  => TEXTO QUE VAI APARECER NA MENSAGEM
		$tipoMensagem	=> ÍCONE QUE VAI APARECER NA MENSAGEM(ERRO, ALERTA OU SUCESSO)
	*/
	public function mensagemRetorno($paginaMensagem,$textoMensagem,$tipoMensagem){
        switch($paginaMensagem){
			case 'mensagens':{
				$corBorda = 'borda_azul';
				$corTexto = 'txt_azul';
				$corBotao = 'btn_azul';
				break;
			}
			case 'forum':{
				$corBorda = 'borda_vermelho';
				$corTexto = 'txt_vermelho';
				$corBotao = 'btn_vermelho';
				break;
			}
			case 'galeria':{
				$corBorda = 'borda_laranja';
				$corTexto = 'txt_laranja';
				$corBotao = 'btn_laranja';
				break;
			}
			case 'livros':{
				$corBorda = 'borda_verde';
				$corTexto = 'txt_verde';
				$corBotao = 'btn_verde';
				break;
			}		
		}
            
		echo '<div class="modal fade exibirMsg in" id="myModal" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="'.$corBorda.'">
						<div class="modal-body">
							<div class="'.$tipoMensagem.'"></div>
							<div class="modal-body-container">
								<div class="text-modal">
									<p class="'.$corTexto.'">'.$textoMensagem.'</p>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn '.$corBotao.' botao_modal" >OK</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-backdrop fade in"></div>';
	}
}

?>
