<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}

include_once($path['dao'].'ForumQuestaoDao.php');
include_once($path['dao'].'ForumRespostaDAO.php');
include_once($path['controller'].'ForumQuestaoController.php');
include_once($path['controller'].'ForumViewController.php');
include_once($path['controller'].'ForumRespostaController.php');
include_once($path['controller'].'UsuarioController.php');

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
				
		$questoes = $questaoController->selectUltimas(5);
		$html = '';
		if (count($questoes)>0){
                    
			foreach ($questoes as $q){
                            $totalRespostas = $respostasController->totalByQuestao($q->getFrq_id());
                            $totalViews = $viewController->totalByQuestao($q->getFrq_id());		
                            if ($totalViews == 1) $msgView = '1 visualização';
                            else $msgView = $totalViews.' visualizaçôes';
					
                            $data = substr(str_replace(' ',' às ',$q->getFrq_data()),0,-3);
                            $html .= '<div class="ln_box ln_box caixaQuestao" style="cursor: pointer" onClick="listaRespostas('.$q->getFrq_id().')" id="'.$q->getFrq_id().'">
                                            <p class="ln_pergunta">'.utf8_encode($q->getFrq_questao()).'</p>
                                            <div class="ln_info row">
                                                <p class="col-xs-12 col-md-12 col-lg-12 align-right">Última postagem '.date('d/m/Y',strtotime($data)).'</p>
                                            </div>
                                            <div style="clear:both"></div>
                                            <div class="ln_info row">
                                                <p class="col-xs-12 col-md-12 col-lg-12 align-right">'.$msgView.'<span class="paipeL">&nbsp|</span> &nbsp'.$totalRespostas.' respostas</p>
                                            </div>
                                            <div style="clear:both"></div>
				      					</div>';
                        }
                }
                echo $html;
   	}
	
	
	public function listaRespostas($idQuestao){
	
		$userController = new UsuarioController();
		$forumController = new ForumQuestaoController();
		$viewController = new ForumViewController();
		$respostasController = new ForumRespostaController();
	
		$logado = $userController->select(1); //Buscar o usuario certo depois q fizer o login!!!
	  	$id = $logado->getUsr_id();
	  	
	  	$resp = $forumController->select($idQuestao);
	  	
	  	// if ($viewController->verificaUsuarioByQuestao($id,$idQuestao) == 0){
	  		// $view = New ForumView();
	  		// $view->setFrv_questao($idQuestao);
	  		// $view->setFrv_usuario(1);
	  		// $view->setFrv_data(date('Y-m-d h:i:s'));
	  		// $viewController->insert($view);
	  	// }
	  	
	  	$usuario = $userController->select($resp->getFrq_usuario());  	
		$respostas = $respostasController->selectByQuestao($resp->getFrq_id());
		
	  	$data = str_replace(' ',' às ',$resp->getFrq_data());
	
		
		$html ='<div id="box_topico" class="row">
                 <p class="foto_aluno col-xs-1 col-md-1 col-lg-1">
                 	<img src="imgp/foto_aluno.png">
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
	  	
	  	if (count($respostas) > 0){
                    $marginRight="";
                    if (count($respostas) > 4) {
                        $marginRight = "margin_right";
                    }
                    foreach($respostas as $r){

                            $usuarioResposta = $userController->select($r->getFrr_usuario());	  
                            $dataResposta = substr(str_replace(' ',' às ',$r->getFrr_data()),0,-3);

                            $html .= '<div class="box_topico_resp '.$marginRight.'">
                                    <p class="foto_aluno col-xs-1 col-md-1 col-lg-1">
                                        <img src="imgp/foto_aluno2.png">
                                    </p>
                                    <div class="col-xs-11 col-md-11 col-lg-11">
                                        <div class="dados_aluno">
                                            <span class="aluno_nome">'.utf8_encode($usuarioResposta->getUsr_nome()).'</span>
                                            <span class="aluno_data">Postado dia '.$dataResposta.'</span>
                                        </div>
                                        <div>  
                                            <p class="resp_aluno">'.utf8_encode($r->getFrr_resposta()).'</p>
                                        </div> 
                                    </div>
                                    <div style="clear:both"></div> 
                                </div>';
                    }
                    $html .= ' <button id="btn_responder" class="btn_form btn_form_forum margin_right">RESPONDER</button>
                         <div id="campo_resp" class="margin_right">
                            <p class="foto_aluno col-xs-1 col-md-1 col-lg-1">
                                    <img src="imgp/foto_aluno3.png">
                            </p>
                            <div class="col-xs-11 col-md-11 col-lg-11">
                                <div class="dados_aluno">
                                    <span class="aluno_nome">'.utf8_encode($logado->getUsr_nome()).'</span>
                                    <span class="aluno_data">Postado dia  <span class="dataResposta"></span></span>
                                    <textarea id="resp_forum" placeholder="Digite aqui sua resposta!"></textarea>
                                    <button class="btn_form btn_form_forum" id="btn_pronto" idAluno="'.$id.'">PRONTO</button>
                                </div>
                            </div> 
                            </div>
                            </div>
                    ';
                }
                    
	  	
                else
                {
                    $html .=    '</div>';
                }

		echo $html .= '</div>';
	}
}
?>
