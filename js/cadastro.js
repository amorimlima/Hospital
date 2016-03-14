"use strict";

var tabs = $('.tab_cadastro');
var containers = $('.conteudo_tab');
var btns = $('.btns_tabs');

var delPerfilId = '0';
var blah;

$(document).ready(function() {
	
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
    
    $('.btn_tab').click(function() {
        $(this).siblings().removeClass('btn_tab_ativo');
        $(this).addClass('btn_tab_ativo');
        
        if ( $(this).hasClass('btn_aluno') ) {
            if ( $(this).hasClass('btn_add_cadastro') ) {
                $('.conteudo_aluno').find('.form_cadastro').show();
                $('.conteudo_aluno').find('.update_cadastro').hide()
            } else if ( $(this).hasClass('btn_update_cadastro') ) {
                $('.conteudo_aluno').find('.form_cadastro').hide();
                $('.conteudo_aluno').find('.update_cadastro').show()
            }
        } else if ( $(this).hasClass('btn_professor') ) {
            if ( $(this).hasClass('btn_add_cadastro') ) {
                $('.conteudo_professor').find('.form_cadastro').show();
                $('.conteudo_professor').find('.update_cadastro').hide()
            } else if ( $(this).hasClass('btn_update_cadastro') ) {
                $('.conteudo_professor').find('.form_cadastro').hide();
                $('.conteudo_professor').find('.update_cadastro').show()
            }
        } else if ( $(this).hasClass('btn_escola') ) {
            if ( $(this).hasClass('btn_add_cadastro') ) {
                $('.conteudo_escola').find('.confirm_cadastro').hide();
                $('.conteudo_escola').find('.form_cadastro').show();
                $('.conteudo_escola').find('.update_cadastro').hide();
            } else if ( $(this).hasClass('btn_update_cadastro') ) {
                $('.conteudo_escola').find('.confirm_cadastro').hide();
                $('.conteudo_escola').find('.form_cadastro').hide();
                $('.conteudo_escola').find('.update_cadastro').show();
            } else if ( $(this).hasClass('btn_confirm_cadastro') ) {
                $('.conteudo_escola').find('.confirm_cadastro').show();
                $('.conteudo_escola').find('.form_cadastro').hide();
                $('.conteudo_escola').find('.update_cadastro').hide();
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
    	var escolaGrupo = $("#selectProfessorAluno").val().split('_');
    	var escola = escolaGrupo[0];
    	var grupo = escolaGrupo[1];
    	
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

        $.ajax({
            url:'ajax/cadastroAjax.php',
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
        		'login':loginProfessor,
        		'escola':'',
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

    	$('.obrigatorioEscola').each(function(){
    		if ($(this).val() == '' || $(this).val() == null ){
    			$("#textoMensagemVazio").text($(this).attr('msgVazio'));
	        	$("#mensagemCampoVazio").show();
	        	$(this).focus();
	        	return false;
    		} 
    	})
    	
    	//Se a div de erro está visivel para aqui.
    	if ($("#mensagemCampoVazio").is(':visible')) return false;
    	
    	if (validaCNPJ($("#inputCnpjEscola").val()) == false){
    		$("#textoMensagemVazio").text('CNPJ inválido!');
    		$("#mensagemCampoVazio").show();
    		$("#inputCpfAluno").focus();
    		return false;
    	}
    	
    	if ($("#inputCepEscola").val().length < 10){
    		$("#textoMensagemVazio").text('CEP inválido!');
    		$("#mensagemCampoVazio").show();
    		$("#inputCepAluno").focus();
    		return false;
    	}
    	
    	if(validaEmail($("#inputEmailEscola").val()) == false){
    		$("#textoMensagemVazio").text('Email inválido!');
    		$("#mensagemCampoVazio").show();
    		$("#inputEmailAluno").focus();
    		return false;    		
    	}
    	
    	if ($('#inputSenhaEscola').val() != $('#inputSenhaConfirmEscola').val()){
			$("#textoMensagemVazio").text('Os campos senha e confirmação da senha devem ser iguais');
    		$("#mensagemCampoVazio").show();
    		$('#inputSenhaAluno').focus();
			return false;    		
    	}

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
    			'emailCoordenador':''
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
    
    
}); //Fim

function tabNavigation(tabToShow) {
	for ( var i = 0; i < tabs.length; i++ ) {
		if ( tabs[i] == tabToShow ) {
			$($(containers).get(i)).show();
			$($(btns).get(i)).show();

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
        url:'ajax/cadastroAjax.php',
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
        url:'ajax/cadastroAjax.php',
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
