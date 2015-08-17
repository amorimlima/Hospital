$(document).ready(function (){
    var url = window.location.href;
	var retorno = url.split("/"); 	
	retorno = retorno[4].split("?"); 
	
	var obj='';
	$('#img_teste').css('display','none'); 
	switch (retorno[1]){
		case 'ano_1':
			obj = 'HCB_1o_5cap/1_Introducao_Pratinha';
		break;
		case 'ano_2':
			obj = 'HCB_2o_5cap/0_Introducao_Pratinha';
		break;
		case 'ano_3':
			obj = 'HCB_3o_5cap/0_Introducao_Pratinha';
		break;
		case 'ano_4':
			obj = 'HCB_4o_5cap/0_Introducao_Pratinha';
		break;
		case 'ano_5':
			obj = 'HCB_5o_5cap/0_Introducao_Pratinha';
		break;
	} 
	$('#objeto').attr('src','Objetos/'+obj+'/index.html').css({'display':'block','height':'581px'});
});
        
       