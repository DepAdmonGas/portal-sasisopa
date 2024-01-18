<?php
require('../../../app/help.php');

$sql_insert = "INSERT INTO tb_investigacion_incidente_accidente_grupo (
id_investigacion,
nombre,
puesto,
especialidad
)
VALUES (
'".$_POST['id']."',
'".$_POST['NombreG']."',
'".$_POST['PuestoG']."',
'".$_POST['EspecialidadG']."'
)";
mysqli_query($con, $sql_insert);

//------------------
mysqli_close($con);
//------------------
