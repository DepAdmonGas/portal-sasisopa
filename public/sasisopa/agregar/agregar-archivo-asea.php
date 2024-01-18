<?php
require('../../../app/help.php');

$idDocumento = $_POST['idDocumento'];
$Comentario = $_POST['Comentario'];

$File  =   $_FILES['ArchivoPdf_file']['name'];
$upload_folder = "../../../archivos/auditorias/ASEA-".$idDocumento."-".strtotime($hoy).".pdf";

if ($File != "") {
$PDFNombre = "archivos/auditorias/ASEA-".$idDocumento."-".strtotime($hoy).".pdf";
}else{
$PDFNombre = ""; 
}

if(move_uploaded_file($_FILES['ArchivoPdf_file']['tmp_name'], $upload_folder)) {}


if ($File != "") {

$sql_insert = "INSERT INTO tb_auditoria_externa_asea (
id_auditoria,
archivo,
comentario
)
VALUES (
'".$idDocumento."',
'".$PDFNombre."',
'".$Comentario."'
)";
mysqli_query($con, $sql_insert);

}
//------------------
mysqli_close($con);
//------------------