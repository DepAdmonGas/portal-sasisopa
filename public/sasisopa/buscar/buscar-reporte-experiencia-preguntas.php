<?php 
require('../../../app/help.php');

$idReporte = $_GET['id'];
$idPregunta = $_GET['pre'];

$sql_encuesta = "SELECT id FROM tb_encuentas_estacion_cliente WHERE id_cuentas_estacion = '".$idReporte."' ";
$result_encuesta = mysqli_query($con, $sql_encuesta);
$numero_encuesta = mysqli_num_rows($result_encuesta);
while($row_encuesta = mysqli_fetch_array($result_encuesta, MYSQLI_ASSOC)){

$IdCliente = $row_encuesta['id'];

$sql_encuestaP = "SELECT resultado FROM tb_encuentas_estacion_cliente_preguntas WHERE id_cliente = '".$IdCliente."' AND id_pregunta = '".$idPregunta."' ORDER BY resultado desc";
$result_encuestaP = mysqli_query($con, $sql_encuestaP);
$numero_encuestaP = mysqli_num_rows($result_encuestaP);
while($row_encuestaP = mysqli_fetch_array($result_encuestaP, MYSQLI_ASSOC)){

$row_encuestaP['resultado'];

if($row_encuestaP['resultado'] == 4){
$resultado4 = $resultado4 + 1;
}else if($row_encuestaP['resultado'] == 3){
$resultado3 = $resultado3 + 1;
}else if($row_encuestaP['resultado'] == 2){
$resultado2 = $resultado2 + 1;
}else if($row_encuestaP['resultado'] == 1){
$resultado1 = $resultado1 + 1;
}

} 
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
