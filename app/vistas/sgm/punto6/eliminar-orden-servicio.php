<?php
require('../../../../app/help.php');



$sql = "SELECT folio FROM sgm_orden_servicio WHERE id = '".$_POST['id_servicio']."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$folio = $row['folio'];

$sql1 = "DELETE FROM sgm_evaluacion_proveedores WHERE id_orden_servicio = '".$_POST['id_servicio']."' ";
mysqli_query($con, $sql1);

$sql2 = "DELETE FROM tb_requisicion_obra WHERE no_folio = '".$folio."' AND id_estacion = '".$Session_IDEstacion."' ";
mysqli_query($con, $sql2);

$sql3 = "DELETE FROM sgm_orden_servicio WHERE id = '".$_POST['id_servicio']."' ";
mysqli_query($con, $sql3);

echo 1;
//------------------
mysqli_close($con);
//------------------