"use strict";

var tabs = $('.tab_cadastro');
var containers = $('.conteudo_tab');
var btns = $('.btns_tabs');
var primeiroAcesso = true;
var delPerfilId = '0';
var pre_cadastros_listados = false;

$(document).ready(function() {
	
	$('#update_cadastro').trigger('click');
	
	$('.conteudo_tab').mCustomScrollbar({
		axis:"y",
		scrollButtons:{
			enable:true
		}
	});
    
    $(tabs).click(function() {
        tabNavigation(this);
    });

    
    tabNavigation(tabs[0]);
    
    $('.data').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        language: "pt-BR",
        toggleActive: true
    });
    
    listarAlunos();
   
    $('.btn_tab').click(function() {
        $(this).siblings().removeClass('btn_tab_ativo');
        $(this).addClass('btn_tab_ativo');
        
        if ( $(this).hasClass('btn_aluno') ) {
            if ( $(this).hasClass('btn_add_cadastro') ) {
            	$('.conteudo_aluno').find('.form_cadastro').show();
                $('.conteudo_aluno').find('.update_cadastro').hide();
                
                $('#cadastroImagemUpload').appendTo("#spanImagemAluno");
                
            } else if ( $(this).hasClass('btn_update_cadastro') ) {
                $('.conteudo_aluno').find('.form_cadastro').hide();

                listarAlunos();
                
                $('.conteudo_aluno').find('.update_cadastro').show()
            }
        } else if ( $(this).hasClass('btn_professor') ) {
            if ( $(this).hasClass('btn_add_cadastro') ) {
                $('.conteudo_professor').find('.form_cadastro').show();
                $('.conteudo_professor').find('.update_cadastro').hide();
                
                $('#cadastroImagemUpload').appendTo("#spanImagemProfessor");
                
            } else if ( $(this).hasClass('btn_update_cadastro') ) {
                $('.conteudo_professor').find('.form_cadastro').hide();
                $('.conteudo_professor').find('.update_cadastro').show()
            }
        } else if ( $(this).hasClass('btn_escola') ) {
            if ( $(this).hasClass('btn_add_cadastro') ) {
                $('.conteudo_escola').find('.confirm_cadastro').hide();
                $('.conteudo_escola').find('.form_cadastro').show();
                $('.conteudo_escola').find('.update_cadastro').hide();
                $('#cadastroImagemUpload').appendTo("#spanImagemEscola");
            } else if ( $(this).hasClass('btn_update_cadastro') ) {
                $('.conteudo_escola').find('.confirm_cadastro').hide();
                $('.conteudo_escola').find('.form_cadastro').hide();
                $('.conteudo_escola').find('.update_cadastro').show();
            } else if ( $(this).hasClass('btn_confirm_cadastro') ) {
                $('.conteudo_escola').find('.confirm_cadastro').show();
                $('.conteudo_escola').find('.form_cadastro').hide();
                $('.conteudo_escola').find('.update_cadastro').hide();
                requestPreCadastros();
            }
        }
    });
    
    //chama a função q carrega os estados no select
    listarEstadoCidade('inputEstadoAluno');
    $('#inputEstadoAluno').change(function(){
    	selectCidade('inputEstadoAluno','inputCidadeAluno')
    });
    listarEstadoCidade('inputEstadoProf');
    $('#inputEstadoProf').change(function(){
    	selectCidade('inputEstadoProf','inputCidadeProf')
    });
    listarEstadoCidade('inputEstadoEscola');
    $('#inputEstadoEscola').change(function(){
    	selectCidade('inputEstadoEscola','inputCidadeEscola')
    });
    
    
    $('.accordion_info').click(function() {
        $(this).toggleClass('accordion_expanded');
    });

    $("#cadastroAluno").click(function(){
    	
    	$('.obrigatorioAluno').each(function(){
    		if ($(this).val() == '' || $(this).val() == null ){
    			if ($(this).attr('id') == 'inputTelResAluno'){	//Verifica se existe ao menos um telefone cadastrado!
    				if ($('#inputTelCelAluno').val() == '' && $('#inputTelComAluno').val() == ''){
    					$("#textoMensagemVazio").text('Pelo menos um número de telefone deve ser cadastrado');
    	        		$("#mensagemCampoVazio").show();
    	        		$(this).focus();
    					return false;
    				}
    			}else{
	    			$("#textoMensagemVazio").text($(this).attr('msgVazio'));
	        		$("#mensagemCampoVazio").show();
	        		$(this).focus();
	        		return false;
    			}
    		} 
    	})
    	
    	//Se a div de erro está visivel para aqui.
    	if ($("#mensagemCampoVazio").is(':visible')) return false;
    	
    	if (validarCPF($("#inputCpfAluno").val()) == false){
    		$("#textoMensagemVazio").text('CPF inválido!');
    		$("#mensagemCampoVazio").show();
    		$("#inputCpfAluno").focus();
    		return false;
    	}
    	
    	if ($("#inputCepAluno").val().length < 10){
    		$("#textoMensagemVazio").text('CEP inválido!');
    		$("#mensagemCampoVazio").show();
    		$("#inputCepAluno").focus();
    		return false;
    	}
    	
    	if(validaEmail($("#inputEmailAluno").val()) == false){
    		$("#textoMensagemVazio").text('Email inválido!');
    		$("#mensagemCampoVazio").show();
    		$("#inputEmailAluno").focus();
    		return false;    		
    	}
    	
    	if ($('#inputSenhaAluno').val() != $('#inputSenhaConfirmAluno').val()){
			$("#textoMensagemVazio").text('Os campos senha e confirmação da senha devem ser iguais');
    		$("#mensagemCampoVazio").show();
    		$('#inputSenhaAluno').focus();
			return false;    		
    	}

    	//dados da tabela usuário
    	var nome = $("#inputNomeAluno").val();
    	//var escolaGrupo = $("#selectProfessorAluno").val().split('_');
    	//var escola = escolaGrupo[0];
    	//var grupo = escolaGrupo[1];
    	var escola = '';
    	var grupo = '';
    	
    	var professor = $("#selectProfessorAluno").val();
        var periodo = $("#selectPeriodoAluno").val();
        var serie = $("#selectSerieAluno").val();
        var nascimento = $("#inputNascimentoAluno").val();
        var rg = $("#inputRgAluno").val();
        var cpf = $("#inputCpfAluno").val();
        var ano = $("#selectAnoAluno").val();
        
        //Dados da tabela endereço do aluno!
        var rua = $("#inputRuaAluno").val();
        var bairro = $("#inputBairroAluno").val();
        var cidade = $("#inputCidadeAluno").val();
        var numCasa = $("#inputNumCasaAluno").val();
        
        var compCasa = $('#inputCompCasaAluno').val();
        
        var estado = $("#inputEstadoAluno").val();
        var cep = $("#inputCepAluno").val(); 
        var celular = $("#inputTelCelAluno").val();
        var telResidencial = $("#inputTelResAluno").val();
        var telComercial = $("#inputTelComAluno").val();
        var email = $("#inputEmailAluno").val();
        var login = $("#inputUsuarioAluno").val();
        var senha = $("#inputSenhaAluno").val();
        var imagem = $("#imagem").val();

        $.ajax({
            url:'ajax/CadastroAjax.php',
            type:'post',
            dataType:'json',
            data: {
                'acao': 'novoUsuario',
                'perfil': '1',
                'nome': nome,
                'professor': professor,
                'periodo': periodo,
                'escola': escola,
                'serie': serie,
                'ano': ano,
                'grupo': grupo,
        		'grauInstrucao':'null',
        		'categoria':'null',
                'nascimento': nascimento,
                'rg': rg,
                'cpf': cpf,
                'rua': rua,
                'bairro': bairro,
                'cidade':cidade,
                'numCasa': numCasa,
                'complemento': compCasa,
                'estado': estado,
                'cep': cep,
                'celular': celular,
                'telResidencial': telResidencial,
                'telComercial': telComercial,
                'email': email,
                'nse':'',
                'imagem':imagem,
                'login':login,
                'senha':senha
            },
            success:function(retorno){
        		if (retorno.erro == false) $("#mensagemSucessoCadastro").show();
	           		else {
	           			$("#textoMensagemVazio").text(retorno.msg);
	           			$("#mensagemCampoVazio").show();
	           		}
            	return false;
            },
            error:function(data){
            	$("#mensagemErroCadastro").show();
            	return false;
            }
        });
        return false;
    });

    $("#cadastroProfessor").click(function(){

    	$('.obrigatorioProf').each(function(){
    		if ($(this).val() == '' || $(this).val() == null ){
    			if ($(this).attr('id') == 'inputTelResProf'){	//Verifica se existe ao menos um telefone cadastrado!
    				if ($('#inputTelCelProf').val() == '' && $('#inputTelComProf').val() == ''){
    					$("#textoMensagemVazio").text($(this).attr('msgVazio'));
    	        		$("#mensagemCampoVazio").show();
    	        		$(this).focus();
    					return false;
    				}
    			}else{
	    			$("#textoMensagemVazio").text($(this).attr('msgVazio'));
	        		$("#mensagemCampoVazio").show();
	        		$(this).focus();
	        		return false;
    			}
    		} 
    	})
    	
    	//Se a div de erro está visivel para aqui.
    	if ($("#mensagemCampoVazio").is(':visible')) return false;
    	
    	if (validarCPF($("#inputCpfProf").val()) == false){
    		$("#textoMensagemVazio").text('CPF inválido!');
    		$("#mensagemCampoVazio").show();
    		$("#inputCpfAluno").focus();
    		return false;
    	}
    	
    	if ($("#inputCepProf").val().length < 10){
    		$("#textoMensagemVazio").text('CEP inválido!');
    		$("#mensagemCampoVazio").show();
    		$("#inputCepAluno").focus();
    		return false;
    	}
    	
    	if(validaEmail($("#inputEmailProf").val()) == false){
    		$("#textoMensagemVazio").text('Email inválido!');
    		$("#mensagemCampoVazio").show();
    		$("#inputEmailAluno").focus();
    		return false;    		
    	}
    	
    	if ($('#inputSenhaProf').val() != $('#inputSenhaConfirmProf').val()){
			$("#textoMensagemVazio").text('Os campos senha e confirmação da senha devem ser iguais');
    		$("#mensagemCampoVazio").show();
    		$('#inputSenhaAluno').focus();
			return false;    		
    	}

    	var nomeProfessor = $("#inputNomeProf").val();
    	var dataNascimentoProfessor = $("#inputNascimentoProf").val();
    	var rgProfessor = $("#inputRgProf").val();
    	var cpfProfessor = $("#inputCpfProf").val();
    	var loginProfessor = $("#inputUsuarioProf").val();
    	var senhaProfessor = $("#inputSenhaProf").val();
    	
    	var ruaProfessor = $("#inputRuaProf").val();
    	var bairroProfessor = $("#inputBairroProf").val();
    	var numeroCasa = $("#inputNumCasaProf").val();
    	var compCasa = $("#inputCompCasaProf").val();
    	var cidadeProfessor = $("#inputCidadeProf").val();
    	var ufProfessor = $("#inputEstadoProf").val();
    	var cepProfessor = $("#inputCepProf").val();
    	var telResidencial = $("#inputTelResProf").val();
    	var celular = $("#inputTelCelProf").val();
    	var telComercial = $("#inputTelComProf").val();
    	var emailProfessor = $("#inputEmailProf").val();
    	var emailProfessor = $("#inputEmailProf").val();
    	
    	var grauInstrucao = $("#selectGrauProf").val();
    	var categoria = $("#selectCategoriaProf").val();
    	var serie = $("#selectSerieProf").val();
    	var imagem = $("#imagem").val();
    	
    	$.ajax({
        	url:'ajax/cadastroAjax.php',
        	type:'post',
        	dataType:'json',
        	data:{'acao':'novoUsuario',
    			'perfil':'2',
        		'nome':nomeProfessor,
        		'nascimento':dataNascimentoProfessor,
        		'rg':rgProfessor,
        		'cpf':cpfProfessor,
        		'ano':'null',
        		'turma':'null',
        		'grupo':'null',
        		'serie':serie,
        		'grauInstrucao': grauInstrucao,
        		'categoria':categoria,
        		'rua':ruaProfessor,
        		'bairro':bairroProfessor,
        		'numCasa':numeroCasa,
        		'cidade':cidadeProfessor,
        		'estado':ufProfessor,
        		'cep':cepProfessor,
        		'telResidencial':telResidencial,
        		'complemento':compCasa,
        		'telComercial':telComercial,
        		'celular':celular,
        		'nse':'',
        		'email':emailProfessor,
        		'escola':'',
        		'imagem':imagem,
        		'login':loginProfessor,
        		'senha':senhaProfessor},
        	success:function(retorno){
        		if (retorno.erro == false) {
        			$("#mensagemSucessoCadastro").show();
        			listaProfessores(); //Lista os professores novamente para aparecer o professor recem-cadsatrado (se precisar)
        		}else {
               			$("#textoMensagemVazio").text(retorno.msg);
               			$("#mensagemCampoVazio").show();
               		}

               	return false;
            },
                error:function(data){
               	$("#mensagemErroCadastro").show();
                	return false;
        	}
        });	
    	return false;
   	});
   
    //Cadastro daescola.
    $("#cadastroEscola").click(function(){

//    	$('.obrigatorioEscola').each(function(){
//    		if ($(this).val() == '' || $(this).val() == null ){
//    			$("#textoMensagemVazio").text($(this).attr('msgVazio'));
//	        	$("#mensagemCampoVazio").show();
//	        	$(this).focus();
//	        	return false;
//    		} 
//    	})
//    	
//    	//Se a div de erro está visivel para aqui.
//    	if ($("#mensagemCampoVazio").is(':visible')) return false;
//    	
//    	if (validaCNPJ($("#inputCnpjEscola").val()) == false){
//    		$("#textoMensagemVazio").text('CNPJ inválido!');
//    		$("#mensagemCampoVazio").show();
//    		$("#inputCpfAluno").focus();
//    		return false;
//    	}
//    	
//    	if ($("#inputCepEscola").val().length < 10){
//    		$("#textoMensagemVazio").text('CEP inválido!');
//    		$("#mensagemCampoVazio").show();
//    		$("#inputCepAluno").focus();
//    		return false;
//    	}
//    	
//    	if(validaEmail($("#inputEmailEscola").val()) == false){
//    		$("#textoMensagemVazio").text('Email inválido!');
//    		$("#mensagemCampoVazio").show();
//    		$("#inputEmailAluno").focus();
//    		return false;    		
//    	}
//    	
//    	if ($('#inputSenhaEscola').val() != $('#inputSenhaConfirmEscola').val()){
//			$("#textoMensagemVazio").text('Os campos senha e confirmação da senha devem ser iguais');
//    		$("#mensagemCampoVazio").show();
//    		$('#inputSenhaAluno').focus();
//			return false;    		
//    	}

    	var nomeEscola = $("#inputNomeEscola").val();
    	var razao = $("#inputRazaoEscola").val();
    	var codigoEscola = $("#inputCodigoEscola").val();
    	var nse = $("#inputNseEscola").val();
    	var cnpj = $("#inputCnpjEscola").val();
    	var adm = $("#inputAdmEscola").val();
    	var tipo = $("#inputTipoEscola").val();
    	var enderecoEscola = $("#inputRuaEscola").val();
    	var bairroEscola = $("#inputBairroEscola").val();
    	var numeroEnderecoEscola = $("#inputNumCasaEscola").val();
    	var complemento = $("#inputCompCasaEscola").val();
    	var cidadeEscola = $("#inputCidadeEscola").val();
    	var ufEscola = $("#inputEstadoEscola").val();
    	var cepEscola = $("#inputCepEscola").val();
    	var telefoneEscola = $("#inputTelefoneEscola").val();
    	var emailEscola = $("#inputEmailEscola").val();
    	var loginEscola = $("#inputUsuarioEscola").val();
    	var senhaEscola = $("#inputSenhaEscola").val();
    	var imagem = $("#imagem").val();
    	
    	
    	$.ajax({
    		url:'ajax/cadastroAjax.php',
    		type:'post',
    		dataType:'json',
    		data:{
    			'acao':'cadastraEscola',
    			'perfil': '4',
    			'status': '1',
    			'nomeEscola':nomeEscola,
    			'razao':razao,
    			'cnpj':cnpj,
    			'nse':nse,
    			'codigoEscola':codigoEscola,
    			'tipoEscola':tipo,
    			'adm':adm,
    			'enderecoEscola':enderecoEscola,
    			'bairroEscola':bairroEscola,
    			'complemento':complemento,
    			'numeroEnderecoEscola':numeroEnderecoEscola,
    			'cidadeEscola':cidadeEscola,
    			'ufEscola':ufEscola,
    			'cepEscola':cepEscola,
    			'telefoneEscola':telefoneEscola,
    			'emailEscola':emailEscola,
    			'loginEscola':loginEscola,
    			'senhaEscola':senhaEscola,
    			'nomeDiretor':'',
    			'emailDiretor':'',
    			'nomeCoordenador':'',
    			'emailCoordenador':'',
    			'imagem':imagem
    		},
    		success:function(retorno){
    			if (retorno.erro == false) {
    				$("#mensagemSucessoCadastro").show();
    	        	listarEscolas();	//Lista es escolas novamente colocando a recem cria e zera a lista dos professores.
    	        	$('#selectProfessorAluno').html('<option value="" disabled selected>Selecione primeiro a escola e a série</option>');
    			}else {
               			$("#textoMensagemVazio").text(retorno.msg);
        	        	$("#mensagemCampoVazio").show();
               		}
               	return false;
    		},
    		error:function(data){
            	$("#mensagemErroCadastro").show();
            	return false;
            }
    	});    		
    	
    	return false;
    });
    
	$("#cadastroImagem").goMobileUpload({
		script : "ajax/CadastroAjax.php"
	});
	
}); //Fim

