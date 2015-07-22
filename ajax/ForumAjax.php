<?php

    require_once /*$_SESSION['BASE_URL']*/'../_loadPaths.inc.php';

$path = $_SESSION['PATH_SYS'];

include_once($path['controller'].'ForumQuestaoController.php');
include_once($path['controller'].'UsuarioController.php');
include_once($path['beans'].'ForumQuestao.php');
include_once($path['beans'].'Usuario.php');
include_once($path['template'].'TemplateForum.php');
$template = new TemplateForum();
$forumController = new ForumQuestaoController();
$userController = new UsuarioController();
//$_POST["acao"] = "perguntar";

switch ($_POST["acao"]){
      case "listaQuestao":{
          
          $forum = $forumController->selectAll();
          $cont = 0;
         
          
          foreach ($forum as $key => $value)
           {
            
              $user = $userController->select(($value->getFrq_usuario()));
              
              
              if($cont % 2 == 0){
                  echo '<div class="perg_box cx_rosa">
                            <div class="perg_box_1">
                                <p class="foto_aluno"><img src="imgp/foto_aluno.png"></p>
                                <p class="perg_aluno">'.$value->getFrq_questao().'</p>
                                <p class="nome_aluno">'.$user->getUsr_nome().'</p>
                                <p class="post_data">'.$value->getFrq_data().'</p>
                            </div>
                            <div class="perg_box_2">
                                <p class="qtd_visu cx_brancaP"><span>8</span> visualizações</p>
                                <p class="qtd_resp cx_brancaP"><span>3</span> respostas</p>
                            </div>
                        </div>';
              }else{             
                  echo  '<div class="perg_box cx_branca">
                            <div class="perg_box_1">
                                <p class="foto_aluno"><img src="imgp/foto_aluno.png"></p>
                                <p class="perg_aluno">'.$value->getFrq_questao().'</p>
                                <p class="nome_aluno">'.$user->getUsr_nome().'</p>
                                <p class="post_data">'.$value->getFrq_data().'</p>
                            </div>
                            <div class="perg_box_2">
                                <p class="qtd_visu cx_rosaP"><span>8</span> visualizações</p>
                                <p class="qtd_resp cx_rosaP"><span>3</span> respostas</p>
                            </div>
                        </div>';
              }
              
              $cont++;
               
          } 
          
          break;
      }
      
      case "perguntar":{

         $texto =  $_POST["txt"];
         $anexo = $_POST["anexo"];
         $topico = $_POST["topico"];
         $usuario = $_POST["usuario"];
         
         print_r($texto);
         print_r($anexo);
         print_r($anexo);
         
         print_r($data = date("Y-m-d")) ;
        
         
         $questao = new ForumQuestao();
         $questao->setFrq_questao($texto);
         $questao->setFrq_topico(1);
         
         if($anexo == '0'){
             $questao->setFrq_anexo('0');
         }else{
              $questao->setFrq_anexo($anexo);
         }
         $questao->setFrq_data($data);
         $questao->setFrq_usuario($usuario);
         $forumController->insert($questao);
         
          break;
           
      }
      
  
      
}

