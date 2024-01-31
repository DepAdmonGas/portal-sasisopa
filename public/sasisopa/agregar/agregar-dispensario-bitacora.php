<?php
require('../../../app/help.php');

if($_POST['categoria'] == 2){

CambioPrecio($Session_IDEstacion,$_POST['Fecha'],$_POST['HoraInicio'],$_POST['HoraTermino'],$_POST['Producto'],$Session_IDUsuarioBD,$_POST['Detalle'],$con);

echo 1;

}else{

if($_POST['categoria'] == 1){
$Clave = 'CALI';
$Motivo = 'Ajuste';
}else if($_POST['categoria'] == 3){
$Clave = 'APPU';
$Motivo = 'Apertura en puerta';
}else if($_POST['categoria'] == 4){
$Clave = 'ACMO';
$Motivo = 'Acceso al modo de programacion';
}else if($_POST['categoria'] == 5){
$Clave = 'CAMF';
$Motivo = 'Cambio de fecha y hora';
}else if($_POST['categoria'] == 6){
$Clave = 'ACTU';
$Motivo = 'Actualizacion del o los programas de computo';
}else if($_POST['categoria'] == 7){
$Clave = 'MAGRL';
$Motivo = 'Mantenimiento General';
}

$sql_insert1 = "INSERT INTO tb_dispensarios_apertura_bitacora (
id_dispensario,
fecha,
hora_inicio,
hora_termino,
lado,
producto,
clave,
motivo,
responsable,
detalle
)
VALUES 
(
'".$_POST['Dispensario']."',
'".$_POST['Fecha']."',
'".$_POST['HoraInicio']."',
'".$_POST['HoraTermino']."',
'".$_POST['Lado']."',
'".$_POST['Producto']."',
'".$Clave."',
'".$Motivo."',
'".$Session_IDUsuarioBD."',
'".$_POST['Detalle']."'
)";

if(mysqli_query($con, $sql_insert1)){
echo 1;
}else{
echo 0;
}

}

function CambioPrecio($idEstacion,$Fecha,$HoraInicio,$HoraTermino,$Producto,$idUsuario,$Detalle,$con){

$sql = "SELECT * FROM tb_dispensarios WHERE id_estacion = '".$idEstacion."' ORDER BY no_dispensario ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$idDispensario = $row['id'];

if($Producto == 'G SUPER' || $Producto == 'MAGNA'){
GuardaRegistro($idDispensario,$Fecha,$HoraInicio,$HoraTermino,$Producto,$idUsuario,$Detalle,$row['producto1'],$con);
}else if($Producto == 'G PREMIUM' || $Producto == 'PREMIUM'){
GuardaRegistro($idDispensario,$Fecha,$HoraInicio,$HoraTermino,$Producto,$idUsuario,$Detalle,$row['producto2'],$con);
}else if($Producto == 'G DIESEL' || $Producto == 'DIESEL'){
GuardaRegistro($idDispensario,$Fecha,$HoraInicio,$HoraTermino,$Producto,$idUsuario,$Detalle,$row['producto3'],$con);
}

}

}

function GuardaRegistro($idDispensario,$Fecha,$HoraInicio,$HoraTermino,$Producto,$idUsuario,$Detalle,$mangueras,$con){

if ($mangueras > 0) {

$lado = 1;
for ($i=1; $i <= $mangueras; $i++) { 

$sql_insert1 = "INSERT INTO tb_dispensarios_apertura_bitacora (
id_dispensario,
fecha,
hora_inicio,
hora_termino,
lado,
producto,
clave,
motivo,
responsable,
detalle
)
VALUES 
(
'".$idDispensario."',
'".$Fecha."',
'".$HoraInicio."',
'".$HoraTermino."',
'".$lado."',
'".$Producto."',
'CAMP',
'Cambio de precio',
'".$idUsuario."',
'".$Detalle."'
)";

mysqli_query($con, $sql_insert1);


$lado++;
}  

}
}


