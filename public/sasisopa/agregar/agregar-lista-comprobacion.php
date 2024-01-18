<?php
require('../../../app/help.php');

$sql_id = "SELECT id FROM tb_politica_lista_comprobacion ORDER BY id desc LIMIT 1";
$result_id = mysqli_query($con, $sql_id);
$numero_id = mysqli_num_rows($result_id);

if ($numero_id == 0) {
$idiia = 1;
}else{
while($row_id = mysqli_fetch_array($result_id, MYSQLI_ASSOC)){
$idiia = $row_id['id'] + 1;
}
}

$sql_insert = "INSERT INTO tb_politica_lista_comprobacion (
id,
id_estacion,
id_usuario,
fecha,
asistentes,
comentarios
)
VALUES (
'".$idiia."',
'".$Session_IDEstacion."',
'".$Session_IDUsuarioBD."',
'".$_POST['Fecha']."',
'".$_POST['Asistentes']."',
'".$_POST['Comentarios']."'
)";

if(mysqli_query($con, $sql_insert)){

$sql_insert1 = "INSERT INTO tb_politica_lista_comprobacion_detalle (
id_lista_comprobacion,criterio,resultado
)
VALUES (
'".$idiia."',
'La política es adecuada a la naturaleza magnitud y actividades del proyecto',
'".$_POST['R1']."'
)";
mysqli_query($con, $sql_insert1);

$sql_insert2 = "INSERT INTO tb_politica_lista_comprobacion_detalle (
id_lista_comprobacion,criterio,resultado
)
VALUES (
'".$idiia."',
'La política incluye la seguridad operativa',
'".$_POST['R2']."'
)";
mysqli_query($con, $sql_insert2);


$sql_insert3 = "INSERT INTO tb_politica_lista_comprobacion_detalle (
id_lista_comprobacion,criterio,resultado
)
VALUES (
'".$idiia."',
'La política incluye la protección al medio ambiente',
'".$_POST['R3']."'
)";
mysqli_query($con, $sql_insert3);

$sql_insert4 = "INSERT INTO tb_politica_lista_comprobacion_detalle (
id_lista_comprobacion,criterio,resultado
)
VALUES (
'".$idiia."',
'Los trabajadores, la alta dirección, los clientes y los subcontratistas tienen conocimiento de la política',
'".$_POST['R4']."'
)";
mysqli_query($con, $sql_insert4);

$sql_insert5 = "INSERT INTO tb_politica_lista_comprobacion_detalle (
id_lista_comprobacion,criterio,resultado
)
VALUES (
'".$idiia."',
'La política se revisa periódicamente',
'".$_POST['R5']."'
)";
mysqli_query($con, $sql_insert5);

$sql_insert6 = "INSERT INTO tb_politica_lista_comprobacion_detalle (
id_lista_comprobacion,criterio,resultado
)
VALUES (
'".$idiia."',
'La política se compromete al control de los peligros e impactos ambientales',
'".$_POST['R6']."'
)";
mysqli_query($con, $sql_insert6);

$sql_insert7 = "INSERT INTO tb_politica_lista_comprobacion_detalle (
id_lista_comprobacion,criterio,resultado
)
VALUES (
'".$idiia."',
'La política considera la participación del personal',
'".$_POST['R7']."'
)";
mysqli_query($con, $sql_insert7);

echo 1;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------