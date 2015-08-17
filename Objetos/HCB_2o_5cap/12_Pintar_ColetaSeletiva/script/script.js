var fs;
var CanContinue = false;
var CanFinalize = false;
var Fim = false;

window.onresize=function(){resize()};

// Botão confirmar
window.onload = function() {
	//document.getElementById('bt_confirmar').style.right = '28px';
	fs = 1;
	resize();
	initPratinha();
}

$('#CanvasDraw').click(function(){
	$('#bt_confirmar').css('right','25px');
	CanFinalize = true;
});


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

function initPratinha()
{
	$('#pratinha_ativo').css('bottom','28px');
	$('.Texto_1').css('bottom','75px');
}

$('#pratinha_next').click(function(){
	if(!Fim)
	{	
		if(!CanContinue)
		{
			$('#pratinha_ativo').css('bottom','-300px');
			$('.Texto_1').css('bottom','-347px');
			$('#pratinha_inativo').css('left','28px');
			$('#CanvasDraw').css('pointer-events','auto');
			$(function() {
				$('#CanvasDraw').sketch({defaultColor: "#fab521"});
			});
			CanContinue = true;
		} else {
			$('#pratinha_ativo').css('bottom','-300px');
			$('.Texto_1').css('bottom','-347px');
			$('#pratinha_inativo').css('left','25px');
			$('#CanvasDraw').css('pointer-events','auto');
			if(CanFinalize)
			{
				$('#bt_confirmar').css('right','25px');	
			}
		}
	
	} else {

		
		$('#pratinha_ativo').css('bottom','-300px');
		$('.Texto_2').css('bottom','-347px');
		window.setTimeout(function(){ window.location="../13_Avaliacao_Final/index.html"; },1000);
	}
});

$('#pratinha_inativo').click(function(){
	$('#pratinha_inativo').css('left','-100px');
	$('#pratinha_ativo').css('bottom','28px');
	$('.Texto_1').css('bottom','75px');
	$('#CanvasDraw').css('pointer-events','none');
	if(CanFinalize)
	{
		$('#bt_confirmar').css('right','-100px');	
	}
});

function FinalizaAtividade()
{
	Fim = true;
	$('#pratinha_inativo').css('left','-100px');
	$('#pratinha_ativo').css('bottom','28px');
	$('.Texto_2').css('bottom','68px');
	$('#CanvasDraw').css('pointer-events','none');
	$('#bt_confirmar').css('right','-100px');
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
}

function voltaAjuda() {
	document.getElementById('telaAjuda').style.top = '-250px';
}



var size = 3;

function aumentarTamanho()
{
	size+=5;
	$('#Aumentar').attr('data-size',size);
}

function diminuirTamanho()
{
	if(size > 10){
		size-=5;
		$('#Diminuir').attr('data-size',size);
	}
}


function SaveIMG()
{
	$('.Texto').hide();
	$('#download').hide();
	$('#download').hide();
	$('#bt_Fs').hide();
	$('#bt_ajuda').hide();
	$('#bt_confirmar').hide();
	$('#telaAjuda').hide();
	$('#fecharAjuda').hide();
	$('#pratinha_ativo').hide();
	$('#pratinha_next').hide();
	$('#pratinha_inativo').hide();
	$('#GradePNG').css("background-image","url('img/para_colorir_reciclagem_alpha.png')")
	window.setTimeout(function(){
	    html2canvas(document.getElementById('container'), {
	      onrendered: function(canvas) {
	        window.open(canvas.toDataURL("image/png"), '_blank');
	      }
	    });
	},500);

	window.setTimeout(function(){
	$('.Texto').show();
	$('#download').show();
	$('#download').show();
	$('#bt_Fs').show();
	$('#bt_ajuda').show();
	$('#bt_confirmar').show();
	$('#telaAjuda').show();
	$('#fecharAjuda').show();
	$('#pratinha_ativo').show();
	$('#pratinha_next').show();
	$('#pratinha_inativo').show();
	$('#GradePNG').css("background-image","url('img/pincel_grande.png'), url('img/pincel_medio.png'), url('img/pincel_pqno.png'), url('img/amarelo.png'), url('img/azul.png'), url('img/marrom.png'), url('img/verdeClaro.png'), url('img/verdeEscuro.png'), url('img/vermelho.png'), url('img/menu.png'), url('img/para_colorir_reciclagem_alpha.png')")
	},1000);
}