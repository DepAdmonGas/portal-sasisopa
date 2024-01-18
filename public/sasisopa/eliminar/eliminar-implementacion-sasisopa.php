<?php
require('../../../app/help.php');

$sql_resultado = "SELECT * FROM tb_implementacion_sasisopa_procedimientos WHERE id_reporte = '".$_POST['id']."' ";
$result_resultado = mysqli_query($con, $sql_resultado);
$numero_resultado = mysqli_num_rows($result_resultado);

while($row_resultado = mysqli_fetch_array($result_resultado, MYSQLI_ASSOC)){

$id = $row_resultado['id'];

$sql = "DELETE FROM tb_implementacion_sasisopa_procedimientos_puesto WHERE id_reporte = '".$id."'  ";
mysqli_query($con, $sql);

}

$sql1 = "DELETE FROM tb_implementacion_sasisopa_procedimientos WHERE id_reporte = '".$_POST['id']."'  ";
mysqli_query($con, $sql1);

$sql1 = "DELETE FROM tb_implementacion_sasisopa WHERE id = '".$_POST['id']."'  ";
mysqli_query($con, $sql1);


//------------------
mysqli_close($con);
//------------------