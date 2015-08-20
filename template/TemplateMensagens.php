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

		if (count($mensagem)>0){
			foreach ($mensagem as $value) {
				if($value->getMsg_lida() === 'n'){
					$naolida = 'msg_nao_lida';
				}else{
					$naolida = '';
				}
				$usuario = $usuarioController->select($value->getMsg_remetente());
				
				echo '<div id="msg_valores_'.$value->getMsg_id().'" class="recebido '.$naolida.' col1 row">
					  <p class="msg_check col-lg-1"><span class="check-box"></span></p>	
					  <div  onclick="RecebidasDetalheFuncao('.utf8_encode($value->getMsg_id()).')">			  
						<p class="msg_nome col-lg-2">'.utf8_encode($usuario->getUsr_nome()).'</p>
						<p class="msg_assunto col-lg-7">'.utf8_encode($value->getMsg_assunto()).'</p>
						<p class="msg_data col-lg-2">'.date('d/m/Y',strtotime($value->getMsg_data())).'</p>
					</div>
				</div>';
			}   
		}else {
			echo '<div class="alert alert-warning" role="alert"><strong>Nenhuma mensagem em sua Caixa de Entrada.</strong></div>';
		}
			
	}
}
?>
