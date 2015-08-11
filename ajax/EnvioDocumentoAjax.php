<?php

    require_once /*$_SESSION['BASE_URL']*/'../_loadPaths.inc.php';

$path = $_SESSION['PATH_SYS'];

include_once($path['controller'].'EnvioDocumentoController.php');
include_once($path['beans'].'EnvioDocumento.php');
$envio = new EnvioDocumento();
$envioController = new EnvioDocumentoController();

//$_POST["acao"] = "upload";

switch ($_POST["acao"]){
      case "upload":{
          
        $destinatario = $_POST["idDestinatario"];
        $remetente = $_POST["idRemetente"];
        $escola = $_POST["escola"];
        $visto = $_POST["visto"];
        $url = $_POST["url"];
       
        $destinatario = $destinatario.';0';
        if(isset($destinatario)){
            $destinatarios = split(';', $destinatario);
        }
        
        foreach ($destinatarios as $value) {
            if($value == 0){
               
            }else{
                
            if(isset($remetente)){
                $envio->setEnv_idRemetente($remetente);
            }
            
            if(isset($escola)){
                $envio->setEnv_idEscola($escola);
            }
            
            if(isset($visto)){
                 $envio->setVisto($visto);
            }
            
            if(isset($url)){
                $envio->setEnv_url($url);
            }
            
            $envio->setEnv_idDestinatario($value);
            $envioController->insert($envio);
            
            }
        }
         
        echo "tudo cero";
              break;
      }
      
   
}