function tabNavigation(tabToShow) {
	
	//Reseta a imagem se não for a primeira vez
    if (primeiroAcesso == true){
    	primeiroAcesso = false;
    }else{
    	limparInputArquivo();
    }
	
	for ( var i = 0; i < tabs.length; i++ ) {
		if ( tabs[i] == tabToShow ) {
			$($(containers).get(i)).show();
			$($(btns).get(i)).show();
			
			//Joga o html da imagem no local certo
			var idDiv = $('.spanImagem').eq(i).attr('id');
			$('#cadastroImagemUpload').appendTo("#"+idDiv);
			
			$($(tabs).get(i)).addClass('tab_cadastro_ativo');
		} else {
			$($(containers).get(i)).hide();
			$($(btns).get(i)).hide();

			$($(tabs).get(i)).removeClass('tab_cadastro_ativo');
		}
	}
}

function cancelDelPerfil() {
    delPerfilId = '0';
}

function confirmDelPerfil() {
    for ( var a in perfisAlunosGerados ) {
        if ( perfisAlunosGerados[a].id == delPerfilId ) {
            perfisAlunosGerados[a].deletar();
            break;
        }
    }
}


function formatar(mascara, documento){
    var i = documento.value.length;
    var saida = mascara.substring(0,1);
    var texto = mascara.substring(i)
    
    if (texto.substring(0,1) != saida){
       documento.value += texto.substring(0,1);
    }
  	  
  }