/*
   function Folio($idEstacion, $con){

  $sql_reporte = "SELECT 
  tb_dispensarios.id_estacion,
  tb_dispensarios_bitacora.folio
  FROM tb_dispensarios_bitacora
  INNER JOIN tb_dispensarios
  ON tb_dispensarios_bitacora.id_dispensario = tb_dispensarios.id
  WHERE tb_dispensarios.id_estacion = '".$idEstacion."' ORDER BY tb_dispensarios_bitacora.folio desc LIMIT 1";
  $result_reporte = mysqli_query($con, $sql_reporte);
  $numero_reporte = mysqli_num_rows($result_reporte);

  if($numero_reporte != 0){
  while($row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC)){
  $NoFolio = $row_reporte['folio'];
  }

  $Folio = $NoFolio + 1;

  }else{
  $Folio = 1;
  }

  return $Folio;

  }

function CambioPrecio($IDEstacion,$Fecha,$HoraInicio,$HoraTermino,$Producto,$Motivo,$Responsable,$Observaciones,$con){

$sql = "SELECT id, no_dispensario FROM tb_dispensarios WHERE id_estacion = '".$IDEstacion."' ORDER BY no_dispensario ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$folio1 = Folio($IDEstacion,$con);

$sql_insert1 = "INSERT INTO tb_dispensarios_bitacora (
folio,
id_dispensario,
fecha,
hora_inicio,
hora_termino,
lado,
producto,
motivo,
responsable,
observaciones,
estado
)
VALUES 
(
'".$folio1."',
'".$row['id']."',
'".$Fecha."',
'".$HoraInicio."',
'".$HoraTermino."',
'A',
'".$Producto."',
'".$Motivo."',
'".$Responsable."',
'".$Observaciones."',
1
)";

mysqli_query($con, $sql_insert1);

//-----------------------------------------
$folio2 = Folio($IDEstacion,$con);

$sql_insert2 = "INSERT INTO tb_dispensarios_bitacora (
folio,
id_dispensario,
fecha,
hora_inicio,
hora_termino,
lado,
producto,
motivo,
responsable,
observaciones,
estado
)
VALUES 
(
'".$folio2."',
'".$row['id']."',
'".$Fecha."',
'".$HoraInicio."',
'".$HoraTermino."',
'B',
'".$Producto."',
'".$Motivo."',
'".$Responsable."',
'".$Observaciones."',
1
)";

mysqli_query($con, $sql_insert2);

}


}

$idEstacion = $_POST['idEstacion'];

$folio = Folio($idEstacion,$con);

if ($_POST['producto2']) {
$producto2 = $_POST['producto2'];
}else{
$producto2 = "";
}

if ($_POST['producto3']) {
$producto3 = $_POST['producto3'];
}else{
$producto3 = "";
}

if ($_POST['producto2'] != "" && $_POST['producto1'] != "") {
$Coma1 = ", ";
}else{
$Coma1 = "";
}

if ($_POST['producto3'] != "" && $_POST['producto2'] != "") {
$Coma2 = ", ";
}else{
$Coma2 = "";
}


if($_POST['CambioPrecio'] == 1){

$productoSel = $_POST['producto1'].$Coma1.$producto2.$Coma2.$producto3;

CambioPrecio($Session_IDEstacion,$_POST['Fecha'],$_POST['HoraInicio'],$_POST['HoraTermino'],$productoSel,$_POST['Motivo'],$_POST['Responsable'],$_POST['Observaciones'],$con);

echo 1;

}else{

$sql_insert1 = "INSERT INTO tb_dispensarios_bitacora (
folio,
id_dispensario,
fecha,
hora_inicio,
hora_termino,
lado,
producto,
motivo,
responsable,
observaciones,
estado
)
VALUES 
(
'".$folio."',
'".$_POST['Dispensario']."',
'".$_POST['Fecha']."',
'".$_POST['HoraInicio']."',
'".$_POST['HoraTermino']."',
'".$_POST['Lado']."',
'".$_POST['producto1'].$Coma1.$producto2.$Coma2.$producto3."',
'".$_POST['Motivo']."',
'".$_POST['Responsable']."',
'".$_POST['Observaciones']."',
1
)";


if(mysqli_query($con, $sql_insert1)){
echo 1;
}else{
echo 2;
}

}
*/

//------------------
mysqli_close($con);
//------------------