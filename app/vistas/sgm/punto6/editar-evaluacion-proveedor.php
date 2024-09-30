<?php
require('../../../../app/help.php');

if($_POST['cate'] == 1){
$sql = "UPDATE sgm_evaluacion_proveedores
SET fecha = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 2){
$sql = "UPDATE sgm_evaluacion_proveedores
SET hora_inicio = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 3){
$sql = "UPDATE sgm_evaluacion_proveedores
SET hora_termino = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 4){
$sql = "UPDATE sgm_evaluacion_proveedores
SET nombre_proveedor = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 5){
$sql = "UPDATE sgm_evaluacion_proveedores
SET no_acreditacion = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 6){
$sql = "UPDATE sgm_evaluacion_proveedores
SET observaciones = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 7){
$sql = "UPDATE sgm_evaluacion_proveedores
SET id_personal_evaluacion = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 8){
$sql = "UPDATE sgm_evaluacion_proveedores
SET respuesta_1 = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 9){
$sql = "UPDATE sgm_evaluacion_proveedores
SET respuesta_2 = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 10){
$sql = "UPDATE sgm_evaluacion_proveedores
SET respuesta_3 = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 11){
$sql = "UPDATE sgm_evaluacion_proveedores
SET respuesta_4 = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 12){
$sql = "UPDATE sgm_evaluacion_proveedores
SET respuesta_5 = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 13){
$sql = "UPDATE sgm_evaluacion_proveedores
SET estado = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}




mysqli_query($con, $sql);
//------------------
mysqli_close($con);
//------------------