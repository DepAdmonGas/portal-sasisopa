<?php
require('../../../app/help.php');

$Equipo = $_POST['Equipo'];

$sqlCE = "SELECT id FROM tb_calibracion_equipos WHERE id_estacion = '".$Session_IDEstacion."' AND equipo = '".$Equipo."' AND estado = 0 ORDER BY id DESC LIMIT 1 ";
$resultCE = mysqli_query($con, $sqlCE);
$numeroCE = mysqli_num_rows($resultCE);

if($numeroCE == 0){

$ID = ID($con);
$Folio = Folio($Session_IDEstacion,$Equipo,$con);
$Agregar = Agregar($Session_IDEstacion,$Session_IDUsuarioBD,$ID,$Folio,$Equipo,$con);

if($Agregar == 1){

if($Equipo == 'Dispensario'){
Dispensarios($ID,$Session_IDEstacion,$con);	
}else if($Equipo == 'Jarra patron'){
JarraPatron($ID,$Session_IDEstacion,$con); 
}else if($Equipo == 'Sondas de medición'){
SondasMedicion($ID,$Session_IDEstacion,$con); 
}else if($Equipo == 'Tanques de almacenamiento'){
Tanques($ID,$Session_IDEstacion,$con); 
}

echo $ID;
}

}else{

while($rowCE = mysqli_fetch_array($resultCE, MYSQLI_ASSOC)){
$ID = $rowCE['id'];
}

echo $ID;
}

//------------------------------------------------------------------------------------------
   function ID($con){
   $sql = "SELECT id FROM tb_calibracion_equipos ORDER BY id DESC LIMIT 1";
   $result = mysqli_query($con, $sql);
   $numero = mysqli_num_rows($result);
   if($numero != 0){
   while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
   $id = $row['id'];
   }
   $NoID = $id + 1;
   }else{
   $NoID = 1;
   }
   return $NoID;
   }

   function Folio($idEstacion,$Equipo,$con){
   $sql = "SELECT folio FROM tb_calibracion_equipos WHERE id_estacion = '".$idEstacion."' AND equipo = '".$Equipo."' ORDER BY folio DESC LIMIT 1";
   $result = mysqli_query($con, $sql);
   $numero = mysqli_num_rows($result);
   if($numero != 0){
   while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
   $NoFolio = $row['folio'];
   }
   $Folio = $NoFolio + 1;
   }else{
   $Folio = 1;
   }
   return $Folio;
   }

  function Agregar($IDEstacion,$IDUsuarioBD,$ID,$Folio,$Equipo,$con){
  $sql = "INSERT INTO tb_calibracion_equipos (
  id,
  id_estacion,
  id_usuario,
  folio,
  fecha,
  hora,
  fecha_termino,
  hora_termino,
  equipo,
  observaciones,
  responsable_verificacion,
  resultados,
  categoria,
  estado
  )
  VALUES (
  '".$ID."',
  '".$IDEstacion."',
  '".$IDUsuarioBD."',
  '".$Folio."',
  '',
  '',
  '',
  '',
  '".$Equipo."',
  '',
  '',
  '',
  1,
  0
  )";
  if(mysqli_query($con, $sql)){
  $Return = 1;
  }else{
  $Return = 0;
  }

  return $Return;
  }

  function Dispensarios($ID,$IDEstacion,$con){

  Detalle($ID,'Unidad de verificación', $con);
  Detalle($ID,'No. de acreditación', $con);

  $sql = "SELECT id FROM tb_dispensarios WHERE id_estacion = '".$IDEstacion."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

  $sql = "INSERT INTO tb_calibracion_equipos_dispensario (
  id_calibracion,
  id_dispensario,
  resultado1,
  resultado2,
  resultado3,
  resultado4
  )
  VALUES (
  '".$ID."',
  '".$row['id']."',
  '',
  '',
  '',
  ''
  )";

  mysqli_query($con, $sql);
  
  }

  return 1;

  }

  function JarraPatron($ID,$IDEstacion,$con){

  Detalle($ID,'Temperatura ambiente', $con);
  Detalle($ID,'Presión atmosférica', $con);
  Detalle($ID,'Humedad', $con);
  Detalle($ID,'Liquido usado en la calibración', $con);
  Detalle($ID,'Temperatura del líquido', $con);
  Detalle($ID,'Laboratorio de calibración', $con);
  Detalle($ID,'No. de acreditación', $con);
  Detalle($ID,'Método de calibración', $con);

  $sql = "SELECT id FROM tb_jarra_patron WHERE id_estacion = '".$IDEstacion."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

  $sql = "INSERT INTO tb_calibracion_equipos_jarra (
  id_calibracion,
  id_jarra,
  resultado1
  )
  VALUES (
  '".$ID."',
  '".$row['id']."',
  ''
  )";

  mysqli_query($con, $sql);
  
  }

  return 1;

  }

  function SondasMedicion($ID,$IDEstacion,$con){

  Detalle($ID,'Unidad de verificación', $con);
  Detalle($ID,'No. de acreditación', $con);
  Detalle($ID,'Método usado para la calibración', $con);

  $sql = "SELECT id FROM tb_sondas_medicion WHERE id_estacion = '".$IDEstacion."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

  $sql = "INSERT INTO tb_calibracion_equipos_sonda (
  id_calibracion,
  id_sonda,
  resultado1
  )
  VALUES (
  '".$ID."',
  '".$row['id']."',
  ''
  )";

  mysqli_query($con, $sql);
  
  }

  return 1;
  }

  function Tanques($ID,$IDEstacion,$con){

  Detalle($ID,'Unidad de verificación', $con);
  Detalle($ID,'No. de acreditación', $con);
  Detalle($ID,'Método usado para la calibración', $con);

  $sql = "SELECT id FROM tb_tanque_almacenamiento WHERE id_estacion = '".$IDEstacion."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

  $sql = "INSERT INTO tb_calibracion_equipos_tanques (
  id_calibracion,
  id_tanque,
  resultado1,
  resultado2,
  resultados
  )
  VALUES (
  '".$ID."',
  '".$row['id']."',
  '',
  '',
  ''
  )";

  mysqli_query($con, $sql);
  
  }

  return 1;

  }

  function Detalle($ID,$Categoria,$con){
  $sql = "INSERT INTO tb_calibracion_equipos_detalle (
  id_calibracion,
  categoria,
  resultado
  )
  VALUES (
  '".$ID."',
  '".$Categoria."',
  ''
  )";
  if(mysqli_query($con, $sql)){
  $Return = 1;
  }else{
  $Return = 0;
  }
  return $Return;
  }



//------------------
mysqli_close($con);
//------------------