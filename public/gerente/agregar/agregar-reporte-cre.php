<?php
require('../../../app/help.php');

$_POST['IdReporte'];
$_POST['Fecha'];

$sql_valida = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '".$_POST['IdReporte']."' and fecha = '".$_POST['Fecha']."' ";
$result_valida = mysqli_query($con, $sql_valida);
$numero_valida = mysqli_num_rows($result_valida);

if ($numero_valida >= 1) {
echo 0;
}else{
/*----------------------------------------------------------------------------*/
if ($Session_ProductoUno != "") {

$sql_insert = "INSERT INTO re_reporte_cre_producto (id_re_mes,fecha,producto,volumen_inicial,volumen_venta,volumen_final)
VALUES ('".$_POST['IdReporte']."','".$_POST['Fecha']."','".$Session_ProductoUno."','".$_POST['Po1_VoI']."','".$_POST['Po1_VoV']."','".$_POST['Po1_VoF']."')";
mysqli_query($con, $sql_insert);

$sql_reportecre = "SELECT id FROM re_reporte_cre_producto WHERE id_re_mes = '".$_POST['IdReporte']."' and producto = '".$Session_ProductoUno."' ";
$result_reportecre = mysqli_query($con, $sql_reportecre);
$numero_reportecre = mysqli_num_rows($result_reportecre);
while($row_reportecre = mysqli_fetch_array($result_reportecre, MYSQLI_ASSOC)){
$idproducto = $row_reportecre['id'];
}

if ($_POST['Po1_Pi1_VC'] != "" || $_POST['Po1_Pi1_PL'] != "" || $_POST['Po1_Pi1_CF'] != "" || $_POST['Po1_Pi1_NF'] != "") {
$sql_insert1 = "INSERT INTO re_reporte_cre_pipas (id_re_producto,pipa_numero, volumen, precio_litro, costo_flete, no_factura, nombre_razonsocial,importe_total)
VALUES ('".$idproducto."',1,'".$_POST['Po1_Pi1_VC']."','".$_POST['Po1_Pi1_PL']."','".$_POST['Po1_Pi1_CF']."','".$_POST['Po1_Pi1_NF']."', '".$_POST['Po1_Pi1_NRSC']."','".$_POST['Po1_Pi1_IT']."')";
mysqli_query($con, $sql_insert1);
}

if ($_POST['Po1_Pi2_VC'] != "" || $_POST['Po1_Pi2_PL'] != "" || $_POST['Po1_Pi2_CF'] != "" || $_POST['Po1_Pi2_NF'] != "") {
$sql_insert2 = "INSERT INTO re_reporte_cre_pipas (id_re_producto,pipa_numero, volumen, precio_litro, costo_flete, no_factura, nombre_razonsocial,importe_total)
VALUES ('".$idproducto."',2,'".$_POST['Po1_Pi2_VC']."','".$_POST['Po1_Pi2_PL']."','".$_POST['Po1_Pi2_CF']."','".$_POST['Po1_Pi2_NF']."', '".$_POST['Po1_Pi2_NRSC']."','".$_POST['Po1_Pi2_IT']."')";
mysqli_query($con, $sql_insert2);
}

if ($_POST['Po1_Pi3_VC'] != "" || $_POST['Po1_Pi3_PL'] != "" || $_POST['Po1_Pi3_cF'] != "" || $_POST['Po1_Pi3_NF'] != "") {
$sql_insert3 = "INSERT INTO re_reporte_cre_pipas (id_re_producto,pipa_numero, volumen, precio_litro, costo_flete, no_factura, nombre_razonsocial,importe_total)
VALUES ('".$idproducto."',3,'".$_POST['Po1_Pi3_VC']."','".$_POST['Po1_Pi3_PL']."','".$_POST['Po1_Pi3_cF']."','".$_POST['Po1_Pi3_NF']."', '".$_POST['Po1_Pi3_NRSC']."','".$_POST['Po1_Pi3_IT']."')";
mysqli_query($con, $sql_insert3);
}

}
/*----------------------------------------------------------------------------*/
if ($Session_ProductoDos != "") {
  $sql_insert = "INSERT INTO re_reporte_cre_producto (id_re_mes,fecha,producto,volumen_inicial,volumen_venta,volumen_final)
  VALUES ('".$_POST['IdReporte']."','".$_POST['Fecha']."','".$Session_ProductoDos."','".$_POST['Po2_VoI']."','".$_POST['Po2_VoV']."','".$_POST['Po2_VoF']."')";
  mysqli_query($con, $sql_insert);

  $sql_reportecre = "SELECT id FROM re_reporte_cre_producto WHERE id_re_mes = '".$_POST['IdReporte']."' and producto = '".$Session_ProductoDos."' ";
  $result_reportecre = mysqli_query($con, $sql_reportecre);
  $numero_reportecre = mysqli_num_rows($result_reportecre);
  while($row_reportecre = mysqli_fetch_array($result_reportecre, MYSQLI_ASSOC)){
  $idproducto = $row_reportecre['id'];
  }

  if ($_POST['Po2_Pi1_VC'] != "" || $_POST['Po2_Pi1_PL'] != "" || $_POST['Po2_Pi1_CF'] != "" || $_POST['Po2_Pi1_NF'] != "") {
  $sql_insert1 = "INSERT INTO re_reporte_cre_pipas (id_re_producto,pipa_numero, volumen, precio_litro, costo_flete, no_factura, nombre_razonsocial,importe_total)
  VALUES ('".$idproducto."',1,'".$_POST['Po2_Pi1_VC']."','".$_POST['Po2_Pi1_PL']."','".$_POST['Po2_Pi1_CF']."','".$_POST['Po2_Pi1_NF']."', '".$_POST['Po2_Pi1_NRSC']."','".$_POST['Po2_Pi1_IT']."')";
  mysqli_query($con, $sql_insert1);
  }

  if ($_POST['Po2_Pi2_VC'] != "" || $_POST['Po2_Pi2_PL'] != "" || $_POST['Po2_Pi2_CF'] != "" || $_POST['Po2_Pi2_NF'] != "") {
  $sql_insert2 = "INSERT INTO re_reporte_cre_pipas (id_re_producto,pipa_numero, volumen, precio_litro, costo_flete, no_factura, nombre_razonsocial,importe_total)
  VALUES ('".$idproducto."',2,'".$_POST['Po2_Pi2_VC']."','".$_POST['Po2_Pi2_PL']."','".$_POST['Po2_Pi2_CF']."','".$_POST['Po2_Pi2_NF']."', '".$_POST['Po2_Pi2_NRSC']."','".$_POST['Po2_Pi2_IT']."')";
  mysqli_query($con, $sql_insert2);
  }

  if ($_POST['Po2_Pi3_VC'] != "" || $_POST['Po2_Pi3_PL'] != "" || $_POST['Po2_Pi3_CF'] != "" || $_POST['Po2_Pi3_NF'] != "") {
  $sql_insert2 = "INSERT INTO re_reporte_cre_pipas (id_re_producto,pipa_numero, volumen, precio_litro, costo_flete, no_factura, nombre_razonsocial,importe_total)
  VALUES ('".$idproducto."',3,'".$_POST['Po2_Pi3_VC']."','".$_POST['Po2_Pi3_PL']."','".$_POST['Po2_Pi3_CF']."','".$_POST['Po2_Pi3_NF']."', '".$_POST['Po2_Pi3_NRSC']."','".$_POST['Po2_Pi3_IT']."')";
  mysqli_query($con, $sql_insert2);
  }
}
/*----------------------------------------------------------------------------*/
if ($Session_ProductoTres != "") {

  $sql_insert = "INSERT INTO re_reporte_cre_producto (id_re_mes,fecha,producto,volumen_inicial,volumen_venta,volumen_final)
  VALUES ('".$_POST['IdReporte']."','".$_POST['Fecha']."','".$Session_ProductoTres."','".$_POST['Po3_VoI']."','".$_POST['Po3_VoV']."','".$_POST['Po3_VoF']."')";
  mysqli_query($con, $sql_insert);

  $sql_reportecre = "SELECT id FROM re_reporte_cre_producto WHERE id_re_mes = '".$_POST['IdReporte']."' and producto = '".$Session_ProductoTres."' ";
  $result_reportecre = mysqli_query($con, $sql_reportecre);
  $numero_reportecre = mysqli_num_rows($result_reportecre);
  while($row_reportecre = mysqli_fetch_array($result_reportecre, MYSQLI_ASSOC)){
  $idproducto = $row_reportecre['id'];
  }

  if ($_POST['Po3_Pi1_VC'] != "" || $_POST['Po3_Pi1_PL'] != "" || $_POST['Po3_Pi1_CF'] != "" || $_POST['Po3_Pi1_NF'] != "") {
  $sql_insert1 = "INSERT INTO re_reporte_cre_pipas (id_re_producto,pipa_numero, volumen, precio_litro, costo_flete, no_factura, nombre_razonsocial,importe_total)
  VALUES ('".$idproducto."',1,'".$_POST['Po3_Pi1_VC']."','".$_POST['Po3_Pi1_PL']."','".$_POST['Po3_Pi1_CF']."','".$_POST['Po3_Pi1_NF']."', '".$_POST['Po3_Pi1_NRSC']."','".$_POST['Po3_Pi1_IT']."')";
  mysqli_query($con, $sql_insert1);
  }

  if ($_POST['Po3_Pi2_VC'] != "" || $_POST['Po3_Pi2_PL'] != "" || $_POST['Po3_Pi2_CF'] != "" || $_POST['Po3_Pi2_NF'] != "") {
  $sql_insert2 = "INSERT INTO re_reporte_cre_pipas (id_re_producto,pipa_numero, volumen, precio_litro, costo_flete, no_factura, nombre_razonsocial,importe_total)
  VALUES ('".$idproducto."',2,'".$_POST['Po3_Pi2_VC']."','".$_POST['Po3_Pi2_PL']."','".$_POST['Po3_Pi2_CF']."','".$_POST['Po3_Pi2_NF']."', '".$_POST['Po3_Pi2_NRSC']."','".$_POST['Po3_Pi2_IT']."')";
  mysqli_query($con, $sql_insert2);
  }

  if ($_POST['Po3_Pi3_VC'] != "" || $_POST['Po3_Pi3_PL'] != "" || $_POST['Po3_Pi3_CF'] != "" || $_POST['Po3_Pi3_NF'] != "") {
  $sql_insert2 = "INSERT INTO re_reporte_cre_pipas (id_re_producto,pipa_numero, volumen, precio_litro, costo_flete, no_factura, nombre_razonsocial,importe_total)
  VALUES ('".$idproducto."',3,'".$_POST['Po3_Pi3_VC']."','".$_POST['Po3_Pi3_PL']."','".$_POST['Po3_Pi3_CF']."','".$_POST['Po3_Pi3_NF']."', '".$_POST['Po3_Pi3_NRSC']."','".$_POST['Po3_Pi3_IT']."')";
  mysqli_query($con, $sql_insert2);
  }
}
/*----------------------------------------------------------------------------*/
echo 1;
}
?>
