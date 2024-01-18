<?php
require('../../../app/help.php');

$id = $_POST['idHallazgo'];
$FileEvidencia = $_FILES['File']['name'];

$extension = pathinfo($FileEvidencia, PATHINFO_EXTENSION);

$ruta_file = "../../../archivos/atencion-hallazgos/Atencion-Hallazgos-".strtotime($hoy).".".$extension;

$ruta_protocolo = "Atencion-Hallazgos-".strtotime($hoy).".".$extension;


if(move_uploaded_file($_FILES['File']['tmp_name'], $ruta_file)) {

$sql_insert1 = "INSERT INTO tb_atencion_hallazgos_evidencia (
id_hallazgo,
archivo
)
VALUES 
(
'".$id."',
'".$ruta_protocolo."'
)";

if(mysqli_query($con, $sql_insert1)){
echo 1;
}else{
echo 0;
}

}
//------------------
mysqli_close($con);
//------------------