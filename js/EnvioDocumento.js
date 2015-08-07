     function enviarFuncao(){
           var url = $("#enviarDocumentos").val(); 
            url = url.split('\\');
            alert(url[2]);
            $.ajax({
	          url:'ajax/EnvioDocumentoAjax.php',
	          type:'post',
		  dataType:'html',
		  data:{'acao':'upload','idDestinatario':'1;2;3;4;5;6','idRemetente':'7','escola':1,'visto':0,'url':url[2]},
		  success:function(data)
                  {
		    
                    alert(data);
           
		  }
		  });
              }
              