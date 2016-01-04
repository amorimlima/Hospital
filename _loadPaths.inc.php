<?php
session_start();

$system = "W"; // W ou L

if ($system == "W")
	$_PATH_SEPARATOR = '\\';  // Windows
else
	$_PATH_SEPARATOR = '/';  // Linux
//

if ($system == "W")
	$_LOAD_PATH_SYS['home']    = 'C:\\xampp\\htdocs\\Hospital\\'; // Windows
else
	$_LOAD_PATH_SYS['home']    = '/var/www/html/';


$_LOAD_PATH_SYS['sys']        = $_LOAD_PATH_SYS['home'].'sys'.$_PATH_SEPARATOR;
$_LOAD_PATH_SYS['DB']         = $_LOAD_PATH_SYS['sys'].'DB'.$_PATH_SEPARATOR;
$_LOAD_PATH_SYS['Adm']        = $_LOAD_PATH_SYS['sys'].'Adm'.$_PATH_SEPARATOR;
$_LOAD_PATH_SYS['Nav']        = $_LOAD_PATH_SYS['sys'].'Nav'.$_PATH_SEPARATOR;
$_LOAD_PATH_SYS['Auth']       = $_LOAD_PATH_SYS['sys'].'Auth'.$_PATH_SEPARATOR;
$_LOAD_PATH_SYS['beans']      = $_LOAD_PATH_SYS['home'].'beans'.$_PATH_SEPARATOR;
$_LOAD_PATH_SYS['controller'] = $_LOAD_PATH_SYS['home'].'controller'.$_PATH_SEPARATOR;
$_LOAD_PATH_SYS['dao']        = $_LOAD_PATH_SYS['home'].'dao'.$_PATH_SEPARATOR;
$_LOAD_PATH_SYS['js']         = $_LOAD_PATH_SYS['home'].'js'.$_PATH_SEPARATOR;
$_LOAD_PATH_SYS['css']        = $_LOAD_PATH_SYS['home'].'css'.$_PATH_SEPARATOR;
$_LOAD_PATH_SYS['img']        = $_LOAD_PATH_SYS['home'].'img'.$_PATH_SEPARATOR;
$_LOAD_PATH_SYS['imgg']       = $_LOAD_PATH_SYS['home'].'imgg'.$_PATH_SEPARATOR;
$_LOAD_PATH_SYS['imgp']       = $_LOAD_PATH_SYS['home'].'imgp'.$_PATH_SEPARATOR;
$_LOAD_PATH_SYS['miniaturas'] = $_LOAD_PATH_SYS['home'].'miniaturas'.$_PATH_SEPARATOR;
$_LOAD_PATH_SYS['temporaria'] = $_LOAD_PATH_SYS['home'].'temporaria'.$_PATH_SEPARATOR;
$_LOAD_PATH_SYS['images']     = $_LOAD_PATH_SYS['home'].'images'.$_PATH_SEPARATOR;
$_LOAD_PATH_SYS['template']   = $_LOAD_PATH_SYS['home'].'template'.$_PATH_SEPARATOR;

$_LOAD_PATH_SYS['funcao']     = $_LOAD_PATH_SYS['home'].'funcao'.$_PATH_SEPARATOR;

 
if ($system == "W")
	$_LOAD_URL_SYS['BASE_URL']    = '/Hospital/';
else
	$_LOAD_URL_SYS['BASE_URL']    = '/var/www/html/';

$_LOAD_URL_SYS['URL_MINIATURAS']      		= $_LOAD_URL_SYS['BASE_URL'].'miniaturas/';
$_LOAD_URL_SYS['URL_IMGG']      		    = $_LOAD_URL_SYS['BASE_URL'].'imgg/';
$_LOAD_URL_SYS['URL_IMGP']      		    = $_LOAD_URL_SYS['BASE_URL'].'imgp/';
$_LOAD_URL_SYS['URL_TEMPORARIA']      		= $_LOAD_URL_SYS['BASE_URL'].'temporaria/';
$_LOAD_URL_SYS['URL_AJAX']       = $_LOAD_URL_SYS['BASE_URL'].'ajax/';

$_SESSION['PATH_SYS'] = $_LOAD_PATH_SYS;
$_SESSION['URL_SYS']  = $_LOAD_URL_SYS;

?>