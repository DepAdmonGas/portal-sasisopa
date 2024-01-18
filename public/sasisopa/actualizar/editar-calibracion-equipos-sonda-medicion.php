<?php
require('../../../app/help.php');

if($_POST['input'] == 1){

$sql = "UPDATE tb_calibracion_equipos SET
fecha = '".$_POST['contenido']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 2){

$sql = "UPDATE tb_calibracion_equipos SET
hora = '".$_POST['contenido']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 3){

$sql = "UPDATE tb_calibracion_equipos_detalle SET
resultado = '".$_POST['contenido']."'
 WHERE id_calibracion = '".$_POST['id']."' AND categoria = 'Unidad de verificación' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 4){

$sql = "UPDATE tb_calibracion_equipos_detalle SET
resultado = '".$_POST['contenido']."'
 WHERE id_calibracion = '".$_POST['id']."' AND categoria = 'No. de acreditación' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 5){

$sql = "UPDATE tb_calibracion_equipos_detalle SET
resultado = '".$_POST['contenido']."'
 WHERE id_calibracion = '".$_POST['id']."' AND categoria = 'Método usado para la calibración' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 6){

$sql = "UPDATE tb_calibracion_equipos SET
observaciones = '".$_POST['contenido']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 7){

$sql = "UPDATE tb_calibracion_equipos SET
responsable_verificacion = '".$_POST['contenido']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 8){

$sql = "UPDATE tb_calibracion_equipos_sonda SET
resultado1 = '".$_POST['contenido']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}

//------------------
mysqli_close($con);
//------------------