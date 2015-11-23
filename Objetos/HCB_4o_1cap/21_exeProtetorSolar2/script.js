var fs;
var gamestate = 0;
var falaPratinha = 1;

var ajudaAtiv = false;

var Anterior1;
var Anterior2;

var Created = false;

var inputText = document.getElementsByTagName('input');

var Corretos = [0,0,0,0];

var Direcoes = {
	'Um' : [0,1,2,3,4,5],
	'Dois' : [9,10,11,12,13,14,15,16,17,18,19,20,21],
	'Tres' : [23,24,25,26],
	'A' : [3,6,7,8,15,22,24,27]
};

 
 

window.onresize=function(){resize()};

// Botão confirmar
window.onload = function() {
	fs = 1;
	resize();
	initPratinha();
	
}


function initPratinha()
{
	
	UpFalas();
}

// Fullscreen
function reqFs() {
	switch (fs){
		case 1:
			document.getElementById('bt_Fs').style.backgroundImage = "url('img/bt_diminuir2.png')";
			launchIntoFullscreen(document.documentElement);
			fs = 0;
			break;
		case 0:
			document.getElementById('bt_Fs').style.backgroundImage = "url('img/bt_aumentar2.png')";
			exitFullscreen();
			fs = 1;
			break;
	}
}

function launchIntoFullscreen(element) {
  if(element.requestFullscreen) {
    element.requestFullscreen();
  } else if(element.mozRequestFullScreen) {
    element.mozRequestFullScreen();
  } else if(element.webkitRequestFullscreen) {
    element.webkitRequestFullscreen();
  } else if(element.msRequestFullscreen) {
    element.msRequestFullscreen();
  }
}

function exitFullscreen() {
  if(document.exitFullscreen) {
    document.exitFullscreen();
  } else if(document.mozCancelFullScreen) {
    document.mozCancelFullScreen();
  } else if(document.webkitExitFullscreen) {
    document.webkitExitFullscreen();
  }
}

// Ajuda
function chamarAjuda() {
	document.getElementById('telaAjuda').style.top = '277px';
	ajudaAtiv=true;
	$('#Cruzadinha_back').css('pointer-events','none');
	$('#pratinha_inativo').css('pointer-events','none');
	$('#pratinha_ativo').css('pointer-events','none');
}

function voltaAjuda() {
	document.getElementById('telaAjuda').style.top = '-250px';
	ajudaAtiv=false;
	$('#Cruzadinha_back').css('pointer-events','all');
	$('#pratinha_inativo').css('pointer-events','all');
	$('#pratinha_ativo').css('pointer-events','all');
}

function confirmar() {
	document.getElementById('bt_confirmar').style.right = '-100px';
	setTimeout (function() {window.location.href = '../22_posProtetorSolar/index.html';}, 1000)
}

function TrocaFala()
{
	if(gamestate ==0)
	{
		if(falaPratinha == 1 && !Created)
		{
			loadCruzadinha();
			$('#Cruzadinha_back').css('left','0px');
			Created = true;
		}
		
		DownFalas();
	} else if(gamestate == 1)
	{
		
		DownFalas();
		setTimeout (function() {window.location.href = '../22_posProtetorSolar/index.html';}, 1000)
		
	}
}

function UpFalas()
{
	$('#pratinha_ativo').css('bottom','24px');
	for(var a=1; a<15; a++)
	{
		$('#Texto'+a).css('bottom','0px');
	}
	$('#pratinha_inativo').css('left','-100px');
	$('#bt_ajuda').css('pointer-events','none');
}

function DownFalas()
{
	$('#pratinha_ativo').css('bottom','-300px');
	for(var a=1; a<15; a++)
	{
		$('#Texto'+a).css('bottom','-324px');
	}
	if(gamestate == 0){$('#pratinha_inativo').css('left','25px');}
	$('#bt_ajuda').css('pointer-events','all');
}

function ClickedPratinhaInativo()
{
	//if(gamestate == 0 ) 
	//{
		//$('#Texto'+falaPratinha).css('opacity','0');
		//falaPratinha = 0;
		//$('#Texto'+falaPratinha).css('opacity','1');
		//$('#Dica').css('left','0px');
		//$('#Cruzadinha_back').css('left','1024px');
	//}

	UpFalas();
}

function loadCruzadinha()
{
	for(var a=0; a<ArrayLocais.length; a++)
	{
		for(var b=0; b<ArrayLocais[a].length;b++)
		{
			if(ArrayLocais[a][b] == 1)
			{
				document.getElementById('Cruzadinha_back').innerHTML += "<div class='containTextbox' style='top:"+((a*47.5)+255)+"px;left:"+((b*49.5)+217)+"px;'><input maxlength='1' type='text' /></div>";
			}
		}
	}

	var x = inputText;
	var inputList = Array.prototype.slice.call(inputText)

	for(var d=0; d<inputText.length; d++)
	{
		inputList[d].addEventListener("keypress",clearTextbox.bind(false, d),false);
		inputList[d].addEventListener("keypress",nextTextbox.bind(false, d),false);
		inputList[d].addEventListener("click",function(){Anterior2=0;Anterior1=0;});
	}

	window.setInterval(function(){ if(gamestate == 0){VerificaResposta();};},100);

}

function clearTextbox(numero)
{
	if(!inputText[numero].readOnly)
	{
		inputText[numero].value="";
	}
}

