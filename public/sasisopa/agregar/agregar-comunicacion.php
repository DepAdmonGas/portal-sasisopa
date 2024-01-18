<?php
require('../../../app/help.php');

$sql_reporte_Co = "SELECT no_comunicacion FROM se_comunicacion_i_e WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY no_comunicacion desc LIMIT 1";
   $result_reporte_Co = mysqli_query($con, $sql_reporte_Co);
   $numero_reporte_Co = mysqli_num_rows($result_reporte_Co);

   if ($numero_reporte_Co == 0) {
   $noComunicacion = 1;
   }else{
   while($row_reporte_Co = mysqli_fetch_array($result_reporte_Co, MYSQLI_ASSOC)){
   $noComunicacion = $row_reporte_Co['no_comunicacion'] + 1;
   }
   }

$dirigidoa = implode(",", $_POST['dirigidoa']);


$sql_insert1 = "INSERT INTO se_comunicacion_i_e (id_estacion,no_comunicacion,fecha,tema,detalle,encargado_comunicacion,tipo_comunicacion,material,seguimiento,dirigidoa,url,asistencia)
VALUES (
'".$Session_IDEstacion."',
'".$noComunicacion."',
'".$fecha_del_dia."',
'".$_POST['temacomunicar']."',
'".$_POST['detalle']."',
'".$Session_IDUsuarioBD."',
'".$_POST['tipocomunicacion']."',
'".$_POST['materialcomunicar']."',
'".$_POST['seguimientocomunicacion']."',
'".$dirigidoa."','',0)";
mysqli_query($con, $sql_insert1);

//------------------
mysqli_close($con);
//------------------