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
 WHERE id_calibracion = '".$_POST['id']."' AND categoria = 'Temperatura ambiente' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 4){

$sql = "UPDATE tb_calibracion_equipos_detalle SET
resultado = '".$_POST['contenido']."'
 WHERE id_calibracion = '".$_POST['id']."' AND categoria = 'Presión atmosférica' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 5){

$sql = "UPDATE tb_calibracion_equipos_detalle SET
resultado = '".$_POST['contenido']."'
 WHERE id_calibracion = '".$_POST['id']."' AND categoria = 'Humedad' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 6){

$sql = "UPDATE tb_calibracion_equipos_detalle SET
resultado = '".$_POST['contenido']."'
 WHERE id_calibracion = '".$_POST['id']."' AND categoria = 'Liquido usado en la calibración' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 7){

$sql = "UPDATE tb_calibracion_equipos_detalle SET
resultado = '".$_POST['contenido']."'
 WHERE id_calibracion = '".$_POST['id']."' AND categoria = 'Temperatura del líquido' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 8){

$sql = "UPDATE tb_calibracion_equipos_detalle SET
resultado = '".$_POST['contenido']."'
 WHERE id_calibracion = '".$_POST['id']."' AND categoria = 'Laboratorio de calibración' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 9){

$sql = "UPDATE tb_calibracion_equipos_detalle SET
resultado = '".$_POST['contenido']."'
 WHERE id_calibracion = '".$_POST['id']."' AND categoria = 'No. de acreditación' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 10){

$sql = "UPDATE tb_calibracion_equipos_detalle SET
resultado = '".$_POST['contenido']."'
 WHERE id_calibracion = '".$_POST['id']."' AND categoria = 'Método de calibración' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 11){

$sql = "UPDATE tb_calibracion_equipos SET
observaciones = '".$_POST['contenido']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 12){

$sql = "UPDATE tb_calibracion_equipos SET
responsable_verificacion = '".$_POST['contenido']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 13){

$sql = "UPDATE tb_calibracion_equipos_jarra SET
resultado1 = '".$_POST['contenido']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}

//------------------
mysqli_close($con);
//------------------