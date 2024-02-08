<?php
require('../../../app/help.php');

$id = $_POST['id'];

$File  =   $_FILES['ArchivoPdf_file']['name'];
$upload_folder = "../../../archivos/auditorias/A-I-ANEXO-".$id."-".strtotime($hoy).".pdf";

if ($File != "") {
$PDFNombre = "archivos/auditorias/A-I-ANEXO-".$id."-".strtotime($hoy).".pdf";
}else{
$PDFNombre = ""; 
}

if(move_uploaded_file($_FILES['ArchivoPdf_file']['tmp_name'], $upload_folder)) {}


if ($File != "") {

echo $sql_insert = "INSERT INTO tb_auditoria_interna_anexos (
id_auditoria,
formato,
documento,
archivo
)
VALUES (
'".$id."',
'".$_POST['formato']."',
'".$_POST['Documento']."',
'".$PDFNombre."'
)";
mysqli_query($con, $sql_insert);

}

//------------------
mysqli_close($con);
//------------------