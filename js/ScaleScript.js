$(document).ready(function (){
   resize(); 
});

window.onresize = function(){resize();}

function resize(){
    height = window.innerHeight;
    width = window.innerWidth;
    scale = Math.min(1,height/800,width/1280);
    document.body.style['-webkit-transform'] = 'scale('+scale+')';
    document.body.style['-ms-transform'] = 'scale('+scale+')';
    document.body.style['-moz-transform'] = 'scale('+scale+')';
    document.body.style['transform'] = 'scale('+scale+')';	    
    document.body.style.width = ((width/scale).toString()+"px");
    document.body.style.height =  ((height/scale).toString()+"px");
    document.getElementsByTagName('html')[0].style.width = width+"px";
    document.getElementsByTagName('html')[0].style.height = height+"px";
    window.zoomScale = scale;
}

