$(document).ready(function (){
    var url = window.location.href;
	var retorno = url.split("/"); 	
	retorno = retorno[4].split("?"); 
	
	var obj='';
	var qtd_total_obj=0;
	switch (retorno[1]){
		case 'ano_1':{
			obj = 'HCB_1o_5cap/1_Introducao_Pratinha';
			$('.linha_atividade1').css('display','block');
			qtd_total_obj = 20;
		break;
		}
		case 'ano_2':{
			obj = 'HCB_2o_5cap/0_Introducao_Pratinha';
			$('.linha_atividade2').css('display','block');
			qtd_total_obj = 14;		
		break;
		}
		case 'ano_3':{
			obj = 'HCB_3o_5cap/0_Introducao_Pratinha';	
			$('.linha_atividade3').addClass('aparecer_mapa');
			qtd_total_obj = 15;	
		break;
		}
		case 'ano_4':{
			obj = 'HCB_4o_5cap/0_Introducao_Pratinha';
			$('.linha_atividade4').addClass('aparecer_mapa');
			qtd_total_obj = 15;		
		break;
		}
		case 'ano_5':{
			obj = 'HCB_5o_5cap/0_Introducao_Pratinha';
			$('.linha_atividade5').addClass('aparecer_mapa');
			qtd_total_obj = 15;
		break;
		}
	} 
	$('#objeto').attr('src','Objetos/'+obj+'/index.html').css({'display':'block'});
	
	var contador = 0;
	$('.tema').click(function(){
		var classe = $(this).attr('class');		
		classe = classe.split(" ");
		$('.'+classe[2]).addClass('obj_icone_ativo');	
		contador +=1;
		if(contador==qtd_total_obj){
			$('#btn_exercicio_5_parabens').css('display','none');
			$('#btn_exercicio_5_parabens_brilho').css('display','block');
		}
	});		
});
      
       