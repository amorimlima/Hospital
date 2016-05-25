"use strict";
var tabs = $('.tab_cadastro, .tab_cadastro_professor');
var containers = $('.conteudo_tab');
var btns = $('.btns_tabs');
var primeiroAcesso = true;
var delPerfilId = '0';
var blah;
var perfisAlunosGerados = [];
var perfisProfessoresGerados = [];
var perfisEscolasGerados = [];

var mydate=new Date()
var ano = mydate.getYear()


$(document).ready(function() {
    $("[data-inputType='senha']").keyup(function() {
        var perfil = this.id.slice(10);
        verificarPadraoSenha(perfil);
    });

    $("[data-inputType='senha']").focus(function() {
        var perfil = this.id.slice(10);
        $("#regrasSenha"+perfil).fadeIn(200);
    });

    $("[data-inputType='senha']").blur(function() {
        var perfil = this.id.slice(10);
        $("#regrasSenha"+perfil).fadeOut(200);
    });
	
	$('#update_cadastro').trigger('click');
	
	$('.conteudo_tab').mCustomScrollbar({
		axis:"y",
		scrollButtons:{
			enable:true
		}
	});
    
    $(tabs).click(function() {
    	
    	tabNavigation(this);
    	
    	//Coloca automaticamente na página que lista os usuários de acordo com o clicado
    	var classe = $(this).attr('pagina');
        $('.'+classe+' .btn_update_cadastro').trigger( "click" );
        
        //Função só para gastar linhas e deixar mais complicado
        
        return false;
    });

    
    tabNavigation(tabs[0]);
    
    $('.data').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        language: "pt-BR",
        toggleActive: true
    });
    
    //Quando carrega a página lista somente os alunos.
    listarAlunos();
    //listarProfessores();
    //listarEscolas();
   
    $('.btn_tab').click(function() {

        $(this).siblings().removeClass('btn_tab_ativo');
        $(this).addClass('btn_tab_ativo');
        
        if ( $(this).hasClass('btn_aluno') ) {
            if ( $(this).hasClass('btn_add_cadastro') ) {
            	$('.conteudo_aluno').find('.form_cadastro').show();
                $('.conteudo_aluno').find('.update_cadastro').hide();
                $('#inputCpfAluno').removeAttr('readonly');
                $('#cadastroImagemUpload').appendTo("#spanImagemAluno");
            } else if ( $(this).hasClass('btn_update_cadastro') ) {
                $('.conteudo_aluno').find('.form_cadastro').hide();
                listarAlunos();
                $('.conteudo_aluno').find('.update_cadastro').show();
            }
        } else if ( $(this).hasClass('btn_professor') ) {
            if ( $(this).hasClass('btn_add_cadastro') ) {
                $('.conteudo_professor').find('.form_cadastro').show();
                $('.conteudo_professor').find('.update_cadastro').hide();
                $('#inputCpfProf').removeAttr('readonly');
                $('#cadastroImagemUpload').appendTo("#spanImagemProfessor");
                
            } else if ( $(this).hasClass('btn_update_cadastro') ) {
                $('.conteudo_professor').find('.form_cadastro').hide();
                $('.conteudo_professor').find('.update_cadastro').show()
                listarProfessores();
            }
        } else if ( $(this).hasClass('btn_escola') ) {
            if ( $(this).hasClass('btn_add_cadastro') ) {
                $('.conteudo_escola').find('.confirm_cadastro').hide();
                $('.conteudo_escola').find('.form_cadastro').show();
                $('.conteudo_escola').find('.update_cadastro').hide();
                $('#cadastroImagemUpload').appendTo("#spanImagemEscola");
                $('#inputCnpjEscola').removeAttr('readonly');
            } else if ( $(this).hasClass('btn_update_cadastro') ) {
                $('.conteudo_escola').find('.confirm_cadastro').hide();
                $('.conteudo_escola').find('.form_cadastro').hide();
                $('.conteudo_escola').find('.update_cadastro').show();
                listarEscolas();
            } else if ( $(this).hasClass('btn_confirm_cadastro') ) {
                $('.conteudo_escola').find('.confirm_cadastro').show();
                $('.conteudo_escola').find('.form_cadastro').hide();
                $('.conteudo_escola').find('.update_cadastro').hide();
            }
        }
    });
    
    $("#inserirNovaSerie").click(function() {expandSeriePeriodoProfessor(this);});

    //chama a função q carrega os estados no select
    listarEstadoCidade('inputEstadoAluno');
    $('#inputEstadoAluno').change(function(){
    	selectCidade('inputEstadoAluno','inputCidadeAluno');
    });
    listarEstadoCidade('inputEstadoProf');
    $('#inputEstadoProf').change(function(){
    	selectCidade('inputEstadoProf','inputCidadeProf');
    });
    listarEstadoCidade('inputEstadoEscola');
    $('#inputEstadoEscola').change(function(){
    	selectCidade('inputEstadoEscola','inputCidadeEscola');
    });
    
    
    $('.accordion_info').click(function() {
        $(this).toggleClass('accordion_expanded');
    });

    $("#cadastroAluno").click(function(){
    	
    	if ($('#idAluno').val() != ''){
    		$('#inputSenhaAluno').removeClass('obrigatorioAluno');
    		var acao = 'editarUsuario';
    	}else{
    		$('#inputSenhaAluno').addClass('obrigatorioAluno');
    		var acao = 'novoUsuario';
    	}
    	
    	$('.obrigatorioAluno').each(function(){
    		if ($(this).val() == '' || $(this).val() == null ){
    			if ($(this).attr('id') == 'inputTelResAluno' &&
                    $('#inputTelCelAluno').val() == '' && $('#inputTelComAluno').val() == ''){
    					$("#textoMensagemVazio").text('Pelo menos um número de telefone deve ser cadastrado');
    	        		$("#mensagemCampoVazio").show();
    	        		$(this).focus();
    					return false;
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
    	
    	if (validaData($("#inputNascimentoAluno").val()) == false){
	    	$("#textoMensagemVazio").text('Data de nascimento inválida!');
	    	$("#mensagemCampoVazio").show();
	    	$("#inputNascimentoAluno").focus();
	    	return false;
	    }
    	
    	if ($("#inputCpfAluno").val() != ''){ 
	    	if (validarCPF($("#inputCpfAluno").val()) == false){
		    	$("#textoMensagemVazio").text('CPF inválido!');
		    	$("#mensagemCampoVazio").show();
		    	$("#inputCpfAluno").focus();
		    	return false;
		    }
    	}
    	    	
    	if ($("#inputCepAluno").val().length < 10){
    		$("#textoMensagemVazio").text('CEP inválido!');
    		$("#mensagemCampoVazio").show();
    		$("#inputCepAluno").focus();
    		return false;
    	}
    	
    	if ($("#inputEmailAluno").val() != ''){
	    	if(validaEmail($("#inputEmailAluno").val()) == false){
	    		$("#textoMensagemVazio").text('Email inválido!');
	    		$("#mensagemCampoVazio").show();
	    		$("#inputEmailAluno").focus();
	    		return false;    		
	    	}
    	}
    	
    	//Senha pode vir vazia se for na edição.
    	if ($('#inputSenhaAluno').val() != ''){ 
	    	if ($('#inputSenhaAluno').val() != $('#inputSenhaConfirmAluno').val()){
				$("#textoMensagemVazio").text('Os campos senha e confirmação da senha devem ser iguais');
	    		$("#mensagemCampoVazio").show();
	    		$('#inputSenhaAluno').focus();
				return false;    		
	    	}else if (!validaSenha($('#inputSenhaAluno').val())){
	    		$("#textoMensagemVazio").text('Senha inválida');
	    		$("#mensagemCampoVazio").show();
	    		$('#inputSenhaAluno').focus();
	    		return false;
	    	}
            if (!$('#inputSenhaAluno').hasClass('obrigatorioAluno') &&
                (usuario.perfil == 1 && !senhaAtualCorreta($('#idAluno').val() , $('#inputSenhaAtual').val()))){
                $("#textoMensagemVazio").text('Senha atual incorreta');
                $("#mensagemCampoVazio").show();
                $('#inputSenhaAtual').focus();
                return false;
            }
    	}
    	
    	
    	//dados da tabela usuário
    	var nome = $("#inputNomeAluno").val();
    	var profGrupo = $("#selectProfessorAluno").val().split('_');
    	var professor = profGrupo[0];
    	var grupo = profGrupo[1];
    	    	
    	var escola = $("#selectEscolaAluno").val();
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
        var idUsuario = $("#idAluno").val();
        var idUsuarioVar = $("#idUsuarioVariavelAluno").val();
        var idEndereco = $("#idEnderecoAluno").val();

        $.ajax({
            url:'ajax/CadastroAjax.php',
            type:'post',
            dataType:'json',
            data: {
                'acao': acao,
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
                'senha':senha,
                'idUsuario':idUsuario,
                'idUsuarioVar':idUsuarioVar,
                'idEndereco':idEndereco
            },
            success:function(retorno){
        		if (retorno.erro == false) {
        			$("#mensagemSucessoCadastro").show();
        			$('.btns_aluno .btn_update_cadastro').trigger( "click" );
        		}
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

    $("#cadastroProf").click(function(){
    
    	if ($('#idProfessor').val() != ''){
    		$('#inputSenhaProf').removeClass('obrigatorioProf');
    		var acao = 'editarUsuario';
    	}else{
    		$('#inputSenhaProf').addClass('obrigatorioProf');
    		var acao = 'novoUsuario';
    	}
    	//$("#inputNascimentoProf").val('10/10/2010');
    	var seriesProfessor = '';
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
    	
    	
    	if (validaData($("#inputNascimentoProf").val()) == false){
	    	$("#textoMensagemVazio").text('Data de nascimento inválida!');
	    	$("#mensagemCampoVazio").show();
	    	$("#inputNascimentoAluno").focus();
	    	return false;
	    }
    	
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
    		$("#inputEmailProf").focus();
    		return false;    		
    	}
    	
   	
    	//Verifica se alguma série foi selecionada e concatena todas em uma variavel
    	var seriesProfessor = '';
    	var seriesExcluir = '';
    	var serieErro = '';

    	//Percorre os selects dos grupos para montar a string e verificar erro
    	// $("[data-grupoAttr='serie']").each(function() {
    	// 	if (($(this).val() != 0) && ($(this).val() != null)){

    	// 		var contador = $(this).attr('id').replace('inputSerieProf', '');
    	// 		//Verifica se o campo não está vazio ou se já tem um erro na série.
    	// 		if (($("#inputPeriodoProf"+contador).val() != '') && ($("#inputPeriodoProf"+contador).val() != null) && (serieErro == '')){
    	// 			//Só haverá o atributo idGrupo na edição.
    	// 			if ($(this).attr('idGrupo') != undefined){
    	// 				seriesProfessor += $(this).val()+'-'+$("#inputPeriodoProf"+contador).val()+'-'+$(this).attr('idGrupo')+';';
    	// 			}else{
    	// 				seriesProfessor += $(this).val()+'-'+$("#inputPeriodoProf"+contador).val()+';';
    	// 			}
    	//  		}else{
    	//  			serieErro = contador;
    	//  		}
    	// 	 }else{
    	// 		 //Só vai acontecer na edição
    	// 		 if ($(this).attr('idGrupo') != undefined){
    	// 			 //monta string 'idGrupo-;' para futura exclusão.
    	// 			 seriesExcluir += $(this).attr('idGrupo')+';';
    	// 		 }
    	// 	 }
    	// })
    	
    	//Se teve erro de alguma série ficar vazia.
    	if (serieErro != ''){
    		$("#textoMensagemVazio").text('Todos os grupos precisam ter série!');
    		$("#mensagemCampoVazio").show();
    		$("#inputPeriodoProf"+serieErro).focus();
    		return false;
    	}
    	//Se nenhum grupo foi criado
    	if (seriesProfessor == '' && acao != 'editarUsuario'){
    		$("#textoMensagemVazio").text('Selecione ao menos uma grupo!');
    		$("#mensagemCampoVazio").show();
    		$("#inputSerieProf1").focus();
    		return false;
    	}else{
    		seriesProfessor += seriesExcluir;
    	}
    	
    	//Senha pode vir vazia se for na edição.
    	if ($('#inputSenhaProf').val() != ''){ 
	    	if ($('#inputSenhaProf').val() != $('#inputSenhaConfirmProf').val()){
				$("#textoMensagemVazio").text('Os campos senha e confirmação da senha devem ser iguais');
	    		$("#mensagemCampoVazio").show();
	    		$('#inputSenhaProf').focus();
				return false;    		
	    	}else if (!validaSenha($('#inputSenhaProf').val())){
				$("#textoMensagemVazio").text('Senha inválida');
				$("#mensagemCampoVazio").show();
				$('#inputSenhaProf').focus();
				return false;
			}
            if (!$('#inputSenhaAluno').hasClass('obrigatorioProf') &&
                (usuario.perfil == 2 && !senhaAtualCorreta($('#idProfessor').val() , $('#inputSenhaAtualProf').val()))){
                $("#textoMensagemVazio").text('Senha atual incorreta');
                $("#mensagemCampoVazio").show();
                $('#inputSenhaAtual').focus();
                return false;
            }
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
    	//var serie = 'null';
    	var imagem = $("#imagem").val();
    	var perfil = $("#perfil").val();
    	
    	var idUsuario = $("#idProfessor").val();
    	var idGrupo = $("#idGrupoProfessor").val();
    	var idUsuarioVar = $("#idUsuarioVariavelProfessor").val();
    	var idEndereco = $("#idEnderecoProfessor").val();
    	
    	
    	$.ajax({
        	url:'ajax/CadastroAjax.php',
        	type:'post',
        	dataType:'json',
        	data:{'acao':acao,
    			'perfil': perfil,
        		'nome':nomeProfessor,
        		'nascimento':dataNascimentoProfessor,
        		'rg':rgProfessor,
        		'cpf':cpfProfessor,
        		'ano':'null',
        		'turma':'null',
        		'grupo':'null',
        		'serie': seriesProfessor,
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
        		'senha':senhaProfessor,
        		'idUsuario': idUsuario,
        		'idGrupo': idGrupo,
        		'idUsuarioVar': idUsuarioVar,
        		'idEndereco': idEndereco
    		},
        	success:function(retorno){
        		if (retorno.erro == false) {
        			$("#mensagemSucessoCadastro").show();
        			$('.btns_professor .btn_update_cadastro').trigger( "click" );
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
    	
    	if ($('#idEscola').val() != ''){
    		$('#inputSenhaEscola').removeClass('obrigatorioEscola');
    		var acao = 'editarEscola';
    	}else{
    		$('#inputSenhaEscola').addClass('obrigatorioEscola');
    		var acao = 'cadastraEscola';
    	}
    		
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
    		$("#inputEmailEscola").focus();
    		return false;    		
    	}

    	//Senha pode vir vazia se for na edição.
    	if ($('#inputSenhaEscola').val() != ''){ 
	    	if ($('#inputSenhaEscola').val() != $('#inputSenhaConfirmEscola').val()){
				$("#textoMensagemVazio").text('Os campos senha e confirmação da senha devem ser iguais');
	    		$("#mensagemCampoVazio").show();
	    		$('#inputSenhaEscola').focus();
				return false;    		
	    	}else if (!validaSenha($('#inputSenhaEscola').val())){
	    		$("#textoMensagemVazio").text('Senha inválida');
	    		$("#mensagemCampoVazio").show();
	    		$('#inputSenhaEscola').focus();
	    		return false;
	    	}
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
    	//var emailEscola2 = $("#inputEmailEscolaAntigo").val();
    	var loginEscola = $("#inputUsuarioEscola").val();
    	//var loginEscola2 = $("#inputUsuarioEscolaAntigo").val();
    	var senhaEscola = $("#inputSenhaEscola").val();
    	var imagem = $("#imagem").val();
    	
    	var idEscola = $("#idEscola").val();
    	var idEndereco = $("#idEnderecoEscola").val();
    	var idUsuario = $("#idUsuarioEscola").val();
    	
    	$.ajax({
    		url:'ajax/CadastroAjax.php',
    		type:'post',
    		dataType:'json',
    		data:{
    			'acao': acao,
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
    			'imagem':imagem,
    			'idEscola':idEscola,
    			'idEndereco':idEndereco,
    			'idUsuario':idUsuario
    		},
    		success:function(retorno){
    			if (retorno.erro == false) {
    				if (acao =='cadastraEscola'){
    					$("#mensagemSucessoCadastro").show();
    					$('.btns_escola .btn_update_cadastro').trigger( "click" );
    				}
    				else $("#mensagemSucessoEdicao").show();
    				
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
	
	
	$("body").delegate(".btnUpdateCadAluno", "click", function (){
		var idUsuario = $(this).attr('idUsuario');

		$('#idAluno').val(idUsuario);
		$('#idEnderecoAluno').val($(this).attr('idEndereco'));
		$('#idUsuarioVariavelAluno').val($(this).attr('idUsuarioVar'));
		$('#selectEscolaAluno').val($('#escola'+idUsuario).attr('idEscola'));
		$('#selectSerieAluno').val($('#serie'+idUsuario).val());
		
		var idProfessor = $('#professor'+idUsuario).attr('idProfessor');
		var idGrupo = $('#grupo'+idUsuario).val();
		listaProfessores(idProfessor+'_'+idGrupo);
		
		$('#selectAnoAluno').val($('#ano'+idUsuario).val());
		$('#inputNomeAluno').val($('#updateAlunoInfo'+idUsuario).text());
		$('#inputNascimentoAluno').val($('#nascimento'+idUsuario).text());
		$('#inputRgAluno').val($('#rg'+idUsuario).text());
		$('#inputCpfAluno').val($('#cpf'+idUsuario).text());
		
		if ($('#inputCpfAluno').val() != '') $('#inputCpfAluno').attr('readonly', 'readonly');
			else $('#inputCpfAluno').removeAttr('readonly');
		
		$('#inputRuaAluno').val($('#rua'+idUsuario).val());
		$('#inputNumCasaAluno').val($('#numero'+idUsuario).val());
		$('#inputCompCasaAluno').val($('#complemento'+idUsuario).val());
		$('#inputCepAluno').val($('#cep'+idUsuario).val());
		$('#inputBairroAluno').val($('#bairro'+idUsuario).val());
		$('#inputEstadoAluno').val($('#estado'+idUsuario).val());
		selectCidade('inputEstadoAluno','inputCidadeAluno')
		$('#inputCidadeAluno').val($('#cidade'+idUsuario).val());
		$('#inputTelResAluno').val($('#telResidencial'+idUsuario).val());
		$('#inputTelCelAluno').val($('#telCelular'+idUsuario).val());
		$('#inputTelComAluno').val($('#telComercial'+idUsuario).val());
		$('#inputEmailAluno').val($('#email'+idUsuario).text());
	    $('#inputUsuarioAluno').val($('#usuario'+idUsuario).text());
	    $('#inputSenhaAluno').val('');
	    $('#inputSenhaConfirmAluno').val('');
		
		if ($('#imagem'+idUsuario).val() != '')	mostrarInputArquivo($('#imagem'+idUsuario).val(), 'imgp/'+$('#imagem'+idUsuario).val());
			else limparInputArquivo();	    
		
		$('.conteudo_aluno').find('.form_cadastro').show();
		$('.conteudo_aluno').find('.update_cadastro').hide();
		$('#cadastroImagemUpload').appendTo("#spanImagemAluno");

        //Esconder e Bloquear Campos
        $("#dados_escolares select").attr("disabled", "true");
        $("#inputNascimentoAluno").attr("disabled", "true");
        $("#inputRgAluno").attr("disabled", "true");
        $("#inputCpfAluno").attr("disabled", "true");
        if (usuario.perfil == 1){
            $("#inputUsuarioAluno").parent().parent().hide();
            $("#inputSenhaAtual").parent().parent().show();
        }
        else
            $("#inputUsuarioAluno").attr("disabled", "true");
        $("label[for=inputSenhaAluno] .asterisco").remove();
        $("label[for=inputSenhaConfirmAluno] .asterisco").remove();
        $("#resetarAluno").hide();
        
		
		return false;
	})

	$("body").delegate(".btnUpdateCadProf", "click", function (){
		var idUsuario = $(this).attr('idUsuario');
		
		$('#idGrupoProfessor').val($(this).attr('idGrupo'));
		$('#idEnderecoProfessor').val($(this).attr('idEndereco'));
		$('#idProfessor').val(idUsuario);
		$('#idUsuarioVariavelProfessor').val($(this).attr('idUsuarioVar'));
		
		$('.divSerie').remove();
		$('.divPeriodo').remove();

		$.ajax({
	        url:'ajax/CadastroAjax.php',
	        type:'post',
	        dataType:'json',
	        data: {
	            'acao': 'BuscaGruposByIdProfessor',
	            'idProfessor': idUsuario
	        },
	        success:function(data){
	        	
	        	//Faz o for varrendo os resultados e criando o html. No primeiro coloca n campo fixo.
	        	for (var i=0; i< data.length; i++){
	    				//console.log(data[i]);
	        			var fieldCount = i + 1;
	        			
	    				if (i > 0){

	    					var idperiodoSelect = "#inputPeriodoProf"+fieldCount;
	    				    var idserieSelect   = "#inputSerieProf"+fieldCount;
	    				    var htmlSeries      = "";
	    				    var htmlPeriod      = "";

	    				    htmlSeries += '<div class="form_celula_p divSerie" style="height: 0;">';
	    				    htmlSeries +=     '<label for="" class="form_info info_p">Série<span class="asterisco">*</span></label>';
	    				    htmlSeries +=     '<span class="select_container">';												//ATENÇÃO: Não colocar classe obrigatorioProf nesse select. A verificação dele é feita de outra maneira							
	    				    htmlSeries +=         '<select name="" id="inputSerieProf'+fieldCount+'" data-grupoAttr="serie" name="grp_serie" class="form_value form_select value_p formProf " required msgVazio="O campo série é obrigatório">';
	    				    htmlSeries +=             '<option value="" disabled hidden selected style="font-style: italic;">Carregando...</option>';
	    				    htmlSeries +=         '</select>';
	    				    htmlSeries +=     '</span>';
	    				    htmlSeries += '</div>';

	    				    htmlPeriod += '<div class="form_celula_p divPeriodo" style="height: 0;">';
	    				    htmlPeriod +=     '<label for="" class="form_info info_p">Período<span class="asterisco">*</span></label>';
	    				    htmlPeriod +=     '<span class="select_container">';												//ATENÇÃO: Não colocar classe obrigatorioProf nesse select. A verificação dele é feita de outra maneira
	    				    htmlPeriod +=         '<select name="" id="inputPeriodoProf'+fieldCount+'" data-grupoAttr="periodo" name="grp_periodo" class="form_value form_select value_p formProf" required msgVazio="O campo período é obrigatório">';
	    				    htmlPeriod +=             '<option value="" disabled hidden selected style="font-style: italic;">Carregando...</option>';
	    				    htmlPeriod +=         '</select>';
	    				    htmlPeriod +=     '</span>';
	    				    htmlPeriod += '</div>';

	    				    $(htmlSeries+htmlPeriod).insertBefore("#acaoNovaSerieContainer");
	    				    $(idperiodoSelect).parent().parent().animate({height: "40px"}, 200);
	    				    $(idserieSelect).parent().parent().animate({height: "40px"}, 200);

	    				    getSeries(idserieSelect,idperiodoSelect,data[i].idSerie);
	    				    getPeriodos(idserieSelect, idperiodoSelect,data[i].idPeriodo);

	    					$('#inputSerieProf'+fieldCount).attr('idGrupo',data[i].idGrupo);
	    				}else{
		    				$('#inputSerieProf'+fieldCount).val(data[i].idSerie);
	    					$('#inputSerieProf'+fieldCount).attr('idGrupo',data[i].idGrupo);
	    					$('#inputPeriodoProf'+fieldCount).val(data[i].idPeriodo);
	    				}
				
	        }
	        },
	    });
		
		$('#inputNomeProf').val($('#updateProfInfo'+idUsuario).text());
		//$('#selectSerieProf').val($('#serie'+idUsuario).val());
		$('#selectCategoriaProf').val($('#categoria'+idUsuario).attr('idCategoria'));
		$('#selectGrauProf').val($('#instrucao'+idUsuario).attr('idInstrucao'));
		$('#perfil').val($('#perfil'+idUsuario).val());
		$('#inputNascimentoProf').val($('#dataNasc'+idUsuario).text());
		$('#inputRgProf').val($('#rg'+idUsuario).text());
		$('#inputCpfProf').val($('#cpf'+idUsuario).text());
		if ($('#inputCpfProf').val() != '') $('#inputCpfProf').attr('readonly', 'readonly');
			else $('#inputCpfProf').removeAttr('readonly');
		$('#inputRuaProf').val($('#rua'+idUsuario).val());
		$('#inputNumCasaProf').val($('#numero'+idUsuario).val());
		$('#inputCompCasaProf').val($('#complemento'+idUsuario).val());
		$('#inputCepProf').val($('#cep'+idUsuario).val());
		$('#inputBairroProf').val($('#bairro'+idUsuario).val());
		$('#inputTelResProf').val($('#telResidencial'+idUsuario).val());
		$('#inputTelCelProf').val($('#telCelular'+idUsuario).val());
		$('#inputTelComProf').val($('#telComercial'+idUsuario).val());
		$('#inputEstadoProf').val($('#estado'+idUsuario).val());
		selectCidade('inputEstadoProf','inputCidadeProf')
		$('#inputCidadeProf').val($('#cidade'+idUsuario).val());
		$('#inputEmailProf').val($('#email'+idUsuario).text());
	    $('#inputUsuarioProf').val($('#usuario'+idUsuario).text());
	    $('#inputSenhaProf').val('');
	    $('#inputSenhaConfirmProf').val('');
	    
		if ($('#imagem'+idUsuario).val() != '')	mostrarInputArquivo($('#imagem'+idUsuario).val(), 'imgp/'+$('#imagem'+idUsuario).val());
			else limparInputArquivo();	    
		
		$('.conteudo_professor').find('.form_cadastro').show();
        $('.conteudo_professor').find('.update_cadastro').hide();
        $('#cadastroImagemUpload').appendTo("#spanImagemProfessor");

        //Bloqueio de campos        
        $('#inputNascimentoProf').attr("disabled", "true");
        $('#inputRgProf').attr("disabled", "true");
        $('#inputCpfProf').attr("disabled", "true");
        $("#inputUsuarioProf").attr("disabled", "true");
        if (usuario.perfil == 2){
            $('#perfil').attr("disabled", "true");
            $("#inputUsuarioProf").parent().parent().hide();
            $("#inputSenhaAtualProf").parent().parent().show();
        }
        else
            $("#inputUsuarioProf").attr("disabled", "true");
        $("label[for=inputSenhaProf] .asterisco").remove();
        $("label[for=inputSenhaConfirmProf] .asterisco").remove();
        $('#divisao_grupo').hide();
        $("#resetarProf").hide();
        
		
		return false;
	})
	
	
	$("body").delegate(".btnUpdateCadEscola", "click", function (){
		var idUsuario = $(this).attr('idUsuario');

		$('#idEscola').val($(this).attr('idEscola'));
		$('#idEnderecoEscola').val($(this).attr('idEndereco'));
		$('#idUsuarioEscola').val(idUsuario);
		
		$('#inputNomeEscola').val($('#updateEscInfo'+idUsuario).text());
		$('#inputRazaoEscola').val($('#razao'+idUsuario).text());
		$('#inputNseEscola').val($('#nse'+idUsuario).val());
		$('#inputCodigoEscola').val($('#codigo'+idUsuario).val());
		$('#inputCnpjEscola').val($('#cnpj'+idUsuario).text());
		$('#inputCnpjEscola').attr('readonly', 'readonly');
		$('#inputAdmEscola').val($('#adm'+idUsuario).attr('idAdm'));
		$('#inputTipoEscola').val($('#tipo'+idUsuario).attr('idTipo'));
		$('#inputRuaEscola').val($('#rua'+idUsuario).val());
		$('#inputBairroEscola').val($('#bairro'+idUsuario).val());
		$('#inputNumCasaEscola').val($('#numero'+idUsuario).val());
		$('#inputCompCasaEscola').val($('#complemento'+idUsuario).val());
		$('#inputEstadoEscola').val($('#estado'+idUsuario).val());
		selectCidade('inputEstadoEscola','inputCidadeEscola')
		$('#inputCidadeEscola').val($('#cidade'+idUsuario).val());
		$('#inputCepEscola').val($('#cep'+idUsuario).val());
		$('#inputTelefoneEscola').val($('#telefone'+idUsuario).text());
		$('#inputEmailEscola').val($('#email'+idUsuario).text());
		$('#inputEmailEscolaAntigo').val($('#email'+idUsuario).text());
		$('#inputUsuarioEscola').val($('#usuario'+idUsuario).text());
		$('#inputUsuarioEscolaAntigo').val($('#usuario'+idUsuario).text());
		$('#inputSenhaEscola').val('');
	    $('#inputSenhaConfirmEscola').val('');
		
		if ($('#imagem'+idUsuario).val() != '')	mostrarInputArquivo($('#imagem'+idUsuario).val(), 'imgp/'+$('#imagem'+idUsuario).val());
			else limparInputArquivo();
				
		//aparece a página de cadastro de escolas com os dados da escola a ser editada.
		$('.conteudo_escola').find('.confirm_cadastro').hide();
        $('.conteudo_escola').find('.form_cadastro').show();
        $('.conteudo_escola').find('.update_cadastro').hide();
		return false;
	})
	
	$('body').delegate('.btnDelCadAluno, .btnDelCadProf, .btnDelCadEscola','click', function(){
		//alert(Excluir);
		var idVar = $(this).attr('idUsuarioVariavel');
		var idUsuario = $(this).attr('idUsuario');
		console.log('............');
		console.log(idVar);
		console.log(idUsuario);
//		return false;
		$.ajax({
	        url:'ajax/CadastroAjax.php',
	        type:'post',
	        dataType:'json',
	        data: {
	            'acao': 'excluirUsuario',
	            'idUsuarioVar': idVar
	        },
	        success:function(retorno){
	        	if (retorno.erro == false){
	        		$(".updateUsuarioInfo"+idUsuario).trigger('click');
		        	$(".updateUsuarioInfo"+idUsuario).hide();
	        	}else{
	        		$("#textoMensagemVazio").text(retorno.mensagem);
			    	$("#mensagemCampoVazio").show();
	        	}
	        },
	        error:function(retorno){
	        	$("#textoMensagemVazio").text('Erro ao excluir!!');
		    	$("#mensagemCampoVazio").show();
	        }
	    });
		return false;
	})

    $("#voltarAluno").click(function() {
        $('.conteudo_aluno').find('.form_cadastro').hide();
        $('.conteudo_aluno').find('.update_cadastro').show();
    });

    $("#voltarProf").click(function() {
        $('.conteudo_professor').find('.form_cadastro').hide();
        $('.conteudo_professor').find('.update_cadastro').show();
    });

    listarEscolasPreCadastradas();

}); //Fim

function senhaAtualCorreta (idUsuario, senha) {
    var r;
    $.ajax({
        url: "ajax/UsuarioAjax.php",
        type: "GET",
        data: { 'acao'      : 'verificaSenha',
                'senha'     : senha,
                'usuario'   : idUsuario},
        async: false,
        success: function(d) {
            if (d.trim())
                r = true;
            else
                r = false;
        }
    });

    return r;
}

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

//function confirmDelPerfil() {
//    for ( var a in perfisAlunosGerados ) {
//        if ( perfisAlunosGerados[a].id == delPerfilId ) {
//            perfisAlunosGerados[a].deletar();
//            break;
//        }
//    }
//}

function formatar(mascara, documento){
    var i = documento.value.length;
    var saida = mascara.substring(0,1);
    var texto = mascara.substring(i)
    
    if (texto.substring(0,1) != saida){
       documento.value += texto.substring(0,1);
    }
  	  
  }

function listaProfessores(id){

	if ($('#selectEscolaAluno').val() == null || $('#selectSerieAluno').val() == null){
		$('#selectProfessorAluno').html('<option value="" disabled selected>Selecione primeiro a série</option>');
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
        	if (id != '') $('#selectProfessorAluno').val(id);
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

function mostrarInputArquivo(nomeImagem, caminho){
	$("#imgUp").show();
	$("#cadastroImagem form").hide();
	$("#cadastroImagem").hide();
	$("#imgUp img").attr('src',caminho)
	$("#imagem").val(nomeImagem);
	return false;
}

//Classe Perfil Aluno
function PerfilAluno(aluno) {
	self = this;
    this.id = aluno.idUsuario;
    this.nome = aluno.nomeUsuario;
    this.idEscola = aluno.idEscola;
    this.escola = aluno.nomeEscola;
    this.idProfessor = aluno.idProfessor;
    this.professor = aluno.nomeProfessor;
    this.idGrupo = aluno.idGrupo;
    this.sala = aluno.grupo;
    this.nascimento = aluno.dataNascBR;
    this.rg = aluno.rg;
    this.cpf = aluno.cpf;
    this.idEndereco = aluno.idEndereco;
    this.rua = aluno.logradouro;
    this.num = aluno.numero;
    this.complemento = aluno.complemento;
    this.cep = aluno.cep;
    this.bairro = aluno.bairro;
    this.estado = aluno.uf;
    this.pais = 'Brasil';
    this.cidade = aluno.cidade;
    this.telResidencial = aluno.telResidencial;
    this.telCelular = aluno.telCelular;
    this.telComercial = aluno.telComercial;
    this.email = aluno.email;
    this.usuario = aluno.login;
    this.imagem = aluno.imagem;
    this.idUsuarioVar = aluno.idUsuarioVar;
    this.idSerie = aluno.idSerie;
    this.idAno = aluno.idAno;
    
    this.gerarHTML = function () {
        var html = '';
        var telefones = '';
        
        if (this.telResidencial != '') telefones = this.telResidencial;
        if (this.telCelular != ''){
        	if (telefones != '') telefones += ' / '+this.telCelular;
        	else telefones = this.telCelular;
        }
        if (this.telComercial != ''){
        	if (telefones != '') telefones += ' / '+this.telComercial;
        	else telefones = this.telComercial;
        }
        
        var collapseContent = usuario.perfil == "1"? '' : 'data-toggle="collapse"';
        var collapse = usuario.perfil == "1"? '' : 'collapse';

        html +=
        '<a href="#updateAlunoCont'+this.id+'" class="accordion_info_toggler updateAlunoToggler " '+collapseContent+'>'+
            '<div class="accordion_info updateUsuarioInfo'+this.id+'" id="updateAlunoInfo'+this.id+'">'+this.nome+'</div>'+
        '</a>'+
        '<div class="accordion_content '+collapse+'" id="updateAlunoCont'+this.id+'">'+
            '<div class="content_col_info">';

        html +=
        	
	    		'<input type="hidden" value="'+this.idSerie+'" id="serie'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.idGrupo+'" id="grupo'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.idAno+'" id="ano'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.rua+'" id="rua'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.num+'" id="numero'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.complemento+'" id="complemento'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.cep+'" id="cep'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.bairro+'" id="bairro'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.telResidencial+'" id="telResidencial'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.telCelular+'" id="telCelular'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.telComercial+'" id="telComercial'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.estado+'" id="estado'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.cidade+'" id="cidade'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.imagem+'" id="imagem'+this.id+'"/>'+
	    		
                '<table border="0">'+
                    '<tr class="content_info_row">'+
                         '<td colspan="6"><span class="content_info_label">Escola:</span> <span id="escola'+this.id+'" idEscola="'+this.idEscola+'" class="content_info_txt">'+this.escola+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="3"><span class="content_info_label">Professor:</span> <span id="professor'+this.id+'" idProfessor="'+this.idProfessor+'" class="content_info_txt">'+this.professor+'</span></td>'+
                        '<td colspan="3"><span class="content_info_label">Sala:</span> <span id="grupo'+this.id+'" idGrupo="'+this.idGrupo+'" class="content_info_txt">'+this.sala+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="2"><span class="content_info_label">Nascimento:</span> <span id="nascimento'+this.id+'" class="content_info_txt">'+this.nascimento+'</span></td>'+
                        '<td colspan="2"><span class="content_info_label">RG:</span> <span id="rg'+this.id+'" class="content_info_txt">'+this.rg+'</span></td>'+
                        '<td colspan="2"><span class="content_info_label">CPF:</span> <span id="cpf'+this.id+'" class="content_info_txt">'+this.cpf+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="6">'+
                            '<span class="content_info_label">Endereço:</span> '+
                            '<span class="content_info_txt">'+
                                (this.rua != '' ? this.rua+', '+this.num+(this.complemento != '' && this.complemento != undefined ? ', '+this.complemento : '')+' - '+this.bairro+' - '+this.cidade+' - '+this.estado:'')+'. CEP: '+this.cep+
                            '</span>'+
                        '</td>'+
                        //'<td><span class="content_info_label">CEP:</span> <span class="content_info_txt">'+this.cep+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="6"><span class="content_info_label">Tel.:</span> <span class="content_info_txt">'+telefones+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="2"><span class="content_info_label">Usuário:</span> <span id="usuario'+this.id+'" class="content_info_txt">'+this.usuario+'</span></td>'+
                        '<td colspan="4"><span class="content_info_label">E-mail:</span> <span id="email'+this.id+'" class="content_info_txt">'+this.email+'</span></td>'+
                    '</tr>'+
                '</table>';
        
        if (this.imagem != ''){
        	var img = '<div><img src="imgm/'+this.imagem+'"/></div><br/>';
        	var posicao = 'style="position: relative"';
        }
        else {
        	var img = '';
        	var posicao = '';
        }
        
        html +=
            '</div>'+
            '<div class="content_col_btns" '+posicao+'>'+
            	img;
                if (usuario.perfil != "1")
                    html += '<button id="btnDelAluno'+this.id+'" idUsuarioVariavel="'+this.idUsuarioVar+'" idUsuario="'+this.id+'" class="section_btn btn_del_cad btnDelCadAluno">Excluir cadastro</button>';
        html += '<button id="btnUpdateAluno'+this.id+'" class="section_btn btn_update_cad btnUpdateCadAluno"  idUsuario="'+this.id+'" idUsuarioVar="'+this.idUsuarioVar+'" idEndereco="'+this.idEndereco+'">Alterar Dados</button>'+
            '</div>'+
        '</div>';
        
        return html;
    }
      
    this.deletar = function() {
        $('#updateAlunoInfo'+this.id).parent('a').remove();
        $('#updateAlunoCont'+this.id).remove();
    }
}

//Classe Perfil Professor
function PerfilProfessor(professor) {
    self = this;

    //console.log(professor.serie);
    this.id = professor.idUsuario;
    this.nome = professor.nomeUsuario;
    this.nascimento = professor.dataNascimento;
    this.nascimentoBr = professor.dataNascBR;
    this.rg = professor.rg;
    this.cpf = professor.cpf;
    this.idEndereco = professor.idEndereco;
    this.rua = professor.logradouro;
    this.numero = professor.numero;
    this.complemento = professor.complemento;
    this.cep = professor.cep;
    this.bairro = professor.bairro;
    this.estado = professor.uf;
    this.cidade = professor.cidade;
    this.telResidencial = professor.telResidencial;
    this.telComercial = professor.telComercial;
    this.telCelular = professor.telCelular;
    this.email = professor.email;
    this.escola = professor.idEscola;
    this.nomeEscola = professor.nomeEscola;
    this.idSala = professor.idGrupo;
    this.sala = professor.grupo;
    this.usuario = professor.login;
    this.imagem = professor.imagem;
    this.idCategoria = professor.idCatFuncional;
    this.categoria = professor.categoria;
    this.idInstrucao = professor.idInstrucao;
    this.instrucao = professor.instrucao;
    this.idUsuarioVar = professor.idUsuarioVar;
    this.serie = professor.serie;
    this.idPerfil = professor.idPerfil;
    this.imagem = professor.imagem;
    this.idEscola = professor.idEscola;
    this.perfil = professor.idPerfil;
    
    this.gerarHTML = function () {
        var html = '';
        
        var telefones = '';
        
        if (this.telResidencial != '') telefones = this.telResidencial;
        if (this.telCelular != ''){
        	if (telefones != '') telefones += ' / '+this.telCelular;
        	else telefones = this.telCelular;
        }
        if (this.telComercial != ''){
        	if (telefones != '') telefones += ' / '+this.telComercial;
        	else telefones = this.telComercial;
        }

        var collapseContent = usuario.perfil == "2"? '' : 'data-toggle="collapse"';
        var collapse = usuario.perfil == "2"? '' : 'collapse';
        
        html +=
        '<a href="#updateProfCont'+this.id+'" class="accordion_info_toggler updateProfToggler" '+collapseContent+'>'+
            '<div class="accordion_info updateUsuarioInfo'+this.id+'" id="updateProfInfo'+this.id+'">'+this.nome+'</div>'+
        '</a>'+
        '<div class="accordion_content '+collapse+'" id="updateProfCont'+this.id+'">'+
            '<div class="content_col_info">';
            
        html +=
        	
	        	'<input type="hidden" value="'+this.serie+'" id="serie'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.idGrupo+'" id="grupo'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.idAno+'" id="ano'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.rua+'" id="rua'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.numero+'" id="numero'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.complemento+'" id="complemento'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.cep+'" id="cep'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.bairro+'" id="bairro'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.telResidencial+'" id="telResidencial'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.telCelular+'" id="telCelular'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.telComercial+'" id="telComercial'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.estado+'" id="estado'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.cidade+'" id="cidade'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.imagem+'" id="imagem'+this.id+'"/>'+
	    		'<input type="hidden" value="'+this.perfil+'" id="perfil'+this.id+'"/>'+
	    		
                '<table border="0">'+
                	'<tr class="content_info_row">'+
		                '<td colspan="4"><span class="content_info_label">Escola: </span><span id="nomeEscola'+this.id+'" class="content_info_txt">'+ this.nomeEscola +'</span></td>'+
		            '</tr>'+
		            //'<tr class="content_info_row">'+
		            //    '<td colspan="3"><span class="content_info_label">Categoria Funcional: </span><span id="categoria'+this.id+'" idCategoria="'+this.idCategoria+'" class="content_info_txt">'+ this.categoria +'</span></td>'+
		            //    '<td colspan="3"><span class="content_info_label">Grau Instrução: </span><span id="instrucao'+this.id+'" idInstrucao="'+this.idInstrucao+'" class="content_info_txt">'+this.instrucao + '</span></td>'+
		            //'</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="2"><span class="content_info_label">Nascimento:</span> <span id="dataNasc'+this.id+'" class="content_info_txt">'+this.nascimentoBr+'</span></td>'+
                        '<td colspan="2"><span class="content_info_label">RG:</span> <span id="rg'+this.id+'" class="content_info_txt">'+this.rg+'</span></td>'+
                        '<td colspan="2"><span class="content_info_label">CPF:</span> <span id="cpf'+this.id+'" class="content_info_txt">'+this.cpf+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="6"><span class="content_info_label">Endereço:</span> <span class="content_info_txt">'+
                            this.rua + ', ' + this.numero + (this.complemento != '' ? ', '+this.complemento : '') + ' - ' + this.bairro + ' - ' + this.cidade + ', ' + this.estado +'. CEP: '+this.cep+
                        '</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="6"><span class="content_info_label">Tel.:</span> <span class="content_info_txt">'+telefones+'</span></td>'+
                    '</tr>'+
                    
                    '<tr class="content_info_row">'+
                        '<td colspan="3"><span class="content_info_label">Usuário</span> <span id="usuario'+this.id+'" class="content_info_txt">'+this.usuario+'</span></td>'+
                        '<td colspan="3"><span class="content_info_label">E-mail:</span> <span id="email'+this.id+'" class="content_info_txt">'+this.email+'</span></td>'+
                    '</tr>'+
                '</table>';
        
        if (this.imagem != ''){
        	var img = '<div><img src="imgm/'+this.imagem+'"/></div><br/>';
        	var posicao = 'style="position: relative"';
        }
        else {
        	var img = '';
        	var posicao = '';
        }
        
        html +=
            '</div>'+
            '<div class="content_col_btns" '+posicao+'>'+
            	img;
                if (usuario.perfil != "2")
                    html += '<button id="btnDelProf'+this.id+'" idUsuarioVariavel="'+this.idUsuarioVar+'" idUsuario="'+this.id+'" class="section_btn btn_del_cad btnDelCadProf">Excluir cadastro</button>';
                html += '<button id="btnUpdateProf'+this.id+'" class="section_btn btn_update_cad btnUpdateCadProf" idUsuario="'+this.id+'" idEndereco="'+this.idEndereco+'" idUsuarioVar="'+this.idUsuarioVar+'" idGrupo="'+this.idSala+'">Alterar Dados</button>'+
            '</div>'+
        '</div>';
    
        return html;
    }

}

function PerfilEscola(escola) {
	
    self = this;

    this.id = escola.idUsuario;
    this.idEndereco = escola.idEndereco;
    this.idEscola = escola.idEscola;
    this.codigo = escola.codigo; 
    this.nome = escola.nomeEscola;
    this.razao = escola.razaoEscola;
    this.cnpj = escola.cnpj;
    this.nse = escola.nse;
    this.adm = escola.administracao;
    this.tipoEscola = escola.tipoEscola;
    this.rua = escola.logradouro;
    this.numero = escola.numero;
    this.complemento = escola.complemento;
    this.cep = escola.cep;
    this.bairro = escola.bairro;
    this.pais = 'Brasil';
    this.estado = escola.uf;
    this.cidade = escola.cidade;
    this.telefone = escola.telResidencial;
    this.email = escola.email;
    this.nomeDiretor = escola.nomeDiretor;
    this.emailDiretor = escola.emailDiretor;
    this.nomeCoord = escola.nomeCoord;
    this.emailCoord = escola.emailCoord;
    this.usuario = escola.login;
    this.site = escola.site;
    this.status = escola.status;
    this.idAdm = escola.idAdm;
    this.idTipoEscola = escola.idTipoEscola;
    this.imagem = escola.imagem; 
    this.idUsuarioVar = escola.idUsuarioVar;
    
    this.gerarHTML = function () {
        var html = '';
        
        if (this.status == 0) status = 'Desativado'
        else if (this.status == 1) status = 'Ativado'
        else if (this.status == 2) status = 'Rejeitado'
        else status = '';

        var collapseContent = usuario.perfil == "4"? '' : 'data-toggle="collapse"';
        var collapse = usuario.perfil == "4"? '' : 'collapse';
        
        html +=
        '<a href="#updateEscCont'+this.id+'" class="accordion_info_toggler updateEscToggler" '+collapseContent+'>'+
            '<div class="accordion_info updateUsuarioInfo'+this.id+'" id="updateEscInfo'+this.id+'">'+this.nome+'</div>'+
        '</a>'+
        '<div class="accordion_content '+collapse+'" id="updateEscCont'+this.id+'">'+
            '<div class="content_col_info">';
            
        html +=
       		
        		//Campos hiddens de dados
        		'<input type="hidden" value="'+this.nse+'" id="nse'+this.id+'"/>'+	
        		'<input type="hidden" value="'+this.codigo+'" id="codigo'+this.id+'"/>'+
        		'<input type="hidden" value="'+this.rua+'" id="rua'+this.id+'"/>'+
        		'<input type="hidden" value="'+this.bairro+'" id="bairro'+this.id+'"/>'+
        		'<input type="hidden" value="'+this.numero+'" id="numero'+this.id+'"/>'+
        		'<input type="hidden" value="'+this.complemento+'" id="complemento'+this.id+'"/>'+
        		'<input type="hidden" value="'+this.estado+'" id="estado'+this.id+'"/>'+
        		'<input type="hidden" value="'+this.cidade+'" id="cidade'+this.id+'"/>'+
        		'<input type="hidden" value="'+this.cep+'" id="cep'+this.id+'"/>'+
        		'<input type="hidden" value="'+this.imagem+'" id="imagem'+this.id+'"/>'+

                '<table border="0">'+
                	'<tr class="content_info_row">'+
		                '<td colspan="6"><span class="content_info_label">Razão Social: </span><span id="razao'+this.id+'" class="content_info_txt">'+ this.razao +'</span></td>'+
		                //'<td colspan="2"><span class="content_info_label">Sala: </span><span class="content_info_txt">'+this.sala + '</span></td>'+
		            '</tr>'+
                	'<tr class="content_info_row">'+
		                '<td colspan="2"><span class="content_info_label">CNPJ: </span><span id="cnpj'+this.id+'" class="content_info_txt">'+this.cnpj+'</span></td>'+
		                '<td colspan="2"><span class="content_info_label">Administração: </span><span id="adm'+this.id+'" idAdm="'+this.idAdm+'" class="content_info_txt">'+this.adm+'</span></td>'+
		                '<td colspan="2"><span class="content_info_label">Tipo: </span><span id="tipo'+this.id+'" idTipo="'+this.idTipoEscola+'" class="content_info_txt">'+this.tipoEscola + '</span></td>'+
		            '</tr>'+
		            '<tr class="content_info_row">'+
	                    '<td colspan="6"><span class="content_info_label">Endereço:</span> <span class="content_info_txt">'+
	                        this.rua + ', ' + this.numero + (this.complemento != '' ? ', '+this.complemento : '') + ' - ' + this.bairro + ' - ' + this.cidade + ', ' + this.estado +'. CEP: '+this.cep+
	                    '</span></td>'+
	                '</tr>'+
	                '<tr class="content_info_row">'+
	                    '<td colspan="3"><span class="content_info_label">Tel.:</span> <span id="telefone'+this.id+'" class="content_info_txt">'+this.telefone+'</span></td>'+
	                    '<td colspan="3"><span class="content_info_label">Email:</span> <span id="email'+this.id+'" class="content_info_txt">'+this.email+'</span></td>'+
	                '</tr>'+
	                '<tr class="content_info_row">'+
	                    '<td colspan="3"><span class="content_info_label">Diretor:</span> <span class="content_info_txt">'+this.nomeDiretor+'</span></td>'+
	                    '<td colspan="3"><span class="content_info_label">Email:</span> <span class="content_info_txt">'+this.emailDiretor+'</span></td>'+
	                '</tr>'+
	                '<tr class="content_info_row">'+
	                    '<td colspan="3"><span class="content_info_label">Coordenador:</span> <span class="content_info_txt">'+this.nomeCoord+'</span></td>'+
	                    '<td colspan="3"><span class="content_info_label">Email:</span> <span class="content_info_txt">'+this.emailCoord+'</span></td>'+
	                '</tr>'+
	                '<tr class="content_info_row">'+
	                    '<td colspan="6"><span class="content_info_label">Site:</span> <span class="content_info_txt">'+this.site+'</span></td>'+
	                '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="3"><span class="content_info_label">Usuário</span> <span id="usuario'+this.id+'" class="content_info_txt">'+this.usuario+'</span></td>'+
                        '<td colspan="3"><span class="content_info_label">Status:</span> <span class="content_info_txt">'+status+'</span></td>'+
                    '</tr>'+
                '</table>';
        
        html +=
            '</div>'+
            '<div class="content_col_btns">';
                if(usuario.perfil != "4")
                    html += '<button id="btnDelEscola'+this.id+'" idUsuarioVariavel="'+this.idUsuarioVar+'" idUsuario="'+this.id+'" class="section_btn btn_del_cad btnDelCadEscola">Excluir cadastro</button>';
                html +='<button id="btnUpdateEscola'+this.id+'" class="section_btn btn_update_cad btnUpdateCadEscola" idUsuario="'+this.id+'" idEndereco="'+this.idEndereco+'" idEscola="'+this.idEscola+'">Alterar Dados</button>'+
            '</div>'+
        '</div>';
    
        return html;
    }
    
    //inputNomeEscola
}

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

function listarAlunos(){

	$.ajax({
        url:'ajax/CadastroAjax.php',
        type:'post',
        dataType:'json',
        data: {
            'acao': 'listaUsuariosCompleto',
            'perfil': '1',
            'perfil_usr' : usuario.perfil,
            'usr_id' : usuario.perfil == 4? usuario.escola : usuario.id
        },
        success:function(alunos){
        	$('.update_aluno_accordion').html('');
        	
        	for ( var a in alunos ) {
              perfisAlunosGerados[a] = new PerfilAluno(alunos[a]);
              var outerHTML = perfisAlunosGerados[a].gerarHTML();
              $('.update_aluno_accordion').append(outerHTML);
        	}
              
        },error:function(){
        	console.log('Erro ao listar alunos!!');
        }
    });
}

function listarProfessores(){
	$.ajax({
        url:'ajax/CadastroAjax.php',
        type:'post',
        dataType:'json',
        data: {
            'acao': 'listaUsuariosCompleto',
            'perfil': '2',
            'perfil_usr' : usuario.perfil,
            'usr_id' : usuario.perfil == 4? usuario.escola : usuario.id
        },
        success:function(professores){
        	$('.update_prof_accordion').html('');
        	
        	for ( var a in professores ) {
        		perfisProfessoresGerados[a] = new PerfilProfessor(professores[a]);
        		var outerHTML = perfisProfessoresGerados[a].gerarHTML();
        		$('.update_prof_accordion').append(outerHTML);
        	}
        	  
        },error:function(){
        	console.log('Erro ao listar professores!!');
        }
    });	
}



function listarEscolas(){
	
	$.ajax({
        url:'ajax/CadastroAjax.php',
        type:'post',
        dataType:'json',
        data: {
            'acao': 'listaUsuariosCompleto',
            'perfil': '4',
            'perfil_usr' : usuario.perfil,
            'usr_id' : usuario.id
        },
        success:function(escolas){
        	$('.update_escola_accordion').html('');
        	
        	for ( var a in escolas ) {
        		perfisEscolasGerados[a] = new PerfilEscola(escolas[a]);
        		var outerHTML = perfisEscolasGerados[a].gerarHTML();
        		$('.update_escola_accordion').append(outerHTML);
        	}
        	 
        },error:function(){
        	console.log('Erro ao listar escolas!!');
        }
    });	
}

//Função para limpar os campos.
function limparCadastro(classe){
	
	//Função para preparar para receber uma nova imagem.
	limparInputArquivo();	

	//Percorre o formulário com a classe limpando todos os campos. 
	$('.'+classe).each(function(){
		$(this).val('');
	});
	
	//alert(classe);
	//Casos expecificos para cada formulário.
	if (classe == 'formAluno'){
		listarEscolas();
		$('.anoAtual').attr('selected','selected');

        //Mostrar campos escondidos caso tenha-se editado um aluno anteriormente
        $("#dados_escolares select").removeAttr("disabled");
        $("#inputNascimentoAluno").removeAttr("disabled");
        $("#inputRgAluno").removeAttr("disabled");
        $("#inputCpfAluno").removeAttr("disabled");
        $("#inputUsuarioAluno").removeAttr("disabled");
        $("label[for=inputSenhaAluno]").append('<span class="asterisco">*</span>');
        $("label[for=inputSenhaConfirmAluno]").append('<span class="asterisco">*</span>');
        $('#selectEscolaAluno').val(usuario.escola);
        $("#resetarAluno").show();
        $("#inputSenhaAtual").parent().parent().hide();

	}else if (classe = 'formProf'){
		$('.seriesProfessor').prop('checked',false);
		$('.seriesProfessor').eq(0).prop('checked',true);

        //Mostrar campos escondidos caso tenha-se editado um aluno anteriormente
        $("#inputNascimentoProf").removeAttr("disabled");
        $("#inputRgProf").removeAttr("disabled");
        $("#inputCpfProf").removeAttr("disabled");
        $("#inputUsuarioProf").removeAttr("disabled");
        $("label[for=inputSenhaProf]").append('<span class="asterisco">*</span>');
        $("label[for=inputSenhaConfirmProf]").append('<span class="asterisco">*</span>')
        $("#resetarProf").show();
        $("#inputSenhaAtualProf").parent().parent().hide();

	}else if (classe == 'formEscola'){
		//
	}
		
	//Coloca o foco sobre o primeiro campo para ficar na parte de cima da tela.
	$('.'+classe).eq(0).focus();
	
	return false;
}

function expandSeriePeriodoProfessor(trigger) {
    var fieldCount      = (document.querySelectorAll("[data-grupoAttr]").length/2)+1;
    var idperiodoSelect = "#inputPeriodoProf"+fieldCount;
    var idserieSelect   = "#inputSerieProf"+fieldCount;
    var htmlSeries      = "";
    var htmlPeriod      = "";

    htmlSeries += '<div class="form_celula_p" style="height: 0;">';
    htmlSeries +=     '<label for="" class="form_info info_p">Série<span class="asterisco">*</span></label>';
    htmlSeries +=     '<span class="select_container">';
    htmlSeries +=         '<select name="" id="inputSerieProf'+fieldCount+'" data-grupoAttr="serie" name="grp_serie" class="form_value form_select value_p formProf" required msgVazio="O campo série é obrigatório">';
    htmlSeries +=             '<option value="" disabled hidden selected style="font-style: italic;">Carregando...</option>';
    htmlSeries +=         '</select>';
    htmlSeries +=     '</span>';
    htmlSeries += '</div>';

    htmlPeriod += '<div class="form_celula_p" style="height: 0;">';
    htmlPeriod +=     '<label for="" class="form_info info_p">Período<span class="asterisco">*</span></label>';
    htmlPeriod +=     '<span class="select_container">';
    htmlPeriod +=         '<select name="" id="inputPeriodoProf'+fieldCount+'" data-grupoAttr="periodo" name="grp_periodo" class="form_value form_select value_p formProf" required>';
    htmlPeriod +=             '<option value="" disabled hidden selected style="font-style: italic;">Carregando...</option>';
    htmlPeriod +=         '</select>';
    htmlPeriod +=     '</span>';
    htmlPeriod += '</div>';

    $(htmlSeries+htmlPeriod).insertBefore("#acaoNovaSerieContainer");
    $(idperiodoSelect).parent().parent().animate({height: "40px"}, 200);
    $(idserieSelect).parent().parent().animate({height: "40px"}, 200);

    getSeries(idserieSelect,idperiodoSelect);
}

function getSeries(idserieSelect,idperiodoSelect) {
    var series;
    $.ajax({
        url: "ajax/SerieAjax.php",
        type: "GET",
        dataType: "json",
        data: "acao=selectAll",
        success: function(data) {
            series = data;
        },
        complete: function() {
            listSeries(series,idserieSelect,idperiodoSelect);
        }
    });
}

function listSeries(series,idserieSelect,idperiodoSelect) {
    var seriesSelecionadas  = [];
    var seriesCombos        = document.querySelectorAll("[data-grupoAttr='serie']");
    var seriesHtml          = "<option value='' selected disabled hidden>Selecione</option>";
    var periodosHtml        = "<option hidden selected disabed>Selecione uma série</option>";

    $(seriesCombos).each(function(a) {
        if (a !== seriesCombos.length-1) 
            seriesSelecionadas.push(this.value);
    });

    for (var b in series.retorno) {
        if (seriesSelecionadas.indexOf(series.retorno[b].id) > -1) {
            var disponivel = verificarOcorrenciasSerie(seriesCombos, series.retorno[b]);

            if (!disponivel)
                continue;
        }
        
        seriesHtml += '<option value="'+series.retorno[b].id+'">'+series.retorno[b].serie+'</option>';
    }

    seriesHtml += '<option value="0" style="font-style: italic;">Remover</option>';

    $(idserieSelect).html(seriesHtml);
    $(idperiodoSelect).html(periodosHtml);
    atribuirEventosSerie(idserieSelect,idperiodoSelect);
}

function verificarOcorrenciasSerie(combos, serie) {
    var count = 0;
    for (var a in combos) {
        if (combos[a].value == serie.id)
            count++;
    }

    if (count === 2)
        return false;
    else
        return true;
}

function getPeriodos(combo, idserieSelect, idperiodoSelect) {
    var retorno;

    $.ajax({
        url: "ajax/PeriodoAjax.php",
        type: "GET",
        dataType: "json",
        data: "acao=selectAll",
        beforeSend: function() {
            var htmlPeriodos = "<option disabled selected hidden style='font-style:italic;'>Carregando...</option>";
            $(idperiodoSelect).html(htmlPeriodos);
        },
        success: function(periodos) {
            retorno = periodos.retorno;;
        },
        complete: function() {
            listPeriodos(combo, idserieSelect, idperiodoSelect, retorno);
        }
    });
}

function listPeriodos(combo, idserieSelect, idperiodoSelect, periodos) {
    var combosSeries = document.querySelectorAll("[data-grupoAttr='serie']");
    var comboAtual = document.getElementById(idserieSelect.slice(1));
    var periodsSelecionados = [];
    var htmlPeriodos = "<option value='' disabled selected hidden>Selecione</option>";

    for (var a = 0; a < combosSeries.length-1; a++) { 
        if (combosSeries[a].value == comboAtual.value) {
            var idNumeroCombo = combosSeries[a].id.slice(14);
            var selectPeriodoVal = $("#inputPeriodoProf"+idNumeroCombo).find("option:selected").val();

            periodsSelecionados.push(selectPeriodoVal);
        }
    }

    for (var b = 0; b < periodos.length; b++) {
        if (periodsSelecionados.length > 0) {
            for (var c = 0; c < periodsSelecionados.length; c++) {
                if (periodos[b].id != periodsSelecionados[c]) {
                    htmlPeriodos += "<option value='"+periodos[b].id+"''>"+periodos[b].periodo+"</option>";
                }
            }
        } else {
            htmlPeriodos += "<option value='"+periodos[b].id+"''>"+periodos[b].periodo+"</option>";
        }
    }

    $(idperiodoSelect).html(htmlPeriodos);
}

function atribuirEventosSerie(idserieSelect,idperiodoSelect) {
    $("[data-grupoAttr='serie']").change(function() {
        getPeriodos(this, idserieSelect,idperiodoSelect);
    });
}

function verificarPadraoSenha(perfil)
{
    var senha = $("#inputSenha"+perfil).val();

    if (/\W+/.test(senha))
    {
        $("#regrasSenha"+perfil).find(".regra_char_esp").removeClass("text-danger");
        $("#regrasSenha"+perfil).find(".regra_char_esp").addClass("text-success");
    }
    else
    {
        $("#regrasSenha"+perfil).find(".regra_char_esp").addClass("text-danger");
        $("#regrasSenha"+perfil).find(".regra_char_esp").removeClass("text-success");
    }

    if (/[0-9]/.test(senha))
    {
        $("#regrasSenha"+perfil).find(".regra_char_mai").removeClass("text-danger");
        $("#regrasSenha"+perfil).find(".regra_char_mai").addClass("text-success");
    }
    else
    {
        $("#regrasSenha"+perfil).find(".regra_char_mai").addClass("text-danger");
        $("#regrasSenha"+perfil).find(".regra_char_mai").removeClass("text-success");
    }

    if (/[a-z]/.test(senha))
    {
        $("#regrasSenha"+perfil).find(".regra_char_min").removeClass("text-danger");
        $("#regrasSenha"+perfil).find(".regra_char_min").addClass("text-success");
    }
    else
    {
        $("#regrasSenha"+perfil).find(".regra_char_min").addClass("text-danger");
        $("#regrasSenha"+perfil).find(".regra_char_min").removeClass("text-success");
    }

    if (senha.length >= 6 && senha.length <= 10)
    {
        $("#regrasSenha"+perfil).find(".regra_length").removeClass("text-danger");
        $("#regrasSenha"+perfil).find(".regra_length").addClass("text-success");
    }
    else
    {
        $("#regrasSenha"+perfil).find(".regra_length").addClass("text-danger");
        $("#regrasSenha"+perfil).find(".regra_length").removeClass("text-success");
    }
}

function gerarHtmlEscolasPendentes(data)
{
    var html = "";
    for (var i in data)
    {
        var status = "";

        if (data[i].status == 0)
            status = 'Inativo'
        else if (data[i].status == 1)
            status = 'Ativo'
        else if (data[i].status == 2)
            status = 'Rejeitado'

        var collapseContent = usuario.perfil == "4"? '' : 'data-toggle="collapse"';
        var collapse = usuario.perfil == "4"? '' : 'collapse';
        html +=
            '<a href="#confirmEscCont'+data[i].id+'" class="accordion_info_toggler confirmEscToggler" '+collapseContent+'>'+
                '<div class="accordion_info confirmEscInfo'+data[i].id+'" id="confirmEscInfo'+data[i].id+'">'+data[i].nome+'</div>'+
            '</a>'+
            '<div class="accordion_content '+collapse+'" id="confirmEscCont'+data[i].id+'">'+
                '<div class="content_col_info">';

        html +=
                //Campos hiddens de dados
                '<input type="hidden" value="'+data[i].nse+'" id="nse'+data[i].id+'"/>'+
                '<input type="hidden" value="'+data[i].codigo+'" id="codigo'+data[i].id+'"/>'+
                '<input type="hidden" value="'+data[i].rua+'" id="rua'+data[i].id+'"/>'+
                '<input type="hidden" value="'+data[i].bairro+'" id="bairro'+data[i].id+'"/>'+
                '<input type="hidden" value="'+data[i].numero+'" id="numero'+data[i].id+'"/>'+
                '<input type="hidden" value="'+data[i].complemento+'" id="complemento'+data[i].id+'"/>'+
                '<input type="hidden" value="'+data[i].estado+'" id="estado'+data[i].id+'"/>'+
                '<input type="hidden" value="'+data[i].cidade+'" id="cidade'+data[i].id+'"/>'+
                '<input type="hidden" value="'+data[i].cep+'" id="cep'+data[i].id+'"/>'+
                '<input type="hidden" value="'+data[i].imagem+'" id="imagem'+data[i].id+'"/>'+

                '<table border="0">'+
                    '<tr class="content_info_row">'+
                        '<td colspan="6"><span class="content_info_label">Razão Social: </span><span id="razao'+data[i].id+'" class="content_info_txt">'+ data[i].razaoSocial +'</span></td>'+
                        //'<td colspan="2"><span class="content_info_label">Sala: </span><span class="content_info_txt">'+data[i].sala + '</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="2"><span class="content_info_label">CNPJ: </span><span id="cnpj'+data[i].id+'" class="content_info_txt">'+data[i].cnpj+'</span></td>'+
                        '<td colspan="2"><span class="content_info_label">Administração: </span><span id="adm'+data[i].id+'" idAdm="'+data[i].administracao.id+'" class="content_info_txt">'+data[i].administracao.administracao+'</span></td>'+
                        '<td colspan="2"><span class="content_info_label">Tipo: </span><span id="tipo'+data[i].id+'" idTipo="'+data[i].tipo.id+'" class="content_info_txt">'+data[i].tipo.tipo_escola + '</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="6"><span class="content_info_label">Endereço:</span> <span class="content_info_txt">'+
                            data[i].endereco.logradouro + ', ' + data[i].endereco.numero + (data[i].endereco.complemento != '' ? ', '+data[i].endereco.complemento : '') + ' - ' + data[i].endereco.bairro + ' - ' + data[i].endereco.cidade + ', ' + data[i].endereco.uf +'. CEP: '+data[i].endereco.cep+
                        '</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="3"><span class="content_info_label">Tel.:</span> <span id="telefone'+data[i].id+'" class="content_info_txt">'+data[i].endereco.tel_res+'</span></td>'+
                        '<td colspan="3"><span class="content_info_label">Email:</span> <span id="email'+data[i].id+'" class="content_info_txt">'+data[i].endereco.email+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="3"><span class="content_info_label">Diretor:</span> <span class="content_info_txt">'+data[i].diretor+'</span></td>'+
                        '<td colspan="3"><span class="content_info_label">Email:</span> <span class="content_info_txt">'+data[i].emailDiretor+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="3"><span class="content_info_label">Coordenador:</span> <span class="content_info_txt">'+data[i].coordenador+'</span></td>'+
                        '<td colspan="3"><span class="content_info_label">Email:</span> <span class="content_info_txt">'+data[i].emailCoord+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="6"><span class="content_info_label">Site:</span> <span class="content_info_txt">'+data[i].site+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="6"><span class="content_info_label">Status:</span> <span class="content_info_txt">'+status+'</span></td>'+
                    '</tr>'+
                '</table>';

        html +=
            '</div>'+
            '<div class="content_col_btns">';
                html += '<button id="btnRejectEscola'+data[i].id+'" class="section_btn btn_del_cad btnDelCadEscola" onclick="rejeitarPreCadastroEscola(\''+data[i].id+'\')">Rejeitar cadastro</button>';
                html += '<button id="btnConfirmEscola'+data[i].id+'" class="section_btn btn_update_cad btnConfirmCadEscola" onclick="confirmarPreCadastroEscola(\''+data[i].id+'\')">Aceitar cadastro</button>'+
            '</div>'+
        '</div>';
    }
    return html;
}

function listarEscolasPreCadastradas()
{
    $.ajax({
        url:'ajax/CadastroAjax.php',
        type:'post',
        dataType:'json',
        data: "acao=listaPendentes",
        success: function(data)
        {
            console.log(data);
            if(data)
            {
                var html = gerarHtmlEscolasPendentes(data);
                $(".confirm_escola_accordion").html(html);
            }
            else
            {
                showAlertSemEscolasPendentes();
            }
        },
        error: function(e)
        {
            console.log(e);
        }
    });
}

function rejeitarPreCadastroEscola(id)
{
    $.ajax({
        url:'ajax/CadastroAjax.php',
        type:'post',
        dataType:'json',
        data: "acao=reject&id="+id,
        beforeSend: function() {
            $("#btnRejectEscola"+id).attr("disabled","disabled");
            $("#btnConfirmEscola"+id).attr("disabled","disabled");
            $("#btnRejectEscola"+id).text("Carregando...");
            $("#btnConfirmEscola"+id).text("Carregando...");
        },
        success: function(data)
        {
            $("#mensagemRejeitado").fadeIn(200, function()
            {
                $("#confirmEscInfo"+id).parent().remove();
                $("#confirmEscCont"+id).remove();
                countListaEscolaPendetes();
            });
        },
        error: function(e)
        {
            console.log(e);
        },
        complete: function()
        {
            $("#btnRejectEscola"+id).removeAttr("disabled");
            $("#btnConfirmEscola"+id).removeAttr("disabled");
            $("#btnRejectEscola"+id).text("Rejeitar cadastro");
            $("#btnConfirmEscola"+id).text("Aceitar cadastro");
        },
    });
}

function confirmarPreCadastroEscola(id)
{
    $.ajax({
        url:'ajax/CadastroAjax.php',
        type:'post',
        dataType:'json',
        data: "acao=confirm&id="+id,
        beforeSend: function() {
            $("#btnRejectEscola"+id).attr("disabled","disabled");
            $("#btnConfirmEscola"+id).attr("disabled","disabled");
            $("#btnRejectEscola"+id).text("Carregando...");
            $("#btnConfirmEscola"+id).text("Carregando...");
        },
        success: function(data)
        {
            $("#mensagemAprovado").fadeIn(200, function() {
                $("#confirmEscInfo"+id).parent().remove();
                $("#confirmEscCont"+id).remove();
                countListaEscolaPendetes();
            });
        },
        error: function(e)
        {
            console.log(e);
        },
        complete: function()
        {
            $("#btnRejectEscola"+id).removeAttr("disabled");
            $("#btnConfirmEscola"+id).removeAttr("disabled");
            $("#btnRejectEscola"+id).text("Rejeitar cadastro");
            $("#btnConfirmEscola"+id).text("Aceitar cadastro");
        }
    });
}

function countListaEscolaPendetes()
{
    if ($(".confirmEscToggler").length === 0)
        showAlertSemEscolasPendentes();
    else
        return false;
}

function showAlertSemEscolasPendentes()
{
    $(".confirm_escola_accordion").html("<div class='alert alert-warning'>Nenhuma escola com cadastro pendente.</div>");
}