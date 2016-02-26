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
		if ($(this).is(":visible")){
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
						// msg = data.msg;
						$('.'+idMgs).remove();
						
					}
				});
			}
		}
	})
	
	//Verifica se alguma mensagem foi excluida
	if (contMsg==0) {
		//alert('Selecione uma mensagem para ser deletada!');
		$('#mensagemErroDeletar').css('display','block');
	}else{
		//Se excluiu, limpa a div e  
		$('#mensagemSucessoDeletar').css('display','block');
		//alert('Mensagem(s) excluída(s) com sucesso!');
		
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
	
	$('#nova_mensagem').css('display','none');
	$('#box_recebe_msg').html('');
	$('#conteudo_mensagem').css('display','block');
	
	$.ajax({
		url:'ajax/MensagemAjax.php',
		type:'post',
		dataType:'html',
		data:{'acao':'listaEnviadas','id':$('#idUsuario').val()},
		success:function(data)
		{
			$("#titulo_rem").text('DESTINATÁRIOS');
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
		data:{'acao':'listaEnviadosMobile','id':$('#idUsuario').val()},
		success:function(data){		  
			$('#box_msg_enviadas_mobile').html(data);	
			checkbox();			
		}
	});
}
              
function recebidasFuncao(){
	$('#box_msg_listas').css('height','472px');
	$('.btn_msg').removeClass('btn_msg_ativo');
	$('#btn_recebidos').addClass('btn_msg_ativo');
	
	$('#nova_mensagem').css('display','none');
	$('#box_recebe_msg').html('');
	$('#conteudo_mensagem').css('display','block');
	
	$.ajax({
		url:'ajax/MensagemAjax.php',
		type:'post',
		dataType:'html',
		data:{'acao':'listaRecebidos','id':$('#idUsuario').val()},
		success:function(data)
		{
			$("#titulo_rem").text('REMETENTES');
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
		data:{'acao':'listaRecebidosMobile','id':$('#idUsuario').val()},
		success:function(data)
		{
			$('#box_msg_recebidas_mobile').html(data);
			checkbox();
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
        
function DeletadasMobileDetalheFuncao(iMensagem){
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
	$('#nova_mensagem').css('display','none');
	$('#box_recebe_msg').html('');
	$('#conteudo_mensagem').css('display','block');
	
	$.ajax({
		url:'ajax/MensagemAjax.php',
		type:'post',
		dataType:'html',
		data:{'acao':'deletadas'},
		success:function(data){
			$("#titulo_rem").text('USUÁRIOS');
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
			checkbox();
			//console.log('aqui');
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
	$("#mensagem_campo_para").val('');
	$("#mensagem_campo_assunto").val('');
	$("#mensagem_campo_conteudo").val('');
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
		data:{'acao':'recarrega','id':$('#idUsuario').val()},
		success:function(data){
			retorno = data.qtd;		
		}	
	});	
	return retorno;
}

var timerBusca;
timerBusca = setTimeout(function(){}, 1)
function buscaNomeDestinatario(){		
	var retorno;
	var letrasDigitadas = $('#mensagem_campo_para').val();
	var html='';
	var html2='';
	clearTimeout(timerBusca)
	timerBusca = setTimeout(function(){
		$.ajax({
			url:'ajax/MensagemAjax.php',
			type:'post',
			async: false,
			dataType:'json',
			data:{'acao':'listaDestinatario','letrasDigitadas':letrasDigitadas,'opcao':'letras'},
			success:function(data){
				for(a in data){
					var nome = data[a].nome;

					html += '<option>'+nome.trim()+'</option>';
					
					html2 += '<li data-original-index="'+a+'" data-optgroup="1" class="">'+						
						'<a onclick="btn_checkbox('+data[a].usuarioId+')"  tabindex="0" style="" data-tokens="null">'+
						'<span class="check_sel" id="'+data[a].usuarioId+'"></span>'+
						'<span class="text">'+nome.trim()+'</span>'+
						'</a>'+
						'</li>';
				}	
			}	
		}) 		

		$('#caixa_nomes').html(html);
		$('.inner').html(html2);
		setTimeout(function(){
			btn_checkbox();
		},1000)

	}, 2000);		
}

function btn_checkbox(idItem){
	$('#'+idItem).toggleClass('selecionado');
}