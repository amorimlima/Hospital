$(document).ready(function(){
    listaQuestao();
});


function listaQuestao(){
    $.ajax({
	          url:'ajax/ForumAjax.php',
	          type:'post',
		  dataType:'html',
		  data:{'acao':'listaQuestao'},
		  success:function(data)
                  {
                     
		      $('#box_alunos').html(data);
		  }
		  });
}

function perguntar(){
    var texto = $('#box_pergunta').val();
    alert(texto);
     $.ajax({
	          url:'ajax/ForumAjax.php',
	          type:'post',
		  dataType:'html',
		  data:{'acao':'perguntar',"txt":texto,'anexo':'0','topico':1,'usuario':4},
		  success:function(data)
                  {
                      alert('perguntar registrada com sucesso');
                      listaQuestao();
		     
		  }
		  });
}

