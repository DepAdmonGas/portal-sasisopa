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
 firma,
 bitacora_app,
 fecha_ingreso,
 respoabilidad_sgm,
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
  '',
  0,
  '".$_POST['FechaIngreso']."',
  '',
  0
  )";

if (mysqli_query($con, $sql_insert)) {

  $Fecha1 = date("Y-m-d",strtotime($fecha_del_dia."+ 1 day"));
  $Fecha2 = date("Y-m-d",strtotime($fecha_del_dia."+ 2 day"));
  $Fecha3 = date("Y-m-d",strtotime($fecha_del_dia."+ 3 day"));
  $Fecha4 = date("Y-m-d",strtotime($fecha_del_dia."+ 4 day"));
  $Fecha5 = date("Y-m-d",strtotime($fecha_del_dia."+ 5 day"));

  Guardar($Fecha1,$Session_IDEstacion,$IdUsuario,1,$con);
  Guardar($Fecha2,$Session_IDEstacion,$IdUsuario,2,$con);

  Guardar($Fecha3,$Session_IDEstacion,$IdUsuario,24,$con);
  Guardar($Fecha4,$Session_IDEstacion,$IdUsuario,25,$con);
  Guardar($Fecha5,$Session_IDEstacion,$IdUsuario,26,$con);

  echo 1;

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
