<?php
require('../../../app/help.php');


$sql_reporte = "SELECT * FROM re_reporte_cre_producto WHERE id = '".$_POST['id']."' ";
$result_reporte = mysqli_query($con, $sql_reporte);
$numero_reporte = mysqli_num_rows($result_reporte);
while($row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC)){
$producto = $row_reporte['producto'];
}

$mensaje = "Actualice el Volumen final del producto ".$producto;

$sql = "UPDATE re_reporte_cre_producto SET
volumen_final = '".$_POST['inputvf']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

$sql_insert1 = "INSERT INTO re_reporte_cre_mensajes (id_reporte, id_fecha,id_usuario,fecha,mensaje,tipo)
VALUES (
'".$_POST['idReporte']."',
'".$_POST['idMensajes']."',
'".$Session_IDUsuarioBD."',
'".$hoy."',
'".$mensaje."',
1
)";
mysqli_query($con, $sql_insert1);

?>
