<?php
require('../../../../app/help.php');

$id = $_POST['idEquipo'];
$FileEvidencia = $_FILES['File']['name'];

$extension = pathinfo($FileEvidencia, PATHINFO_EXTENSION);

$ruta_file = "../../../../archivos/manuales/MANUAL-GARANTIA-INFORMACION-EQUIPO-".strtotime($hoy).".".$extension;

$ruta_protocolo = "MANUAL-GARANTIA-INFORMACION-EQUIPO-".strtotime($hoy).".".$extension;


if(move_uploaded_file($_FILES['File']['tmp_name'], $ruta_file)) {

echo $sql_insert1 = "INSERT INTO sgm_inventario_equipo_manual (
id_equipo,
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