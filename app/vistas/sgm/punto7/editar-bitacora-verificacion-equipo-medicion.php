<?php
require('../../../../app/help.php');

if($_POST['cate'] == 1){
$sql = "UPDATE sgm_bitacora_verificacion_sensores
SET fecha = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 2){
$sql = "UPDATE sgm_bitacora_verificacion_sensores
SET hora = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 3){
$sql = "UPDATE sgm_bitacora_verificacion_sensores
SET no_tanque = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 4){
$sql = "UPDATE sgm_bitacora_verificacion_sensores
SET marca = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 5){
$sql = "UPDATE sgm_bitacora_verificacion_sensores
SET capacidad = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 6){
$sql = "UPDATE sgm_bitacora_verificacion_sensores
SET producto = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 7){
$sql = "UPDATE sgm_bitacora_verificacion_sensores
SET interno_externo = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 8){
$sql = "UPDATE sgm_bitacora_verificacion_sensores
SET verificacion_movimiento = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 9){
$sql = "UPDATE sgm_bitacora_verificacion_sensores
SET metodo_nivel = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 10){
$sql = "UPDATE sgm_bitacora_verificacion_resultado
SET resultado = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 11){
$sql = "UPDATE sgm_programa_anual_calibracion_verificacion
SET estado = '".$_POST['valor']."'
WHERE id = '".$_POST['idbitacora']."' ";
}


mysqli_query($con, $sql);
//------------------
mysqli_close($con);
//------------------