<?php
require('../../../app/help.php');

$sql_reporteP = "SELECT * FROM re_reporte_cre_pipas WHERE id = '".$_POST['id']."' ";
$result_reporteP = mysqli_query($con, $sql_reporteP);
$numero_reporteP = mysqli_num_rows($result_reporteP);
while($row_reporteP = mysqli_fetch_array($result_reporteP, MYSQLI_ASSOC)){
$idreporte = $row_reporteP['id_re_producto'];
$pipanumero = $row_reporteP['pipa_numero'];
}

$sql_reporte = "SELECT * FROM re_reporte_cre_producto WHERE id = '".$idreporte."' ";
$result_reporte = mysqli_query($con, $sql_reporte);
$numero_reporte = mysqli_num_rows($result_reporte);
while($row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC)){
$producto = $row_reporte['producto'];
}

if ($_POST['dato'] == 1) {

  $mensaje = "Actualice el volumen de compra de la Pipa numero ".$pipanumero." del producto ".$producto;
  $sql = "UPDATE re_reporte_cre_pipas SET
  volumen = '".$_POST['input']."',
  precio_litro = '".$_POST['dator']."'
   WHERE id = '".$_POST['id']."' ";
  mysqli_query($con, $sql);

  

}else if ($_POST['dato'] == 2) {

  $mensaje = "Actualice el precio por litro de la Pipa numero ".$pipanumero." del producto ".$producto;
  $sql = "UPDATE re_reporte_cre_pipas SET
  precio_litro = '".$_POST['input']."'
   WHERE id = '".$_POST['id']."' ";
  mysqli_query($con, $sql);

}else if ($_POST['dato'] == 3) {

  $mensaje = "Actualice el costo del flete de la Pipa numero ".$pipanumero." del producto ".$producto;
  $sql = "UPDATE re_reporte_cre_pipas SET
  costo_flete = '".$_POST['input']."'
   WHERE id = '".$_POST['id']."' ";
  mysqli_query($con, $sql);

}else if ($_POST['dato'] == 4) {

  $mensaje = "Actualice el numero de factura de la Pipa numero ".$pipanumero." del producto ".$producto;
  $sql = "UPDATE re_reporte_cre_pipas SET
  no_factura = '".$_POST['input']."'
   WHERE id = '".$_POST['id']."' ";
  mysqli_query($con, $sql);

}else if ($_POST['dato'] == 5) {

  $mensaje = "Actualice el nombre o Razón Social del Transportista de la factura de la Pipa numero ".$pipanumero." del producto ".$producto;
  $sql = "UPDATE re_reporte_cre_pipas SET
  nombre_razonsocial = '".$_POST['input']."'
   WHERE id = '".$_POST['id']."' ";
  mysqli_query($con, $sql);

}else if ($_POST['dato'] == 6) {

  $mensaje = "Actualice el importe total de la Pipa numero ".$pipanumero." del producto ".$producto;
  $sql = "UPDATE re_reporte_cre_pipas SET
  importe_total = '".$_POST['input']."',
  precio_litro = '".$_POST['dator']."'
   WHERE id = '".$_POST['id']."' ";
  mysqli_query($con, $sql);

}

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
