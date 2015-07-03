<?php

session_start();

$paths = $_SESSION['PATH_SYS'];
$url = $_SESSION['URL_SYS'];

include_once($paths['DB'].'DataAccess.php');
include_once($paths['Aut'].'Auth.php');
include_once($paths['Nav'].'Navigator.php');
        setcookie("USER_AUTH", "",time()-24*3600,"/");
        session_unset();
        session_destroy();
        

Navigator::Redirect($url['ADMIN_URL']);

?>
