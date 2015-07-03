<?php 
require_once '../../_loadPaths.inc.php';
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/jquery.tabs-ie.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#FFCC99">
<div class="login">
<form method="post" action="../Auth/doAuth.php">
    <table width="368" border="0" cellpadding="2" cellspacing="2" >
    <tr>
      <td height="224" colspan="2" align="center"><h1><img src="../../images/login.png" width="231" height="220" /></h1></td>
    </tr>
    <tr>
      <td width="82" height="25" align="right" >E-Mail:</td>
      <td width="272" height="25" align="left" ><input name="email" type="text" size="35"/>      </td>
    </tr>
    <tr>
      <td height="25" align="right" >Senha:</td>
      <td height="25" align="left" ><input name="senha" type="password" size="35"/>      </td>
    </tr>
     <tr>
       <td height="25" colspan="2" align="center" >
         <h2>
           <input type="hidden" name="login"  value="login"/>
           <input type="submit" class="btn" value=" ENTRAR "/>      
        </h2></td>
     </tr>
   </table>
</form>
</div>
</body>
</html>