function listaProfessores(){
	
	if ($('#selectEscolaAluno').val() == null || $('#selectSerieAluno').val() == null){
		$('#selectProfessorAluno').html('<option value="" disabled selected>Selecione primeiro a escola e a série</option>');
		return false;
	}
	$.ajax({
        url:'ajax/CadastroAjax.php',
        type:'post',
        dataType:'html',
        data: {
            'acao': 'listaProfessoresByEscolaAndSerie',
            'serie': $('#selectSerieAluno').val(),
            'escola': $('#selectEscolaAluno').val()
        },
        success:function(retorno){
        	$('#selectProfessorAluno').html(retorno);
        }
    });
	return false;
}

function listarEscolas(){
	$.ajax({
        url:'ajax/CadastroAjax.php',
        type:'post',
        dataType:'html',
        data: {
            'acao': 'listaEscolas'
        },
        success:function(retorno){
        	$('#selectEscolaAluno').html(retorno);
        }
    });
	return false;
}

function limparInputArquivo(){
	
	$("#imgUp").hide();
	$("#loading").hide();
	document.getElementById("arquivo").value = "";
	$("#cadastroImagem form").show();
	$("#cadastroImagem").show();
	return false;
}

function listarAlunos(){
	
	$.ajax({
        url:'ajax/CadastroAjax.php',
        type:'post',
        dataType:'json',
        data: {
            'acao': 'listaUsuariosCompleto',
            'perfil': '1'
        },
        success:function(retorno){
        	
        }
    });
}

