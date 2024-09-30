<?php
require('../../../../app/help.php');

$sql = "SELECT
sgm_autorizado.id_usuario,
sgm_autorizado.estado,
tb_usuarios.id_gas
FROM sgm_autorizado 
INNER JOIN tb_usuarios 
ON sgm_autorizado.id_usuario = tb_usuarios.id WHERE tb_usuarios.id_gas = '".$Session_IDEstacion."' AND sgm_autorizado.estado = 1 LIMIT 1";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero > 0) {
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$realizadopor = $row['id_usuario'];
}else{
$realizadopor = 0;
}

function numId($con){
$sql = "SELECT id FROM sgm_seguimiento_objetivo_indicador ORDER BY id desc LIMIT 1";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {
$id = 1;
}else{
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$id = $row['id'] + 1;
}
return $id;
}

$numId = numId($con);


$sql_insert = "INSERT INTO sgm_seguimiento_objetivo_indicador (
id, id_estacion, id_usuario, fecha, hora, lugar, realizadopor, estado 
)
VALUES (
'".$numId."',
'".$Session_IDEstacion."',
'".$Session_IDUsuarioBD."',
'',
'',
'',
'".$realizadopor."',
0
)";

if(mysqli_query($con, $sql_insert)){

$sql1 = "INSERT INTO sgm_seguimiento_implementacion_sgm (
id_seguimiento, respuesta_uno, respuesta_dos, respuesta_tres, respuesta_cuatro
)
VALUES (
'".$numId."',
0,
0,
'',
''
)";

$sql2 = "INSERT INTO sgm_seguimiento_calibracion_equipo (
id_seguimiento, respuesta_uno, respuesta_dos, respuesta_tres
)
VALUES (
'".$numId."',
0,
'',
''
)";

$sql3 = "INSERT INTO sgm_seguimiento_satisfaccion_cliente (
id_seguimiento, respuesta_uno, respuesta_dos, respuesta_tres, respuesta_cuatro, respuesta_cinco
)
VALUES (
'".$numId."',
0,
0,
0,
'',
''
)";

mysqli_query($con, $sql1);
mysqli_query($con, $sql2);
mysqli_query($con, $sql3);

echo $numId;

}


//-----------------
mysqli_close($con);
//-----------------