"use strict";

var tabs = $('.tab_cadastro');
var containers = $('.conteudo_tab');
var btns = $('.btns_tabs');
var primeiroAcesso = true;
var delPerfilId = '0';
var blah;
var perfisAlunosGerados = [];
var perfisProfessoresGerados = [];

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
    listarProfessores();
   
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
                listarProfessores();
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
    	var perfil = $("#perfil").val();
    	
    	$.ajax({
        	url:'ajax/cadastroAjax.php',
        	type:'post',
        	dataType:'json',
        	data:{'acao':'novoUsuario',
    			'perfil': perfil,
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
		script : "ajax/cadastroAjax.php"
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

function limparInputArquivo(){
	
	$("#imgUp").hide();
	$("#loading").hide();
	document.getElementById("arquivo").value = "";
	$("#cadastroImagem form").show();
	$("#cadastroImagem").show();
	return false;
}

//Classe Perfil Aluno
function PerfilAluno(id, nome, escola, professor, sala, periodo, nascimento, rg, cpf, rua, num, complemento, cep, bairro, estado, cidade, telResidencial, telCelular, telComercial, email, usuario, imagem) {
    self = this;
    
    this.id = id;
    this.nome = nome;
    this.escola = escola;
    this.professor = professor;
    this.sala = sala;
    this.periodo = periodo
    this.nascimento = nascimento;
    this.rg = rg;
    this.cpf = cpf;
    this.rua = rua;
    this.num = num;
    this.complemento = complemento;
    this.cep = cep;
    this.bairro = bairro;
    this.estado = estado;
    this.pais = 'Brasil';
    this.cidade = cidade;
    this.telResidencial = telResidencial;
    this.telCelular = telCelular;
    this.telComercial = telComercial;
    this.email = email;
    this.usuario = usuario;
    this.imagem = imagem;
    
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
        
        html +=
        '<a href="#updateAlunoCont'+this.id+'" class="accordion_info_toggler updateAlunoToggler" data-toggle="collapse">'+
            '<div class="accordion_info" id="updateAlunoInfo'+this.id+'">'+this.nome+'</div>'+
        '</a>'+
        '<div class="accordion_content collapse" id="updateAlunoCont'+this.id+'">'+
            '<div class="content_col_info">';
        
        html += 
                '<table border="0">'+
                    '<tr class="content_info_row">'+
                         '<td colspan="6"><span class="content_info_label">Escola:</span> <span class="content_info_txt">'+this.escola+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="3"><span class="content_info_label">Professor:</span> <span class="content_info_txt">'+this.professor+'</span></td>'+
                        '<td colspan="3"><span class="content_info_label">Sala:</span> <span class="content_info_txt">'+this.sala+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="2"><span class="content_info_label">Nascimento:</span> <span class="content_info_txt">'+this.nascimento+'</span></td>'+
                        '<td colspan="2"><span class="content_info_label">RG:</span> <span class="content_info_txt">'+this.rg+'</span></td>'+
                        '<td colspan="2"><span class="content_info_label">CPF:</span> <span class="content_info_txt">'+this.cpf+'</span></td>'+
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
                        '<td colspan="2"><span class="content_info_label">Usuário:</span> <span class="content_info_txt">'+this.usuario+'</span></td>'+
                        '<td colspan="4"><span class="content_info_label">E-mail:</span> <span class="content_info_txt">'+this.email+'</span></td>'+
                    '</tr>'+
                '</table>';
        
        if (this.imagem != '')
        	var img = '<div><img src="imgm/'+this.imagem+'"/></div><br/>';
        else var img = '';
        
        html +=
            '</div>'+
            '<div class="content_col_btns" style="position: relative">'+
            	img+
                '<button id="btnDelAluno'+this.id+'" class="section_btn btn_del_cad btnDelCadAluno">Excluir cadastro</button>'+
                '<button id="btnUpdateAluno'+this.id+'" class="section_btn btn_update_cad btnUpdateCadAluno">Alterar Dados</button>'+
            '</div>'+
        '</div>';
        
        return html;
    }
    this.gerarForm = function () {
        $('#inputTurmaAluno').val(this.sala);
        $('#inputNomeAluno').val(this.nome);
        $('#inputNascimentoAluno').val(this.nascimento);
        $('#inputRgAluno').val(this.rg);
        $('#inputCpfAluno').val(this.cpf);
        $('#inputRuaAluno').val(this.rua);
        $('#inputNumCasaAluno').val(this.num);
        $('#inputCompCasaAluno').val(this.complemento);
        $('#inputCepAluno').val(this.cep);
        $('#inputBairroAluno').val(this.bairro);
        $('#inputTelResAluno').val(this.telResidencial);
        $('#inputTelCelAluno').val(this.telCelular);
        $('#inputTelComAluno').val(this.telComercial);
        $('#inputEmailAluno').val(this.email);
        $('#inputUsuarioAluno').val(this.usuario);
    }
    this.deletar = function() {
        $('#updateAlunoInfo'+this.id).parent('a').remove();
        $('#updateAlunoCont'+this.id).remove();
    }
}

//Classe Perfil Professor
function PerfilProfessor(id, nome, nascimento, rg, cpf, rua, numero, complemento, cep, bairro, estado, cidade, telResidencial, telCelular, telComercial, email, escola, sala, periodo, usuario, imagem, categoria, instrucao) {
    self = this;
    
    this.id = id;
    this.nome = nome;
    this.nascimento = nascimento;
    this.rg = rg;
    this.cpf = cpf;
    this.rua = rua;
    this.numero = numero;
    this.complemento = complemento;
    this.cep = cep;
    this.bairro = bairro;
    this.estado = estado;
    this.cidade = cidade;
    this.telResidencial = telResidencial;
    this.telComercial = telComercial;
    this.telCelular = telCelular;
    this.email = email;
    this.escola = escola;
    this.sala = sala;
    this.periodo = periodo;
    this.usuario = usuario;
    this.imagem = imagem;
    this.categoria = categoria;
    this.instrucao = instrucao;

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
        
        html +=
        '<a href="#updateProfCont'+this.id+'" class="accordion_info_toggler updateProfToggler" data-toggle="collapse">'+
            '<div class="accordion_info" id="updateProfInfo'+this.id+'">'+this.nome+'</div>'+
        '</a>'+
        '<div class="accordion_content collapse" id="updateProfCont'+this.id+'">'+
            '<div class="content_col_info">';
            
        html +=    
                '<table border="0">'+
                	'<tr class="content_info_row">'+
		                '<td colspan="4"><span class="content_info_label">Escola: </span><span class="content_info_txt">'+ this.escola +'</span></td>'+
		                '<td colspan="2"><span class="content_info_label">Sala: </span><span class="content_info_txt">'+this.sala + '</span></td>'+
		            '</tr>'+
                	'<tr class="content_info_row">'+
		                '<td colspan="3"><span class="content_info_label">Categoria Funcional: </span><span class="content_info_txt">'+ this.categoria +'</span></td>'+
		                '<td colspan="3"><span class="content_info_label">Grau Instrução: </span><span class="content_info_txt">'+this.instrucao + '</span></td>'+
		            '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="2"><span class="content_info_label">Nascimento:</span> <span class="content_info_txt">'+this.nascimento+'</span></td>'+
                        '<td colspan="2"><span class="content_info_label">RG:</span> <span class="content_info_txt">'+this.rg+'</span></td>'+
                        '<td colspan="2"><span class="content_info_label">CPF:</span> <span class="content_info_txt">'+this.cpf+'</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="6"><span class="content_info_label">Endereço:</span> <span class="content_info_txt">'+
                            this.rua + ', ' + this.numero + (this.complemento != '' ? ', '+this.complemento : '') + ' - ' + this.bairro + ' - ' + this.cidade + ', ' + this.estado +'. CEP: '+this.cep+
                        '</span></td>'+
                    '</tr>'+
                    '<tr class="content_info_row">'+
                        '<td colspan="6"><span class="content_info_label">Tel.:</span> <span class="content_info_txt">+'+telefones+'</span></td>'+
                    '</tr>'+
                    
                    '<tr class="content_info_row">'+
                        '<td colspan="3"><span class="content_info_label">Usuário</span> <span class="content_info_txt">'+this.usuario+'</span></td>'+
                        '<td colspan="3"><span class="content_info_label">E-mail:</span> <span class="content_info_txt">'+this.email+'</span></td>'+
                    '</tr>'+
                '</table>';
        
        if (this.imagem != '')
        	var img = '<div><img src="imgm/'+this.imagem+'"/></div><br/>';
        else var img = '';
        
        html +=
            '</div>'+
            '<div class="content_col_btns" style="position: relative">'+
            	img+
                '<button id="btnDelProf'+this.id+'" class="section_btn btn_del_cad btnDelCadProf">Excluir cadastro</button>'+
                '<button id="btnUpdateProf'+this.id+'" class="section_btn btn_update_cad btnUpdateCadProf">Alterar Dados</button>'+
            '</div>'+
        '</div>';
    
        return html;
    }
    this.gerarForm = function () {
        $('#inputNomeProf').val(this.nome);
        $('#inputNascimentoProf').val(this.nascimento);
        $('#inputRgProf').val(this.rg);
        $('#inputCpfProf').val(this.cpf);
        $('#inputRuaProf').val(this.rua);
        $('#inputNumCasaProf').val(this.numero);
        $('#inputCompCasaProf').val(this.complemento);
        $('#inputCepProf').val(this.cep);
        $('#inputBairroProf').val(this.bairro);
        $('#inputTelResProf').val(this.telResidencial);
        $('#inputTelCelProf').val(this.telCelular);
        $('#inputTelComProf').val(this.telComercial);
        $('#inputEmailProf').val(this.email);
        $('#inputUsuarioProf').val(this.usuario);
    }
    this.deletar = function() {
        $('#updateProfInfo'+this.id).parent('a').remove();
        $('#updateProfCont'+this.id).remove();
    }
}

//Classe Perfil Escola
function PerfilEscola() {
    self = this;

    this.id = id;
    this.codigo = codigo; 
    this.rua = rua;
    this.numero = numero;
    this.complemento = complemento;
    this.cep = cep;
    this.bairro = bairro;
    this.pais = 'Brasil';
    this.estado = estado;
    this.cidade = cidade;
    this.telefone = telefone;
    this.email = email;
    this.usuario = usuario;
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
        url:'ajax/cadastroAjax.php',
        type:'post',
        dataType:'json',
        data: {
            'acao': 'listaUsuariosCompleto',
            'perfil': '1'
        },
        success:function(alunos){
        	//console.log(alunos);
        	
        	for ( var a in alunos ) {
        	  //alert(alunos[a].idUsuario);
              perfisAlunosGerados[a] =
              new PerfilAluno(alunos[a].idUsuario, alunos[a].nomeUsuario, alunos[a].nomeEscola, alunos[a].nomeProfessor, alunos[a].grupo, '', alunos[a].dataNascimento, alunos[a].rg, alunos[a].cpf,
                              alunos[a].logradouro, alunos[a].numero, alunos[a].complemento, alunos[a].cep, alunos[a].bairro, alunos[a].uf, alunos[a].cidade, alunos[a].telResidencial,
                              alunos[a].telCelular, alunos[a].telComercial, alunos[a].email, alunos[a].login, alunos[a].imagem);
        
              var outerHTML = perfisAlunosGerados[a].gerarHTML();
              //var outerHTML = '';
              $('.update_aluno_accordion').append(outerHTML);
        	}
              
        },error:function(){
        	console.log('Erro ao listar alunos!!');
        }
    });
}

function listarProfessores(){
	$.ajax({
        url:'ajax/cadastroAjax.php',
        type:'post',
        dataType:'json',
        data: {
            'acao': 'listaUsuariosCompleto',
            'perfil': '2'
        },
        success:function(professores){
        	console.log(professores);
        	
        	for ( var a in professores ) {
        		perfisProfessoresGerados[a] =
        			new PerfilProfessor(professores[a].idUsuario, professores[a].nomeUsuario,  professores[a].dataNascimento, professores[a].rg, professores[a].cpf,
                              			professores[a].logradouro, professores[a].numero, professores[a].complemento, professores[a].cep, professores[a].bairro, professores[a].uf, professores[a].cidade, professores[a].telResidencial,
                              			professores[a].telCelular, professores[a].telComercial, professores[a].email, professores[a].nomeEscola, professores[a].grupo, '', professores[a].login, professores[a].imagem, professores[a].categoria, professores[a].instrucao);
        
        		var outerHTML = perfisProfessoresGerados[a].gerarHTML();
        		//var outerHTML = '';
        		
        		$('.update_prof_accordion').append(outerHTML);
        	}
              
        },error:function(){
        	console.log('Erro ao listar professores!!');
        	alert('Erro!!');
        }
    });	
}