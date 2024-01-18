<?php
require('../../../app/help.php');


if ($_POST['estado'] == 1) {

$sql_insert = "INSERT INTO tb_implementacion_sasisopa_procedimientos_puesto (
id_reporte,
id_lista,
puesto
)
VALUES 
(
'".$_POST['id']."',
'".$_POST['idPuesto']."',
'".$_POST['Puesto']."'
)";
mysqli_query($con, $sql_insert);

}

if ($_POST['estado'] == 0) {

$sql = "DELETE FROM tb_implementacion_sasisopa_procedimientos_puesto WHERE id_reporte = '".$_POST['id']."' AND id_lista = '".$_POST['idPuesto']."'  ";
mysqli_query($con, $sql);

}


//------------------
mysqli_close($con);
//------------------