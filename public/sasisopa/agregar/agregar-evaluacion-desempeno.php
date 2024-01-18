<?php
require('../../../app/help.php');


$_POST['idUsuario'];
$_POST['idEstacion'];
$_POST['file'];

$ruta = "../../../archivos/evaluacion-desempeño/".$_POST['idEstacion']."-EVALUACION-".strtotime($hoy).".pdf";
$nom = "archivos/evaluacion-desempeño/".$_POST['idEstacion']."-EVALUACION-".strtotime($hoy).".pdf";

if(move_uploaded_file($_FILES['file']['tmp_name'], $ruta)) {}

$sql_insert1 = "INSERT INTO tb_evaluacion_desempeno (
id_estacion,
id_usuario,
archivo
)
VALUES 
(
'".$_POST['idEstacion']."',
'".$_POST['idUsuario']."',
'".$nom."'
)";
mysqli_query($con, $sql_insert1);

//------------------
mysqli_close($con);
//------------------