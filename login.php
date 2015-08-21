<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Login</title>
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<!-- -->
<script type="text/javascript">
$(document).ready(function(){
	
	$("#btLogar").click(function(){
		$("#result").html('').removeClass();
		var user = $("#usuario").val();
		var senha = $("#senha").val();
		//alert(senha);
		if(user != "" && senha != ""){
			$.ajax({
				url:'auth.php',
				type:'post',
				dataType:'json',
				data:{'usuario':user,'senha':senha},
				success:function(data){
					alert(data.msg);
//					if(data.erro){
//						//$("#result").addClass('alert').html(data.msg);
//						}else{
//							window.location  = data.url;
//							}
					}
				});
			}else{
				$("#result").addClass('alert').html("Os campos são obrigatórios");
				}
			return false;
		});
		
});
</script>
</head>
<body>
	Login:<input type="text" class="form-actions" name="usuario" id="usuario"/><br>
	Senha:<input type="pass" class="form-actions" name="senha" id="senha"/><br>
	<button class="btn btn-primary" id="btLogar" type="button">Logar</button>
</body>
</html>