<?php
require('../../../../app/help.php');

if($_POST['cate'] == 1){
$sql = "UPDATE sgm_inventario_equipo
SET nombre = '".$_POST['valor']."'
WHERE id = '".$_POST['idEquipo']."' ";
}else if($_POST['cate'] == 2){
$sql = "UPDATE sgm_inventario_equipo
SET identificacion = '".$_POST['valor']."'
WHERE id = '".$_POST['idEquipo']."' ";
}else if($_POST['cate'] == 3){
$sql = "UPDATE sgm_inventario_equipo
SET funcion = '".$_POST['valor']."'
WHERE id = '".$_POST['idEquipo']."' ";
}else if($_POST['cate'] == 4){
$sql = "UPDATE sgm_inventario_equipo
SET fecha_instalacion = '".$_POST['valor']."'
WHERE id = '".$_POST['idEquipo']."' ";
}else if($_POST['cate'] == 5){
$sql = "UPDATE sgm_inventario_equipo
SET estado = '".$_POST['valor']."'
WHERE id = '".$_POST['idEquipo']."' ";
}




mysqli_query($con, $sql);
//------------------
mysqli_close($con);
//------------------