<?php
require('../../../app/help.php');

$sql_id = "SELECT id FROM tb_lista_asistencia ORDER BY id desc LIMIT 1";
$result_id = mysqli_query($con, $sql_id);
$numero_id = mysqli_num_rows($result_id);

if ($numero_id == 0) {
$idiia = 1;
}else{
while($row_id = mysqli_fetch_array($result_id, MYSQLI_ASSOC)){
$idiia = $row_id['id'] + 1;
}
}

$sql_insert = "INSERT INTO tb_lista_asistencia (
id, id_estacion, id_usuario, punto_sasisopa, fecha, hora, lugar, tema, finalidad, encargado,estado
)
VALUES (
'".$idiia."',
'".$Session_IDEstacion."',
'".$Session_IDUsuarioBD."',
'".$_POST['PuntoSasisopa']."',
'',
'',
'',
'',
'',
'',
0
)";

if(mysqli_query($con, $sql_insert)){

echo $idiia;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------