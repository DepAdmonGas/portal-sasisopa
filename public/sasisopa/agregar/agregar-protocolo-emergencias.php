<?php
require('../../../app/help.php');

$idEstacion = $_POST['idEstacion'];
$FileProtocolo = $_FILES['FileProtocolo']['name'];


$ruta_file = "../../../archivos/protocolo/"."PROTOCOLO-".$idEstacion."-".strtotime($hoy).".pdf";

if($FileProtocolo != "") {
$ruta_protocolo = "archivos/protocolo/"."PROTOCOLO-".$idEstacion."-".strtotime($hoy).".pdf";
}else{
$ruta_protocolo = "";
}

if(move_uploaded_file($_FILES['FileProtocolo']['tmp_name'], $ruta_file)) {}

$sql_insert1 = "INSERT INTO tb_protocolo_emergencias (
id_estacion,
fechacreacion,
archivo
)
VALUES 
(
'".$idEstacion."',
'".$_POST['FechaProtocolo']."',
'".$ruta_protocolo."'
)";
mysqli_query($con, $sql_insert1);

//------------------
mysqli_close($con);
//------------------