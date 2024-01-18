<?php
require('../../../app/help.php');

$sql_encuesta = "SELECT id FROM tb_encuentas_estacion_cliente WHERE id_cuentas_estacion = '".$_POST['IdReporte']."' ";
$result_encuesta = mysqli_query($con, $sql_encuesta);
$numero_encuesta = mysqli_num_rows($result_encuesta);

while($row_encuesta = mysqli_fetch_array($result_encuesta, MYSQLI_ASSOC)){
$idcliente = $row_encuesta['id'];

$sql1 = "DELETE FROM tb_encuentas_estacion_cliente_comentarios WHERE id_cliente = '".$idcliente."'  ";
mysqli_query($con, $sql1);

$sql2 = "DELETE FROM tb_encuentas_estacion_cliente_preguntas WHERE id_cliente = '".$idcliente."'  ";
mysqli_query($con, $sql2);
}

$sql3 = "DELETE FROM tb_encuentas_estacion_cliente WHERE id_cuentas_estacion = '".$_POST['IdReporte']."'  ";
mysqli_query($con, $sql3);

$sql4 = "DELETE FROM tb_encuentas_estacion WHERE id = '".$_POST['IdReporte']."'  ";
mysqli_query($con, $sql4);