<?php
require('../../../app/help.php');

$idMantenimiento = $_POST['idMantenimiento'];
$FileEvidencia = $_FILES['FileEvidencia']['name'];

$extension = pathinfo($FileEvidencia, PATHINFO_EXTENSION);

$ruta_file = "../../../archivos/mantenimiento/"."MANTENIMIENTOP-".$idMantenimiento."-".strtotime($hoy).".".$extension;

if($FileEvidencia != "") {
$ruta_protocolo = "http://portal.admongas.com.mx/portal-sasisopa/archivos/mantenimiento/"."MANTENIMIENTOP-".$idMantenimiento."-".strtotime($hoy).".".$extension;
}else{
$ruta_protocolo = "";
}

if(move_uploaded_file($_FILES['FileEvidencia']['tmp_name'], $ruta_file)) {}


$sql_insert1 = "INSERT INTO po_mantenimiento_verificar_evidencias (
id_mantenimiento,
url
)
VALUES 
(
'".$idMantenimiento."',
'".$ruta_protocolo."'
)";
mysqli_query($con, $sql_insert1);


//------------------
mysqli_close($con);
//------------------