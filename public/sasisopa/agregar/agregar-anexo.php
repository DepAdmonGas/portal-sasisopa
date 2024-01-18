<?php
require('../../../app/help.php');

$idProtocolo = $_POST['idProtocolo'];
$NombreAnexo = $_POST['NombreAnexo'];
$FileAnexo = $_FILES['FileAnexo']['name'];


$ruta_file = "../../../archivos/protocolo/"."ANEXO-".strtotime($hoy).".pdf";

if($FileAnexo != "") {
$ruta_protocolo = "archivos/protocolo/"."ANEXO-".strtotime($hoy).".pdf";
}else{
$ruta_protocolo = "";
}

if(move_uploaded_file($_FILES['FileAnexo']['tmp_name'], $ruta_file)) {}

$sql_insert1 = "INSERT INTO tb_protocolo_emergencias_anexo (
nombre_anexo,
id_protocolo,
archivo
)
VALUES 
(
'".$NombreAnexo."',
'".$idProtocolo."',
'".$ruta_protocolo."'
)";
mysqli_query($con, $sql_insert1);

//------------------
mysqli_close($con);
//------------------