<?php
require('../../../app/help.php');

$sql1 = "DELETE FROM tb_requisicion_obra_formato_15 WHERE id_requisicion = '".$_POST['id']."' ";
mysqli_query($con, $sql1);

$sql_insert = "INSERT INTO tb_requisicion_obra_formato_15 (
id_requisicion,
archivo,
fecha_lv,
hora_lv,
id_usuario,
pregunta1,
pregunta2,
pregunta3,
pregunta4,
pregunta5
)
VALUES 
(
'".$_POST['id']."', 
'',
'".$_POST['Fecha']."',
'".$_POST['Hora']."',
'".$_POST['idSuperviso']."',
'".$_POST['R1']."',
'".$_POST['R2']."',
'".$_POST['R3']."',
'".$_POST['R4']."',
'".$_POST['R5']."'
)";
mysqli_query($con, $sql_insert);

//------------------
mysqli_close($con);
//------------------