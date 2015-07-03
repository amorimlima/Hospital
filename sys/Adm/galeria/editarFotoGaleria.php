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
	<div id="corpo">
 		<form action="" method="post" enctype="multipart/form-data">
        <div id="formulario">
        	<table width="899" border="0" >
              <tr>
                <td colspan="2" align="left" height="28"><strong>
                <p>EDITAR<br>FOTO GALERIA</p></strong></td>
              </tr>
              <tr>
                <td colspan="2" height="2"></td>
              </tr>
              <tr>
                <td width="98" height="20"  align="right"><strong>Foto:</strong></td>
                <td width="791" height="20"><label for="select">
                  <input type="file" name="fileField" id="fileField" />
                </label></td>
              </tr>
              <tr>
                <td colspan="2" height="10"></td>
              </tr>
              <tr>
                <td align="left" height="28">&nbsp;</td>
                <td align="left" height="28"><input type="submit" name="button" id="button" value="SALVAR" /></td>
              </tr>
            </table>
        </div>    
        </form>        
</div>        
</div>	 
</body>
</html>