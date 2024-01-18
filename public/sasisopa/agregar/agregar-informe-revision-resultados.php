<?php
require('../../../app/help.php');

$File  =  $_FILES['File']['name'];
$upload_folder = "../../../archivos/informe-revision-resultados/Informe-revision-resultados-".strtotime($hoy).".pdf";

if ($File != "") {
$archivo = "Informe-revision-resultados-".strtotime($hoy).".pdf";
}else{
$archivo = ""; 
}

  if(move_uploaded_file($_FILES['File']['tmp_name'], $upload_folder)) {}

  if ($File != "") {

  $sql_insert = "INSERT INTO tb_informe_revision_resultados (
  id_estacion,
  fecha,
  archivo
  )
  VALUES (
  '".$Session_IDEstacion."',
  '".$_POST['Fecha']."',
  '".$archivo."'
  )";
  mysqli_query($con, $sql_insert);

  }

//------------------
mysqli_close($con);
//------------------
