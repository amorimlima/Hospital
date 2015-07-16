
        function deleteFuncao(){
               
		$.ajax({
	          url:'ajax/MensagemAjax.php',
	          type:'post',
		  dataType:'json',
		  data:{'acao':'deleteMensagem','id':'8'},
		  success:function(data)
                  {
		     $('#retorno').html(data.msg);
           
		  }
		  });
	}
        
        function envidasFuncao(){
            $.ajax({
	          url:'ajax/MensagemAjax.php',
	          type:'post',
		  dataType:'json',
		  data:{'acao':'listaEnviadas','id':'10'},
		  success:function(data)
                  {
		     $('#retorno').html(data.msg);
           
		  }
		  });
              }
                /*
	          url:'ajax/MensagemAjax.php',
	          type:'post',
		  dataType:'json',
		  data:{'acao':'listaEnviadas','id':'5'},
		  success:function(data)
                  {
		     $('#retorno').html(data.msg);
           
		  }
		  });*/
        
        
        
            
