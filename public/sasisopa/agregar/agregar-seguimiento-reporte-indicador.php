<?php
require('../../../app/help.php');

$sql_insert = "INSERT INTO tb_seguimiento_reporte_indicador (
id_estacion,
id_usuario,
fecha,
capacitacion,
exp_cliente,
ventas,
medidas_correctivas,
fecha_aplicacion
)
VALUES 
(
'".$Session_IDEstacion."', 
'".$Session_IDUsuarioBD."',
'".$_POST['Fecha']."',
'".$_POST['Capacitacion']."',
'".$_POST['ExperienciaC']."',
'".$_POST['Ventas']."',
'".$_POST['MedidasC']."',
'".$_POST['FechaAplicacion']."'

)";

if(mysqli_query($con, $sql_insert)){
echo 1;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------