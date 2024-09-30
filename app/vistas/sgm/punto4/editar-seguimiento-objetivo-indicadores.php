<?php
require('../../../../app/help.php');

$value = $_POST['value'];
$idRegistro = $_POST['idRegistro'];
$seccion = $_POST['seccion'];
$campo = $_POST['campo'];

if($seccion == 1){

if($campo == 1){
$sql = "UPDATE sgm_seguimiento_implementacion_sgm SET
respuesta_uno = '".$value."'
 WHERE id_seguimiento = '".$_POST['idRegistro']."' ";
}else if($campo == 2){
$sql = "UPDATE sgm_seguimiento_implementacion_sgm SET
respuesta_dos = '".$value."'
 WHERE id_seguimiento = '".$_POST['idRegistro']."' ";
}else if($campo == 3){
$sql = "UPDATE sgm_seguimiento_implementacion_sgm SET
respuesta_tres = '".$value."'
 WHERE id_seguimiento = '".$_POST['idRegistro']."' ";
}else if($campo == 4){
$sql = "UPDATE sgm_seguimiento_implementacion_sgm SET
respuesta_cuatro = '".$value."'
 WHERE id_seguimiento = '".$_POST['idRegistro']."' ";
}

}else if($seccion == 2){

if($campo == 1){
$sql = "UPDATE sgm_seguimiento_calibracion_equipo SET
respuesta_uno = '".$value."'
 WHERE id_seguimiento = '".$_POST['idRegistro']."' ";
}else if($campo == 2){
$sql = "UPDATE sgm_seguimiento_calibracion_equipo SET
respuesta_dos = '".$value."'
 WHERE id_seguimiento = '".$_POST['idRegistro']."' ";
}else if($campo == 3){
$sql = "UPDATE sgm_seguimiento_calibracion_equipo SET
respuesta_tres = '".$value."'
 WHERE id_seguimiento = '".$_POST['idRegistro']."' ";
}
	
}else if($seccion == 3){

if($campo == 1){
$sql = "UPDATE sgm_seguimiento_satisfaccion_cliente SET
respuesta_uno = '".$value."'
 WHERE id_seguimiento = '".$_POST['idRegistro']."' ";
}else if($campo == 2){
$sql = "UPDATE sgm_seguimiento_satisfaccion_cliente SET
respuesta_dos = '".$value."'
 WHERE id_seguimiento = '".$_POST['idRegistro']."' ";
}else if($campo == 3){
$sql = "UPDATE sgm_seguimiento_satisfaccion_cliente SET
respuesta_tres = '".$value."'
 WHERE id_seguimiento = '".$_POST['idRegistro']."' ";
}else if($campo == 4){
$sql = "UPDATE sgm_seguimiento_satisfaccion_cliente SET
respuesta_cuatro = '".$value."'
 WHERE id_seguimiento = '".$_POST['idRegistro']."' ";
}else if($campo == 5){
$sql = "UPDATE sgm_seguimiento_satisfaccion_cliente SET
respuesta_cinco = '".$value."'
 WHERE id_seguimiento = '".$_POST['idRegistro']."' ";
}

	
}

if(mysqli_query($con, $sql)){
echo 1;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------