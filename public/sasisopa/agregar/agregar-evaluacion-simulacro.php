<?php
require('../../../app/help.php');

$idPrograma = $_POST['idPrograma'];
$FileEvaluacion = $_FILES['FileEvaluacion']['name'];


$ruta_file = "../../../archivos/protocolo/"."EVALUACION-SIMULACRO-".$idPrograma."-".strtotime($hoy).".pdf";

if($FileEvaluacion != "") {
$ruta_protocolo = "archivos/protocolo/"."EVALUACION-SIMULACRO-".$idPrograma."-".strtotime($hoy).".pdf";
}else{
$ruta_protocolo = "";
}

if(move_uploaded_file($_FILES['FileEvaluacion']['tmp_name'], $ruta_file)) {}

$sql_insert1 = "INSERT INTO tb_programa_anual_simulacros_evaluacion (
id_programa,
archivo
)
VALUES 
(
'".$idPrograma."',
'".$ruta_protocolo."'
)";
mysqli_query($con, $sql_insert1);

//------------------
mysqli_close($con);
//------------------