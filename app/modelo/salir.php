<?php
session_start();
include_once "../config/inc.configuracion.php";
include_once "../bd/ConexionBD.php";

$ClassConexionBD = new ConexionBD();
$con = $ClassConexionBD->conectarBD();

unset($_SESSION);
session_destroy();
$ClassConexionBD->desconectarBD($con);
setcookie('COOKIEADMONGAS', '', time() - 1, '/');
header("Location:".PORTAL."");
die();
?>
