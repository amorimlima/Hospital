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
            $.ajax({
	          url:'ajax/MensagemAjax.php',
	          type:'post',
		  dataType:'html',
		  data:{'acao':'listaEnviadas','id':'20'},
		  success:function(data)
                  {
		     $('#box_msg_listas').html(data);
                     $('#box_msg_right_botton').hide();
           
		  }
		  });
              }
              
        function envidasFuncaoMobile(){
             $.ajax({
	          url:'ajax/MensagemAjax.php',
	          type:'post',
		  dataType:'html',
		  data:{'acao':'listaEnviadosMobile','id':'20'},
		  success:function(data)
                  {
		     $('#tbl_msg2').html(data);
                    
                    // $('#box_msg_right_botton').hide();
           
		  }
		  });
        }
              
        function recebidasFuncao(){
               $.ajax({
	          url:'ajax/MensagemAjax.php',
	          type:'post',
		  dataType:'html',
		  data:{'acao':'listaRecebidos','id':'20'},
		  success:function(data)
                  {
          
		     $('#box_msg_listas').html(data);
                     $('#box_msg_right_botton').hide();
           
           
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
          
		     $('#tbl_msg1').html(data);
                   
                     //$('#box_msg_right_botton').hide();
           
           
		  }
		  });
        }
        
        function EnviadasDetalheFuncao(idMensagem){
            $('.col1').removeClass('delete');
            $.ajax({
	          url:'ajax/MensagemAjax.php',
	          type:'post',
		  dataType:'html',
		  data:{'acao':'listaEnviadasDetalhe','id':idMensagem},
		  success:function(data)
                  {
                     //var t = recarrega();

		     $('#box_msg_right_botton').html(data);
                     $('#msg_valores_'+idMensagem).addClass('delete');
                     $('#box_msg_right_botton').show()();
                     //$('#n_msg').html('RECEBIDOS('+t+')');
           
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
		  success:function(data)
                  {
                       
                       $('#abrir_msg_'+idMensagem).html(data);
                       $('#msg_valores_'+idMensagem).addClass('delete');
                       $('#abrir_msg_').show()();
                     //var t = recarrega();
                     /*
		     $('#box_msg_right_botton').html(data);
                     
                     $('#box_msg_right_botton').show()();*/
                     //$('#n_msg').html('RECEBIDOS('+t+')');
           
		  }
		  });
        }
        
        function RecebidasDetalheFuncao(idMensagem){
            $('.col1').removeClass('delete');
             $('#msg_valores_'+idMensagem).removeClass('msg_nao_lida');
            $.ajax({
	          url:'ajax/MensagemAjax.php',
	          type:'post',
		  dataType:'html',
		  data:{'acao':'listaRecebidasDetalhe','id':idMensagem},
		  success:function(data)
                  {
                     var t = recarrega();
              
		     $('#box_msg_right_botton').html(data);
                     $('#msg_valores_'+idMensagem).addClass('delete');
                     $('#n_msg').html('RECEBIDOS('+t+')');
                     $('#box_msg_right_botton').show()();
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
		  success:function(data)
                  {
                       $('#abrir_msg_'+idMensagem).html(data);
                       $('#msg_valores_'+idMensagem).addClass('delete');
                       $('#abrir_msg_').show()();
		  }
		  });
        }
        
        function deletadas(){
            
            $.ajax({
	          url:'ajax/MensagemAjax.php',
	          type:'post',
		  dataType:'html',
		  data:{'acao':'deletadas'},
		  success:function(data)
                  {
		     $('#box_msg_listas').html(data);
                     $('#box_msg_right_botton').hide();
           
           
		  }
		  });
        }
        
        function deletadasFuncaoMobile(){
            
            $.ajax({
	          url:'ajax/MensagemAjax.php',
	          type:'post',
		  dataType:'html',
		  data:{'acao':'deletadasMobile'},
		  success:function(data)
                  {
		     $('#tbl_msg3').html(data);
                     //$('#box_msg_right_botton').hide();
           
           
		  }
		  });
        }
        
        function responder(){
            
             $.ajax({
	          url:'ajax/MensagemAjax.php',
	          type:'post',
		  dataType:'html',
		  data:{'acao':'responder'},
		  success:function(data)
                  {
		     //$('#box_msg_teste').html(data);
                        //$('#box_msg_right_botton').hide();
		  }
		  });
            
        }
        
        function novo(){
             
             $.ajax({
	          url:'ajax/MensagemAjax.php',
	          type:'post',
		  dataType:'html',
		  data:{'acao':'novo'},
		  success:function(data)
                  {
                      $('#box_msg_right_botton').html(data);
                      $('#box_msg_right_botton').show()();
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
		  success:function(data)
                  {
                     retorno = data.qtd;
              
		  }
                 
		  });
                  
                  return retorno;
        }
        
       