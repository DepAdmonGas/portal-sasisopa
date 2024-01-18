<?php
session_start();
include_once "../config/inc.configuracion.php";
include_once "../bd/inc.conexion.php";
unset($_SESSION);
session_destroy();
mysqli_close($con);
header("Location:".PORTAL."");
die();
?>
