<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'MapaController.php');
include_once($path['beans'].'Mapa.php');
include_once($path['sys'].'Nav/Navigator.php');
$cidade = $_SESSION['CIDADE'];
$idMapa = $_GET["id"];	
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
            <li><a href="../evento/evento.php">Eventos</a></li>
            <li><a href="../galeria/galeriaFotos.php"> Galeria de Fotos</a></li>
            <li><a href="../patrocinio/patrocinio.php">Patrocinios</a></li>
            <li><a href="../pontoTuristico/pontoTuristico.php">Ponto Turístico</a></li>
            <li><a href="../mapa/mapa.php">Mapa</a></li>
            <li><a href="../../Auth/doLogout.php">Sair</a></li>
        </ul>
    </div>
    <?php 
		$mapaController = new MapaController();	  
	   	$listaMapa = $mapaController->selectMapa($idMapa);	
	?>
	<div id="corpo">
 		<form action="doUpdateMapaExe.php?id=<?php echo $listaMapa->getIdMapa();?>&icone=<?php echo $listaMapa->getIconeMapa();?>&img_mapa=<?php echo $listaMapa->getImgMapa();?>" method="post" enctype="multipart/form-data">
        <div id="formulario">
        	<table width="763" border="0" >
              <tr>
                <td colspan="2" align="left" height="28"><strong>
                  <p>EDITAR MAPA</p></strong></td>
              </tr>
              <tr>
                <td colspan="2" height="10"></td>
              </tr>
              <tr>
                <td width="150" height="20"  align="right"><strong>Endereço:</strong></td>
                <td width="603" height="20">
                  <input name="endereco_mapa" type="text" size="50" value="<?php echo $listaMapa->getEnderecoMapa();?>"/>
                </td>
              </tr>
              <tr>
                <td height="20" align="right"><strong>Icone Mapa: </strong></td>
                <td height="20">
                <input type="file" name="icone" /></td>
              </tr>
              <tr>
                <td height="20" align="right" valign="top"><strong>Imagem Mapa:</strong></td>
                <td height="20">
                  <input type="file" name="img_mapa" /></td>
              </tr>
               <tr>
                <td height="20" align="right" valign="top"><strong>Texto:</strong></td>
                <td height="20">
                  <textarea name="texto_mapa" cols="45" rows="5"><?php echo $listaMapa->getTextoMapa();?></textarea></td>
              </tr>
              <tr>
                <td colspan="2" height="10"></td>
              </tr>
              <tr>
                <td align="left" height="28">&nbsp;</td>
                <td align="left" height="28">
                	<input type="submit" name="button" id="button" value="SALVAR" /></td>
              </tr>
            </table>
        </div>    
        </form>        
    </div>        
</div>	 
</body>
</html>