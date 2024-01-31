<?php
require('../../../app/help.php');

$ruta = "../../../archivos/evaluacion-desempeño/".$_POST['id']."-EVALUACION-".strtotime($hoy).".pdf";
$nom = "archivos/evaluacion-desempeño/".$_POST['id']."-EVALUACION-".strtotime($hoy).".pdf";

if(move_uploaded_file($_FILES['file']['tmp_name'], $ruta)) {

$sql0 = "UPDATE tb_evaluacion_desempeno SET
archivo = '".$nom."'
 WHERE id = '".$_POST['id']."' ";

mysqli_query($con, $sql0);

}

$sql = "UPDATE tb_evaluacion_desempeno SET
fecha_hora = '".$_POST['EditFecha']." ".$hora_del_dia."'
 WHERE id = '".$_POST['id']."' ";


if(mysqli_query($con, $sql)){
echo 1;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------