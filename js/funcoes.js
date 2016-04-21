var usuario;

$(document).ready(function(e) {
	//Define o tamanho do objeto na tela mobile
	var largura = $(window).width();
	var alturaJanela = $(window).height();
	var altura =  $('#objeto').height();	
	var result,total;
	if(largura>1280){
		total  = 581;
	}else if(altura>alturaJanela){
		result = (alturaJanela/largura)*100;
		total  = (result * largura ) / 100;		
	}else{
		total  = (74 * largura ) / 100;	
	}
	$('#objeto').css('height', Math.round(total) + 'px');
	//fim 

	var largura1 = $('#img_teste').width();
	var altura2  = ( 74 * largura1) / 100;	
	$('#img_teste').css('height', Math.round(altura2) + 'px');
	
	$('.tema').click(function(){
		var idTema = $(this).attr('id');
		$('#img_teste').css('display','none'); 
		$('#objeto').attr('src','Objetos/'+idTema+'/index.html').css({'display':'block'}); 
		risizeObj();
	});	
	
	$("#mn_livros").click(function(){
		if ($(window).width() < 768){
			$("#sbm_exercicios").toggle('slow');
		}
		return false;
	});
	
	//Aba calendario
	$('#aba_data').click(function(){
		$('#aba_calendario').toggle().animate({
          backgroundColor: "#4ADB5",
          color: "#000",
          width: 197
        }, 1000 );	
	});	
	
	$('.botao_modal').click(function(){
		//Apenas esconde as divs com a classe modalMensagem
		$('.modalMensagem').fadeOut(200);
	});


	$('#mn_galeria').click(function(){
		$.ajax({
			url:'ajax/GaleriaAjax.php',
			type:'post',
			dataType:'text',
			data:{'acao':'registroGaleria','menu':'1','download':'0'},
			success:function(data)
			{
				window.location.href = "galeria.php";
			}
		});
	});

	//Busca e armazena o usuário ativo
	if ($('#idUsuario').length > 0)
		usuario = new Usuario($('#idUsuario').val());

});

function redireciona(pagina){
	window.location= pagina;
}

function risizeObj(){
	var largura = $('#objeto').width();
    var altura  = ( 74 * largura ) / 100;	
    $('#objeto').css('height', Math.round(altura+10) + 'px');
}

function inverteData(data){
	var dataMsg = data.split('-');
	dataMsg = dataMsg[2]+"/"+dataMsg[1]+"/"+dataMsg[0];
	return dataMsg;
}

function validarCPF(cpf) {	
	cpf = cpf.replace(/[^\d]+/g,'');	
	if(cpf == '') return false;	
	// Elimina CPFs invalidos conhecidos	
	if (cpf.length != 11 || 
		cpf == "00000000000" || 
		cpf == "11111111111" || 
		cpf == "22222222222" || 
		cpf == "33333333333" || 
		cpf == "44444444444" || 
		cpf == "55555555555" || 
		cpf == "66666666666" || 
		cpf == "77777777777" || 
		cpf == "88888888888" || 
		cpf == "99999999999")
		return false;		
	// Valida 1o digito	
	add = 0;	
	for (i=0; i < 9; i ++)		
		add += parseInt(cpf.charAt(i)) * (10 - i);	
		rev = 11 - (add % 11);	
		if (rev == 10 || rev == 11)		
		rev = 0;	
		if (rev != parseInt(cpf.charAt(9)))		
		return false;		
	// Valida 2o digito	
		add = 0;	
		for (i = 0; i < 10; i ++)		
		add += parseInt(cpf.charAt(i)) * (11 - i);	
		rev = 11 - (add % 11);	
		if (rev == 10 || rev == 11)	
		rev = 0;	
		if (rev != parseInt(cpf.charAt(10)))
		return false;		
		return true;   
}

function validaEmail(email){
	er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;
	if(er.exec(email))
		return true;
	else
		return false;
}

function validaCNPJ(cnpj) {

    cnpj = cnpj.replace(/[^\d]+/g,'');

    if(cnpj == '') return false;

    if (cnpj.length != 14)
        return false;

    // LINHA 10 - Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        return false;

    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;

    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;

    return true;

}

var Usuario = function (idUsuario) {
	var self = this;

	var dataUsuario;
	$.ajax({
		url: 'ajax/UsuarioAjax.php',
		type: 'GET',
		data: {	'acao'	: 'usuarioGeral',
				'id'	: idUsuario},
		dataType: 'json',
		async: false,
		success: function(data) {
			dataUsuario = data;
		}
	});
	
	this.id = dataUsuario.id;
	this.nome = dataUsuario.nome;
	this.perfil = dataUsuario.perfil;
	this.escola = dataUsuario.escola;
	this.imagem = dataUsuario.imagem;
	this.id_variavel = dataUsuario.id_variavel;
	this.serie = dataUsuario.serie;
	this.grupo = dataUsuario.grupo;
}