<?php
require('../../../app/help.php');

$idEstacion = $_POST['idEstacion'];
$version = $_POST['version'];
$aleatorio = mt_rand(1,99999999);

$File  =   $_FILES['documento_file']['name'];
$upload_folder = "../../../archivos/SASISOPA/".$aleatorio."-".strtotime($hoy).".pdf";

if ($File != "") {
$PDFNombre = "archivos/SASISOPA/".$aleatorio."-".strtotime($hoy).".pdf";
}else{
$PDFNombre = ""; 
}

if(move_uploaded_file($_FILES['documento_file']['tmp_name'], $upload_folder)) {


$sql_insert = "INSERT INTO tb_sasisopa (
id_estacion,version,documento
)
VALUES (
'".$idEstacion."',
'".$version."',
'".$PDFNombre."'
)";

if(mysqli_query($con, $sql_insert)){
echo 1;
}else{
echo 0;
}

}

//------------------
mysqli_close($con);
//------------------