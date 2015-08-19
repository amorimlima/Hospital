$(document).ready(function(e) {
    //Barra de rolagem personalizada
	$("#box_msg_listas").mCustomScrollbar({
		axis:"y",
		scrollButtons:{
			enable:true
		}
	});	
	
	checkbox();
	
});

function checkbox(){
	$('.check-box').click(function(){
		$(this).toggleClass('checked');
	});	
}

function deleteFuncao(){
	
	var contMsg = 0;
	var msg;
	var retorno;
	
	//Passa por todas as mensagens checadas 
	$('.checked').each(function(){
		//Pega o id da div a ser excluido
		var idMgs = $(this).parent().parent().attr('id');
		//Verifica se trouxe o id corretamente
		if (typeof idMgs !== "undefined") {
			
			contMsg++;
			//Paga a classe para saber se lista as mensagens enviadas ou recebidas após a exclusão
			retorno = $('#'+idMgs).attr('class');
			retorno = retorno.split(' ');
			
			//Tranforma em array o id para pegar somente o código salvo no banco 
			var id = idMgs.split('_');

			$.ajax({
				url:'ajax/MensagemAjax.php',
				type:'post',
				dataType:'json',
				data:{'acao':'deleteMensagem','id':id[2]},
				success:function(data)
				{
					//msg = data.msg;
					$('#'+idMgs).remove();
					
				}
			});
		}
	})
	
	//Verifica se alguma mensagem foi excluida
	if (contMsg==0) {
		alert('Selecione uma mensagem para ser deletada!');
	}else{
		//Se excluiu, limpa a div e carrega as mensagens novamente 
		alert('Mensagem(s) excluída(s) com sucesso!');
		$('#box_msg_right_botton').hide();
		if(retorno[0] == 'recebido'){
		   recebidasFuncao();
		}else if(retorno[0] == 'enviado'){
		  envidasFuncao();
		}	
	}
	
	return false;
}
        
function envidasFuncao(){
	$('#box_msg_listas').css('height','472px');
	$('.btn_msg').removeClass('btn_msg_ativo');
	$('#btn_enviados').addClass('btn_msg_ativo');
	$.ajax({
		url:'ajax/MensagemAjax.php',
		type:'post',
		dataType:'html',
		data:{'acao':'listaEnviadas','id':'20'},
		success:function(data)
		{
			$('#box_recebe_msg').html(data);
			$('#box_msg_right_botton').hide();	
			checkbox();	
		}
	});
	return false;
}
              
function envidasFuncaoMobile(){
	$.ajax({
		url:'ajax/MensagemAjax.php',
		type:'post',
		dataType:'html',
		data:{'acao':'listaEnviadosMobile','id':'20'},
		success:function(data){		  
			$('#box_msg_enviadas_mobile').html(data);		
		}
	});
	return false;
}
              
function recebidasFuncao(){
	$('#box_msg_listas').css('height','472px');
	$('.btn_msg').removeClass('btn_msg_ativo');
	$('#btn_recebidos').addClass('btn_msg_ativo');
	$.ajax({
		url:'ajax/MensagemAjax.php',
		type:'post',
		dataType:'html',
		data:{'acao':'listaRecebidos','id':'20'},
		success:function(data)
		{
			$('#box_recebe_msg').html(data);
			$('#box_msg_right_botton').hide();		
			checkbox();
		}
	});
	return false;
}
        
function recebidasFuncaoMobile(){
	$.ajax({
		url:'ajax/MensagemAjax.php',
		type:'post',
		dataType:'html',
		data:{'acao':'listaRecebidosMobile','id':'20'},
		success:function(data)
		{
			$('#box_msg_recebidas_mobile').html(data);
		}
	});
	return false;
}
        
