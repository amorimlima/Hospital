(function($){
	var Upload = {};
	var defaultOpcoes = {
			idFormulario : "formUpload",
			iframe : "iframe",
			script : "",
			nomeInput : "arquivo",
			inserir : "?acao=selecImagem",
			inputHideArquivo : 'imagem',
			deleta : "?acao=deletaPrev"

	};
	
	var acoes = {
		enviaArqivo: function (){
		$("#"+defaultOpcoes.nomeInput).change(function(){
			
			
			acoes.startCarregando();
			$("#"+defaultOpcoes.idFormulario).submit();
		
		});
	},
		startCarregando : function(){
		$("#loading").show();
	},
		stopCarregando : function (){
		$("#loading").hide();
	}
		
	};
	
	$.fn.goMobileUpload = function(opcoes){
		//alert('hahahaha');
		if(opcoes){
			$.extend(defaultOpcoes, opcoes);
		}
		$this = jQuery(this);
		Upload.criaIframe(defaultOpcoes.iframe, this.attr("id"));
		Upload.criaFromulario($("#"+defaultOpcoes.iframe).attr("name"),
				defaultOpcoes.script+''+defaultOpcoes.inserir,
				defaultOpcoes.idFormulario,
				defaultOpcoes.nomeInput,
				$this.attr("id")
				);
		//esconde o iframe
		$("#"+defaultOpcoes.iframe).hide();
		$("#imgUp").hide();
		$("#loading").hide();
		//envia formulario quando escolhe imagem
		acoes.enviaArqivo();
		//ao eviar executa funcao 
		$("#"+defaultOpcoes.idFormulario).submit(function(){
			
			$(this).hide(500);
			
			$("#"+defaultOpcoes.iframe).load(function(){
				console.log('aqui');
				var retorno = $(frames[defaultOpcoes.iframe].document).text();
				console.log(retorno);
				var obj = jQuery.parseJSON(retorno);
				
				console.log('Objeto do retorno!!');
				console.log(obj);
				
				if(obj.erro != 0){
					acoes.stopCarregando();
					//acoes.msgRetorno(''+obj.msg);
					$("#textoMensagemImagem").text(obj.msg);
					$("#mensagemErroImagem").show();
					acoes.startCarregando();
					$("#"+defaultOpcoes.idFormulario).show(500);
				}else{
					
					acoes.stopCarregando();
					$("#imgUp img").attr({"src" : "temporaria/"+obj.img});
					$("#imgUp a").attr({"href" : obj.img});
					if($("#imgAp").is(':visible')){
						$("#imgAp").hide();
						}
					$("#imgUp").show();
					
					console.log("#"+defaultOpcoes.inputHideArquivo);
					
					$("#"+defaultOpcoes.inputHideArquivo).val(obj.img);
					
				}
				
			});
		});
		
	};
	
	Upload.criaIframe = function(nome,div){
		$("<iframe></iframe>").attr({
			"id" : nome,
			"name" : nome
		}).appendTo("#"+div);
	}
	
	Upload.criaFromulario = function(iframe,action,id,nomeInput,div){
		//var formulario = $('<form><fieldset><legend class="titleList"><i class="fa fa-cloud-upload"></i> Imagem</legend></fieldset></form>').attr({
		var formulario = $('<form><fieldset></fieldset></form>').attr({
			"action" : action,
			"method" : "post",
			"enctype" : "multipart/form-data",
			"id" : id,
			"target" : iframe
		});
		$("#"+div).append(formulario);
		$("<input/>").attr({
			"type" : "file",
			"name" : nomeInput,
			"id" : nomeInput
		}).appendTo($("#"+id).children('fieldset'));
	}
	
})(jQuery)