function nextTextbox(numero)
{
	//console.log(numero);

	Anterior2 = Anterior1;
	Anterior1 = numero;

	

	for(var a=0; a< Direcoes.A.length-1; a++)
	{
		if((Direcoes.A[a] == 22 || Direcoes.A[a] == 8) && inputText[Direcoes.A[a+1]].readOnly )
		{
			if(numero == Direcoes.A[a]){inputText[Direcoes.A[ProcuraEditavel("A",a)]].focus();}
		} else {
			if(numero == Direcoes.A[a]){inputText[Direcoes.A[a+1]].focus();}
		}
	}



	for(var a=0; a< Direcoes.Tres.length-1; a++)
	{
		//if(Direcoes.Tres[a] != 24)
		//{
		//	if(numero == Direcoes.Tres[a]){inputText[Direcoes.Tres[a+1]].focus();}
		//} else {
			if(Anterior2 != 22)
			{
				if(numero == Direcoes.Tres[a] && !inputText[Direcoes.Tres[a+1]].readOnly){inputText[Direcoes.Tres[a+1]].focus();}
				else if(numero == Direcoes.Tres[a] && inputText[Direcoes.Tres[a+1]].readOnly){inputText[Direcoes.Tres[ProcuraEditavel("Tres",a)]].focus();}
			}
		//}
	}


	for(var a=0; a< Direcoes.Dois.length-1; a++)
	{
		//if(Direcoes.Dois[a] != 15)
		//{
		//	if(numero == Direcoes.Dois[a]){inputText[Direcoes.Dois[a+1]].focus();}
		//} else {
			if(Anterior2 != 8)
			{
				if(numero == Direcoes.Dois[a] && !inputText[Direcoes.Dois[a+1]].readOnly){inputText[Direcoes.Dois[a+1]].focus();}
				else if(numero == Direcoes.Dois[a] && inputText[Direcoes.Dois[a+1]].readOnly){inputText[Direcoes.Dois[ProcuraEditavel("Dois",a)]].focus();}
			}
		//}
	}



	for(var a=0; a< Direcoes.Um.length-1; a++)
	{
		if(numero == Direcoes.Um[a] && !inputText[Direcoes.Um[a+1]].readOnly){inputText[Direcoes.Um[a+1]].focus();}
		else if(numero == Direcoes.Um[a] && inputText[Direcoes.Um[a+1]].readOnly){inputText[Direcoes.Um[ProcuraEditavel("Um",a)]].focus();}
	}



	/*else{
		inputText[numero+1].focus();
	}*/
	
}



function VerificaResposta()
{

	var localUm ="";
	for(var a=0; a<Direcoes.Um.length; a++)
	{
		localUm+=inputText[(Direcoes.Um[a])].value;
	}

	var localDois ="";
	for(var a=0; a<Direcoes.Dois.length; a++)
	{
		localDois+=inputText[(Direcoes.Dois[a])].value;
	}

	var localTres ="";
	for(var a=0; a<Direcoes.Tres.length; a++)
	{
		localTres+=inputText[(Direcoes.Tres[a])].value;
	}

	var localA ="";
	for(var a=0; a<Direcoes.A.length; a++)
	{
		localA+=inputText[(Direcoes.A[a])].value;
	}

	

	var resUm = localUm.toUpperCase();
	if(resUm == "CHAPÉU"){Desabilitar('Um');}

	var resDois = localDois.toUpperCase();
	if(resDois == "ÓCULOSESCUROS"){Desabilitar('Dois');}

	var resTres = localTres.toUpperCase();
	if(resTres == "BONÉ"){Desabilitar('Tres');}

	var resA = localA.toUpperCase();
	if(resA == "PROTETOR"){Desabilitar('A');}

	
}

function Desabilitar(Escolha)
{

	if(Escolha == 'Um')
	{
		for(var a=0; a<Direcoes.Um.length; a++)
		{
			inputText[(Direcoes.Um[a])].readOnly = true;
			inputText[(Direcoes.Um[a])].style.color = '#248d66';
			Corretos[0] = 1;
		}
	}

	if(Escolha == 'Dois')
	{
		for(var a=0; a<Direcoes.Dois.length; a++)
		{
			inputText[(Direcoes.Dois[a])].readOnly = true;
			inputText[(Direcoes.Dois[a])].style.color = '#248d66';


			Corretos[1] = 1;
		}

		//inputText[28].value = "Ó";
		//inputText[41].value = "Ç";
		//inputText[42].value = "Ã";
	}

	if(Escolha == 'Tres')
	{
		for(var a=0; a<Direcoes.Tres.length; a++)
		{
			inputText[(Direcoes.Tres[a])].readOnly = true;
			inputText[(Direcoes.Tres[a])].style.color = '#248d66';
			Corretos[2] = 1;
		}
	}


	if(Escolha == 'A')
	{
		for(var a=0; a<Direcoes.A.length; a++)
		{
			inputText[(Direcoes.A[a])].readOnly = true;
			inputText[(Direcoes.A[a])].style.color = '#248d66';


			Corretos[3] = 1;
		}
	}



	if(Corretos[0] == 1 && 
		Corretos[1] == 1 &&
		Corretos[2] == 1 &&
		Corretos[3] == 1)
	{
		gamestate = 1;
		$('#Texto'+falaPratinha).css('opacity','0');
		falaPratinha = 2;
		$('#Texto'+falaPratinha).css('opacity','1');
		UpFalas();
	}

}



function ProcuraEditavel(palavra, numero)
{

	var saveChoose;

	switch(palavra)
	{
		case "A":
			saveChoose = Direcoes.A;
		break;
		case "Tres":
			saveChoose = Direcoes.Tres;
		break;
		case "Dois":
			saveChoose = Direcoes.Dois;
		break;
		case "Um":
			saveChoose = Direcoes.Um;
		break;
	}


	for(var a=numero+1; a!=numero; a++)
	{
		console.log(a);
		if(a == saveChoose.length){a = 0;}

		if(!inputText[(saveChoose[a])].readOnly){ return a; }
	}
}