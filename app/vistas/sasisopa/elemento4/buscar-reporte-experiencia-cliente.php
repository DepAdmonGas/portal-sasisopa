<?php 
require('../../../../app/help.php');
include_once "../../../../app/modelo/ObjetivosMetasIndicadores.php";

$class_objetivos_metas_indicadores = new ObjetivosMetasIndicadores();

$resultado4 = 0;
$resultado3 = 0;
$resultado2 = 0;
$resultado1 = 0;

$sql_encuesta = "SELECT id FROM tb_encuentas_estacion WHERE id_estacion = '".$Session_IDEstacion."' and estado = 1 ORDER BY id asc";
$result_encuesta = mysqli_query($con, $sql_encuesta);
$numero_encuesta = mysqli_num_rows($result_encuesta);

while($row_encuesta = mysqli_fetch_array($result_encuesta, MYSQLI_ASSOC)){
$IdReporte = $row_encuesta['id'];
$Total = $class_objetivos_metas_indicadores->Total($IdReporte);
$resultado4 = $resultado4 + $Total['resultado4'];
$resultado3 = $resultado3 + $Total['resultado3'];
$resultado2 = $resultado2 + $Total['resultado2'];
$resultado1 = $resultado1 + $Total['resultado1'];
}

$cols[] = array('id' => '1','label' => 'Titulo', 'type' => 'string');
$cols[] = array('id' => '2','label' => 'Resultado', 'type' => 'string');

$temp4[] = array('v' => 'Excelente ('.$resultado4.')');
$temp4[] = array('v' => $resultado4);

$temp3[] = array('v' => 'Bueno ('.$resultado3.')');
$temp3[] = array('v' => $resultado3);

$temp2[] = array('v' => 'Regular ('.$resultado2.')');
$temp2[] = array('v' => $resultado2);

$temp1[] = array('v' => 'Malo ('.$resultado1.')');
$temp1[] = array('v' => $resultado1);

$rows[] = array('c' => $temp4);
$rows[] = array('c' => $temp3);
$rows[] = array('c' => $temp2);
$rows[] = array('c' => $temp1);

$data = array("cols"=>$cols,"rows"=>$rows);

echo json_encode($data);