<?php
require('../../../../app/help.php');

$sql = "DELETE FROM sgm_seguimiento_asistentes WHERE  id_seguimiento = '".$_POST['id']."'  ";
if(mysqli_query($con, $sql)){
$sql1 = "DELETE FROM sgm_seguimiento_satisfaccion_cliente WHERE id_seguimiento = '".$_POST['id']."'  ";
if(mysqli_query($con, $sql1)){
$sql2 = "DELETE FROM sgm_seguimiento_calibracion_equipo WHERE id_seguimiento = '".$_POST['id']."'  ";
if(mysqli_query($con, $sql2)){
$sql3 = "DELETE FROM sgm_seguimiento_implementacion_sgm WHERE id_seguimiento = '".$_POST['id']."'  ";
if(mysqli_query($con, $sql3)){
$sql4 = "DELETE FROM sgm_seguimiento_objetivo_indicador WHERE id = '".$_POST['id']."'  ";
if(mysqli_query($con, $sql4)){
echo 1;
}else{
echo 0;
}
}else{
echo 0;
}
}else{
echo 0;
}
}else{
echo 0;
}
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------