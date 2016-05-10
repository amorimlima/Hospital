<?php

if (!isset($_SESSION['PATH_SYS'])) {
    session_start();
}

$path = $_SESSION['PATH_SYS'];
include_once($path['controller'] . 'ForumQuestaoController.php');
include_once($path['controller'] . 'ForumRespostaController.php');
include_once($path['controller'] . 'ForumTopicoController.php');
include_once($path['controller'] . 'ForumViewController.php');
include_once($path['controller'] . 'ForumQuestaoParticipanteController.php');
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
        $frqParticipante = new ForumQuestaoParticipanteController();
        $dataFuncao = new DatasFuncao();
        $idusr = (unserialize($_SESSION["USR"])["id"]);
        $idesc = (unserialize($_SESSION["USR"])["escola"]);
        $questoes = [];

        if ($idesc)
            $questoes = $forumController->selectAprovadasByEscola($idesc);
        else
            $questoes = $forumController->selectAllAprovadas($idesc);
        $cont = 0;

        function verificarAlteracaoQuestao($fqp, $frr) {
            $fqp_d = strtotime($fqp->getFqp_ultima_visualizacao());
            $frr_d = strtotime($frr->getFrr_data());
            
            if ($fqp_d - $frr_d < 0)
                return true;
            else
                return false;
        }

        foreach ($questoes as $key => $value) {
            $resp = $respController->totalByQuestao($value->getFrq_id());
            $labelNovo = "";

            if ($frqParticipante->verificarParticipante($value->getFrq_id(), $idusr)) {
                $fqp = $frqParticipante->getUltimaVisualizacao($value->getFrq_id(), $idusr);
                $frr = $respController->getMaisRecenteByQuestao($value->getFrq_id());

                if ($frr && verificarAlteracaoQuestao($fqp, $frr))
                    $labelNovo = "<span class=\"badge\">Novo</span>";
            }


            if ($cont % 2 == 0) {
                $caixaGrande = "cx_rosa";
                $caixaPequena = "cx_brancaP";
            } else {
                $caixaGrande = "cx_branca";
                $caixaPequena = "cx_rosaP";
            }

            if (file_exists("imgp/".$value->getFrq_usuario()->getUsr_imagem()))
                $foto = $value->getFrq_usuario()->getUsr_imagem();
            else
                $foto = 'default.png';

            $idfrq  = $value->getFrq_id();
            $frq    = utf8_encode($value->getFrq_questao());
            $usr    = utf8_encode($value->getFrq_usuario()->getUsr_nome());
            $frt    = utf8_encode($value->getFrq_topico()->getFrt_topico());
            $data   = $dataFuncao->dataTimeBRExibicao($value->getFrq_data());
            $views  = $value->getFrq_visualizacoes();

            echo '<a href="forumResposta.php?resp='.$idfrq.'" id="caixaQuestao'.$idfrq.'">';
            echo     '<div id="perg_box'.$idfrq.'" class="perg_box '.$caixaGrande.' row">';
            echo         '<div class="perg_box_1 col-xs-12 col-md-7 col-lg-7">';
            echo             '<p class="foto_aluno"><img src="imgp/'.$foto.'"></p>';
            echo             '<p class="perg_aluno questaoTexto" id="'.$idfrq.'">'.$frq.' '.$labelNovo.'</p>';
            echo             '<p class="nome_aluno">'.$usr.'</p>';
            echo             '<p class="post_data">Tópico: '.$frt.' | Postado dia '.$data.'</p>';
            echo         '</div>';
            echo         '<div class="perg_box_2 col-xs-12 col-md-5 col-lg-5">';
            echo             '<p id="qtd_visu'.$idfrq.'" class="qtd_visu '.$caixaPequena.'"><span>'.$views.'</span> visualizações</p>';
            echo             '<p id="qtd_resp'.$idfrq.'" class="qtd_resp '.$caixaPequena.'"><span>'.$resp.'</span> respostas</p>';
            echo         '</div>';
            echo     '</div>';
            echo '</a>';

            $cont++;
        }
    }

    public function listarTopicosPendentes() {
        $usuario = unserialize($_SESSION['USR']);
        $perfilLogado = $usuario["perfil_id"];
        $usrEscola = $usuario["escola"];
        $dataFuncao = new DatasFuncao();

        if (intval($perfilLogado) === 2 || intval($perfilLogado) === 4) {
            $forumQuestaoController = new ForumQuestaoController();
            $questoesPendentes = $forumQuestaoController->selectPendentes($usrEscola);
            
            function verificarImagem($arquivo) {
                if (file_exists("imgp/" . $arquivo))
                    return $arquivo;
                else
                    return "default.png";
            }

            $htmlPendentes  = "<div id=\"box_questoes_pendentes_container\">";
            $htmlPendentes .=    "<div id=\"box_questoes_pendentes\">";

            if (count($questoesPendentes) > 0) {
                foreach ($questoesPendentes as $questao) {
                    $idfrq      = $questao->getFrq_id();
                    $imagemFrq  = verificarImagem($questao->getFrq_usuario()->getUsr_imagem());
                    $questaoFrq = utf8_encode($questao->getFrq_questao());
                    $autorFrq   = utf8_encode($questao->getFrq_usuario()->getUsr_nome());
                    $dataFrq    = $dataFuncao->dataTimeBRExibicao($questao->getFrq_data());
                    $idfrt      = $questao->getFrq_topico()->getFrt_id();
                    $topicoFrt  = utf8_encode($questao->getFrq_topico()->getFrt_topico());

                    $htmlPendentes .= "<div id=\"box_questao{$idfrq}\">";
                    $htmlPendentes .=    "<div class=\"row perg_box\">";
                    $htmlPendentes .=        "<div class=\"perg_box_1 col-xs-12 col-md-9\">";
                    $htmlPendentes .=            "<p class=\"foto_aluno\"><img src=\"imgp/{$imagemFrq}\"></p>";
                    $htmlPendentes .=            "<p id=\"{$idfrq}\" class=\"perg_aluno questaoTexto\">{$topicoFrt}</p>";
                    $htmlPendentes .=            "<p class=\"nome_aluno\">Questão: {$questaoFrq}</p>";
                    $htmlPendentes .=            "<p class=\"post_data\">Solicitante: {$autorFrq} | Solicitado dia {$dataFrq}</p>";
                    $htmlPendentes .=        "</div>";
                    $htmlPendentes .=        "<div class=\"btns_container col-xs-12 col-md-3\">";
                    $htmlPendentes .=            "<button type=\"button\" data-action=\"aceitar\" data-topico=\"{$idfrt}\" id=\"btn_aceitar{$idfrq}\" class=\"btn btn-primary\">Aceitar Tópico</p>";
                    $htmlPendentes .=            "<button type=\"button\" data-action=\"rejeitar\" data-topico=\"{$idfrt}\" id=\"btn_rejeitar{$idfrq}\" class=\"btn\">Rejeitar tópico</p>";
                    $htmlPendentes .=        "</div>";
                    $htmlPendentes .=    "</div>";
                    $htmlPendentes .= "</div>";
                }
            } else {
                $htmlPendentes .= "<div class=\"alert_container\">";
                $htmlPendentes .=    "<div class=\"alert alert-warning\">Nenhum tópico ou questão pendente de aprovação.</div>";
                $htmlPendentes .= "</div>";
            }

            $htmlPendentes .=    "</div>";
            $htmlPendentes .= "</div>";

            echo $htmlPendentes;
        }
    }
    
    public function countPendentesByEscola() {
        $usr = unserialize($_SESSION['USR']);
        $usrEscola = $usr["escola"];
        $forumTopicoController = new ForumTopicoController();
        $countFrtPendentes = intval($forumTopicoController->countPendentesByEscola($usrEscola));
        
        return $countFrtPendentes;
    } 
   
    public function mostrarAbasForum() {
        $usr = unserialize($_SESSION['USR']);
        $perfilLogado = $usr["perfil_id"];
        $usrEscola = $usr["escola"];
        
        if (intval($perfilLogado) === 2 || intval($perfilLogado) === 4){
            echo "<p class=\"titulo_box_forum ativo\" id=\"txt_postagens\">POSTAGENS RECENTES</p>";
            echo "<p class=\"titulo_box_forum\" id=\"txt_topicos_pendentes\">";
            echo    "TÓPICOS PENDENTES ";
            
            if ($this->countPendentesByEscola($usrEscola))
                echo "<span class=\"badge\">Novo</span>";
            
            echo "</p>";
        } else {
            echo "<p class=\"titulo_box_forum ativo\" id=\"txt_postagens\">POSTAGENS RECENTES</p>";
        }
        
    }

}

?>
