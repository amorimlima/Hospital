<?php

if (!isset($_SESSION['PATH_SYS'])) {
    session_start();
}

$path = $_SESSION['PATH_SYS'];
include_once($path['controller'] . 'ForumQuestaoController.php');
include_once($path['controller'] . 'ForumRespostaController.php');
include_once($path['controller'] . 'ForumTopicoController.php');
include_once($path['controller'] . 'ForumViewController.php');
include_once($path['controller'] . 'UsuarioController.php');
include_once($path['funcao'] . 'DatasFuncao.php');

/**
 * Description of Template
 *
 * @author MuranoDesign
 */
class TemplateForum {

    public static $path;

    function __construct() {
        self::$path = $_SESSION['URL_SYS'];
    }

    public function listaAlunos() {
        $forumController = new ForumQuestaoController();
        $viewController = new ForumViewController();
        $respController = new ForumRespostaController();
        $dataFuncao = new DatasFuncao();

        $forum = $forumController->selectAprovadas();
        $cont = 0;

        foreach ($forum as $key => $value) {
            $view = $viewController->totalByQuestao($value->getFrq_id());
            $resp = $respController->totalByQuestao($value->getFrq_id());

            if ($cont % 2 == 0) {
                $caixaGrande = "cx_rosa";
                $caixaPequena = "cx_brancaP";
            } else {
                $caixaGrande = "cx_branca";
                $caixaPequena = "cx_rosaP";
            }

            if (file_exists("imgp/".$value->getFrq_usuario()->getUsr_imagem())) {
                $foto = $value->getFrq_usuario()->getUsr_imagem();
            } else {
                $foto = 'default.png';
            }

            echo '<a href="forumResposta.php?resp=' . $value->getFrq_id() . '" id="caixaQuestao' . $value->getFrq_id() . '"><div id="perg_box' . $value->getFrq_id() . '" class="perg_box ' . $caixaGrande . ' row">
					<div class="perg_box_1 col-xs-12 col-md-7 col-lg-7">
						<p class="foto_aluno"><img src="imgp/' . $foto . '"></p>
						<p class="perg_aluno questaoTexto" id="' . $value->getFrq_id() . '">' . utf8_encode($value->getFrq_questao()) . '</p>
						<p class="nome_aluno">' . utf8_encode($value->getFrq_usuario()->getUsr_nome()) . '</p>
						<p class="post_data">Tópico: ' . utf8_encode($value->getFrq_topico()->getFrt_topico()) . ' | Postado dia ' . $dataFuncao->dataTimeBRExibicao($value->getFrq_data()) . '</p>
					</div>
					<div class="perg_box_2 col-xs-12 col-md-5 col-lg-5">
						<p id="qtd_visu' . $value->getFrq_id() . '" class="qtd_visu ' . $caixaPequena . '"><span>' . $view . '</span> visualizações</p>
						<p id="qtd_resp' . $value->getFrq_id() . '" class="qtd_resp ' . $caixaPequena . '"><span>' . $resp . '</span> respostas</p>
					</div>
				</div></a>';

            $cont++;
        }
    }

    public function listarTopicosPendentes() {
        $usuario = unserialize($_SESSION['USR']);
        $perfilLogado = $usuario["perfil_id"];
        $dataFuncao = new DatasFuncao();

        if (intval($perfilLogado) === 2 || intval($perfilLogado) === 4) {
            $forumQuestaoController = new ForumQuestaoController();
            $questoesPendentes = $forumQuestaoController->selectPendentes();
            
            function verificarImagem($arquivo) {
                if (file_exists("imgp/" . $arquivo))
                    return $arquivo;
                else
                    return "default.png";
            }

            echo "<div id=\"box_questoes_pendentes_container\">";
            echo    "<div id=\"box_questoes_pendentes\">";

            if (count($questoesPendentes) > 0) {
                foreach ($questoesPendentes as $questao) {
                    echo "<div id=\"box_questao" . $questao->getFrq_id() . "\">";
                    echo    "<div class=\"row perg_box\">";
                    echo        "<div class=\"perg_box_1 col-xs-12 col-md-9\">";
                    echo            "<p class=\"foto_aluno\"><img src=\"imgp/" . verificarImagem($questao->getFrq_usuario()->getUsr_imagem()) . "\"></p>";
                    echo            "<p id=\"" . $questao->getFrq_id() . "\" class=\"perg_aluno questaoTexto\">" . utf8_encode($questao->getFrq_questao()) . "</p>";
                    echo            "<p class=\"nome_aluno\">" . $questao->getFrq_usuario()->getUsr_nome() . "</p>";
                    echo            "<p class=\"post_data\">Tópico: " . utf8_encode($questao->getFrq_topico()->getFrt_topico()) . " | Solicitado dia " . $dataFuncao->dataTimeBRExibicao($questao->getFrq_data()) . "</p>";
                    echo        "</div>";
                    echo        "<div class=\"btns_container col-xs-12 col-md-3\">";
                    echo            "<button type=\"button\" data-action=\"aceitar\" data-topico=\"" . $questao->getFrq_topico()->getFrt_id() . "\" id=\"btn_aceitar" . $questao->getFrq_id() . "\" class=\"btn btn-primary\">Aceitar Tópico</p>";
                    echo            "<button type=\"button\" data-action=\"rejeitar\" data-topico=\"" . $questao->getFrq_topico()->getFrt_id() . "\" id=\"btn_rejeitar" . $questao->getFrq_id() . "\" class=\"btn\">Rejeitar tópico</p>";
                    echo        "</div>";
                    echo    "</div>";
                    echo "</div>";
                }
            } else {
                echo "<div class=\"alert_container\">";
                echo    "<div class=\"alert alert-warning\">Nenhum tópico ou questão pendente de aprovação.</div>";
                echo "</div>";
            }

            echo    "</div>";
            echo "</div>";
        }
    }
    
    public function mostrarAbasForum() {
        $usuario = unserialize($_SESSION['USR']);
        $perfilLogado = $usuario["perfil_id"];
        
        if (intval($perfilLogado) === 2 || intval($perfilLogado) === 4){
            echo "<p class=\"titulo_box_forum ativo\" id=\"txt_postagens\">POSTAGENS RECENTES</p>";
            echo "<p class=\"titulo_box_forum\" id=\"txt_topicos_pendentes\">TÓPICOS PENDENTES</p>";
        } else {
            echo "<p class=\"titulo_box_forum ativo\" id=\"txt_postagens\">POSTAGENS RECENTES</p>";
        }
        
    }

}

?>
