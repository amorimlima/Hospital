function listaRespostas(a){
	var questao = a;
    $.ajax({
        url: "ajax/ForumAjax.php",
        type: "post",
        dataType: "html",
        data: {
            acao: "listaRespostaQuestao",
            resp: a
        },
        success: function (a)
        {
            $('#questao').val(questao);
        	$(".conteudoRespostas").html(a);
            barraDeRolagem();
        }
    })
}
function barraDeRolagem () {
    $("#resultadoPesq, #box_Respostas_container").mCustomScrollbar({
        axis: "y",
        scrollButtons: {
            enable: !0
        }
    });
}

// Barra de rolagem personalizada
$(document).ready(function ()
{
   barraDeRolagem();

	$("#txt_pesquisa_input").keyup(function (){
			texto = $(this).val().toUpperCase();; 
			var cont = 0;
			
			if (texto != ''){
				$('#listaRecentes').css('display','none');
				$('#listaPesquisa').css('display','block');
				
				$('.perguntaPesquisa').each(function(){
					if($(this).html().toUpperCase().indexOf(texto)==-1) {
						$(this).parent().css('display','none');
					} else {
						$(this).parent().css('display','block');
						
						if (cont%2 == 0) $(this).parent().css('background','#fdf0e7');
							else $(this).parent().css('background','#ffffff');
							
						cont++;
					}
				});
				
			}else{
				$('#listaRecentes').css('display','block');
				$('#listaPesquisa').css('display','none');
				
			}
			
			
			//autoCompleteRespostas($("#txt_pesquisa_input").val())
    });

	$("body").delegate("#btn_responder", "click", function (){
        $(this).css("display", "none");
        var a = new Date;
        dia = a.getDate();
		mes = a.getMonth() + 1;
		ano = a.getFullYear()
		hora = a.getHours();
		min = a.getMinutes();
		seg = a.getSeconds();
		dt = [dia, mes, ano].join("/") + " \xe0s" + [hora, min].join(":");
		$(".dataResposta").text(dt), $("#campo_resp").css("display", "block")
    });

	$("body").delegate("#btn_pronto", "click", function (){
        usuarioId = $(this).attr("idAluno");
		resposta = $("#resp_forum").val();
		questao = $("#questao").val();
		
		if (resposta != ''){
			$.ajax({
				url: "ajax/ForumAjax.php",
			    type: "post",
			    dataType: "json",
			    data: {
			    	acao: "NovaRespostaQuestao",
			        questao: questao,
			        resposta: resposta,
			        usuario: usuarioId
			    },
			    success: function (){
			    	$("#respostaSucesso").css('display','block');
			    	var totalResposta = $("#totalResp"+questao).text();
					totalResposta++; 
					if (totalResposta == 1)	$("#totalRespTexto"+questao).html('<span id="totalResp'+questao+'">1</span> Resposta');
						else $("#totalRespTexto"+questao).html('<span id="totalResp'+questao+'">'+totalResposta+'</span> Respostas');
			    	listaRespostas(questao)
			    }
			})
		}else {
			$('#respostaErroVazia').css('display','block');
		}
		return false;
    })
});

function atualizarVisitas(questao){
	var total = $("#totalVis"+questao).text();
	total++;

	if (total == 1)	$("#totalVisTexto"+questao).html('<span id="totalVis'+questao+'">1</span> Visualização');
		else $("#totalVisTexto"+questao).html('<span id="totalVis'+questao+'">'+total+'</span> Visualizações');
	return false;
}