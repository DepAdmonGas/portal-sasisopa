<?php
require('../../../app/help.php');

$Id = $_POST['Id'];
$Equipo = $_POST['Equipo'];

$sqlCE = "SELECT * FROM tb_calibracion_equipos WHERE id = '".$Id."' ";
$resultCE = mysqli_query($con, $sqlCE);
$numeroCE = mysqli_num_rows($resultCE);
while($rowCE = mysqli_fetch_array($resultCE, MYSQLI_ASSOC)){
$Fecha = $rowCE['fecha'];
$FolioActual = $rowCE['folio'];
$Categoria = $rowCE['categoria'];
}

$ID = ID($con);
$Folio = Folio($Session_IDEstacion,$Equipo,$con);
Actualizar($Id,$con);

if($Equipo == 'Dispensario'){

if($Categoria == 1){
Agregar($Session_IDEstacion,$Session_IDUsuarioBD,$ID,$Folio,$Equipo,$Fecha,$con);
Bitacora($Id,$Session_IDEstacion,$Session_IDUsuarioBD,$con);
Dispensarios($ID,$Session_IDEstacion,$con); 
}else{

if($FolioActual != 1){
$FechaAnterior = ValidaAnterior($Session_IDEstacion,$FolioActual,$con);
Agregar($Session_IDEstacion,$Session_IDUsuarioBD,$ID,$Folio,$Equipo,$FechaAnterior,$con);
Bitacora($Id,$Session_IDEstacion,$Session_IDUsuarioBD,$con);
Dispensarios($ID,$Session_IDEstacion,$con);
}

}

}else if($Equipo == 'Jarra patron'){

Agregar($Session_IDEstacion,$Session_IDUsuarioBD,$ID,$Folio,$Equipo,$Fecha,$con);
JarraPatron($ID,$Session_IDEstacion,$con); 

}else if($Equipo == 'Sondas de medición'){

Agregar($Session_IDEstacion,$Session_IDUsuarioBD,$ID,$Folio,$Equipo,$Fecha,$con);
SondasMedicion($ID,$Session_IDEstacion,$con); 

}else if($Equipo == 'Tanques de almacenamiento'){

Agregar($Session_IDEstacion,$Session_IDUsuarioBD,$ID,$Folio,$Equipo,$Fecha,$con);
Tanques($ID,$Session_IDEstacion,$con); 

}


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

   function Actualizar($Id,$con){

  $sql = "UPDATE tb_calibracion_equipos SET
  estado = 1
  WHERE id = '".$Id."' ";
  mysqli_query($con, $sql);

   }

  function Agregar($IDEstacion,$IDUsuarioBD,$ID,$Folio,$Equipo,$Fecha,$con){

    if($Equipo == 'Dispensario'){
    $FechaCali = date("Y-m-d",strtotime($Fecha."+ 6 month")); 
    }else if($Equipo == 'Jarra patron'){
    $FechaCali = date("Y-m-d",strtotime($Fecha."+ 1 year"));  
    }else if($Equipo == 'Sondas de medición'){
    $FechaCali = date("Y-m-d",strtotime($Fecha."+ 2 year"));  
    }else if($Equipo == 'Tanques de almacenamiento'){
    $FechaCali = date("Y-m-d",strtotime($Fecha."+ 10 year"));  
    }

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
  '".$FechaCali."',
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

  function Bitacora($ID,$IDEstacion,$IDUsuario,$con){

  $sqlCE = "SELECT * FROM tb_calibracion_equipos WHERE id = '".$ID."' ";
$resultCE = mysqli_query($con, $sqlCE);
$numeroCE = mysqli_num_rows($resultCE);
while($rowCE = mysqli_fetch_array($resultCE, MYSQLI_ASSOC)){
$Folio = $rowCE['folio'];
$Fecha = $rowCE['fecha'];
$Hora = $rowCE['hora'];
$Observaciones = $rowCE['observaciones'];
$Responsableveri = $rowCE['responsable_verificacion'];
$Estado = $rowCE['estado'];
}

  $sql = "SELECT id_dispensario FROM tb_calibracion_equipos_dispensario WHERE id_calibracion = '".$ID."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

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
    '".$row['id_dispensario']."',
    '".$Fecha."',
    '".$Hora."',
    '',
    '',
    '',
    'CALI',
    'Ajuste',
    '".$IDUsuario."',
    ''
    )";

    mysqli_query($con, $sql_insert1);

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

function ValidaAnterior($IDEstacion,$FolioActual,$con){

$FolioAnterior = $FolioActual - 1;

$sql = "SELECT id FROM tb_calibracion_equipos WHERE id_estacion = '".$IDEstacion."' AND folio = '".$FolioAnterior."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
  $return = $row['fecha'];
  }  

  return $return;
}

//------------------
mysqli_close($con);
//------------------