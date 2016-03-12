<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();
}

$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'MenuController.php');
include_once($path['controller'].'UsuarioVariavelController.php');
include_once($path['controller'].'ExercicioController.php');

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
                    <div class="col-xs-12">
                        <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    	<div id="user_logout">
                        	<div id="user_logout_pequena">
                                <p id="user_logado">'.$usrLogado['nome'].'</p>
                                <span id="separador">
                                    <img class="img-responsive" src="img/separador.png" width="2" height="22" alt=""/>
                                </span>
                                <a id="logout" href="sair.php">SAIR</a>
                            </div>
                        </div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-4" id="logo">
							<a href="'.$usrLogado['url'].'" class="logo_container">
                                <div class="logotipo"></div>
                            </a>
						</div>
                        <div class="col-xs-12 col-md-8">
                            <nav id="bs-navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
                        	    <div id="menu_container" class="'.($usrLogado['perfil_id']==1?'menu_container_aluno':'menu_container_normal').'">
                                    <ul class="nav navbar-nav" id="menu">';
                                        foreach($menuLista as $menu){
                                            $menuId = explode(".", $menu->getBtn_menu());
                                            echo '<li class="mn_li" id="mn_livros_sub">';
                                            if ($usrLogado['perfil_id'] == 1 && $menuId[0]=='exercicios'){

                                                $usuarioVariavelController = new UsuarioVariavelController();
                                                $exercicioController = new ExercicioController();

                                                $logado = unserialize($_SESSION['USR']);
                                                $userVariavel = $usuarioVariavelController->selectByIdUsuario($logado['id']);
                                                $exercicios = $exercicioController->selectAllExercicioBySerieCapituloLiberado($userVariavel->getUsv_ano_letivo(), $logado['escola'],"");
                                                $capitulos = Array();

                                                foreach ($exercicios as $i => $value){
                                                    if(!in_array($value['exe_capitulo'],$capitulos)){
                                                        $capitulos[$i] = $value['exe_capitulo'];
                                                    }
                                                }

                                                echo'<a href="#" id="mn_'.$menuId[0].'" class="mn_a_menu"></a>
                                                        <ul id="sbm_exercicios">
                                                            <li class="sub_a menu_li_capitulo '.(in_array('1', $capitulos) ? "" : "inativoL").'">
                                                                <a href="capitulos.php?capitulo=1">1º Capítulo</a>
                                                            </li>
                                                            <li class="sub_a menu_li_capitulo '.(in_array('2', $capitulos) ? "" : "inativoL").'">
                                                                <a href="capitulos.php?capitulo=2">2º Capítulo</a>
                                                            </li>
                                                            <li class="sub_a menu_li_capitulo '.(in_array('3', $capitulos) ? "" : "inativoL").'">
                                                                <a href="capitulos.php?capitulo=3">3º Capítulo</a>
                                                            </li>
                                                            <li class="sub_a menu_li_capitulo '.(in_array('4', $capitulos) ? "" : "inativoL").'">
                                                                <a href="capitulos.php?capitulo=4">4º Capítulo</a>
                                                            </li>
                                                            <li class="sub_a menu_li_capitulo '.(in_array('5', $capitulos) ? "" : "inativoL").'">
                                                                <a href="capitulos.php?capitulo=5">5º Capítulo</a>
                                                            </li>
                                                        </ul>';


                                            }elseif($usrLogado['perfil_id'] != 1 && $menuId[0]=='livros'){
                                                  echo'<a href="#" id="mn_'.$menuId[0].'" class="mn_a_menu"></a>
                                                        <ul id="sbm_exercicios" style="width: 85px; margin: 6px 19px;">
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
				$onClick = '';
				break;
			}
			case 'forum':{
				$corBorda = 'borda_vermelho';
				$corTexto = 'txt_vermelho';
				$corBotao = 'btn_vermelho';
				$onClick = '';
				break;
			}
			case 'galeria':{
				$corBorda = 'borda_laranja';
				$corTexto = 'txt_laranja';
				$corBotao = 'btn_laranja';
				$onClick = '';
				break;
			}
			case 'livros':{
				$corBorda = 'borda_verde';
				$corTexto = 'txt_verde';
				$corBotao = 'btn_verde';
				$onClick = '';
				break;
			}
            case 'exercicios':{
                $corBorda = 'borda_verde';
                $corTexto = 'txt_verde';
                $corBotao = 'btn_verde';
                $onClick = 'onclick="redireciona(\'areaAluno.php\')"';
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
							<button type="button" class="btn '.$corBotao.' botao_modal" '.$onClick.'>OK</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-backdrop fade in"></div>';
	}
}

?>
