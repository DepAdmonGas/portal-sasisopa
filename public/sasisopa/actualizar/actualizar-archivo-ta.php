<?php
require('../../../app/help.php');


$idta = $_POST['idta'];

$File  =   $_FILES['ArchivoPdf_file']['name'];
$upload_folder = "../../../archivos/incidentes-accidentes/I-T-A-".$idta."-".strtotime($hoy).".pdf";

if ($File != "") {
$PDFNombre = "archivos/incidentes-accidentes/I-T-A-".$idta."-".strtotime($hoy).".pdf";
}else{
$PDFNombre = ""; 
}

if(move_uploaded_file($_FILES['ArchivoPdf_file']['tmp_name'], $upload_folder)) {}


if ($File != "") {

$sql = "UPDATE tb_investigacion_incidente_accidente_tercerautorizado SET
fecha = '".$fecha_del_dia."',
archivo = '".$PDFNombre."'
 WHERE id = '".$idta."' ";
mysqli_query($con, $sql);

}



//------------------
mysqli_close($con);
//------------------