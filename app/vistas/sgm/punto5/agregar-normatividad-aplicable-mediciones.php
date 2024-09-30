<?php
require('../../../../app/help.php');


$sql_insert = "INSERT INTO sgm_inventario_normatividad_aplicable (
norma, fecha_publicacion, fecha_aplicacion, equipo, link, estado
)
VALUES (
'".$_POST['Norma']."',
'".$_POST['FechaPublicacion']."',
'".$_POST['FechaAplicacion']."',
'".$_POST['EquipoProcedimiento']."',
'".$_POST['Link']."',
'".$Session_IDEstacion."'
)";

if(mysqli_query($con, $sql_insert)){
echo 1;
}else{
echo 0;
}

//-----------------
mysqli_close($con);
//-----------------