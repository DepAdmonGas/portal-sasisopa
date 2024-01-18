<?php
require('../../../app/help.php');

$aleatorio = uniqid();
$File  =   $_FILES['Documento_File']['name'];
$upload_folder = "../../../archivos/analisis-riesgo/".$aleatorio."-".$File;
$PDFNombre = $aleatorio."-".$File;

$id = $_POST['id'];

$sql1 = "UPDATE tb_analisis_riesgo SET
fecha = '".$_POST['Fecha']."',
descripcion = '".$_POST['Descripcion']."'
 WHERE id = '".$id."' ";
if(mysqli_query($con, $sql1)){

if(move_uploaded_file($_FILES['Documento_File']['tmp_name'], $upload_folder)) {
$sql2 = "UPDATE tb_analisis_riesgo SET
documento = '".$PDFNombre."'
 WHERE id = '".$id."' ";
mysqli_query($con, $sql2);
}

echo 1;

}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------