function getPreCadastros() {
    "use strict";

    var escolas;

    $.ajax({
        url: "ajax/CadastroAjax.php?acao=listaPendentes",
        type: "GET",
        async: false,
        success: function(data) {
            var preCadastros = JSON.parse(data);
            escolas = preCadastros;
        }
    });

 	return escolas;
};

function viewPreCadastros(preCadastros) {
    "use strict";
    
	var html = new String();

	for (var b in preCadastros) {
		html += "<a href=\"#updateEscolaCont"+preCadastros[b].id+"\" class=\"accordion_info_toggler updateAlunoToggler\" data-toggle=\"collapse\">";
		html += 	"<div class=\"accordion_info\" data-status=\""+preCadastros[b].status+"\" id=\"updateEscolaInfo"+preCadastros[b].id+"\">"+preCadastros[b].nome+"</div>";
		html += "</a>";
		html += "<div class=\"accordion_content collapse\" id=\"updateEscolaCont"+preCadastros[b].id+"\">";
		html += 	"<div class=\"content_col_info\">";
		html += 		"<table>";
		html += 			"<tr class=\"content_info_row\">";
		html +=					"<td colspan=\"4\"><span class=\"content_info_label\">Razão Social:</span> <span class=\"content_info_txt\">"+preCadastros[b].razaoSocial+"</span></td>";
		html += 			"</tr>";
		html += 			"<tr class=\"content_info_row\">";
		html += 				"<td colspan=\"2\"><span class=\"content_info_label\">CNPJ:</span> <span class=\"content_info_txt\">"+preCadastros[b].cnpj+"</span></td>";
		html +=					"<td colspan=\"2\"><span class=\"content_info_label\">Código:</span> <span class=\"content_info_txt\">"+preCadastros[b].codigo+"</span></td>";
		html += 			"</tr>";
		html += 			"<tr class=\"content_info_row\">";
		html += 				"<td colspan=\"2\"><span class=\"content_info_label\">Tipo:</span> <span id=\"tipoEscola"+preCadastros[b].tipo.id+"\" class=\"content_info_txt\">"+preCadastros[b].tipo.tipo_escola+"</span></td>";
		html +=					"<td colspan=\"2\"><span class=\"content_info_label\">Administração:</span> <span id=\"administracaoEscola"+preCadastros[b].administracao.id+"\" class=\"content_info_txt\">"+preCadastros[b].administracao.administracao+"</span></td>";
		html += 			"</tr>";
		html += 			"<tr class=\"content_info_row\">";
		html += 				"<td colspan=\"4\"><span class=\"content_info_label\">Endereço: </span>";
		html += 					"<span id=\"escolaEndereco"+preCadastros[b].endereco.id+"\" class=\"content_info_txt\">";
		html +=							preCadastros[b].endereco.logradouro + ", ";
		html +=							preCadastros[b].endereco.numero + ", "
		html += 						preCadastros[b].endereco.complemento ? preCadastros[b].endereco.complemento + ", " : "";
		html += 						preCadastros[b].endereco.cep + " - ";
		html += 						preCadastros[b].endereco.bairro + " - ";
		html += 						preCadastros[b].endereco.cidade + ", ";
		html +=							preCadastros[b].endereco.uf + " - ";
		html += 						preCadastros[b].endereco.pais;
		html += 					"</span>";
		html += 				"</td>";
		html += 			"</tr>";
		html += 			"<tr class=\"content_info_row\">";
		html += 				"<td colspan=\"4\"><span class=\"content_info_label\">E-mail:</span> <span class=\"content_info_txt\">"+preCadastros[b].endereco.email+"</span></td>";
		html += 			"</tr>";
		html += 			"<tr class=\"content_info_row\">";
		html += 				"<td colspan=\"4\"><span class=\"content_info_label\">Telefone:</span> <span class=\"content_info_txt\">"+preCadastros[b].endereco.tel_res+"</span></td>";
		html += 			"</tr>";
		html += 			"<tr class=\"content_info_row\">";
		html += 				"<td colspan=\"4\"><span class=\"content_info_label\">Website:</span> <span class=\"content_info_txt\">"+preCadastros[b].site+"</span></td>";
		html += 			"</tr>";
		html += 			"<tr class=\"content_info_row\">";
		html += 				"<td colspan=\"4\"><span class=\"content_info_label\">Diretor(a):</span> <span class=\"content_info_txt\">"+preCadastros[b].diretor+"</span></td>";
		html += 			"</tr>";
		html += 			"<tr class=\"content_info_row\">";
		html +=					"<td colspan=\"4\"><span class=\"content_info_label\">E-mail do(a) diretor(a):</span> <span class=\"content_info_txt\">"+preCadastros[b].emailDiretor+"</span></td>";
		html += 			"</tr>";
		html += 			"<tr class=\"content_info_row\">";
		html += 				"<td colspan=\"4\"><span class=\"content_info_label\">Coordenador(a):</span> <span class=\"content_info_txt\">"+preCadastros[b].coordenador+"</span></td>";
		html += 			"</tr>";
		html += 			"<tr class=\"content_info_row\">";
		html +=					"<td colspan=\"4\"><span class=\"content_info_label\">E-mail do(a) coordenador(a):</span> <span class=\"content_info_txt\">"+preCadastros[b].emailCoord+"</span></td>";
		html += 			"</tr>";
		html +=			"</table>";
		html +=		"</div>";
		html += 	"<div class=\"content_col_btns\">";
        html +=         "<button data-action=\"requestPdf\" data-action-for=\"updateEscolaCont"+preCadastros[b].id+"\" class=\"section_btn btn_request_cad\">Ver pesquisa</button>";
		html += 		"<button data-action=\"reject\" data-action-for=\"updateEscolaCont"+preCadastros[b].id+"\" class=\"section_btn btn_reject_cad\">Rejeitar cadastro</button>";
		html += 		"<button data-action=\"confirm\" data-action-for=\"updateEscolaCont"+preCadastros[b].id+"\" class=\"section_btn btn_confirm_cad\">Confirmar cadastro</button>";
		html += 	"</div>";
		html +=	"</div>";
	};

 	return html;
};

