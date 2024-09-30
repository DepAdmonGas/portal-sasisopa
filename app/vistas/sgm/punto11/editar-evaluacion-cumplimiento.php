<?php
require('../../../../app/help.php');

if($_POST['cate'] == 1){
$sql = "UPDATE sgm_cumplimiento_objetivos_revision
SET fecha = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 2){
$sql = "UPDATE sgm_cumplimiento_objetivos_revision
SET hora = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 3){
$sql = "UPDATE sgm_cumplimiento_objetivos_revision
SET lugar = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 4){
$sql = "UPDATE sgm_cumplimiento_objetivos_revision
SET responsable = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 6){
$sql = "UPDATE sgm_cumplimiento_objetivos_revision_detalle
SET resultado1 = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 7){
$sql = "UPDATE sgm_cumplimiento_objetivos_revision_detalle
SET resultado2 = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 8){
$sql = "UPDATE sgm_cumplimiento_objetivos_revision_detalle
SET resultado3 = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 9){
$sql = "UPDATE sgm_cumplimiento_objetivos_revision_detalle
SET resultado4 = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 10){
$sql = "UPDATE sgm_cumplimiento_objetivos_revision_detalle
SET resultado5 = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 11){

$sql = "INSERT INTO sgm_cumplimiento_objetivos_revision_asistentes (
  id_cumplimiento,
  id_usuario
  )
  VALUES ('".$_POST['id']."','".$_POST['valor']."')
  ";

}else if($_POST['cate'] == 12){

$sql = "DELETE FROM sgm_cumplimiento_objetivos_revision_asistentes WHERE id = '".$_POST['id']."' ";

}else if($_POST['cate'] == 13){
$sql = "UPDATE sgm_cumplimiento_objetivos_revision
SET estado = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}

mysqli_query($con, $sql);
//------------------
mysqli_close($con);
//------------------