<?php

require_once '../_loadPaths.inc.php';

$path = $_SESSION['PATH_SYS'];

include_once($path['controller'] . 'ForumQuestaoController.php');
include_once($path['controller'] . 'UsuarioController.php');
include_once($path['controller'] . 'ForumRespostaController.php');
include_once($path['controller'] . 'ForumTopicoController.php');
include_once($path['controller'] . 'ForumViewController.php');
include_once($path['template'] . 'TemplateForum.php');
include_once($path['funcao'] . 'DatasFuncao.php');
$template = new TemplateForum();
$forumController = new ForumQuestaoController();
$userController = new UsuarioController();
$respostasController = new ForumRespostaController();
$viewController = new ForumViewController();
$questaoController = new ForumQuestaoController();
$forumTopicoController = new ForumTopicoController();

switch ($_REQUEST["acao"]) {

    case "listaQuestoesRecentes": {

            if ($_POST['texto'] != '') {
                $questoes = $questaoController->selectComleta($_POST['texto']);
            } else {
                $questoes = $questaoController->selectUltimas(5);
            }


            $html = '';
            if (count($questoes) > 0) {
                $viewController = new ForumViewController();
                $dataFuncao = new DatasFuncao();

                foreach ($questoes as $q) {

                    $totalViews = $viewController->totalByQuestao($q->getFrq_id());
                    $totalRespostas = $respostasController->totalByQuestao($q->getFrq_id());

                    if ($totalViews == 1)
                        $msgView = '<span id="totalVisTexto' . $q->getFrq_id() . '"><span id="totalVis' . $q->getFrq_id() . '">1</span> visualização</span>';
                    else
                        $msgView = '<span id="totalVisTexto' . $q->getFrq_id() . '"><span id="totalVis' . $q->getFrq_id() . '">' . $totalViews . '</span> visualizaçôes</span>';

                    if ($totalRespostas == 1)
                        $totalRespostas = '<span id="totalRespTexto' . $q->getFrq_id() . '"><span id="totalResp' . $q->getFrq_id() . '">1</span> resposta</span>';
                    else
                        $totalRespostas = '<span id="totalRespTexto' . $q->getFrq_id() . '"><span id="totalResp' . $q->getFrq_id() . '">' . $totalRespostas . '</span> respostas</span>';


                    //$data = substr(str_replace(' ',' às ',$q->getFrq_data()),0,-3);
                    $data = $dataFuncao->dataBR($q->getFrq_data());


                    $html .= '<div class="ln_box ln_box caixaQuestao" style="cursor: pointer" onClick="listaRespostas(' . $q->getFrq_id() . ')" id="' . $q->getFrq_id() . '">
						<p class="ln_pergunta">' . utf8_encode($q->getFrq_questao()) . '</p>
				        <div class="ln_info row">
				          <p class="col-xs-7 col-md-7 col-lg-7 align-right">Última postagem ' . $data . '</p> 
				          <p class="col-xs-3 col-md-3 col-lg-3 align-right"><span class="paipeR">|</span>' . $msgView . ' <span class="paipeL">|</span></p>
				          <p class="col-xs-2 col-md-2 col-lg-2 align-right">' . $totalRespostas . '</p>
				        </div>
				        <div style="clear:both"></div>
				      </div>';
                }
            }
            echo $html;
            break;
        }
    case "listaRespostaQuestao": {
            $dataFuncao = new DatasFuncao();
            $l = unserialize($_SESSION['USR']);
            $logado = $userController->select($l['id']);
            $id = $logado->getUsr_id();

            $resp = $forumController->select($_POST['resp']);

            if ($viewController->verificaUsuarioByQuestao($id, $_POST['resp']) == 0) {
                $view = New ForumView();
                $view->setFrv_questao($_POST['resp']);
                $view->setFrv_usuario($id);
                $view->setFrv_data(date('Y-m-d h:i:s'));
                $viewController->insert($view);
                $htmlJquery = '<script text="<script type="text/javascript">atualizaVisitas(' . $_POST['resp'] . ')</script>';
            } else
                $htmlJquery = '';

            $usuario = $userController->select($resp->getFrq_usuario());
            $respostas = $respostasController->selectByQuestao($resp->getFrq_id());

            //$data = str_replace(' ',' às ',$resp->getFrq_data());
            $data = $dataFuncao->dataTimeBRExibicao($resp->getFrq_data());

            if (file_exists("imgp/" . $usuario->getUsr_imagem())) {
                $foto = $usuario->getUsr_imagem();
            } else
                $foto = 'default.png';

            $html = '<div id="box_topico" class="row">
                 <p class="foto_aluno col-xs-1 col-md-1 col-lg-1">
                 	<img src="imgp/' . $foto . '">
                 </p>
              <div class="col-xs-11 col-md-11 col-lg-11">
              	 <p class="dados_aluno">
                 	<span class="aluno_nome">' . utf8_encode($usuario->getUsr_nome()) . '</span>
                    <span class="aluno_data">Postado dia ' . $data . '</span>
                 </p>
                 <p>
                   <span class="resp_aluno">' . utf8_encode($resp->getFrq_questao()) . '</span>
                 </p>
               </div>
              </div>
              <div id="box_Respostas_container">
                <div id="box_Respostas">';
            $marginRight = "";
            if (count($respostas) > 0) {
                if (count($respostas) > 4) {
                    $marginRight = "margin_right";
                }
                foreach ($respostas as $r) {

                    $usuarioResposta = $userController->select($r->getFrr_usuario());
                    //$dataResposta = substr(str_replace(' ',' às ',$r->getFrr_data()),0,-3);
                    $dataResposta = $dataFuncao->dataTimeBRExibicao($r->getFrr_data());

                    if (file_exists("imgp/" . $usuarioResposta->getUsr_imagem())) {
                        $foto = $usuarioResposta->getUsr_imagem();
                    } else
                        $foto = 'default.png';

                    $html .= '<div class="box_topico_resp ' . $marginRight . '">
	                                <p class="foto_aluno col-xs-1 col-md-1 col-lg-1">
	                                    <img src="imgp/"' . $foto . '">
	                                 </p>
	                                <div class="col-xs-11 col-md-11 col-lg-11">
	                                    <div class="dados_aluno">
	                                        <span class="aluno_nome">' . utf8_encode($usuarioResposta->getUsr_nome()) . '</span>
	                                        <span class="aluno_data">Postado dia ' . $dataResposta . '</span>
	                                    </div>
	                                    <div>  
	                                        <p class="resp_aluno">' . $r->getFrr_resposta() . '</p>
	                                    </div> 
	                                </div>
	                                <div style="clear:both"></div> 
	                            </div>';
                }
            }

            if (file_exists("imgp/" . $usuarioResposta->getUsr_imagem())) {
                $foto = $usuarioResposta->getUsr_imagem();
            } else {
                $foto = 'default.png';
            }

            $html .= ' <button id="btn_responder" class="btn_form btn_form_forum ' . $marginRight . '">RESPONDER</button>
                             <div id="campo_resp">
                            	<p class="foto_aluno col-xs-1 col-md-1 col-lg-1">
                                	<img src="imgp/' . $foto . '">
                            	</p>
                            	<div class="col-xs-11 col-md-11 col-lg-11">
                                    <div class="dados_aluno">
                                        <span class="aluno_nome">' . utf8_encode($logado->getUsr_nome()) . '</span>
                                        <span class="aluno_data">Postado dia  <span class="dataResposta"></span></span>
                                        <textarea id="resp_forum" placeholder="Digite aqui sua resposta!"></textarea>
                                    	<button class="btn_form btn_form_forum" id="btn_pronto" idAluno="' . $id . '">PRONTO</button>
                                    </div>
                            	</div> 
                       	 	</div>
                        </div>';
            $html .= '</div></div>';
            $html .= $htmlJquery;

            echo $html;
            break;
        }

    case "NovaRespostaQuestao": {
            $resp = new ForumResposta();
            $resp->setFrr_questao($_POST['questao']);
            $resp->setFrr_resposta($_POST['resposta']);
            $resp->setFrr_usuario($_POST['usuario']);
            $resp->setFrr_data(date('Y-m-d h:i:s'));

            if ($respostasController->insert($resp)) {
                $result = Array();
            } else {
                $result = Array('erro' => true);
            }
            echo json_encode($result);
            break;
        }

    case "perguntar": {

            $dataFuncao = new DatasFuncao();

            $logado = unserialize($_SESSION['USR']);

            $texto = $_POST["txt"];
            $anexo = $_POST["anexo"];
            $topico = $_POST["topico"];
            $usuario = $logado['id'];
            $data = date("Y-m-d H:i:s");

            $questao = new ForumQuestao();
            $questao->setFrq_questao(utf8_decode($texto));
            $questao->setFrq_topico($topico);

            $frt = $forumTopicoController->select($questao->getFrq_topico());
            $topico = new ForumTopico();
            $topico->setFrt_id($frt->getFrt_id());
            $topico->setFrt_topico($frt->getFrt_topico());
            $topico->setFrt_status($frt->getFrt_status());


            if ($anexo == '') {
                $questao->setFrq_anexo('0');
            } else {
                $questao->setFrq_anexo($anexo);
            }

            $questao->setFrq_data($data);
            $questao->setFrq_usuario($usuario);
            $id = $forumController->insert($questao);
            $user = $userController->select($usuario);


            if (file_exists("imgp/" . $user->getUsr_imagem())) {
                $foto = $user->getUsr_imagem();
            } else
                $foto = 'default.png';

            //$html  = '<a href="forumResposta.php?resp='.$id.'"><div class="perg_box '.$caixaGrande.' row">
            echo '<a href="forumResposta.php?resp=' . $id . '" id="caixaQuestao' . $id . '"><div id="perg_box' . $id . '" class="perg_box row">
						<div class="perg_box_1 col-xs-12 col-md-7 col-lg-7">
							<p class="foto_aluno"><img src="imgp/' . $foto . '"></p>
							<p class="perg_aluno questaoTexto" id="' . $id . '">' . $texto . '</p>
							<p class="nome_aluno">' . utf8_encode($user->getUsr_nome()) . '</p>
							<p class="post_data">Tópico: ' . utf8_encode($topico->getFrt_topico()) . ' | Postado dia ' . $dataFuncao->dataTimeBRExibicao($data) . '</p>
						</div>
						<div class="perg_box_2 col-xs-12 col-md-5 col-lg-5">
							<p id="qtd_visu' . $id . '" class="qtd_visu"><span>0</span> visualizações</p>
							<p id="qtd_resp' . $id . '" class="qtd_resp"><span>0</span> respostas</p>
							
						</div>
					</div></a>';


            break;
        }

    case "novoTopico":
        $usuario = unserialize($_SESSION['USR']);
        $perfilLogado = $usuario["perfil_id"];
        $topico = utf8_decode($_REQUEST["topico"]);
        $status = $perfilLogado == "1" ? 0 : 1;

        $frt = new ForumTopico();
        $frt->setFrt_topico($topico);
        $frt->setFrt_status($status);

        $request = $forumTopicoController->insertAndReturnId($frt);
        $retorno = Array("erro" => false, "retorno" => Array());

        if ($frt) {
            $retorno["retorno"] = Array("id" => $request, "perfil" => $perfilLogado);
        } else {
            $retorno["erro"] = true;
            $retorno["retorno"] = Array("mensagem" => "Erro ao inserir novo tópico");
        }

        echo json_encode($retorno);
        break;

    case "aprovarTopico":
        $usuario = unserialize($_SESSION["USR"]);
        $perfilLogado = $usuario["perfil_id"];
        $frt_id = $_REQUEST["id_topico"];
        $retorno = Array("erro" => false, "retorno" => Array());

        if ($perfilLogado == 2 || $perfilLogado == 4) {
            if ($request = $forumTopicoController->aprovarTopico($frt_id)) {
                $retorno["retorno"] = Array("mensagem" => "Tópico aprovado com sucesso.");
            } else {
                $retorno["erro"] = true;
                $retorno["retorno"] = Array("mensagem" => "Erro ao solicitar a aprovação do tópico.");
            }
        } else {
            $retorno["erro"] = true;
            $retorno["retorno"] = Array("mensagem" => "Ação não permitida para este perfil.");
        }

        echo json_encode($retorno);
        break;

    case "rejeitarTopico":
        $usuario = unserialize($_SESSION["USR"]);
        $perfilLogado = $usuario["perfil_id"];
        $frt_id = $_REQUEST["id"];
        $retorno = Array("erro" => false, "retorno" => Array());

        if ($perfilLogado == 2 || $perfilLogado == 4) {
            if ($request = $forumTopicoController->delete($frt_id)) {
                $retorno["retorno"] = Array("mensagem" => "Tópico rejeitado com sucesso.");
            } else {
                $retorno["erro"] = true;
                $retorno["retorno"] = Array("mensagem" => "Erro ao rejeitar a criação do tópico.");
            }
        } else {
            $retorno["erro"] = true;
            $retorno["retorno"] = Array("mensagem" => "Ação não permitida para este perfil.");
        }

        echo json_encode($retorno);
        break;
    
    case "selectTopico":
        $id_topico = $_GET["idtopico"];
        $topico = $forumTopicoController->select($id_topico);
        $retorno = Array("erro" => false, "retorno" => Array());
        
        if ($topico) {
            $retorno["retorno"] = Array(
                "id" => utf8_encode($topico->getFrt_id()),
                "topico" => utf8_encode($topico->getFrt_topico()),
                "status" => utf8_encode($topico->getFrt_status())
            );
        } else {
            $retorno["erro"] = true;
            $retorno["retorno"] = Array(
                "mensagem" => "Erro ao carregar o tópico."
            );
        }
        
        echo json_encode($retorno);
    break;    
        
    case "selectTopicoAprovado":
        $id_topico = $_GET["idtopico"];
        $topico = $forumTopicoController->select($id_topico);
        $retorno = Array("erro" => false, "retorno" => Array());
        
        if ($topico) {
            $retorno["retorno"] = Array(
                "id" => utf8_encode($topico->getFrt_id()),
                "topico" => utf8_encode($topico->getFrt_topico()),
                "status" => utf8_encode($topico->getFrt_status())
            );
        } else {
            $retorno["erro"] = true;
            $retorno["retorno"] = Array(
                "mensagem" => "Erro ao carregar o tópico aprovado."
            );
        }
        
        echo json_encode($retorno);
    break;
    
    case "selectQuestoesByTopico":
        $id_topico = $_GET["idtopico"];
        $retorno = Array("erro" => false, "retorno" => Array());
        $questoes = $forumController->selectByTopico($id_topico);
        $dataFuncao = new DatasFuncao();
        
        if ($questoes) {
            function checkImagem($arquivo) {
                if (file_exists("imgp/{$arquivo}"))
                    return $arquivo;
                else
                    return "default.png";
            }
            
            foreach ($questoes as $questao) {
                $frq = Array(
                    "id" => $questao->getFrq_id(),
                    "questao" => utf8_encode($questao->getFrq_questao()),
                    "anexo" => utf8_encode($questao->getFrq_anexo()),
                    "data" => $dataFuncao->dataTimeBR($questao->getFrq_data()),
                    "usuario" => Array(
                        "id" => $questao->getFrq_usuario()->getUsr_id(),
                        "nome" => utf8_encode($questao->getFrq_usuario()->getUsr_nome()),
                        "escola" => utf8_encode($questao->getFrq_usuario()->getUsr_escola()),
                        "imagem" => checkImagem($questao->getFrq_usuario()->getUsr_imagem())
                    ),
                    "topico" => Array(
                        "id" => $questao->getFrq_topico()->getFrt_id(),
                        "topico" => utf8_encode($questao->getFrq_topico()->getFrt_topico()),
                        "status" => utf8_encode($questao->getFrq_topico()->getFrt_status())
                    )
                );
                
                array_push($retorno["retorno"], $frq);
            }
        } else {
            $erro = Array("mensagem" => "Erro ao carregar as questões deste tópico");
            
            $retorno["erro"] = true;
            array_push($retorno["retorno"], $erro);
        }
        
        echo json_encode($retorno);
    break;
    
    case "selectAutorByQuestao":
        $idquestao = $_GET["idquestao"];
        $retorno = Array("erro"=>false, "retorno"=>Array());
        $autor = $forumController->selectAutorByQuestao($idquestao);
        
        if ($autor) {
            $usr = Array(
                "id" => $autor->getFrq_usuario()->getUsr_id(),
                "nome" => utf8_encode($autor->getFrq_usuario()->getUsr_nome()),
                "escola" => utf8_encode($autor->getFrq_usuario()->getUsr_escola()),
            );
            
            array_push($retorno["retorno"],$usr);
        } else {
            $retorno["erro"] = true;
            $retorno["retorno"] = Array("mensagem"=>"Autor não encontrado ou questão inválida.");
        }
        
        echo json_encode($retorno);
    break;
    
    case "deletarQuestao":
        $usuario = unserialize($_SESSION["USR"]);
        $perfilLogado = $usuario["perfil_id"];
        $idquestao = $_POST["idquestao"];
        $retorno = Array("erro"=>false,"retorno"=>Array());
        
        if (intval($perfilLogado) === 2 || intval($perfilLogado) === 4) {
            if($forumController->delete($idquestao)) {
                $retorno["retorno"] = Array("mensagem" => "Questão deletada com sucesso");
            } else {
                $retorno["erro"] = true;
                $retorno["retorno"] = Array("mensagem" => "Questão não encontrada.");
            }
        } else {
            $retorno["erro"] = true;
            $retorno["retorno"] = Array("mensagem" => "Ação não permitida para este perfil.");
        }
        
        echo json_encode($retorno); 
    break;
}

