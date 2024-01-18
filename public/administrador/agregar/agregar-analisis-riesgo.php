<?php
require('../../../app/help.php');

$aleatorio = uniqid();
$File  =   $_FILES['Documento_File']['name'];
$upload_folder = "../../../archivos/analisis-riesgo/".$aleatorio."-".$File;
$PDFNombre = $aleatorio."-".$File;

if(move_uploaded_file($_FILES['Documento_File']['tmp_name'], $upload_folder)) {

$sql_insert = "INSERT INTO tb_analisis_riesgo (
id_estacion, 
fecha,
descripcion,
documento
)
VALUES (
'".$_POST['idEstacion']."',
'".$_POST['Fecha']."',
'".$_POST['Descripcion']."',
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