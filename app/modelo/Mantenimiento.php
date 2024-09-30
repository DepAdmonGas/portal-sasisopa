<?php


class Mantenimiento
{
	
	function __construct()
	{
	
	}

function IdMantenimiento($con){

   $sql_reporte = "SELECT id FROM po_mantenimiento_verificar ORDER BY id desc LIMIT 1";
   $result_reporte = mysqli_query($con, $sql_reporte);
   $numero_reporte = mysqli_num_rows($result_reporte);

   if ($numero_reporte == 0) {
   $Id = 1;
   }else{
   while($row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC)){
   $Id = $row_reporte['id'] + 1;
   }
   }

   return $Id;

   }

   function Folio($idEstacion, $IdEquipo, $fecha_del_dia, $con){

   $sql_reporte = "SELECT id,folio,fechacreacion FROM po_mantenimiento_verificar WHERE id_estacion = '".$idEstacion."' AND id_equipo = '".$IdEquipo."' ORDER BY id desc LIMIT 1";
   $result_reporte = mysqli_query($con, $sql_reporte);
   $numero_reporte = mysqli_num_rows($result_reporte);

   if($numero_reporte != 0){
    while($row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC)){
    $NoFolio = $row_reporte['folio'];
    $FechaConsulta = $row_reporte['fechacreacion'];
    }

    $ExplodeFA = explode("-", $fecha_del_dia);
    $ExplodeFC = explode("-", $FechaConsulta);

    $YearFA = $ExplodeFA[0];
    $YearFC = $ExplodeFC[0];

    if($YearFA == $YearFC){
        $Folio = $NoFolio + 1;
    }else{
        $Folio = 1;
    }

   }else{
    $Folio = 1;
   }

   return $Folio;

   }

   function IdEquipo($Equipo,$con){

   $sql_equipo = "SELECT id FROM po_mantenimiento_lista WHERE detalle = '".$Equipo."'";
   $result_equipo = mysqli_query($con, $sql_equipo);
   $numero_equipo = mysqli_num_rows($result_equipo);

   while($row_equipo = mysqli_fetch_array($result_equipo, MYSQLI_ASSOC)){
   $IdEquipo = $row_equipo['id'];
   }

    return $IdEquipo;

   }

   function ValidaEquipo($idEstacion, $IdEquipo, $fecha_del_dia, $con){

   $sql_equipo = "SELECT id FROM po_mantenimiento_verificar WHERE id_estacion = '".$idEstacion."' AND id_equipo = '".$IdEquipo."' AND fechacreacion = '".$fecha_del_dia."' LIMIT 1 ";
   $result_equipo = mysqli_query($con, $sql_equipo);
   $numero_equipo = mysqli_num_rows($result_equipo);

   if ($numero_equipo == 0) {
    $Result = 0;
   }else{
    $Result = 1;
   }

   return $Result;

   }

function MantenimientoDia($idEstacion, $fecha_del_dia, $hora_del_dia, $con){

$IdMantenimiento = $this->IdMantenimiento($con);
$Equipo = "Limpieza";
$IdEquipo = $this->IdEquipo($Equipo,$con);
$NumeroFolio = $this->Folio($idEstacion, $IdEquipo, $fecha_del_dia, $con);

$ValidaEquipo = $this->ValidaEquipo($idEstacion, $IdEquipo, $fecha_del_dia, $con);

if ($ValidaEquipo == 0) {

$sql_insert = "INSERT INTO po_mantenimiento_verificar (
id,
folio,
id_estacion,
id_equipo,
fechacreacion,
horacreacion,
estado
)
VALUES 
(
'".$IdMantenimiento."',
'".$NumeroFolio."',
'".$idEstacion."',
'".$IdEquipo."',
'".$fecha_del_dia."',
'".$hora_del_dia."',
0
)";

if (mysqli_query($con, $sql_insert)) {

$this->InsertDetalle($idEstacion, $IdMantenimiento, $IdEquipo, $con);

} 

}

}
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------

