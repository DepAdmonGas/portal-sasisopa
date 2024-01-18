<?php
require('../../../app/help.php');

if($_POST['input'] == 1){
 
$ValidaFecha = ValidaFecha($_POST['contenido'],$_POST['id'],$con);

if($ValidaFecha == 1){

$sql = "UPDATE tb_calibracion_equipos SET
fecha = '".$_POST['contenido']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);	

}


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

$sql = "UPDATE tb_calibracion_equipos SET
observaciones = '".$_POST['contenido']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 6){

$sql = "UPDATE tb_calibracion_equipos SET
responsable_verificacion = '".$_POST['contenido']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 7){

$sql = "UPDATE tb_calibracion_equipos_dispensario SET
resultado1 = '".$_POST['contenido']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 8){

$sql = "UPDATE tb_calibracion_equipos_dispensario SET
resultado2 = '".$_POST['contenido']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 9){

$sql = "UPDATE tb_calibracion_equipos_dispensario SET
resultado3 = '".$_POST['contenido']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 10){

$sql = "UPDATE tb_calibracion_equipos_dispensario SET
resultado4 = '".$_POST['contenido']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if($_POST['input'] == 11){

$sql = "UPDATE tb_calibracion_equipos SET
categoria = '".$_POST['contenido']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}if($_POST['input'] == 12){
 
$sql = "UPDATE tb_calibracion_equipos SET
fecha_termino = '".$_POST['contenido']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);	

}else if($_POST['input'] == 13){

$sql = "UPDATE tb_calibracion_equipos SET
hora_termino = '".$_POST['contenido']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}

function ValidaFecha($fecha,$id,$con){

$sqlCE = "SELECT * FROM tb_calibracion_equipos WHERE id = '".$id."' ";
$resultCE = mysqli_query($con, $sqlCE);
$numeroCE = mysqli_num_rows($resultCE);
while($rowCE = mysqli_fetch_array($resultCE, MYSQLI_ASSOC)){
$Equipo = $rowCE['equipo'];
$FechaAnt = $rowCE['fecha'];
}

if($Equipo == 'Dispensario'){

$sql = "UPDATE tb_dispensarios_apertura_bitacora SET
fecha = '".$fecha."'
WHERE fecha = '".$FechaAnt."' AND clave = 'CALI' AND motivo = 'Ajuste' ";


if(mysqli_query($con, $sql)){
return 1;
}else{
return 0;
}

}else{
return 1;
}

}

//------------------
mysqli_close($con);
//------------------