function EnviadasDetalheFuncao(idMensagem){
	$('#box_msg_listas').css('height','222px');
	$('.col1').removeClass('delete');
	$.ajax({
		url:'ajax/MensagemAjax.php',
		type:'post',
		dataType:'json',
		data:{'acao':'listaEnviadasDetalhe','id':idMensagem},
		success:function(data){
			$('#ass_msg_data').html(data.data);
			$('#ass_msg_rem_nome').html(data.remetente);
			$('#ass_msg_para_nome').html(data.destinatario);
			$('#ass_msg_resp').html(data.mensagem);	
			$('#msg_valores_'+idMensagem).addClass('delete');
			$('#box_msg_right_botton').show();           
		}
	});
}
        
function EnviadasMobileDetalheFuncao(idMensagem){
	$('.col1-mobile').removeClass('delete');	
	$.ajax({
		url:'ajax/MensagemAjax.php',
		type:'post',
		dataType:'html',
		data:{'acao':'listaEnviadasMobileDetalhe','id':idMensagem},
		success:function(data){		
			$('#abrir_msg_'+idMensagem).html(data);
			$('#msg_valores_'+idMensagem).addClass('delete');
			$('#abrir_msg_').show();		
		}
	});
}
        
function RecebidasDetalheFuncao(idMensagem){	
	$('#box_msg_listas').css('height','222px');
	$('.col1').removeClass('delete');
	$('#msg_valores_'+idMensagem).removeClass('msg_nao_lida');
	$.ajax({
		url:'ajax/MensagemAjax.php',
		type:'post',
		dataType:'json',
		data:{'acao':'listaRecebidasDetalhe','id':idMensagem},
		success:function(data){
			var t = recarrega();
								
			$('#ass_msg_data').html(data.data);
			$('#ass_msg_rem_nome').html(data.remetente);
			$('#ass_msg_para_nome').html(data.destinatario);
			$('#ass_msg_resp').html(data.mensagem);	
			$('#msg_valores_'+idMensagem).addClass('delete');
			
			$('#msg_valores_'+idMensagem).addClass('delete');
			$('#n_msg').html('RECEBIDOS('+t+')');
			$('#box_msg_right_botton').show();
		}
	});
}
        
function RecebidasMobileDetalheFuncao(idMensagem){
	$('.col1-mobile').removeClass('delete');
	$('#msg_valores_'+idMensagem).removeClass('msg_nao_lida');
	$.ajax({
		url:'ajax/MensagemAjax.php',
		type:'post',
		dataType:'html',
		data:{'acao':'listaRecebidasMobileDetalhe','id':idMensagem},
		success:function(data){
			$('#abrir_msg_'+idMensagem).html(data);
			$('#msg_valores_'+idMensagem).addClass('delete');
			$('#abrir_msg_').show();
		}
	});
}
        
function deletadas(){
	$('.btn_msg').removeClass('btn_msg_ativo');
	$('#btn_excluidos').addClass('btn_msg_ativo');
	$.ajax({
		url:'ajax/MensagemAjax.php',
		type:'post',
		dataType:'html',
		data:{'acao':'deletadas'},
		success:function(data){
			$('#box_recebe_msg').html(data);
			$('#box_msg_right_botton').hide();
			checkbox();
		}
	});
}
        
function deletadasFuncaoMobile(){
	$.ajax({
		url:'ajax/MensagemAjax.php',
		type:'post',
		dataType:'html',
		data:{'acao':'deletadasMobile'},
		success:function(data){
			$('#box_msg_excluidas_mobile').html(data);
		}
	});
}
        
function responder(){
	$.ajax({
		url:'ajax/MensagemAjax.php',
		type:'post',
		dataType:'html',
		data:{'acao':'responder'},
		success:function(data){
		}
	});
}
        
function novo(){
	$.ajax({
		url:'ajax/MensagemAjax.php',
		type:'post',
		dataType:'html',
		data:{'acao':'novo'},
		success:function(data){
			$('#box_msg_right_botton').html(data);
			$('#box_msg_right_botton').show();
		}
	});
}
        
function recarrega(){
	var retorno;
	$.ajax({
		url:'ajax/MensagemAjax.php',
		type:'post',
		async: false,
		dataType:'json',
		data:{'acao':'recarrega','id':'20'},
		success:function(data){
			retorno = data.qtd;		
		}	
	});	
	return retorno;
}
        
		