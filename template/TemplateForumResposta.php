<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}

include_once($path['controller'].'ForumQuestaoController.php');
include_once($path['controller'].'ForumViewController.php');
include_once($path['controller'].'ForumRespostaController.php');
include_once($path['controller'].'ForumQuestaoParticipanteController.php');
include_once($path['controller'].'UsuarioController.php');
include_once($path['funcao'].'DatasFuncao.php');
date_default_timezone_set("America/Sao_Paulo");

$path = $_SESSION['PATH_SYS'];


class TemplateForumResposta{

	public static $path;
	
	function __construct()
	{
		self::$path = $_SESSION['URL_SYS'];
	}
        
	public function listaQuestoesRecentes()
	{	
		$questaoController = new ForumQuestaoController();
		$respostasController = new ForumRespostaController();
		$viewController = new ForumViewController();
		$dataFuncao = new DatasFuncao();
        $idesc = (unserialize($_SESSION["USR"])["escola"]);
        $questoesAll;
		
		$questoes = $questaoController->selectUltimas(5);

        if ($idesc)
            $questoesAll = $questaoController->selectAprovadasByEscola($idesc);
        else
            $questoes = $forumController->selectAllAprovadas($idesc);

		$html = '<div id="listaRecentes">';
		if (count($questoes)>0){
                    
			foreach ($questoes as $q){
            	$totalRespostas = $respostasController->totalByQuestao($q->getFrq_id());
                $totalViews = $q->getFrq_visualizacoes();		
                if ($totalViews == 1) $msgView = '<span id="totalVisTexto'.$q->getFrq_id().'"><span id="totalVis'.$q->getFrq_id().'">1</span> visualização</span>';
                	else $msgView = '<span id="totalVisTexto'.$q->getFrq_id().'"><span id="totalVis'.$q->getFrq_id().'">'.$totalViews.'</span> visualizações</span>';
                            
                if ($totalRespostas == 1) $totalRespostas = '<span id="totalRespTexto'.$q->getFrq_id().'"><span id="totalResp'.$q->getFrq_id().'">1</span> resposta</span>';
                	else $totalRespostas = '<span id="totalRespTexto'.$q->getFrq_id().'"><span id="totalResp'.$q->getFrq_id().'">'.$totalRespostas.'</span> respostas</span>';
					
                $data = $dataFuncao->dataBR($q->getFrq_data());
                            
                $html .= '<div class="ln_box ln_box caixaQuestao" style="cursor: pointer" onClick="listaRespostas('.$q->getFrq_id().')" id="'.$q->getFrq_id().'">
                			<p class="ln_pergunta">'.utf8_encode($q->getFrq_questao()).'</p>
                            <div class="ln_info row">
                            	<p class="col-xs-12 col-md-12 col-lg-12 align-right">Última postagem '.$data.'</p>
                            </div>
                            <div style="clear:both"></div>
                            <div class="ln_info row">
                            	<p class="col-xs-12 col-md-12 col-lg-12 align-right">'.$msgView.'<span class="paipeL">&nbsp|</span> &nbsp'.$totalRespostas.'</p>
                            </div>
                          	<div style="clear:both"></div>
				      	 </div>';
                }
         }
         $html .= '</div>';
        
         //Daqui p baixo, vai listar as questões que serão listadas apenas no caso de efetuar uma busca, senão nem aparecerão na tela.
         $html .= '<div id="listaPesquisa" style="display:none">';
         	foreach($questoesAll as $q){
         		$totalRespostas = $respostasController->totalByQuestao($q->getFrq_id());
                $totalViews = $viewController->totalByQuestao($q->getFrq_id());
         		$data = $dataFuncao->dataBR($q->getFrq_data());
         		
         		if ($totalViews == 1) $msgView = '<span id="totalVisTexto'.$q->getFrq_id().'"><span id="totalVis'.$q->getFrq_id().'">1</span> visualização</span>';
                	else $msgView = '<span id="totalVisTexto'.$q->getFrq_id().'"><span id="totalVis'.$q->getFrq_id().'">'.$totalViews.'</span> visualizações</span>';
                            
                if ($totalRespostas == 1) $totalRespostas = '<span id="totalRespTexto'.$q->getFrq_id().'"><span id="totalResp'.$q->getFrq_id().'">1</span> resposta</span>';
                	else $totalRespostas = '<span id="totalRespTexto'.$q->getFrq_id().'"><span id="totalResp'.$q->getFrq_id().'">'.$totalRespostas.'</span> respostas</span>';
         		
         		$html .= '<div class="ln_box caixaQuestao caixaQuestaoPesquisa" style="cursor: pointer" onClick="listaRespostas('.$q->getFrq_id().')" id="'.$q->getFrq_id().'">
                			<p class="ln_pergunta perguntaPesquisa">'.utf8_encode($q->getFrq_questao()).'</p>
                            <div class="ln_info row">
                            	<p class="col-xs-12 col-md-12 col-lg-12 align-right">Última postagem '.$data.'</p>
                            </div>
                            <div style="clear:both"></div>
                            <div class="ln_info row">
                            	<p class="col-xs-12 col-md-12 col-lg-12 align-right">'.$msgView.'<span class="paipeL">&nbsp|</span> &nbsp'.$totalRespostas.'</p>
                            </div>
                          	<div style="clear:both"></div>
				      	 </div>';
                }

        $html .= '</div>';
         //Fim da div da busca

        echo $html;
   	}
	
	
	public function listaRespostas($idQuestao){
	    date_default_timezone_set("America/Sao_Paulo");
		$userController = new UsuarioController();
		$forumController = new ForumQuestaoController();
        $frqController = new ForumQuestaoParticipanteController();
		$viewController = new ForumViewController();
		$respostasController = new ForumRespostaController();
		$dataFuncao = new DatasFuncao();
		$logado = unserialize($_SESSION['USR']);
	  	$id = $logado['id'];

	  	$resp = $forumController->select($idQuestao);
	  	
	  	if ($viewController->verificaUsuarioByQuestao($id,$idQuestao) == 0){
	  		$view = New ForumView();
	  		$view->setFrv_questao($idQuestao);
	  		$view->setFrv_usuario($id);
	  		$view->setFrv_data(date('Y-m-d h:i:s'));
	  		$viewController->insert($view);
	  	}
	  	
	  	$usuario = $userController->select($resp->getFrq_usuario());  	
		$respostas = $respostasController->selectByQuestao($resp->getFrq_id());
		
	  	$data = $dataFuncao->dataTimeBRExibicao($resp->getFrq_data());

	  	if (file_exists("imgp/".$usuario->getUsr_imagem())){
			$foto = $usuario->getUsr_imagem();
		}else $foto = 'default.png';
		
		$html ='<div id="box_topico" class="row">
                 <p class="foto_aluno col-xs-1 col-md-1 col-lg-1">
                 	<img src="imgp/'.$foto.'">
                 </p>
              <div class="col-xs-11 col-md-11 col-lg-11">
              	 <p class="dados_aluno">
                 	<span class="aluno_nome">'.utf8_encode($usuario->getUsr_nome()).'</span>
                    <span class="aluno_data">Postado dia '.$data.'</span>
                 </p>
                 <p>
                   <span class="resp_aluno">'.utf8_encode($resp->getFrq_questao()).'</span>
                 </p>
               </div>
              </div>
              <div id="box_Respostas_container">
                <div id="box_Respostas">';
	  	$marginRight="";
	  	if (count($respostas) > 0){
                    
                    if (count($respostas) > 4) {
                        $marginRight = "margin_right";
                    }
                    foreach($respostas as $r){

                            $usuarioResposta = $userController->select($r->getFrr_usuario());	  
                            $dataResposta = $dataFuncao->dataTimeBRExibicao($r->getFrr_data());
                            
                    			
                            if (file_exists("imgp/".$usuarioResposta->getUsr_imagem())){
                    			$foto = $usuarioResposta->getUsr_imagem();
							}else{
								$foto = 'default.png';
							}

                            $html .= '<div class="box_topico_resp '.$marginRight.'">
                                    <p class="foto_aluno col-xs-1 col-md-1 col-lg-1">
                                        <img src="imgp/'.$foto.'">
                                    </p>
                                    <div class="col-xs-11 col-md-11 col-lg-11">
                                        <div class="dados_aluno">
                                            <span class="aluno_nome">'.utf8_encode($usuarioResposta->getUsr_nome()).'</span>
                                            <span class="aluno_data">Postado dia '.$dataResposta.'</span>
                                        </div>
                                        <div>  
                                            <p class="resp_aluno">'.$r->getFrr_resposta().'</p>
                                        </div> 
                                    </div>
                                    <div style="clear:both"></div> 
                                </div>';
                    }
        
                }
                 
	  	            $html .= ' <button id="btn_responder" class="btn_form btn_form_forum '.$marginRight.'">RESPONDER</button>
                         <div id="campo_resp" class="margin_right">
                            <p class="foto_aluno col-xs-1 col-md-1 col-lg-1">
                                    <img src="imgp/'.$userController->buscaFotoByIdUsuario($logado['id']).'">
                            </p>
                            <div class="col-xs-11 col-md-11 col-lg-11">
                                <div class="dados_aluno">
                                    <span class="aluno_nome">'.utf8_encode($logado['nome']).'</span>
                                    <span class="aluno_data">Postado dia  <span class="dataResposta"></span></span>
                                    <textarea id="resp_forum" placeholder="Digite aqui sua resposta!"></textarea>
                                    <button class="btn_form btn_form_forum" id="btn_pronto" idAluno="'.$id.'">PRONTO</button>
                                </div>
                            </div> 
                            </div>
                            <!-- </div> -->
                    ';

		echo $html .= '</div></div>';
	}

    public function updateQuestaoParticipante() {
        $fqpController = new ForumQuestaoParticipanteController();
        $data = date("Y-m-d H:i:s");
        $idusr = unserialize($_SESSION["USR"])["id"];
        $idfrq = $_GET["resp"];

        $fqp = new ForumQuestaoParticipante();
        $fqp->setFqp_questao($idfrq);
        $fqp->setFqp_usuario($idusr);
        $fqp->setFqp_ultima_visualizacao($data);

        $fqpController->update($fqp);
    }

    public function updateQuestaoVisualizacao() {
        $idfrq = $_GET["resp"];
        $frqController = new ForumQuestaoController();
        $frqController->incrementarVisualizacoes($idfrq);
    }
}
?>
