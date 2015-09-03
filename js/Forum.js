$(document).ready(function(e) {
    //Barra de rolagem personalizada
	$("#box_alunos_container").mCustomScrollbar({
		axis:"y",
		scrollButtons:{
			enable:true
		}
	});	
	
	$("#txt_pesquisa_input").keyup(function (){
		autoComplete($("#txt_pesquisa_input").val());
	});
});

function enviar(){
    var t =  $("#box_pergunta").val();
    var topico = $("#topico").val();
    
    return false;
	if (t != ''){
		$.ajax({
			url:'ajax/ForumAjax.php',
			type:'post',
			dataType:'html',
			data:{'acao':'perguntar','anexo':'','topico':topico,'txt':t},
			success:function(data)
			{
				$.ajax({                                      
					url:'ajax/ForumAjax.php',
					type:'post',
					dataType:'html',
					data:{'acao':'listaQuestao'},           
					success:function(data)
					  {
						$("#forumPerguntaSucesso").css('display','block');
						$("#box_pergunta").val("");
						$("#topico option").eq(0).attr('selected','selected');
						$('#box_alunos').html(data);
					  },
					error:function(){
						$("#forumErroInesperado").css('display','block');
					  }
				});
			}
		});
	}else{
		$("#forumErroVazia").css('display','block');
	}
	
	return false;
}

function autoComplete(a){
	
	setTimeout(function(){
		if ( $("#txt_pesquisa_input").val() == a) {
			$.ajax({
				url: "ajax/ForumAjax.php",
				type: "post",
				dataType: "html",
				data: {
					acao: "autoComplete",
					valor: a
				},
				success: function (data){
					$("#box_alunos").html(data)
				}
			})
		}
	}, 3000)    
//    var t = $("#txt_pesquisa_input").val(); 
//
//    $.ajax({                                      
//        url:'ajax/ForumAjax.php',
//        type:'post',
//        dataType:'html',
//        data:{'acao':'autoComplete','valor':t},           
//        success:function(data)
//          {
//             $('#box_alunos').html(data);
//          }
//    });
}