function requestPreCadastros() {
    "use strict";

    var preCadastros;
    var htmlPreCadastros;

    if (!pre_cadastros_listados) {
        preCadastros = getPreCadastros();
        if (typeof(preCadastros[0].status) === undefined) {
            htmlPreCadastros = viewPreCadastros(preCadastros);
        } else {
            htmlPreCadastros = "<div class=\"alert alert-warning\">Nenhum pré-cadastro pendente de confirmação até o momento.</div>";
        }

        $("#containerPreCadastros").html(htmlPreCadastros);
        pre_cadastros_listados = true;
        atribuirEventosPreCadastro();
    } else {
        console.info("Pré-cadastros já listados.");
    }
};

function confirmPreCadastro(action, id) {
	"use strict";

	$.ajax({
		url: "ajax/CadastroAjax.php",
		type: "POST",
		data: {"acao": action, "id": id},
		dataType: "JSON",
		success: function(data) {
			console.info(data.mensagem+"\nStatus: "+data.status);
			$("#mensagemSucessoConfirmCad").show();
			removerItemPreCadastro(id);
		},
		error: function(data) {
			console.error(data.mensagem+"\nStatus: "+data.status);
			$("#mensagemErroConfirmCad").show();
		}
	});
};

function removerItemPreCadastro(id) {
	//Remove da listagem a escola cujo cadastro acabou de ser confirmado
	$("#updateEscolaCont"+id).remove();
	$("#updateEscolaInfo"+id).parent("a").remove();
};

