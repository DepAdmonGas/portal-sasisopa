<?php
require('../../../app/help.php');

$array = $_POST['NombrePersonal'];

foreach ($array as &$valor) {

$sql_insert = "INSERT INTO tb_programa_anual_simulacros_personal (
id_programa,
nombre
)
VALUES (
'".$_POST['id_programa']."',
'".$valor."'
)";
mysqli_query($con, $sql_insert);

}

//------------------
mysqli_close($con);
//------------------