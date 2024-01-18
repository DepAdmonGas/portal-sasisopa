<?php
require('../../../app/help.php');

$ruta = "../../../archivos/calibracion/RESULTADOS-".strtotime($hoy).".pdf";
$nom = "RESULTADOS-".strtotime($hoy).".pdf";

if(move_uploaded_file($_FILES['file']['tmp_name'], $ruta)) {

$sql = "UPDATE tb_calibracion_equipos_tanques SET
resultados = '".$nom."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}

//------------------
mysqli_close($con);
//------------------