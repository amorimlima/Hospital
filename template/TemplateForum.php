<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}

//session_start();
include_once($path['dao'].'ForumQuestaoDao.php');
include_once($path['dao'].'ForumRespostaDAO.php');
include_once($path['controller'].'ForumQuestaoController.php');
include_once($path['controller'].'ForumRespostaController.php');
include_once($path['controller'].'UsuarioController.php');

$path = $_SESSION['PATH_SYS'];

/**
 * Description of Template
 *
 * @author MuranoDesign
 */

class TemplateForum{

	public static $path;
	
	function __construct()
	{
		self::$path = $_SESSION['URL_SYS'];
	}
        
	public function listaAlunos()
	{			   
		$forumController = new ForumQuestaoController();
		$userController = new UsuarioController();
		$forum = $forumController->selectAll();
		$cont = 0; 
		foreach ($forum as $key => $value){				
			$user = $userController->select(($value->getFrq_usuario()));			
			
			if($cont % 2 == 0){
				$caixaGrande  = "cx_rosa"; 	
				$caixaPequena = "cx_brancaP";
			}else{
				$caixaGrande  = "cx_branca"; 	
				$caixaPequena = "cx_rosaP";
			}
			  
			echo '<a href="forumResposta.php?resp='.$value->getFrq_id().'"><div class="perg_box '.$caixaGrande.' row">
					<div class="perg_box_1 col-xs-12 col-md-8 col-lg-8">
						<p class="foto_aluno"><img src="imgp/foto_aluno.png"></p>
						<p class="perg_aluno">'.$value->getFrq_questao().'</p>
						<p class="nome_aluno">'.$user->getUsr_nome().'</p>
						<p class="post_data">Postado dia '.$value->getFrq_data().'</p>
					</div>
					<div class="perg_box_2 col-xs-12 col-md-4 col-lg-4">
						<p class="qtd_visu '.$caixaPequena.'"><span>8</span> visualizações</p>
						<p class="qtd_resp '.$caixaPequena.'"><span>3</span> respostas</p>
					</div>
				</div></a>';
		  
		  $cont++;		   
	  	} 		
   	} 
}
?>
