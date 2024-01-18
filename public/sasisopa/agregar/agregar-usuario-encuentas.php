<?php
require('../../../app/help.php');

$IdUsuario = strtotime($hoy);


$sql_insert = "INSERT INTO tb_encuentas_estacion_cliente (
id, id_cuentas_estacion, nombre)
VALUES (
  '".$IdUsuario."',
  '".$_POST['IdReporte']."',
  '".$_POST['Nombre']."'
)";
mysqli_query($con, $sql_insert);

echo $IdUsuario;

//------------------
mysqli_close($con);
//------------------