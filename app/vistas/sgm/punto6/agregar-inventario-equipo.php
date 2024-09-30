<?php
require('../../../../app/help.php');

function numId($con){
$sql = "SELECT id FROM sgm_inventario_equipo ORDER BY id desc LIMIT 1";
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

$numId = numId($con);

$sql_insert = "INSERT INTO sgm_inventario_equipo (
id,id_estacion,nombre,identificacion,funcion,fecha_instalacion,realizadopor,estado
)
VALUES (
'".$numId."',
'".$Session_IDEstacion."',
'',
'',
'',
'',
'".$realizadopor."',
2
)";

if(mysqli_query($con, $sql_insert)){
echo $numId;
}else{
echo 0;
}

//-----------------
mysqli_close($con);
//-----------------