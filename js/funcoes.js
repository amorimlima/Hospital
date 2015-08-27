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
		$('.modalMensagem').css('display','none');
	});
});

function risizeObj(){
	var largura = $('#objeto').width();
    var altura  = ( 74 * largura ) / 100;	
    $('#objeto').css('height', Math.round(altura+10) + 'px');
}