function rejectPreCadastro(action, id) {
	"use strict";

	$.ajax({
		url: "ajax/CadastroAjax.php",
		type: "POST",
		data: {"acao": action, "id": id},
		dataType: "JSON",
		success: function(data) {
			console.info(data.mensagem+"\nStatus: "+data.status);
			$("#mensagemSucessoRejectCad").show();
			removerItemPreCadastro(id);
		},
		error: function(data) {
			console.error(data.mensagem+"\nStatus: "+data.status);
			$("#mensagemErroRejectCad").show();
		}
	});

	unbindBotoesModalRejeitar();
};

function confirmRejeitarCadastro(action, id) {
	$("#mensagemConfirmRejectCad").find("button[data-confirma=sim]").attr("onclick", "rejectPreCadastro('"+action+"','"+id+"')");
	$("#mensagemConfirmRejectCad").find("button[data-confirma=nao]").attr("onclick", "unbindBotoesModalRejeitar()");
	$("#mensagemConfirmRejectCad").show();
};

function unbindBotoesModalRejeitar() {
	$("#mensagemConfirmRejectCad").find("button[data-confirma=sim]").attr("onclick", "");
	$("#mensagemConfirmRejectCad").find("button[data-confirma=nao]").attr("onclick", "");
};

function getArquivoPesquisa(action, id) {
    "use strict";

    var arquivo;

    $.ajax({
        url: "ajax/CadastroAjax.php?acao="+action+"&id="+id,
        type: "GET",
        async: false,
        success: function (data) {
            arquivo = JSON.parse(data);
        }
    });

    return arquivo;
};

function requestArquivoPesquisa(action, cadastroId) {
    var arquivo = getArquivoPesquisa(action, cadastroId);

    if (arquivo.status) {
        window.open(arquivo.url, "_blank");
    } else {
        $("#mensagemErroGetArquivo").show();
    }
}

/* ================================================ */
function atribuirEventosPreCadastro() {
	$(".btn_confirm_cad").click(function() {
		var action = this.getAttribute("data-action");
		var cadastroId = this.getAttribute("data-action-for").substring(16);

		confirmPreCadastro(action, cadastroId);
	});
	$(".btn_reject_cad").click(function() {
		var action = this.getAttribute("data-action");
		var cadastroId = this.getAttribute("data-action-for").substring(16);

		confirmRejeitarCadastro(action,cadastroId);
	});

    $(".btn_request_cad").click(function() {
        var action = this.getAttribute("data-action");
        var cadastroId = this.getAttribute("data-action-for").substring(16);

        requestArquivoPesquisa(action,cadastroId);
    });
};