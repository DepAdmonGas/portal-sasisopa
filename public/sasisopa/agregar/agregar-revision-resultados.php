<?php
require('../../../app/help.php');


$_POST['idUsuario'];
$_POST['idEstacion'];
$_POST['file'];

$ruta = "../../../archivos/revision-resultados/".$_POST['idEstacion']."-RESULTADOS-".strtotime($hoy).".pdf";
$nom = "archivos/revision-resultados/".$_POST['idEstacion']."-RESULTADOS-".strtotime($hoy).".pdf";

if(move_uploaded_file($_FILES['file']['tmp_name'], $ruta)) {}

$sql_insert1 = "INSERT INTO tb_revision_resultados (
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