function MantenimientoSemanal($idEstacion, $fecha_del_dia, $hora_del_dia, $con){

  $sql_equipo = "SELECT
  po_mantenimiento_lista.id,
  po_mantenimiento_lista.num_lista,
  po_mantenimiento_lista.detalle,
  po_mantenimiento_lista.periodicidad,
  po_programa_anual_mantenimiento_calendario.fecha
  FROM po_mantenimiento_lista 
  INNER JOIN po_programa_anual_mantenimiento_calendario 
  ON po_mantenimiento_lista.id = po_programa_anual_mantenimiento_calendario.id_mantenimiento 
  WHERE po_programa_anual_mantenimiento_calendario.id_estacion = '".$idEstacion."' AND po_programa_anual_mantenimiento_calendario.fecha = '".$fecha_del_dia."' ";
  $result_equipo = mysqli_query($con, $sql_equipo);
  $numero_equipo = mysqli_num_rows($result_equipo);
  while($row_equipo = mysqli_fetch_array($result_equipo, MYSQLI_ASSOC)){

    $IdEquipo = $row_equipo['id'];
    $ValidaEquipo = $this->ValidaEquipo($idEstacion, $IdEquipo, $fecha_del_dia, $con);

    if ($ValidaEquipo == 0) {
      $IdMantenimiento = $this->IdMantenimiento($con);
      $NumeroFolio = $this->Folio($idEstacion, $IdEquipo, $fecha_del_dia, $con);

      $sql_insert = "INSERT INTO po_mantenimiento_verificar (
      id,
      folio,
      id_estacion,
      id_equipo,
      fechacreacion,
      horacreacion,
      estado
      )
      VALUES 
      (
      '".$IdMantenimiento."',
      '".$NumeroFolio."',
      '".$idEstacion."',
      '".$IdEquipo."',
      '".$fecha_del_dia."',
      '".$hora_del_dia."',
      0
      )";

      if (mysqli_query($con, $sql_insert)) {
        if($IdEquipo == 48){
          $this->InsertDetalleDetectorHumo($IdMantenimiento, $idEstacion, $con);
        }else{
          $this->InsertDetalle($idEstacion, $IdMantenimiento, $IdEquipo, $con); 
        }
      }
    }

  }
  
}

function InsertDetalleDetectorHumo($IdMantenimiento, $idEstacion, $con){

  $sql = "SELECT id FROM tb_detector_humo 
  WHERE id_estacion = '".$idEstacion."' AND estado = 1 ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);

  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
  $idDetector = $row['id'];

  $sql_insert = "INSERT INTO po_mantenimiento_detector_humo (
  id_verificar,
  id_detector,
  revision,
  resultado
  )
  VALUES 
  ('".$IdMantenimiento."','".$idDetector."','Revisión auditiva (Emisión de sonido)',''),
  ('".$IdMantenimiento."','".$idDetector."','Revisión visual (Emisión de luz indicadora)',''),
  ('".$IdMantenimiento."','".$idDetector."','¿El funcionamiento del detector es el óptimo?',''),
  ('".$IdMantenimiento."','".$idDetector."','¿Requiere cambio de batería?','')";
  mysqli_query($con, $sql_insert);
  }

 }
//--------------------------------------------------------------------
//--------------------------------------------------------------------
function InsertDetalle($idEstacion,$IdMantenimiento, $IdEquipo, $con){

   $sql_equipo = "SELECT id FROM po_mantenimiento_detalle WHERE id_lista = '".$IdEquipo."'";
   $result_equipo = mysqli_query($con, $sql_equipo);
   $numero_equipo = mysqli_num_rows($result_equipo);

   while($row_equipo = mysqli_fetch_array($result_equipo, MYSQLI_ASSOC)){
   $ID = $row_equipo['id'];

   if($IdEquipo == 45){
   $Resultado = $this->ValidaVaDe($idEstacion,$IdEquipo,$ID,$con);
   }else{
    $Resultado = "";
   }

   $sql_insert = "INSERT INTO po_mantenimiento_verificar_detalle (
    id_verificar,
    id_detalle,
    resultado
    )
    VALUES 
    (
    '".$IdMantenimiento."',
    '".$ID."',
    '".$Resultado."'
    )";
    mysqli_query($con, $sql_insert);

    }

}

function ValidaVaDe($idEstacion,$IdEquipo,$ID,$con){

$sql_equipo = "SELECT
po_mantenimiento_verificar.id,
po_mantenimiento_verificar_detalle.resultado
FROM po_mantenimiento_verificar 
INNER JOIN po_mantenimiento_verificar_detalle 
ON po_mantenimiento_verificar.id = po_mantenimiento_verificar_detalle.id_verificar
WHERE po_mantenimiento_verificar.id_estacion = '".$idEstacion."' AND 
po_mantenimiento_verificar.id_equipo = '".$IdEquipo."' AND 
po_mantenimiento_verificar_detalle.id_detalle = '".$ID."'
ORDER BY po_mantenimiento_verificar.id DESC LIMIT 1";
$result_equipo = mysqli_query($con, $sql_equipo);
$numero_equipo = mysqli_num_rows($result_equipo);
if($numero_equipo > 0){
while($row_equipo = mysqli_fetch_array($result_equipo, MYSQLI_ASSOC)){ 
$Resultado = $row_equipo['resultado'];
}  
}else{
$Resultado = "";  
}

return $Resultado;
}

//------------------------------------------------------------------------------------------------

function IdProgramaAnual($idEstacion, $fecha_del_dia, $con){
  
	 $explode = explode("-", $fecha_del_dia);
	 $year = $explode[0];

   $sql_year = "SELECT id, id_estacion FROM po_programa_anual_mantenimiento WHERE id_estacion = '".$idEstacion."' AND year = '".$year."' ";
   $result_year = mysqli_query($con, $sql_year);
   $numero_year = mysqli_num_rows($result_year);
   while($row_year = mysqli_fetch_array($result_year, MYSQLI_ASSOC)){
   $IdYear = $row_year['id'];
   }

   return $IdYear;
}

