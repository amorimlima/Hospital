<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}

//session_start();
include_once($path['dao'].'MensagemDAO.php');
include_once($path['controller'].'MensagemController.php');

$path = $_SESSION['PATH_SYS'];

/**
 * Description of Template
 *
 * @author MuranoDesign
 */

class TemplateMensagens {

	public static $path;
	
	function __construct()
	{
		self::$path = $_SESSION['URL_SYS'];
	}
	
	public function recebidos(){
		$mensagem = new MensagemController();
		return $mensagem->count(20);       
	}
	
	public function mensagensRecebidas($destinatario){
        $mensagemController = new MensagemController();
	   	$mensagem = $mensagemController->listaRecebidos($destinatario);

        foreach ($mensagem as $value) {
            if($value->getMsg_lida() === 'n'){
                $naolida = 'msg_nao_lida';
            }else{
                $naolida = '';
            }
			echo '<div id="msg_valores_'.$value->getMsg_id().'"  onclick="RecebidasDetalheFuncao('.$value->getMsg_id().')" class=" recebido '.$naolida.' col1">
				  <p class="msg_nome ">'.$value->getMsg_id().'</p>
				  <p class="msg_assunto">'.$value->getMsg_assunto().'</p>
				  <p class="msg_data">'.$value->getMsg_data().'</p>
			</div>';
        }    
	}
   
}
?>
