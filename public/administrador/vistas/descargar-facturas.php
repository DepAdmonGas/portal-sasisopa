<?php 
require('app/help.php');

$sql_estacion = "SELECT razonsocial FROM tb_estaciones WHERE id = '".$idEstacion."' ";
$result_estacion = mysqli_query($con, $sql_estacion);
$numero_estacion = mysqli_num_rows($result_estacion);

while($row_estacion = mysqli_fetch_array($result_estacion, MYSQLI_ASSOC)){
$razonsocial = $row_estacion['razonsocial'];
}

$adarchivos = array();

$nombre_zip = 'Facturas CRE '.$razonsocial.'.zip';

$mizip = new ZipArchive();
$mizip->open($nombre_zip, ZipArchive::CREATE);


$sql_reportecre = "SELECT * FROM re_reporte_cre_mes WHERE id_estacion = '".$idEstacion."' and year = '".$selyear."' ";
$result_reportecre = mysqli_query($con, $sql_reportecre);
$numero_reportecre = mysqli_num_rows($result_reportecre);
while($row_reportecre = mysqli_fetch_array($result_reportecre, MYSQLI_ASSOC)){
$idReporteCre = $row_reportecre['id'];
$mes = $row_reportecre['mes'];

$Ffactura_uno = $row_reportecre['f_producto_uno'];
$Ffactura_dos = $row_reportecre['f_producto_dos'];
$Ffactura_tres = $row_reportecre['f_producto_tres'];

$FIfactura_uno = $row_reportecre['fi_producto_uno'];
$FIfactura_dos = $row_reportecre['fi_producto_dos'];
$FIfactura_tres = $row_reportecre['fi_producto_tres'];

$FFfactura_uno = $row_reportecre['ff_producto_uno'];
$FFfactura_dos = $row_reportecre['ff_producto_dos'];
$FFfactura_tres = $row_reportecre['ff_producto_tres'];

$adarchivos[] = $Ffactura_uno;
$adarchivos[] = $Ffactura_dos;
$adarchivos[] = $Ffactura_tres;
$adarchivos[] = $FIfactura_uno;
$adarchivos[] = $FIfactura_dos;
$adarchivos[] = $FIfactura_tres;
$adarchivos[] = $FFfactura_uno;
$adarchivos[] = $FFfactura_dos;
$adarchivos[] = $FFfactura_tres;
}

foreach ($adarchivos as $nuevo){

$sql = "SELECT * FROM re_reporte_cre_mes WHERE f_producto_uno = '".$nuevo."' OR f_producto_dos = '".$nuevo."' OR f_producto_tres = '".$nuevo."' OR fi_producto_uno = '".$nuevo."' OR fi_producto_dos = '".$nuevo."' OR fi_producto_tres = '".$nuevo."' OR ff_producto_uno = '".$nuevo."' OR ff_producto_dos = '".$nuevo."' OR ff_producto_tres = '".$nuevo."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$mes = $row['mes'];
}

$nombremes = nombremes($mes);

$mizip->addFile($nuevo, $nombremes."/".$nuevo);
}
$mizip->close();

header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$nombre_zip);
header('Content-Length: ' . filesize($nombre_zip));
readfile($nombre_zip);

unlink($nombre_zip);

