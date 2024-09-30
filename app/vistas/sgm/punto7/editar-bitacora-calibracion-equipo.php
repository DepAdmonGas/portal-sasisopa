<?php
require('../../../../app/help.php');

if($_POST['cate'] == 1){
$sql = "UPDATE sgm_bitacora_calibracion_equipo
SET fecha = '".$_POST['valor']."'
WHERE id = '".$_POST['idbitacora']."' ";
}else if($_POST['cate'] == 2){
$sql = "UPDATE sgm_bitacora_calibracion_equipo
SET hora = '".$_POST['valor']."'
WHERE id = '".$_POST['idbitacora']."' ";
}else if($_POST['cate'] == 3){
$sql = "UPDATE sgm_bitacora_calibracion_equipo
SET nombre_equipo = '".$_POST['valor']."'
WHERE id = '".$_POST['idbitacora']."' ";
}else if($_POST['cate'] == 4){
$sql = "UPDATE sgm_bitacora_calibracion_equipo
SET marca = '".$_POST['valor']."'
WHERE id = '".$_POST['idbitacora']."' ";
}else if($_POST['cate'] == 5){
$sql = "UPDATE sgm_bitacora_calibracion_equipo
SET capacidad = '".$_POST['valor']."'
WHERE id = '".$_POST['idbitacora']."' ";
}else if($_POST['cate'] == 6){
$sql = "UPDATE sgm_bitacora_calibracion_equipo
SET almacena = '".$_POST['valor']."'
WHERE id = '".$_POST['idbitacora']."' ";
}else if($_POST['cate'] == 7){
$sql = "UPDATE sgm_bitacora_calibracion_equipo
SET nombre_laboratorio = '".$_POST['valor']."'
WHERE id = '".$_POST['idbitacora']."' ";
}else if($_POST['cate'] == 8){
$sql = "UPDATE sgm_bitacora_calibracion_equipo
SET no_acreditacion = '".$_POST['valor']."'
WHERE id = '".$_POST['idbitacora']."' ";
}else if($_POST['cate'] == 9){
$sql = "UPDATE sgm_bitacora_calibracion_equipo
SET metodo_calibracion = '".$_POST['valor']."'
WHERE id = '".$_POST['idbitacora']."' ";
}else if($_POST['cate'] == 10){
$sql = "UPDATE sgm_bitacora_calibracion_equipo
SET nombre_patron = '".$_POST['valor']."'
WHERE id = '".$_POST['idbitacora']."' ";
}else if($_POST['cate'] == 11){
$sql = "UPDATE sgm_bitacora_calibracion_equipo
SET marca_modelo_serie = '".$_POST['valor']."'
WHERE id = '".$_POST['idbitacora']."' ";
}else if($_POST['cate'] == 12){
$sql = "UPDATE sgm_bitacora_calibracion_equipo
SET resolucion = '".$_POST['valor']."'
WHERE id = '".$_POST['idbitacora']."' ";
}else if($_POST['cate'] == 13){
$sql = "UPDATE sgm_bitacora_calibracion_equipo
SET incertidumbre = '".$_POST['valor']."'
WHERE id = '".$_POST['idbitacora']."' ";
}else if($_POST['cate'] == 14){
$sql = "UPDATE sgm_bitacora_calibracion_equipo
SET vigencia_certificado = '".$_POST['valor']."'
WHERE id = '".$_POST['idbitacora']."' ";
}else if($_POST['cate'] == 15){
$sql = "UPDATE sgm_bitacora_calibracion_equipo_detalle
SET resultado = '".$_POST['valor']."'
WHERE id = '".$_POST['idbitacora']."' ";
}else if($_POST['cate'] == 16){
$sql = "UPDATE sgm_programa_anual_calibracion_verificacion
SET estado = '".$_POST['valor']."'
WHERE id = '".$_POST['idbitacora']."' ";
}


mysqli_query($con, $sql);
//------------------
mysqli_close($con);
//------------------