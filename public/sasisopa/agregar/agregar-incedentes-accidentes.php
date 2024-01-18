<?php
require('../../../app/help.php');

$sql_id = "SELECT id FROM tb_investigacion_incidente_accidente ORDER BY id desc LIMIT 1";
$result_id = mysqli_query($con, $sql_id);
$numero_id = mysqli_num_rows($result_id);

if ($numero_id == 0) {
$idiia = 1;
}else{
while($row_id = mysqli_fetch_array($result_id, MYSQLI_ASSOC)){
$idiia = $row_id['id'] + 1;
}
}


if ($_POST['TipoAdd'] == 1) {

$sql_insert = "INSERT INTO tb_investigacion_incidente_accidente (
id,
id_estacion,
fechacreacion,
id_usuario,
descripcion,
tipo_evento,
muertes,
tercer_autorizado
)
VALUES (
'".$idiia."',
'".$Session_IDEstacion."',
'".$_POST['Fecha']." ".$hora_del_dia."',
'".$Session_IDUsuarioBD."',
'".$_POST['Descripcion']."',
'".$_POST['TipoEvento']."',
0,
0
)";
mysqli_query($con, $sql_insert);

}else if($_POST['TipoAdd'] == 2){

$sql_insert = "INSERT INTO tb_investigacion_incidente_accidente (
id,
id_estacion,
fechacreacion,
id_usuario,
descripcion,
tipo_evento,
muertes,
tercer_autorizado
)
VALUES (
'".$idiia."',
'".$Session_IDEstacion."',
'".$_POST['Fecha']." ".$hora_del_dia."',
'".$Session_IDUsuarioBD."',
'".$_POST['Descripcion']."',
'".$_POST['TipoEvento']."',
0,
'".$_POST['TercerA']."'
)";
mysqli_query($con, $sql_insert);

$sql_insert2 = "INSERT INTO tb_investigacion_incidente_accidente_tercerautorizado (
id_investigacion,
nombre,
numero,
lider,
fecha,
archivo
)
VALUES (
'".$idiia."',
'".$_POST['NombreTA']."',
'".$_POST['NumeroA']."',
'".$_POST['NombreLI']."',
'',
''
)";
mysqli_query($con, $sql_insert2);

}else if($_POST['TipoAdd'] == 3){

$sql_insert = "INSERT INTO tb_investigacion_incidente_accidente (
id,
id_estacion,
fechacreacion,
id_usuario,
descripcion,
tipo_evento,
muertes,
tercer_autorizado
)
VALUES (
'".$idiia."',
'".$Session_IDEstacion."',
'".$_POST['Fecha']." ".$hora_del_dia."',
'".$Session_IDUsuarioBD."',
'".$_POST['Descripcion']."',
'".$_POST['TipoEvento']."',
'".$_POST['Muertes']."',
'".$_POST['TercerA']."'
)";
mysqli_query($con, $sql_insert);

$sql_insert2 = "INSERT INTO tb_investigacion_incidente_accidente_tercerautorizado (
id_investigacion,
nombre,
numero,
lider,
fecha,
archivo
)
VALUES (
'".$idiia."',
'".$_POST['NombreTA']."',
'".$_POST['NumeroA']."',
'".$_POST['NombreLI']."',
'',
''
)";
mysqli_query($con, $sql_insert2);

}


//------------------
mysqli_close($con);
//------------------