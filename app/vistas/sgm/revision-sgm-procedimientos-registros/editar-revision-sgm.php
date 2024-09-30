<?php 
require('../../../../app/help.php');

if($_POST['seccion'] == 1){

echo $sql = "UPDATE sgm_revision_procedimiento_registro SET
fecha = '".$_POST['value']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}if($_POST['seccion'] == 2){

echo $sql = "UPDATE sgm_revision_procedimiento_registro SET
hora = '".$_POST['value']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}if($_POST['seccion'] == 3){

echo $sql = "UPDATE sgm_revision_procedimiento_registro SET
lugar = '".$_POST['value']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if($_POST['seccion'] == 4){

$sql = "UPDATE sgm_revision_procedimiento_registro_detalle SET
respuesta = '".$_POST['value']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}
else if($_POST['seccion'] == 5){

echo $sql = "UPDATE sgm_revision_procedimiento_registro SET
estado = 1
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}

