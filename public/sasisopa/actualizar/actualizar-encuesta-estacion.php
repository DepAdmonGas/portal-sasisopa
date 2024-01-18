<?php
require('../../../app/help.php');

$FechaCompleta = $_POST['Fecha'].' '.$hora_del_dia;

$sql = "UPDATE tb_encuentas_estacion SET
fechacreacion = '".$FechaCompleta."',
estado = 1
 WHERE id = '".$_POST['IdReporte']."' ";
mysqli_query($con, $sql);

//------------------
mysqli_close($con);
//------------------