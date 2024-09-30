<?php
require('../../../../app/help.php');

if($_POST['cate'] == 2){

if($_POST['id'] == 0){

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

$sql = "INSERT INTO sgm_programa_anual_capacitacion_externa (
id_estacion, 
id_personal,
nombre_curso,
tipo_capacitacion,
fecha_programada,
duracion,
instructor,
fecha_real,
realizadopor,
estado 	
)
VALUES (
'".$Session_IDEstacion."',
'".$Session_IDUsuarioBD."',
'".$_POST['Nombrecurso']."',
'".$_POST['Capacitacion']."',
'".$_POST['Fechaprogramada']."',
'".$_POST['Duracion']."',
'".$_POST['Instructor']."',
'',
'".$realizadopor."',
0
)";

}else{

$sql = "UPDATE sgm_programa_anual_capacitacion_externa
SET 
nombre_curso = '".$_POST['Nombrecurso']."',
fecha_programada = '".$_POST['Fechaprogramada']."',
duracion = '".$_POST['Duracion']."',
instructor = '".$_POST['Instructor']."',
fecha_real = '".$_POST['Fecharealprogramada']."',
estado = 1
WHERE id = '".$_POST['id']."' ";

}

}


if(mysqli_query($con, $sql)){
echo 1;
}else{
echo 0;
}




