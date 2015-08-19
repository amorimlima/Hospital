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
	var idMgs = $('.delete').attr('id');
	if (typeof idMgs !== "undefined") {
		var retorno = $('#'+idMgs).attr('class');
		retorno = retorno.split(' ');
		var id = idMgs.split('_');
		$.ajax({
			url:'ajax/MensagemAjax.php',
			type:'post',
			dataType:'json',
			data:{'acao':'deleteMensagem','id':id[2]},
			success:function(data)
			{
				$('#retorno').html(data.msg);
				$('#box_msg_right_botton').toggle();
				$('#'+idMgs).remove();
				if(retorno[0] == 'recebido'){
				   recebidasFuncao();
				}else if(retorno[0] == 'enviado'){
				  envidasFuncao();
				}	
			}
		});
	}else{
		alert('Selecione uma mensagem para ser deletada!');
	}
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

var controleMobile = 0; 
function novo(){
	$("#conteudo_mensagem").css("display", "none");
	$("#nova_mensagem").css("display", "block");
	 if( $("#mn_mobile").css("display") == "block") {
	 	$("#box_msg_left").css("display", "none");
	 	$("div.col-lg-8").addClass("col-sm-12");
	 	$("div.col-lg-8").removeClass("col-sm-9");
	 	controleMobile = 1;
	 }
	/*$.ajax({
		url:'ajax/MensagemAjax.php',
		type:'post',
		dataType:'html',
		data:{'acao':'novo'},
		success:function(data){
			$('#box_msg_right_botton').html(data);
			$('#box_msg_right_botton').show();
		}
	});*/
}
function fecharNovaMsg () {
	$("#conteudo_mensagem").css("display", "block");
	$("#nova_mensagem").css("display", "none");
	if (controleMobile === 1) {
		$("#box_msg_left").css("display", "block");
	 	$("div.col-lg-8").removeClass("col-sm-12");
	 	$("div.col-lg-8").addClass("col-sm-9");
	 	controleMobile = 0;
	}
}

function checkEnviar () {
	var para = document.getElementById("mensagem_campo_para");
	var assunto = document.getElementById("mensagem_campo_assunto");
	var mensagem = document.getElementById("mensagem_campo_conteudo");

	if(para.value != "" && assunto.value != "" && mensagem.value != "") {
		$("#texto_box").html("Sua mensagem foi enviada com sucesso!");
		$("#img_modal").addClass ("img_check");
		$("#img_modal").removeClass( "img_erro");
	} else {
		$("#texto_box").html("Preencha todos os campos.");
		$("#img_modal").removeClass ("img_check");
		$("#img_modal").addClass( "img_erro");
	}
}
function modalOk() {
	var para = document.getElementById("mensagem_campo_para");
	var assunto = document.getElementById("mensagem_campo_assunto");
	var mensagem = document.getElementById("mensagem_campo_conteudo");
	
	if (para.value != "" && assunto.value != "" && mensagem.value != "") {
		$("#conteudo_mensagem").css("display", "block");
		$("#nova_mensagem").css("display", "none");
		if (controleMobile === 1) {
			$("#box_msg_left").css("display", "block");
		 	$("div.col-lg-8").removeClass("col-sm-12");
		 	$("div.col-lg-8").addClass("col-sm-9");
		 	controleMobile = 0;
	}
	}
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
        
       