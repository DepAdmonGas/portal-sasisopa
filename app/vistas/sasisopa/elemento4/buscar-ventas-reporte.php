<?php 
require('../../../../app/help.php');
include_once "../../../../app/modelo/ObjetivosMetasIndicadores.php";
$class_objetivos_metas_indicadores = new ObjetivosMetasIndicadores();

$Year = $_GET['Year'];

$cols = $class_objetivos_metas_indicadores->construirCols($Session_ProductoUno,$Session_ProductoDos,$Session_ProductoTres);
$rows = $class_objetivos_metas_indicadores->construirRows($Session_ProductoUno,$Session_ProductoDos,$Session_ProductoTres,$Session_IDEstacion,$Year,12);

$data = array("cols"=>$cols,"rows"=>$rows);

echo json_encode($data);

