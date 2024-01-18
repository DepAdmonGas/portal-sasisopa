<?php
require('../../../app/help.php');

$NombreRT = $_POST['NombreRT'];
$FechaAsignacion = $_POST['FechaAsignacion'];
$PDF_file = $_FILES['PDF_file']['name'];



$ruta_file = "../../../archivos/representante-tecnico/"."Formato-".strtotime($hoy).".pdf";

if($PDF_file != "") {
$ruta = "archivos/representante-tecnico/"."Formato-".strtotime($hoy).".pdf";
}else{
$ruta = "";
}

if(move_uploaded_file($_FILES['PDF_file']['tmp_name'], $ruta_file)) {}

$sql_insert1 = "INSERT INTO tb_representante_tecnico (
id_estacion,
nom_representante,
fecha,
archivo
)
VALUES 
(
'".$Session_IDEstacion."',
'".$NombreRT."',
'".$FechaAsignacion."',
'".$ruta."'
)";
mysqli_query($con, $sql_insert1);

//------------------
mysqli_close($con);
//------------------