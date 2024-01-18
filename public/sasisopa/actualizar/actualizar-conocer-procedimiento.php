<?php
require('../../../app/help.php');


if ($_POST['estado'] == 1) {

$sql = "UPDATE tb_implementacion_sasisopa_procedimientos SET
informacion = 'Si'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}

if ($_POST['estado'] == 2) {

$sql = "UPDATE tb_implementacion_sasisopa_procedimientos SET
informacion = 'No'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}

if ($_POST['estado'] == 3) {

	$hora = date("H:i:s");

$sql = "UPDATE tb_implementacion_sasisopa SET
fecha_hora = '".$_POST['Fecha'].' '.$hora."'
 WHERE id = '".$_POST['idReporte']."' ";
mysqli_query($con, $sql);

}
//------------------
mysqli_close($con);
//------------------