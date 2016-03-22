<?php 

if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}
//echo '<pre>';
//print_r($_SESSION);
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
        <title>Nome da página</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" hreg="css/cadastroAluno.css">
        <link href='http://fonts.googleapis.com/css?family=Overlock:400,400italic,700,900,700italic,900italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,700,600italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="js/malihu.3.0.3/mCustomScrollbar.css" />
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>    
<body>
	<!--Conteudo Geral-->
    <div id="container">
    	<!--Topo-->
    	<div class="row">
            <?php 
				$templateGeral->topoSite();
			?>      
        </div>
        <!--Conteudo Central-->
        <div id="Conteudo_Area">
            <div class="row">
                <div class="row">
                   <div class="col-xs-12 col-md-8 col-lg-8">               
                        <div id="Conteudo_Area_box_left">
                           
                           <div>
                           <form action="Script_do_Formulario.php" method="post">

<!-- DADOS PESSOAIS-->
<fieldset>
 <legend>Dados Pessoais</legend>
 <table cellspacing="12">
  <tr>
      <td>
          <label for="usr_id">ID:</label>
      </td>
      <td align="left">
          <input type="text" name="usr_id" size=19 maxlength=7>
      </td>
  </tr>
  <tr>
   <td>
    <label for="usr_nome">Nome: </label>
   </td>
   <td align="left">
    <input type="text" name="usr_nome" size=19 maxlength=200>
   </td>
  </tr>
  <tr>
   <td>
    <label for="usr_data_nasimento">Nascimento: </label>
   </td>
   <td align="left">
       <input type="date" name="usr_data_nascimento" size=20>
   </td>
  </tr>
  <tr>
 </table>
</fieldset>
<br />
<!-- ENDEREÇO -->
<fieldset>
 <legend>Dados de Endereço</legend>
 <table cellspacing="10">

  <tr>
   <td>
    <label for="usr_rua">Rua:</label>
   </td>
   <td align="left">
    <input type="text" name="usr_rua" size="19" maxlength=200>
   </td>
   <td>
    <label for="usr_numero">Numero:</label>
   </td>
   <td align="left">
       <input type="text" name="usr_numero" size="4" maxlength=200>
   </td>
  </tr>
  <tr>
   <td>
    <label for="usr_bairro">Bairro: </label>
   </td>
   <td align="left">
    <input type="text" name="usr_bairro" size="19">
   </td>
  </tr>
  <tr>
   <td>
    <label for="usr_estado">Estado:</label>
   </td>
   <td align="left">
    <select name="usr_estado">
        <option vale="none"></option>
    <option value="ac">Acre</option> 
    <option value="al">Alagoas</option> 
    <option value="am">Amazonas</option> 
    <option value="ap">Amapá</option> 
    <option value="ba">Bahia</option> 
    <option value="ce">Ceará</option> 
    <option value="df">Distrito Federal</option> 
    <option value="es">Espírito Santo</option> 
    <option value="go">Goiás</option> 
    <option value="ma">Maranhão</option> 
    <option value="mt">Mato Grosso</option> 
    <option value="ms">Mato Grosso do Sul</option> 
    <option value="mg">Minas Gerais</option> 
    <option value="pa">Pará</option> 
    <option value="pb">Paraíba</option> 
    <option value="pr">Paraná</option> 
    <option value="pe">Pernambuco</option> 
    <option value="pi">Piauí</option> 
    <option value="rj">Rio de Janeiro</option> 
    <option value="rn">Rio Grande do Norte</option> 
    <option value="ro">Rondônia</option> 
    <option value="rs">Rio Grande do Sul</option> 
    <option value="rr">Roraima</option> 
    <option value="sc">Santa Catarina</option> 
    <option value="se">Sergipe</option> 
    <option value="sp">São Paulo</option> 
    <option value="to">Tocantins</option> 
   </select>
   </td>
  </tr>
  <tr>
   <td>
    <label for="usr_cidade">Cidade: </label>
   </td>
   <td align="left">
    <input type="text" name="usr_cidade" size="19">
   </td>
  </tr>
  <tr>
   <td>
    <label for="usr_cep">CEP: </label>
   </td>
   <td align="left">
    <input type="text" name="usr_cep" size="5" maxlength="5"> - <input type="text" name="cep2" size="3" maxlength="3">
   </td>
  </tr>
 </table>
</fieldset>
<br />

<!-- DADOS DA ESCOLA -->

<fieldset>
    <legend>Dados da Escola</legend>
    <table cellspacing="10">
    <tr>
   <td>
    <label for="usr_escola">Escola: </label>
   </td>
   <td align="left">
    <input type="text" name="usr_escola" size="19">
   </td>
  <tr>
   <td>
    <label for="usr_data_entrada_escola">Matricula: </label>
   </td>
   <td align="left">
       <input type="date" name="usr_data_entrada_escola" size="19">
   </td>
  </tr>
  <tr>
      <td>
  <label for="usr_nse">Série</label> 
    </td>
    <td align="left">
        <input type="text" name="_nse" size="19">
    </td>
  </tr>
  </table>
</fieldset>

<!-- DADOS DE LOGIN -->
<fieldset>
 <legend>Dados de login</legend>
 <table cellspacing="10">
     <tr>
   <td>
    <label for="usr_perfil">Perfil do usuário: </label>
   </td>
   <td align="left">
       <input type="text" name="usr_perfil" size=19 maxlength=11>
   </td>
  </tr>
  <tr>
   <td>
    <label for="usr_login">Login de usuário: </label>
   </td>
   <td align="left">
    <input type="text" name="usr_login" size="19">
   </td>
  </tr>
  <tr>
   <td>
    <label for="usr_senha">Senha: </label>
   </td>
   <td align="left">
    <input type="password" name="usr_senha" size="19">
   </td>
  </tr>
 </table>
</fieldset>
<br />
<input type="submit">
<input type="reset" value="Limpar">
</form>
                       </div>
                        </div>
                   </div>
                   <div class="col-xs-12 col-md-8 col-lg-4">     
                        <div id="Conteudo_Area_box_right">				                         
                        </div>   
                                              
                    </div>
                </div>
            </div>              	
        </div>
        <footer>
        <?php
            $templateGeral->rodape();
        ?>
        </footer>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/malihu.3.0.3/mCustomScrollbar.js"></script>
    <script src="js/malihu.3.0.3/mCustomScrollbar.concat.min.js"></script>	
    <script src="js/funcoes.js"></script>

</body>
</html>