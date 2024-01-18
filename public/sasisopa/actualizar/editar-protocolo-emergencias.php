<?php
require('../../../app/help.php');

$idEstacion = $Session_IDEstacion;
$EditFileProtocolo = $_FILES['EditFileProtocolo']['name'];


$ruta_file = "../../../archivos/protocolo/"."PROTOCOLO-".$idEstacion."-".strtotime($hoy).".pdf";

if($EditFileProtocolo != "") {
$ruta_protocolo = "archivos/protocolo/"."PROTOCOLO-".$idEstacion."-".strtotime($hoy).".pdf";
}else{
$ruta_protocolo = "";
}

if(move_uploaded_file($_FILES['EditFileProtocolo']['tmp_name'], $ruta_file)) {}

if($EditFileProtocolo != "") {

$sql_insert1 = "UPDATE tb_protocolo_emergencias SET
fechacreacion = '".$_POST['EditFechaProtocolo']."',
archivo = '".$ruta_protocolo."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql_insert1);

}else{

$sql_insert1 = "UPDATE tb_protocolo_emergencias SET
fechacreacion = '".$_POST['EditFechaProtocolo']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql_insert1);

}

//------------------
mysqli_close($con);
//------------------