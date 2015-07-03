<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['beans'].'FotoEvento.php');
include_once($path['controller'].'FotoEventoController.php');
include_once($path['sys'].'Nav/Navigator.php');
include_once($path['template'].'Template.php');
$cidade = $_SESSION['CIDADE'];	
$idEvento = $_GET["id"];
$template = new Template();	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Categoria</title> 
<link href="../../../css/jquery.tabs-ie.css" rel="stylesheet" type="text/css" />
</head>
<body id="adm">
	<div id="topo"></div>
    <div id="menu">
    	<ul>
        	<li><a href="../categoria/categoria.php">Categoria</a></li>
            <li><a href="evento.php">Eventos</a></li>
            <li><a href="../galeria/galeriaFotos.php"> Galeria de Fotos</a></li>
            <li><a href="../patrocinio/patrocinio.php">Patrocinios</a></li>
            <li><a href="../pontoTuristico/pontoTuristico.php">Ponto Turístico</a></li>
            <li><a href="../mapa/mapa.php">Mapa</a></li>
            <li><a href="../../Auth/doLogout.php">Sair</a></li>
        </ul>
    </div>
	<div id="corpo">
        <form id="foto"  method="post" action="doAddFotoEventoExe.php?id=<?php echo $idEvento?> " enctype="multipart/form-data">
          <table width="438" cellpadding="2" cellspacing="2">
            <tr>
              <td width="139" align="right">Nova Foto: </td>
              <td width="248" align="left"><input name="img" type="file" /></td>
              <td width="91" align="right"><input type="submit" name="button" id="button" value="SALVAR" /></td>
            </tr>
          </table>
        </form>
        <?php 
			$template->listaFotoEventosByEvento($idEvento);
		?>        
</body>
</html>