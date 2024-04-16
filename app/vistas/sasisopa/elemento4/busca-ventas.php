<?php 
require('../../../../app/help.php');
include_once "../../../../app/modelo/ObjetivosMetasIndicadores.php";
$class_objetivos_metas_indicadores = new ObjetivosMetasIndicadores();

$mes = date("m");
$year = date("Y");

$cols = $class_objetivos_metas_indicadores->construirCols($Session_ProductoUno,$Session_ProductoDos,$Session_ProductoTres);
$rows = $class_objetivos_metas_indicadores->construirRows($Session_ProductoUno,$Session_ProductoDos,$Session_ProductoTres,$Session_IDEstacion,$year,$mes);

$data = array("cols"=>$cols,"rows"=>$rows);

echo json_encode($data);
