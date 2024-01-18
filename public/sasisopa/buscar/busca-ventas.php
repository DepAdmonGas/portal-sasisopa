<?php 
require('../../../app/help.php');

function ConstCols($Session_ProductoUno,$Session_ProductoDos,$Session_ProductoTres){

$colid = array('id' => '','label' => '', 'pattern' => '', 'type' => 'string');

if ($Session_ProductoUno != "") {
$colprod1 = array('id' => '','label' => $Session_ProductoUno, 'pattern' => '', 'type' => 'number');
}

if ($Session_ProductoDos != "") {
$colprod2 = array('id' => '','label' => $Session_ProductoDos, 'pattern' => '', 'type' => 'number');
}

if ($Session_ProductoTres != "") {
$colprod3 = array('id' => '','label' => $Session_ProductoTres, 'pattern' => '', 'type' => 'number');
}

if ($Session_ProductoUno != "" && $Session_ProductoDos != "" && $Session_ProductoTres != "") {
$myarray = array($colid, $colprod1, $colprod2,$colprod3);
}if ($Session_ProductoUno != "" && $Session_ProductoDos != "" && $Session_ProductoTres == "") {
$myarray = array($colid, $colprod1, $colprod2);
}

return $myarray;

}

function ConstRows($Session_ProductoUno,$Session_ProductoDos,$Session_ProductoTres,$Session_IDEstacion,$con){

$fecha_mes = date("m");
$fecha_year = date("Y");

for ($i=1; $i <= $fecha_mes; $i++) { 

if ($Session_ProductoUno != "") {
$da[] = BuscaVentas($i,$fecha_year,$Session_ProductoUno,$Session_ProductoDos,$Session_ProductoTres,$Session_IDEstacion,$con);
}
}
return $da;
}

function BuscaVentas($mes,$fecha_year,$Session_ProductoUno,$Session_ProductoDos,$Session_ProductoTres,$Session_IDEstacion,$con){


$sql_reportecre = "SELECT id FROM re_reporte_cre_mes WHERE id_estacion = '".$Session_IDEstacion."' AND mes = '".$mes."' AND year = '".$fecha_year."' ORDER BY mes asc ";
$result_reportecre = mysqli_query($con, $sql_reportecre);
while($row_reportecre = mysqli_fetch_array($result_reportecre, MYSQLI_ASSOC)){
$idReporte = $row_reportecre['id'];

$sql_producto1 = "SELECT sum(volumen_venta) AS totalProducto FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporte."' AND producto = '".$Session_ProductoUno."' LIMIT 1 ";
$result_producto1 = mysqli_query($con, $sql_producto1);
while($row_producto1 = mysqli_fetch_array($result_producto1, MYSQLI_ASSOC)){
$total1 = $row_producto1['totalProducto'];
}

$sql_producto2 = "SELECT sum(volumen_venta) AS totalProducto FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporte."' AND producto = '".$Session_ProductoDos."' LIMIT 1 ";
$result_producto2 = mysqli_query($con, $sql_producto2);
while($row_producto2 = mysqli_fetch_array($result_producto2, MYSQLI_ASSOC)){
$total2 = $row_producto2['totalProducto'];
}

$sql_producto3 = "SELECT sum(volumen_venta) AS totalProducto FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporte."' AND producto = '".$Session_ProductoTres."' LIMIT 1 ";
$result_producto3 = mysqli_query($con, $sql_producto3);
while($row_producto3 = mysqli_fetch_array($result_producto3, MYSQLI_ASSOC)){
$total3 = $row_producto3['totalProducto'];
}

$temp[] = array('v' => nombremes($mes));

if ($Session_ProductoUno != "" && $Session_ProductoDos != "" && $Session_ProductoTres != "") {

$temp[] = array('v' => $total1);
$temp[] = array('v' => $total2);
$temp[] = array('v' => $total3);

}if ($Session_ProductoUno != "" && $Session_ProductoDos != "" && $Session_ProductoTres == "") {

$temp[] = array('v' => $total1);
$temp[] = array('v' => $total2);

}

}
$rows = array('c' => $temp);
return $rows;

}
 
$cols = ConstCols($Session_ProductoUno,$Session_ProductoDos,$Session_ProductoTres);
$rows = ConstRows($Session_ProductoUno,$Session_ProductoDos,$Session_ProductoTres,$Session_IDEstacion,$con);

$data = array("cols"=>$cols,"rows"=>$rows);

echo json_encode($data);

