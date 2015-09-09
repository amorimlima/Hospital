<?php 
session_start();

if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}

// if(!isset($_SESSION['USR'])){
   // header("location:index.php");
   // die();
// }
$path = $_SESSION['PATH_SYS'];
include_once($path['template'].'Template.php');
$templateGeral = new Template();

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Home</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/areaAluno.css">
    <link href='http://fonts.googleapis.com/css?family=Overlock:400,400italic,700,900,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,700,600italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div id="container">
        <div class="row">
        	<?php 
				$templateGeral->topoSite();
			?>      
        </div>
        <div id="Conteudo_Area">            
            <div class="row">
               <div class="col-xs-12 col-md-12 col-lg-8">
               		<div  id="Conteudo_Area_box_left">
                        <a href="#">
                            <!--<iframe id="objeto" src="Objetos/HCB_1o_5cap/4_Atividade_Quarto2/index.html" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" msallowfullscreen="true" width="100%" height="100%"></iframe>-->
                        	<img src="img/abertura_Ca.png" alt="" id="img_teste" class="img-responsive"/>   	
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12 col-lg-4">
                	<!--<div id="box_data">
                        <p id="aba_data"><img src="img/calendario_dia.png"></p>
                        <div id="aba_calendario"></div>
                    </div>-->
                	<div id="Conteudo_Area_box_right">
                        <div id="box_right_1">
                            <p id="box_right_1_img"></p>
                            <div class="box_right_box">
                                <p id="box_right_1_box_titulo_1">CATEGORIA</p>
                                <p class="box_right_1_box_select">
                                    <select id="categoria">
                                        <option value="-1"></option>
                                    </select>
                                </p>
                                <p id="box_right_1_box_titulo_2">ASSUNTO</p>
                                <p class="box_right_1_box_select">
                                    <select id="assunto">
                                        <option value="-1"></option>
                                    </select>
                                </p>
                            </div>
                        </div>
                        <div id="box_right_2">
                            <p id="box_right_2_img"></p>
                            <div class="box_right_box">
                                <table id="tb_mensagens">
                                  <thead>
                                    <tr>
                                      <th>REMETENTE</th>
                                      <th>ASSUNTO</th>
                                      <th>DATA</th>
                                    </tr>
                                  <thead>
                                  <tbody>
                                    <tr id="n_lida">
                                      <td>Laura Sampaio</td>
                                      <td>Aula 12</td>
                                      <td>02/03/2015</td>
                                    </tr>
                                    <tr>
                                      <td>Talita Lourenço</td>
                                      <td>Reposição</td>
                                      <td>02/03/2015</td>
                                    </tr>
                                    <tr>
                                      <td>Maurício Santos</td>
                                      <td>Dúvida ex.03</td>
                                      <td>01/03/2015</td>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="box_right_3">
                            <p id="box_right_3_img"></p>
                            <div class="box_right_box_mv">
                                <div class="mv_caixa mv_video">
                                    <p class="mv_icone_video"></p>
                                    <p class="mv_texto">
                                        Conheça os perigos da sua...
                                    </p>
                                </div>
                                <div class="mv_caixa mv_foto">
                                    <p class="mv_icone_foto"></p>
                                    <p class="mv_texto">
                                        Parques ecológicos
                                    </p>
                                </div>
                                <div class="mv_caixa mv_jogo">
                                    <p class="mv_icone_jogo"></p>
                                    <p class="mv_texto">
                                        Reciclagem - O Jogo
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="row" id="rodape"></div>
        </footer>
    </div>    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/funcoes.js"></script>
  </body>
</html>