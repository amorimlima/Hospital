
var context = document.getElementById('CanvasDraw').getContext("2d");


function resize(){
    height = window.innerHeight,
   	width = window.innerWidth,
   	scale = Math.min(1,height/768,width/1024);
   	document.body.style['-webkit-transform'] = 'scale('+scale+')';
   	document.body.style['-ms-transform'] = 'scale('+scale+')';
   	document.body.style['-moz-transform'] = 'scale('+scale+')';
   	document.body.style['transform'] = 'scale('+scale+')';	    
   	document.body.style.width = ((width/scale).toString()+"px");
   	document.body.style.height =  ((height/scale).toString()+"px");
   	document.getElementsByTagName('html')[0].style.width = width+"px";
   	document.getElementsByTagName('html')[0].style.height = height+"px";

      context.scale(scale, scale);
      Savedangle = scale;
      context.setTransform(1, 0, 0, 1, 0, 0);
      //context.canvas.width  = 1024/scale;
      //context.canvas.height = 768/scale;
      //$('#CanvasDraw').attr('height',768*scale);
   	window.zoomScale = scale;
}

