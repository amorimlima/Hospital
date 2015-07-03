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
 		<form action="doAddCategoriaExe.php?categoria=<?php echo $_GET['categoria'];?>" method="post">
        <div id="formulario">
        	<table width="767" border="0" >
              <tr>
                <td colspan="2" align="left" height="28"><strong>
                <p>CADASTRO NOVO ARTESANATO</p></strong></td>
              </tr>
               <tr>
                <td colspan="2" height="10"></td>
              </tr>
              <tr>
                <td width="114" height="20"  align="right"><strong>Título:</strong></td>
                <td width="641" height="20">
                  <input name="tituloCategoria" type="text" id="tituloCategoria" size="50" />
                </td>
              </tr>
              <tr>
                <td height="20" align="right"><strong>Endereço: </strong></td>
                <td height="20">
                  <label for="endCategoria"></label>
                  <input type="text" name="endCategoria" id="endCategoria" size="50" />
                </td>
              </tr>
              <tr>
                <td height="20" align="right" valign="top"><strong>Telefone:</strong></td>
                <td height="20">
                  <label for="textarea">
                    <input type="text" name="telefoneCategoria" id="telefoneCategoria" size="50" />
                </label></td>
              </tr>
              <tr>
                <td colspan="2" height="10"><input name="categoria" type="hidden" id="categoria" value="gatronomia" /></td>
              </tr>
              <tr>
                <td align="left" height="28">&nbsp;</td>
                <td align="left" height="28">
                	<input type="submit" id="button" value="SALVAR" /></td>
              </tr>
            </table>
        </div>    
        </form>        
    </div>        
</div>	 
</body>
</html>