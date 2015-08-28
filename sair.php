<?php
require_once("_loadPaths.inc.php");
unset($_SESSION["USR"]);
unset($_SESSION);
session_destroy();
header("location:index.php");
exit();

