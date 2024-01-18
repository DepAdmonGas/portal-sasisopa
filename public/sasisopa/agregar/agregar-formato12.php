<?php
require('../../../app/help.php');

$File  =   $_FILES['File']['name'];
$upload_folder = "../../../archivos/seguridad-contratistas/Fo.ADMONGAS.012-".strtotime($hoy).".pdf";

if ($File != "") {
$archivo = "archivos/seguridad-contratistas/Fo.ADMONGAS.012-".strtotime($hoy).".pdf";
}else{
$archivo = ""; 
}

if(move_uploaded_file($_FILES['File']['tmp_name'], $upload_folder)) {}

if ($File != "") {

$sql = "DELETE FROM tb_requisicion_obra_formato_12 
WHERE id_requisicion = '".$_POST['id']."' ";
mysqli_query($con, $sql);

$sql_insert = "INSERT INTO tb_requisicion_obra_formato_12 (
  id_requisicion,
  archivo
  )
  VALUES (
  '".$_POST['id']."',
  '".$archivo."'
  )";
  mysqli_query($con, $sql_insert);


}

//------------------
mysqli_close($con);
//------------------
