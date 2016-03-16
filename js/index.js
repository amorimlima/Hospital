"use strict";
var estado = "login";
var formulario;

$(document).ready(atribuirEventos);

function atribuirEventos() {
	
	$('#mensagemSucessoCadastro div div div .modal-footer .btn').click(function(){
		window.location.href = "pesquisa.php";
		return false;
	})
	
    $("#link_pre_cadastro").click(toggleFormPreCadastro);
    $("#cancel_pre_cadastro").click(toggleFormPreCadastro);

    formulario = new Formulario({
        idFormulario: "formulario_pre_cadastro",
        idBtnEnviar: "enviar_pre_cadastro",
        idBtnCancelar: "cancel_pre_cadastro"
    });
    
    formulario.iniciar();

    $("#btLogar").click(validarLogin);
    $("#enviar_pre_cadastro").click(formulario.validar)
    $("input:radio").filter("[name=esc_tipo_escola]").change(mudarTipoEscola);

    /* Barra de rolagem */
    $(".form_barra").mCustomScrollbar({ axis: "y", scrollButtons: { enable:true } });
    
    listarEstadoCidade('estado');
    
    $('#estado').change(function(){
    	selectCidade('estado','cidade')
    })
    
    $("#enviar_pre_cadastro").click(function(){
    	
    	$(".input_faltando").removeClass("input_faltando");
    	
    	var erro = false;
    	$('.obrigatorio').each(function(){
    		//console.log( $(this).attr('id') + ': ' + $(this).val() );
    		if ($(this).val() == '' || $(this).val() == null ){
    			if (erro == false){
    				$("#textoMensagemVazio").text($(this).attr('msgVazio'));
    				$("#mensagemCampoVazio").show();
    				erro = true;
    			}
	        	$(this).addClass('input_faltando');
    		}
    	})	
    	
    	if (erro == true){
    		$('.input_faltando').eq(0).focus();
    		return false;
    	}
         	
   		if (validaCNPJ($("#cnpj").val()) == false){
   			$("#cnpj").addClass("input_faltando");
			$("#textoMensagemVazio").text('CNPJ inválido!');
			$("#mensagemCampoVazio").show();
			return false;
       	}
        	
        if(validaEmail($("#email").val()) == false){
        	$("#email").addClass("input_faltando");
        	$("#textoMensagemVazio").text('Email inválido!');
        	$("#mensagemCampoVazio").show();
        	return false;
        }
        if(($("#email_diretor").val() != '') && (validaEmail($("#email_diretor").val()) == false)){
        	$("#email_diretor").addClass("input_faltando");
        	$("#textoMensagemVazio").text('Email do diretor inválido!');
        	$("#mensagemCampoVazio").show();
        	return false;
        }
        if(($("#email_coordenador").val() != '') && (validaEmail($("#email_coordenador").val())) == false){
        	$("#email_coordenador").addClass("input_faltando");
        	$("#textoMensagemVazio").text('Email do coordenador inválido!');
        	$("#mensagemCampoVazio").show();
        	return false;
        }
        	
        	var nomeEscola = $("#nome_escola").val();
        	var razao = $("#razao_social").val();
        	var cnpj = $("#cnpj").val();
        	var tipo = $("input[name=esc_tipo_escola]:checked").val();
        	var adm = $("#administracao").val();
        	var cepEscola = $("#cep").val();
        	var enderecoEscola = $("#logradouro").val();
        	var numeroEnderecoEscola = $("#numero").val();
        	var complemento = $("#complemento").val();
        	var bairroEscola = $("#bairro").val();
        	var ufEscola = $("#estado").val();
        	var cidadeEscola = $("#cidade").val();
        	var emailEscola = $("#email").val();
        	var telefoneEscola = $("#tel_comercial").val();
        	var codigoEscola = '';
        	var nse = '';
        	var loginEscola = '';
        	var senhaEscola = '';
        	
        	var nomeDiretor = $("#nome_diretor").val();
        	var emailDiretor = $("#email_diretor").val();
        	var nomeCoordenador = $("#nome_coordenador").val();
        	var emailCoordenador = $("#email_coordenador").val();
        	
        	$.ajax({
        		url:'ajax/cadastroAjax.php',
        		type:'post',
        		dataType:'json',
        		data:{
        			'acao':'cadastraEscola',
        			'perfil': '4',
        			'preCadastro':true,
        			'status': '0',
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
        			'nomeDiretor':nomeDiretor,
        			'emailDiretor':emailDiretor,
        			'nomeCoordenador':nomeCoordenador,
        			'emailCoordenador':emailCoordenador,
        			'imagem':''
        		},
        		success:function(retorno){
        			if (retorno.erro == false) {
        				$("#mensagemSucessoCadastro").show();
        			}else {
                   			$("#textoMensagemVazio").text(retorno.msg);
            	        	$("#mensagemCampoVazio").show();
                   		}
                   	return false;
        		},
        		error:function(data){
        			$("#textoMensagemVazio").text('Houve um erro ao cadastrar!');
    	        	$("#mensagemCampoVazio").show();
                	return false;
                }
        	});    		
        	
        	
        	
        	
        	return false;
    	})

}

function toggleFormPreCadastro() {
    switch (estado) {
        case "login":
            $("#login").hide();
            $("#form_pre_cadastro").show();

            estado = "cadastro";
        break;
        case "cadastro":
            $("#login").show();
            $("#form_pre_cadastro").hide();

            estado = "login";
        break;
    }
}

function validarLogin() {
    $("#result").html('').removeClass();
    var user = $("#usuario").val();
    var senha = $("#senha").val();

    if (user !== "" && senha !== "") {
        $.ajax({
            url:'auth.php',
            type:'post',
            dataType:'json',
            data:{'usuario':user,'senha':senha},
            success:function(data){
                if(data.erro == true) {
                    alert(data.msg);
                } else {
                    window.location.href=data.url;
                }
            }
        });
    } else {
        alert('Os campos são obrigatórios!');
    }
    return false;
}

function mudarTipoEscola() {
	var radioChecked = $("input:radio").filter("[name=esc_tipo_escola]:checked");
	var tipoEscolaHtml = new String();

	if ($(radioChecked).attr("id") === "escola_publica") {
            tipoEscolaHtml += "<option value=\"1\" selected>Municipal</option>";
            tipoEscolaHtml += "<option value=\"2\">Estadual</option>";
            tipoEscolaHtml += "<option value=\"3\">Federal</option>";

            $("#administracao").html(tipoEscolaHtml);
	} else {
            tipoEscolaHtml += "<option value=\"4\" selected>Particular</option>";

            $("#administracao").html(tipoEscolaHtml);
	}
}










