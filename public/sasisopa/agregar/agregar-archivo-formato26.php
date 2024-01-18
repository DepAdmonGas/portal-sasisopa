<?php
require('../../../app/help.php');

$idDocumento = $_POST['idDocumento'];

$File  =   $_FILES['ArchivoPdf_file']['name'];
$upload_folder = "../../../archivos/incidentes-accidentes/F-I-D-".$idDocumento."-".strtotime($hoy).".pdf";

if ($File != "") {
$PDFNombre = "archivos/incidentes-accidentes/F-I-D-".$idDocumento."-".strtotime($hoy).".pdf";
}else{
$PDFNombre = ""; 
}

if(move_uploaded_file($_FILES['ArchivoPdf_file']['tmp_name'], $upload_folder)) {}


if ($File != "") {

$sql_insert = "INSERT INTO tb_investigacion_incidente_accidente_formato (
id_investigacion,
archivo
)
VALUES (
'".$idDocumento."',
'".$PDFNombre."'
)";
mysqli_query($con, $sql_insert);


}
echo $PDFNombre;
//------------------
mysqli_close($con);
//------------------