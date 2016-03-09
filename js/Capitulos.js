$(document).ready(function (){

	var contador = 0;
	var qtd_total_obj = 


	$('.tema').click(function(){
		var classe = $(this).attr('class');		
		classe = classe.split(" ");
		$('.'+classe[2]).addClass('obj_icone_ativo');	
		
		var id = $(this).attr('id');
		var idTema = $(this).attr('url');
		var qtd_total_obj = $('#'+id).attr('qtd');

		contador ++;
		if(contador==qtd_total_obj){
			$('#btn_exercicio_5_parabens').css('display','none');
			$('#btn_exercicio_5_parabens_brilho').css('display','block');
		}

		
		$('#img_teste').css('display','none'); 
		$('#objeto').attr('src','Objetos/'+idTema+'/index.html').css({'display':'block'}); 

		console.log(idTema);

		risizeObj();

	});
});

function objectLength (object) {
	var key, count = 0;

	for(key in object)
	  if(object.hasOwnProperty(key))
	    count++;

	return count;
}