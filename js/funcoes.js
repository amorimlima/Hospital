$(document).ready(function(e) {
	var largura = $('#objeto').width();
	var altura  = ( 74 * largura ) / 100;	
	$('#objeto').css('height', Math.round(altura+10) + 'px');
	
	var largura = $('#img_teste').width();
	var altura  = ( 74 * largura ) / 100;	
	$('#img_teste').css('height', Math.round(altura+10) + 'px');
	
	$('.tema').click(function(){
		var idTema = $(this).attr('id');
		$('#img_teste').css('display','none'); 
		$('#objeto').attr('src','Objetos/'+idTema+'/index.html').css({'display':'block','height':'581px'}); 
		risizeObj();
	});
	
	
	$("#mn_livros").click(function(){
		if ($(window).width() < 769){
			$("#sbm_exercicios").toggle('slow');
		}
		return false;
	})
	
	
});

function risizeObj(){
	var largura = $('#objeto').width();
    var altura  = ( 74 * largura ) / 100;	
    $('#objeto').css('height', Math.round(altura+10) + 'px');
}
