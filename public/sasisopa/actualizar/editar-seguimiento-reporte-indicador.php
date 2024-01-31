<?php
require('../../../app/help.php');

$sql = "UPDATE tb_seguimiento_reporte_indicador SET
fecha = '".$_POST['EditFecha']."',
capacitacion = '".$_POST['EditCapacitacion']."',
exp_cliente = '".$_POST['EditExperienciaC']."',
ventas = '".$_POST['EditVentas']."',
medidas_correctivas = '".$_POST['EditMedidasC']."',
fecha_aplicacion = '".$_POST['EditFechaAplicacion']."'
 WHERE id = '".$_POST['idSeguimiento']."' ";


if(mysqli_query($con, $sql)){
echo 1;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------