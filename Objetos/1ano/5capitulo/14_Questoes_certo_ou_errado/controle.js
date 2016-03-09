var tempoInicioExercicio;
var tempoFinalExercicio;
var usuarioLogado;
var exercicioAtual;
var tempo;
var startDate;


function getUsuario(){
	
	$(function(){
		$.ajax({
			url:'../acoes.php',
			type:'post',
			dataType:'json',
			data:{
				'acao':'getUsuario'
				},
			success:function(data){
				if(!data.erro){
					//console.log(data.usuario);
					usuarioLogado = data.usuario;
					console.log("Usuario: "+usuarioLogado);
				}
			}
		});
	});
		return (usuarioLogado);
	}	

function getExercicio(parametro){
	exercicioAtual = parametro;
	startTimer();
	tempo = convertTotalSeconds(startDate);
	//console.log("Usuario: "+getUsuario());
	//usuarioLogado = getUsuario();
	console.log("Tempo: "+tempo);
	console.log("Exercicio: "+exercicioAtual);
	//console.log("Usuario: "+usuarioLogado);
}

function registraOpcaoResposta(exercicio,resposta,questao){
	$(function(){
	$.ajax({
		url:'../acoes.php',
		type:'post',
		dataType:'json',
		data:{
			'acao':'registraOpcaoResposta',
			'exercicio':exercicio,
			'resposta':resposta,
			'questao':questao},
		success:function(data){
			if(data.erro){
			alert("Ocorreu um erro em executar ação  do Exercício.");	
			}
		}
	});
	});
}

function acaoExercicio(exercicio,tipoAcao){
	$(function(){
	$.ajax({
		url:'../acoes.php',
		type:'post',
		dataType:'json',
		data:{
			'acao':'acaoExercicio',
			'exercicio':exercicio,
			'tipoacao':tipoAcao},
		success:function(data){
			if(data.erro){
			alert("Ocorreu um erro em executar ação  do Exercício.");	
			}
		}
	});
	});
}
function iniciaParticipacaoExercicio(exercicio){
	$(function(){
	$.ajax({
		url:'../acoes.php',
		type:'post',
		dataType:'json',
		data:{
			'acao':'iniciaExercicio',
			'exercicio':exercicio},
		success:function(data){
			if(data.erro){
			alert("Ocorreu um erro em executar ação  do Exercício.");	
			}
		}
	});
	});
}
function finalizaParticipacaoExercicio(exercicio){
	$(function(){
	$.ajax({
		url:'../acoes.php',
		type:'post',
		dataType:'json',
		data:{
			'acao':'finalizaExercicio',
			'exercicio':exercicio},
		success:function(data){
			if(data.erro){
			alert("Ocorreu um erro em executar ação  do Exercício.");	
			}
		}
	});
	});
}

function liberaExercicio(){
	$(function(){
	$.ajax({
		url:'../acoes.php',
		type:'post',
		dataType:'json',
		data:{
			'acao':'verificaExercicio',
			'usuario':usuarioLogado,
			'exercicio':exercicioAtual,
			'tempo':tempo},
		success:function(data){
			if(!data.erro){
				return true;
			}else{
				return false;
			}
		}
	});
	});
}

//-------------------------------------------------------------------------
function startTimer()
{
   startDate = new Date().getTime();
   console.log("funcao startDate "+startDate);
}

//---------------------------------------------------------------------------
function convertTotalSeconds(ts)
{
   var sec = (ts % 60);

   ts -= sec;
   var tmp = (ts % 3600);  //# of seconds in the total # of minutes
   ts -= tmp;              //# of seconds in the total # of hours

   // convert seconds to conform to CMITimespan type (e.g. SS.00)
   sec = Math.round(sec*100)/100;
   
   var strSec = new String(sec);
   var strWholeSec = strSec;
   var strFractionSec = "";

   if (strSec.indexOf(".") != -1)
   {
      strWholeSec =  strSec.substring(0, strSec.indexOf("."));
      strFractionSec = strSec.substring(strSec.indexOf(".")+1, strSec.length);
   }
   
   if (strWholeSec.length < 2)
   {
      strWholeSec = "0" + strWholeSec;
   }
   strSec = strWholeSec;
   
   if (strFractionSec.length)
   {
      strSec = strSec+ "." + strFractionSec;
   }


   if ((ts % 3600) != 0 )
      var hour = 0;
   else var hour = (ts / 3600);
   if ( (tmp % 60) != 0 )
      var min = 0;
   else var min = (tmp / 60);

   if ((new String(hour)).length < 2)
      hour = "0"+hour;
   if ((new String(min)).length < 2)
      min = "0"+min;

   var rtnVal = hour+":"+min+":"+strSec;

   return rtnVal;
}
//-------------------------------------------------------------------------------
