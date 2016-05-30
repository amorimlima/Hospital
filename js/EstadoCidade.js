/*Funçoes que manipula as combo-box de estado e cidade*/
function listarEstadoCidade(id){	//Recebe o id do select
	var estados= new Array();
	var HtmlContentEstados;
	$.ajax({
		type: "GET",
		async:false,
		crossDomain: true,		
		url: "js/estados&cidades.json",
		dataType: "json"			
		}).then(function(data) {
			for(var f=0;f<data['estados'].length; f++)
			{
				HtmlContentEstados += "<option value='"+data['estados'][f].sigla+"'>"+data['estados'][f].nome+"</option>";
			}
		});
	$("#"+id).html('<option value="" disabled selected>Selecione o estado</option>'+HtmlContentEstados);
}

function selectCidade(idEstado,idCidade){
	var HtmlContentCidades;
	var estado = $("#"+idEstado).val();
	var cidades	
	$.ajax({
		type: "GET",
		async:false,
		crossDomain: true,		
		url: "js/estados&cidades.json",
		dataType: "json"			
		}).then(function(data) { 			
			for(var h=0;h<data['estados'].length; h++)
			{										 
				if(data['estados'][h].sigla == estado){									
					cidades = data['estados'][h].cidades;
					for(var k=0;k<cidades.length; k++)
					{
						HtmlContentCidades += "<option value='"+cidades[k]+"'>"+cidades[k]+"</option>";
					}
				}			
			}		
		});
	$("#"+idCidade).html(HtmlContentCidades);	
}
/*Fim funções estado e cidade*/