<?php 
require_once '_loadPaths.inc.php';
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['template'].'Template.php');
include_once($path['template'].'TemplateAreaAluno.php');
$templateGeral = new Template();
$templateAreaAluno = new TemplateAreaAluno();
?>

<!doctype html>
<html>
    <head>
    	<meta charset="utf-8">
   	<title>home</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/areaAluno.css">
        <!--<script src="//use.typekit.net/rtp0aku.js"></script>
		<script>try{Typekit.load();}catch(e){}</script>        
        <script src="js/ScaleScript.js"></script>   -->         
    </head>    
<body>
	<!--Conteudo Geral-->
    <div id="Container">
    	<!--Topo-->
    	<div id="topo">        	
            <?php 
				$templateGeral->topoSite();
			?> 
        </div>
        <!--Conteudo Central-->
        <div id="Conteudo_Area"> 
        	<!--Area Duas colunas Media e Pequena-->         
            <div id="Conteudo_Area_box_left">
            	
            </div>      
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
        <div id="rodape"></div>
    </div>
</body>
</html>