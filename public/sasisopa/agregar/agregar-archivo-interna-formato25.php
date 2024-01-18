<?php
require('../../../app/help.php');

$idDocumento = $_POST['idDocumento'];

$File  =   $_FILES['ArchivoPdf_file']['name'];
$upload_folder = "../../../archivos/auditorias/P-D-H-".$idDocumento."-".strtotime($hoy).".pdf";

if ($File != "") {
$PDFNombre = "archivos/auditorias/P-D-H-".$idDocumento."-".strtotime($hoy).".pdf";
}else{
$PDFNombre = ""; 
}

if(move_uploaded_file($_FILES['ArchivoPdf_file']['tmp_name'], $upload_folder)) {}


if ($File != "") {

$sql_insert = "INSERT INTO tb_auditoria_interna_formato (
id_auditoria,
formato,
archivo
)
VALUES (
'".$idDocumento."',
'formato025',
'".$PDFNombre."'
)";
mysqli_query($con, $sql_insert);


}
echo $PDFNombre;
//------------------
mysqli_close($con);
//------------------
