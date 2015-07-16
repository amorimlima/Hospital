<?php
//if(!isset($_SESSION['PATH_SYS'])){
    require_once /*$_SESSION['BASE_URL']*/'../_loadPaths.inc.php';
//}
$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'MensagemController.php');
include_once($path['beans'].'Mensagem.php');
$mensagemController = new MensagemController();
//print_r($_POST); die();
switch ($_POST["acao"]){
    case "deleteMensagem":{
      
        $idmens = $_POST["id"];
        $mensagem = $mensagemController->selectMensagem($idmens);
        
        if(!empty($mensagem->getMsg_id())){
            $mensagemController->delete($_POST["id"]);  
            $result = Array('ok'=>true,'msg'=>'<div class="alert alert-danger"><i class="fa fa-times"></i> Deletado com sucesso!</div>');
          echo json_encode($result);
        }
      
          
        
        break;
    }
    
    case "desativa":{
       
            break;
    }
    
    case "criarMensagem":{
        
            break;
    }
     
    case "editarMensagem":{
        
            break;
    }
    
    case "listaEnviadas":{
        $idmens = $_POST["id"];
        
        //$mensagem = array($mensagemController->listaEnviadas($idmens));
        $frutas = array ("a"=>"laranja");
       
        //$result = Array('ok'=>$mensagem->getMsg_id());
        $result = Array('ok'=>true,'msg'=>$frutas["a"]/*'<div class="alert alert-danger"><i class="fa fa-times"></i> Ni!</div>'*/);
        
        echo json_encode($result);
        break;
        
    }
    
    case "listarMensagemId":{
        
            break;
    }
}

?>
