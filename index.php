<?php
require_once '_loadPaths.inc.php';
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Login</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />
<link href="css/index.css" rel="stylesheet" />

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
					if(data.erro == true){
						alert(data.msg);
						}else{
							window.location.href=data.url;
						}
					}
				});
			}else{
				alert('Os campos são obrigatórios!');
			}
			return false;
		});
		
});
</script>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="logo-container">
				<img src="img/logo/logo_lg.png">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">&nbsp;</div>
		<div class="col-md-4">
			<div class="login-panel-container">
				<div class="panel panel-default">
					<div class="panel-body">
						<form class="form center-block">
							<div class="form-group">
								<label for"usuario">USUÁRIO</label>
								<input type="text" class="form-control input-lg form-actions" name="usuario" id="usuario" value="hcbAluno">
							</div>
							<div class="form-group">
								<label for"usuario">SENHA</label>
								<input type="password" class="form-control input-lg form-actions" name="senha" id="senha" value="123">
							</div>
							<div class="form-group">
								<button class="btn btn-primary btn-lg" id="btLogar">Entrar</button>
							</div>
						  </form>
						  <div class="link">
						  	<a href="#">Esqueceu a senha?</a>
						  </div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="pratinha"></div>
		</div>
		<div class="col-md-2">&nbsp;</div>
	</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</html>