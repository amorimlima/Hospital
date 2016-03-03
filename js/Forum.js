$(document).ready(function(e) {
    //Barra de rolagem personalizada
	$("#box_alunos_container").mCustomScrollbar({
		axis:"y",
		scrollButtons:{
			enable:true
		}
	});	
	
	$("#txt_pesquisa_input").keyup(function (){
		var texto = $(this).val().toUpperCase();
		
		$('.questaoTexto').each(function(){
			if($(this).html().toUpperCase().indexOf(texto)==-1) {
					$(this).parent().parent().parent().css('display','none');
				} else {
					$(this).parent().parent().parent().css('display','block');
				}
		});
		
		colorirDivs();

		//autoComplete($("#txt_pesquisa_input").val());
	});
});

function colorirDivs(){
	$('.qtd_visu').removeClass('cx_rosaP cx_brancaP');
	$('.qtd_resp').removeClass('cx_brancaP cx_rosaP');
	$('.perg_box').removeClass('cx_branca cx_rosa');
	cont = 0;
	
	$('.questaoTexto').each(function(){
		if ($(this).is(':visible')){
			id = $(this).attr('id'); 

			if (cont%2 == 0){
				$('#qtd_visu'+id).addClass('cx_brancaP');
				$('#qtd_resp'+id).addClass('cx_brancaP');
				$('#perg_box'+id).addClass('cx_rosa');
			}else{
				$('#qtd_visu'+id).addClass('cx_rosaP');
				$('#qtd_resp'+id).addClass('cx_rosaP');
				$('#perg_box'+id).addClass('cx_branca');
			}
			cont++;
		}
	})
}
function enviar(){
	var t =  $("#box_pergunta").val();
    var topico = $("#topico").val();
    
    if (t != ''){
    	if (topico == null){
    		$("#forumErroTopico").css('display','block');
    		return false;
    	}
    	
    	//$('#box_alunos').prepend('dsadsadsadasd');
    	//return false;
		$.ajax({
			url:'ajax/ForumAjax.php',
			type:'post',
			dataType:'html',
			data:{
				'acao':'perguntar',
				'anexo':'',
				'topico':topico,
				'txt':t
			},
			success:function(data)
			{
				$('#box_alunos').prepend(data);
				colorirDivs();
				$("#forumPerguntaSucesso").css('display','block');
				$("#box_pergunta").val("");
				$("#topico option").eq(0).attr('selected','selected');		

			}
		});
	}else{
		$("#forumErroVazia").css('display','block');
	}
	
	return false;
}

//function autoComplete(a){
//	
//	setTimeout(function(){
//		if ( $("#txt_pesquisa_input").val() == a) {
//			$.ajax({
//				url: "ajax/ForumAjax.php",
//				type: "post",
//				dataType: "html",
//				data: {
//					acao: "autoComplete",
//					valor: a
//				},
//				success: function (data){
//					$("#box_alunos").html(data)
//				}
//			})
//		}
//	}, 3000)    
//}