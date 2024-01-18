<?php
require('../../../app/help.php');

if($_POST['id'] == 0){

$sql_insert = "INSERT INTO tb_programa_anual_simulacros (
id_estacion,
nombre_simulacro,
periodicidad,
fecha
)
VALUES (
'".$_POST['idEstacion']."',
'".$_POST['NombreSimulacro']."',
'".$_POST['Periodicidad']."',
'".$_POST['Fecha']."'
)";
mysqli_query($con, $sql_insert);

}else{

$sql = "UPDATE tb_programa_anual_simulacros SET
fecha = '".$_POST['Fecha']."',
nombre_simulacro = '".$_POST['NombreSimulacro']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}



//------------------
mysqli_close($con);
//------------------