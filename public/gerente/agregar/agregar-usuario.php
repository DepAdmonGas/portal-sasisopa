<?php
require('../../../app/help.php');

$_POST['idEstacion'];
$_POST['Nombres'];
$_POST['ApellidoP'];
$_POST['ApellidoM'];
$_POST['Email'];
$_POST['Puesto'];
$_POST['Telefono'];
$_POST['NomUsuario'];
$_POST['PasswordOriginal'];

function IdUsuario($con){
$sql = "SELECT id FROM tb_usuarios ORDER BY id ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {
$idUsuario = 1;
}else{
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$idUsuario = $row['id'] + 1; 
}
}
return $idUsuario;
}

$IdUsuario = IdUsuario($con);

$sql_insert = "INSERT INTO tb_usuarios (
 id,
 nombre,
 email,
 telefono,
 id_gas,
 id_puesto,
 usuario,
 password,
 fecha_nacimiento,
 estado_civil,
 seguro_social,
 domicilio,
 estatus)
VALUES (
  '".$IdUsuario."',
  '".$_POST['Nombres']."',
  '".$_POST['Email']."',
  '".$_POST['Telefono']."',
  '".$Session_IDEstacion."',
  '".$_POST['Puesto']."',
  '".$_POST['NomUsuario']."',
  '".$_POST['PasswordOriginal']."',
  '',
  '',
  '',
  '',
  0
  )";

if (mysqli_query($con, $sql_insert)) {

  $Fecha1 = date("Y-m-d",strtotime($fecha_del_dia."+ 1 day"));
  $Fecha2 = date("Y-m-d",strtotime($fecha_del_dia."+ 2 day"));

  Guardar($Fecha1,$Session_IDEstacion,$IdUsuario,1,$con);
  Guardar($Fecha2,$Session_IDEstacion,$IdUsuario,2,$con);

} else {

}

function Guardar($Fecha,$IDEstacion,$IdUsuario,$tema,$con){

$sql_insert = "INSERT INTO tb_cursos_calendario (
    fecha_programada,
    fecha_real,
    id_estacion,
    id_personal,
    id_tema,
    resultado,
    observaciones,
    estado
    )
    VALUES 
    (
    '".$Fecha."',
    '', 
    '".$IDEstacion."',
    '".$IdUsuario."',
    '".$tema."',
    0,
    'Inducción',
    0
    )";
    mysqli_query($con, $sql_insert);

}

mysqli_close($con);

?>
