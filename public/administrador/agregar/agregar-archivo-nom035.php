<?php
require('../../../app/help.php');

$idEstacion = $_POST['idEstacion'];
$numarchivo = $_POST['numarchivo'];
$aleatorio = mt_rand(1,99999999);

$File  =   $_FILES['ArchivoPdf_file']['name'];
$upload_folder = "../../../archivos/nom-035/".$aleatorio."-".strtotime($hoy).".pdf";

if ($File != "") {
$PDFNombre = "archivos/nom-035/".$aleatorio."-".strtotime($hoy).".pdf";
}else{
$PDFNombre = ""; 
}

if(move_uploaded_file($_FILES['ArchivoPdf_file']['tmp_name'], $upload_folder)) {}

if ($File != "") {

	if ($numarchivo == 1) {
	$nom_archivo = "politica-cuerpo";
	}else if ($numarchivo == 2) {
	$nom_archivo = "politica-archivo";
	}else if ($numarchivo == 3) {
	$nom_archivo = "politica-triptico";
	}else if ($numarchivo == 4) {
	$nom_archivo = "politica-acta";
	}

$sql_insert = "INSERT INTO tb_nom_035_archivos (
id_estacion,categoria,nom_archivo,archivo
)
VALUES (
'".$idEstacion."',
'Politica',
'".$nom_archivo."',
'".$PDFNombre."'
)";
mysqli_query($con, $sql_insert);

}

echo $PDFNombre;
//------------------
mysqli_close($con);
//------------------