function nombremes($mes){

if ($mes=="01") $mes="enero";
if ($mes=="02") $mes="febrero";
if ($mes=="03") $mes="marzo";
if ($mes=="04") $mes="abril";
if ($mes=="05") $mes="mayo";
if ($mes=="06") $mes="junio";
if ($mes=="07") $mes="julio";
if ($mes=="08") $mes="agosto";
if ($mes=="09") $mes="septiembre";
if ($mes=="10") $mes="octubre";
if ($mes=="11") $mes="noviembre";
if ($mes=="12") $mes="diciembre";

return $mes;
}

function MantenimientoCalendario($idEstacion, $fecha_del_dia, $hora_del_dia, $con){

	$explode = explode("-", $fecha_del_dia);
	$mes = nombremes($explode[1]);
  $IdProgramaAnual = $this->IdProgramaAnual($idEstacion, $fecha_del_dia, $con);
  $this->Mantenimiento($idEstacion, $IdProgramaAnual, $mes, $fecha_del_dia, $hora_del_dia, $con);

}

function Mantenimiento($idEstacion, $IdProgramaAnual, $mes, $fecha_del_dia, $hora_del_dia, $con){
	
   $sql_equipo = "SELECT id_programa_fecha, id_mantenimiento FROM po_programa_anual_mantenimiento_detalle WHERE id_programa_fecha = '".$IdProgramaAnual."' AND $mes = '".$fecha_del_dia."' ";
   $result_equipo = mysqli_query($con, $sql_equipo);
   $numero_equipo = mysqli_num_rows($result_equipo);
   while($row_equipo = mysqli_fetch_array($result_equipo, MYSQLI_ASSOC)){
   $idmantenimiento = $row_equipo['id_mantenimiento'];

   $ValidaEquipo = $this->ValidaEquipo($idEstacion, $idmantenimiento, $fecha_del_dia, $con);

if ($ValidaEquipo == 0) {

  $IdMantenimiento = $this->IdMantenimiento($con);
  $NumeroFolio = $this->Folio($idEstacion, $idmantenimiento, $fecha_del_dia, $con);

  $sql_insert = "INSERT INTO po_mantenimiento_verificar (
  id,
  folio,
  id_estacion,
  id_equipo,
  fechacreacion,
  horacreacion,
  estado
  )
  VALUES 
  (
  '".$IdMantenimiento."',
  '".$NumeroFolio."',
  '".$idEstacion."',
  '".$idmantenimiento."',
  '".$fecha_del_dia."',
  '".$hora_del_dia."',
  0
  )";

  if (mysqli_query($con, $sql_insert)) {

  if ($idmantenimiento == 20) {
  $this->InsertDetalleExtintor($IdMantenimiento, $idEstacion, $con); 
  }else if ($idmantenimiento == 46){
  $this->InsertDetalle($idEstacion, $IdMantenimiento, $idmantenimiento, $con);
  $this->InsertDetalleHermeticidad($IdMantenimiento, $idEstacion, $con); 
  }else{
  $this->InsertDetalle($idEstacion, $IdMantenimiento, $idmantenimiento, $con); 
  }

  } 
  }
  }
  }

  function InsertDetalleExtintor($IdMantenimiento, $idEstacion, $con){

   $sql_extintor = "SELECT id FROM po_extintores_estacion WHERE id_estacion = '".$idEstacion."' AND estado = 1";
   $result_extintor = mysqli_query($con, $sql_extintor);
   $numero_extintor = mysqli_num_rows($result_extintor);

   while($row_extintor = mysqli_fetch_array($result_extintor, MYSQLI_ASSOC)){
   $IdExtintor = $row_extintor['id'];

   $sql_insert = "INSERT INTO po_extintores_estacion_detalle(
   id_verificar,
   id_extintor,
   manometro,
   boquilla_descarga,
   manguera,
   funcionalidad,
   observaciones
   )
   VALUES 
   (
   '".$IdMantenimiento."',
   '".$IdExtintor."',
   '',
   '',
   '',
   '',
   ''
   )";
   mysqli_query($con, $sql_insert);
   }

  }

//---------------------------------------------------------------
//---------------------------------------------------------------

  function InsertDetalleHermeticidad($IdMantenimiento, $idEstacion, $con){

   $sql = "SELECT id FROM tb_tanque_almacenamiento 
   WHERE id_estacion = '".$idEstacion."' ";
   $result = mysqli_query($con, $sql);
   $numero = mysqli_num_rows($result);

   while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
   $idTanque = $row['id'];

   $sql_insert = "INSERT INTO po_mantenimiento_prueba_hermeticidad (
   id_verificar,
   id_tanque,
   fecha,
   hora_inicio,
   hora_termino,
   resultado
   )
   VALUES 
   (
   '".$IdMantenimiento."',
   '".$idTanque."',
   '',
   '',
   '',
   ''
   )";
   mysqli_query($con, $sql_insert);
   }

  }

//---------------------------------------------------------------
//---------------------------------------------------------------

}
?>