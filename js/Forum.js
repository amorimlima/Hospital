function enviar(){
    var t =  $("#box_pergunta").val();   
     $.ajax({
        url:'ajax/ForumAjax.php',
        type:'post',
        dataType:'html',
        data:{'acao':'perguntar','usuario':'4','anexo':'teste','topico':'teste','txt':t},
        success:function(data)
        {
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
    });
}

function autoComplete(){
    var t = $("#txt_pesquisa_input").val(); 

    $.ajax({                                      
        url:'ajax/ForumAjax.php',
        type:'post',
        dataType:'html',
        data:{'acao':'autoComplete','valor':t},           
        success:function(data)
          {
             $('#box_alunos').html(data);
          }
    });
}