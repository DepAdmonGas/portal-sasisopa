<?php
require('../../../app/help.php');

$idEstacion = $_POST['idEstacion'];
$Actividad = $_POST['Actividad'];
$Fecha = $_POST['Fecha'];

function Folio($idEstacion,$actividad, $con){
$sql = "SELECT folio FROM tb_calendario_actividades WHERE id_estacion = '".$idEstacion."' AND id_actividad = '".$actividad."' ORDER BY folio ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {
$folio = 1;
}else{
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$folio = $row['folio'] + 1;	
}
}
return $folio;
}

function IdMantenimiento($con){
$sql = "SELECT id FROM tb_calendario_actividades ORDER BY id ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {
$id = 1;
}else{
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$id = $row['id'] + 1; 
}
}
return $id;
}

$sql = "SELECT * FROM sa_sasisopa_actividades WHERE id = '".$Actividad."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$actividad = $row['actividad'];
$periodicidad = $row['periodicidad'];
}

function AgregarActividad($Fecha,$idEstacion,$Actividad,$con){

$Folio = Folio($idEstacion,$Actividad,$con);
$ID = IdMantenimiento($con);

$sql_insert = "INSERT INTO tb_calendario_actividades (
id,
id_estacion,
id_actividad,
folio,
fecha_inicio,
fecha_termino,
estado
  )
  VALUES (
  '".$ID."',
  '".$idEstacion."',
  '".$Actividad."',
  '".$Folio."',
  '".$Fecha."',
  '',
  0
  )";
  if(mysqli_query($con, $sql_insert)){
  return true;
  }else{
  return false;
  }
}

function ValidaActividad($idEstacion,$Actividad,$con){

$sql = "SELECT * FROM sa_sasisopa_estaciones_actividad WHERE id_estacion = '".$idEstacion."' AND id_actividad = '".$Actividad."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {

$sql_insert = "INSERT INTO sa_sasisopa_estaciones_actividad (
id_estacion,
id_actividad
  )
  VALUES (
  '".$idEstacion."',
  '".$Actividad."'
  )";
  if(mysqli_query($con, $sql_insert)){
  return true;
  }else{
  return false;
  }

}else{

return true;

}

}

AgregarActividad($Fecha,$idEstacion,$Actividad,$con);

if($periodicidad == "Diario"){

for ($i = 1; $i <= 1800; $i++) {
$SumaMes = 1 * $i;
$FechaNuevaM = date("Y-m-d",strtotime($Fecha."+ $SumaMes days"));
AgregarActividad($FechaNuevaM,$idEstacion,$Actividad,$con);
}

}else if($periodicidad == "Mensual"){

for ($i = 1; $i <= 60; $i++) {
$SumaMes = 1 * $i;
$FechaNuevaM = date("Y-m-d",strtotime($Fecha."+ $SumaMes month"));
AgregarActividad($FechaNuevaM,$idEstacion,$Actividad,$con);
}

}else if($periodicidad == "Trimestral"){

for ($i = 1; $i <= 20; $i++) {
$SumaMes = 3 * $i;
$FechaNuevaM = date("Y-m-d",strtotime($Fecha."+ $SumaMes month"));
AgregarActividad($FechaNuevaM,$idEstacion,$Actividad,$con);
}

}else if($periodicidad == "Semestral"){

for ($i = 1; $i <= 20; $i++) {
$SumaMes = 6 * $i;
$FechaNuevaM = date("Y-m-d",strtotime($Fecha."+ $SumaMes month"));
AgregarActividad($FechaNuevaM,$idEstacion,$Actividad,$con);
}

}else if($periodicidad == "Anual"){

for ($i = 1; $i <= 12; $i++) {
$SumaMes = 1 * $i;
$FechaNuevaM = date("Y-m-d",strtotime($Fecha."+ $SumaMes year"));
AgregarActividad($FechaNuevaM,$idEstacion,$Actividad,$con);
}


}else if($periodicidad == "5 años"){

for ($i = 1; $i <= 12; $i++) {
$SumaMes = 5 * $i;
$FechaNuevaM = date("Y-m-d",strtotime($Fecha."+ $SumaMes year"));
AgregarActividad($FechaNuevaM,$idEstacion,$Actividad,$con);
}

}

$val = ValidaActividad($idEstacion,$Actividad,$con);

if($val){
echo 1;  
}else{
echo 0;
}

mysqli_close($con);